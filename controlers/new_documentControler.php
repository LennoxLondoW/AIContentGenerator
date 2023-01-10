<?php
/*main operation file*/
require_once '../app/extensions/app.element.php';
require_once '../app/extensions/app.validation.php';
require_once '../app.extensions/app.front.extension.php';
//loging in check
if (!isset($_SESSION['email'])) {
	// do something
	$_SESSION['current_page'] = $_SERVER['REQUEST_URI'];
	header('location:' . base_path . "sign_in");
	die();
} else {
	// do something
	// if(!isset($_SESSION['admin_edits'])){
	// 	header('location:' . $page );
	// }
}



//this validates the name of the file and the csrf token 


if (isset($_POST['generate'])) {
	// instantiate validation class 
	$validation = new Validation();
	// validate csrf token 
	$validation->csrf();

	//lets name to to database // only alhanumerals allowed 
	if (!$validation->is_alphanumeral($_POST['document_name'])) {
		$validation->report("Error! only alphabets and white space allowed on document name");
	}

	// fetch token balance 
	$element = new Element();
	$element->activeTable = "lentec_user_tokens";
	$element->comparisons = [["client_id", " = ", $_SESSION['email']], ["expire", " > ", date("Y-m-d")]];
	$element->joiners = ['', ' && '];
	$element->order = " BY id DESC ";
	$element->cols = " SUM(tokens) as tokens";
	$element->limit = 1;
	$element->offset = 0;
	$data = $element->getData();
	if (count($data) > 0) {
		$tokens = $_SESSION['tokens'] = $data[0]["tokens"];
	} else {
		$tokens = 0;
	}




	// //check if the tokens requested are enough
	// $element = new Element();
	// $element->activeTable = "lentec_user_tokens";
	// $element->comparisons = [["client_id", " = ", $_SESSION['email']]];
	// $element->joiners = [''];
	// $element->order = " BY id DESC ";
	// $element->cols = "*";
	// $element->limit = 1;
	// $element->offset = 0;
	// $data = $element->getData();
	// if (count($data) > 0) {
	// 	$tokens = $_SESSION['tokens'] = $data[0]["tokens"];
	// } else {
	// 	$validation->report("Error! Please recharge your tokens and try again. Token balance: 0");
	// }
	// we have fetched user tokens for this user 

	// now compare it to intented token 
	if ($tokens < $_POST['tokens']) {
		$validation->report("Error! Please recharge your tokens and try again. Token balance: " . $tokens);
	}



	// lets check if the supplied name already exist if not updating
	if (!isset($_POST['update_document'])) {
		$validation->activeTable = "lentec_user_document";
		$validation->comparisons = [["document_id", " = ", md5($_SESSION['email'] . $_POST['document_name'])]]; //what to campre
		$validation->joiners = ['']; //logic || or &&
		$validation->offset = 0;
		$validation->limit = 1;
		// chek if the supplied name exist
		if (count($validation->getData()) > 0) {
			$validation->report("Error! the supplied document name already exists");
		}
	}


	//reject empty instruction
	if (empty($_POST['genetator_instructions'])) {
		$validation->report("The requested content cannot be an empty string.");
	}

	//so here we sent the provided instructions to the API
	//this will return a json output that can be stored in a database or error
	//fetch the app url from table
	$ai_path = new Element();
	$ai_path->activeTable = "lentec_new_document";
	$ai_path->comparisons = [["section_id", " = ", "python_app"]];
	$ai_path->joiners = [''];
	$ai_path->order = " BY id DESC ";
	$ai_path->cols = "section_id, section_title";
	$ai_path->limit = 1;
	$ai_path->offset = 0;

	$_data = $ai_path->getData();

	$url = $_data[0]['section_title'];

	//check if url is okay
	if (!filter_var($url, FILTER_VALIDATE_URL)) {
		$validation->report("Error! Please update the python AI application path");
	}


	//fetch app url from table
	$content = file_get_contents($url . '?tokens=' . $_POST['tokens'] . '&prompt=' . urlencode($_POST['genetator_instructions']));
	//lets decode json
	$array = json_decode($content, true);

	if (!isset($array['choices'][0]['text'])) {

		file_put_contents("errors.txt", $content);
		// report error to user from the api 
		$validation->report("Something unusual just happened, please try again.");
	}

	// tokens that have been used  
	$used_tokens = $array['usage']['total_tokens'];


	// since everything is okay, we can update the tokens here 
	//first lets fetch all active subscriptions in the order of expire dates 
	$element = new Element();
	$element->activeTable = "lentec_user_tokens";
	$element->comparisons = [["client_id", " = ", $_SESSION['email']], ["expire", " > ", date("Y-m-d")]];
	$element->joiners = ['', ' && '];
	$element->order = " BY expire ASC ";
	$element->cols = "id,tokens";
	$element->limit = 1000;
	$element->offset = 0;
	$data = $element->getData();


	$element->joiners = [''];
	//lets loop while updating bundles 
	foreach ($data as $key => $value) {
		$this_token = $value['tokens'];
		$this_token -= $used_tokens;

		$break = false;

		if ($this_token < 0) {
			$used_tokens = 0 - $this_token;
			$this_token = 0;
		} else {
			$break = true;
		}

		// here we update 
		$element->comparisons = [["id", " = ", $value['id']]];
		$element->update_data = [
			"tokens" => $this_token
		];

		if (!$element->updateData()) {
			$element->report('Something wrong has happened, please try again');
		}
		//if break ... break
		if ($break) {
			break;
		}
	}
	if (isset($_SESSION['tokens'])) {
		unset($_SESSION['tokens']);
	}

	if (isset($_SESSION['active_subscription'])) {
		unset($_SESSION['active_subscription']);
	}

	if (isset($_SESSION['balance'])) {
		unset($_SESSION['balance']);
	}

	// all deductions has been done 


	// lets store this result in a database 
	$validation->activeTable = "lentec_user_document";
	$validation->insertData = [
		[
			"document_id" => $id = md5($_SESSION['email'] . $_POST['document_name']),
			"document_name" => $_POST['document_name'],
			"user_email" => $_SESSION['email'],
			"tokens" => $_POST['tokens'],
			"document_content" => $array['choices'][0]['text'],
			"document_question" => $_POST['genetator_instructions'],
			"finish_reason" => $array['choices'][0]['finish_reason'],
			"total_tokens" => $array['usage']['total_tokens'],
		]
	];


	// store data in the database 
	//fields to upate incase of updating 
	$save = $validation->saveData(['document_content', 'document_question', 'tokens','finish_reason','total_tokens']);
	if ($save === "success") {
		if (isset($_SESSION['my_documents'])) {
			unset($_SESSION['my_documents']);
		}
		//here relocate to that document
		die(" 
		        $(`input[name='csrf_token']`).val(`" . $_SESSION['csrf_token'] . "`);
		        form.prepend(`<a id='view_doc' href='" . base_path . "view_document/document_id/" . urlencode($id) . "'></a>`); 
				$('#view_doc').trigger('click')");
	} else {
		// /report an error 
		$validation->report('Something is not right, please try again.' . $save);
	}
}



// fetch data required for this page 
$element = new Element();
$element->activeTable = "lentec_new_document";
$element->comparisons = [];
$element->joiners = [''];
$element->order = " BY id DESC ";
$element->cols = "section_id, section_title";
$element->limit = 1000;
$element->offset = 0;
/*get_data*/
$data = $element->GetElementData();


