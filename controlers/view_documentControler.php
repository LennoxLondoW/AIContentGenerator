<?php
/*main operation file*/
require_once '../app/extensions/app.element.php';
require_once '../app/extensions/app.validation.php';
require_once '../app.extensions/app.front.extension.php';
//loging in check
if (!isset($_SESSION['email'])) {
	//do something
	$_SESSION['current_page'] = $_SERVER['REQUEST_URI'];
	header('location:' . base_path . "sign_in");
	die();
} else {
	// do something
	// if(!isset($_SESSION['admin_edits'])){
	// 	header('location:' . $page );
	// }
}


// duplicating document 
if (isset($_POST['duplicate'])) {
	$validation = new Validation();
	$validation->csrf();
	//lets fetch this document and move it to recycle bin 
	$element = new Element();
	$element->activeTable = "lentec_user_document";
	$element->comparisons = [["document_id", "=", $_POST['document_id']], ["user_email", "=", $_SESSION['email']]];
	$element->joiners = ['', '&&'];
	$element->cols = "*";
	$element->limit = 1;
	/*get_data*/
	$data = $element->getData();

	if (count($data) > 0) {
		// rename it to avoid clashing 
		unset($data[0]['id']);
		$data[0]['document_name'] .= time()." copy";
		$data[0]['document_id'] = md5($_SESSION['email'] . $data[0]['document_name']);
		$element->insertData = $data;
		// store data in the database 
		if($element->saveData(false) == "success"){
			die(" 
		        $(`input[name='csrf_token']`).val(`" . $_SESSION['csrf_token'] . "`);
		        form.prepend(`<a id='view_doc' href='" . base_path . "view_document/document_id/" . urlencode($data[0]['document_id']) . "'></a>`); 
				$('#view_doc').trigger('click')");
			
		}
		$validation->report("The requested content might have been deleted");

	}

	$validation->report("The requested content might have been deleted");
}




//editing and saving document
if (isset($_POST['edit_and_save'])) {
	// instantiate validation class 
	$validation = new Validation();
	// validate csrf token 
	$validation->csrf();

	if ($_POST['document_name_prev'] === $_POST['document_name']) {
		//check if the tokens requested are enough
		$validation->activeTable = "lentec_user_document";
		$validation->comparisons = [["document_id", "=", $_POST['document_id']], ["user_email", "=", $_SESSION['email']]];
		$validation->joiners = ['', '&&'];
		$validation->update_data = [
			"document_content" => $_POST['document_content']
		];

		if ($validation->updateData()) {
			$validation->report("Data updated successfully.", "success");
		} else {
			$validation->report("Something wrong has happened, please try again");
		}
	}

	// we do renaming check if supplied name exist
	$element = new Element();
	$element->activeTable = "lentec_user_document";
	$element->comparisons = [["document_name", "=", $_POST['document_name']], ["user_email", "=", $_SESSION['email']]];
	$element->joiners = ['', '&&'];
	$element->cols = "*";
	$element->limit = 1;
	/*get_data*/
	$data = $element->getData();

	if (count($data) > 0) {
		$validation->report("Error! The supplied content already exist");
	}

	// now lets update data 
	$validation->activeTable = "lentec_user_document";
	$validation->comparisons = [["document_id", "=", $_POST['document_id']], ["user_email", "=", $_SESSION['email']]];
	$validation->joiners = ['', '&&'];
	$validation->update_data = [
		"document_content" => $_POST['document_content'],
		"document_name" => $_POST['document_name'],
		"document_id" => $id = md5($_SESSION['email'] . $_POST['document_name']),

	];

	if ($validation->updateData()) {
		die(" 
		        $(`input[name='csrf_token']`).val(`" . $_SESSION['csrf_token'] . "`);
		        form.prepend(`<a id='view_doc' href='" . base_path . "view_document/document_id/" . urlencode($id) . "'></a>`); 
				$('#view_doc').trigger('click')");
	} else {
		$validation->report("Something wrong has happened, please try again");
	}
}

// deleting user books 
//requesting new verification link
if (isset($_POST['delete'])) {
	//check forgery
	$validation = new Validation();
	$validation->csrf();


	//lets fetch this document and move it to recycle bin 
	$element = new Element();
	$element->activeTable = "lentec_user_document";
	$element->comparisons = [["document_id", "=", $_POST['document_id']], ["user_email", "=", $_SESSION['email']]];
	$element->joiners = ['', '&&'];
	$element->cols = "*";
	$element->limit = 1;
	/*get_data*/
	$data = $element->getData();

	if (count($data) > 0) {
		// rename it to avoid clashing 
		unset($data[0]['id']);
		$arr = explode(" ", $data[0]['document_name']);
		if (is_numeric(end($arr))) {
			array_pop($arr);
		}
		$data[0]['document_name'] = implode(" ", $arr) . " " . date("YmdHis");
		$data[0]['document_id'] = md5($_SESSION['email'] . $data[0]['document_name']);
		$element->activeTable = "lentec_trash_document";
		$element->insertData = $data;
		// store data in the database 
		$element->saveData(false);
	}

	// for the purpose of restoring 

	$validation->activeTable = "lentec_user_document";
	$validation->comparisons = [["document_id", "=", $_POST['document_id']], ["user_email", "=", $_SESSION['email']]];
	$validation->joiners = ['', '&&'];
	if ($validation->deleteData()) {
		if (isset($_SESSION['my_documents'])) {
			unset($_SESSION['my_documents']);
		}

		if (isset($_SESSION['trash'])) {
			unset($_SESSION['trash']);
		}
		die(" 
		        $(`input[name='csrf_token']`).val(`" . $_SESSION['csrf_token'] . "`);
		        form.prepend(`<a id='view_doc2' href='" . base_path . "documents" . urlencode($id) . "'></a>`); 
				$('#view_doc2').trigger('click')");
	} else {
		$validation->report("Error! Something is not right, please try again.");
	}
}






// default values 
$document_id = false;
$document_name = "";
$user_email = "";
$document_content = _404;
$document_question = "";
//check if document is is set
if (isset($_GET['document_id'])) {
	// try to fetch the requested document 
	$element = new Element();
	$element->activeTable = "lentec_user_document";
	$element->comparisons = [["document_id", "=", $_GET['document_id']], ["user_email", "=", $_SESSION['email']]];
	$element->joiners = ['', '&&'];
	$element->cols = "*";
	$element->limit = 1;
	/*get_data*/
	$data = $element->getData();
	if (count($data) > 0) {
		extract($data[0]);
	}
}


$element = new Element();
$element->activeTable = "lentec_view_document";
$element->comparisons = [];
$element->joiners = [''];
$element->order = " BY id DESC ";
$element->cols = "section_id, section_title";
$element->limit = 1000;
$element->offset = 0;
/*get_data*/
$data = $element->GetElementData();
