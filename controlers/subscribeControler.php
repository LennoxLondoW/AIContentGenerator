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




// lets subscribe token to a new user 
if (isset($_POST['tokens'])) {

	$validation = new Validation();
	//check forgery
	$validation->csrf();


	$token_index = $_POST['tokens'];
	$price_index = $_POST['price'];
	$days_index = $_POST['days'];

	//fetch price
	$element = new Element();
	$element->activeTable = "lentec_subscribe";
	$element->comparisons = [["section_id", " = ", $price_index]];
	$element->joiners = [''];
	$element->order = " BY id DESC ";
	$element->cols = "section_id, section_title";
	$element->limit = 1;
	$element->offset = 0;
	/*get_data*/
	$data = $element->getData();
	if (count($data) === 0) {
		$validation->report("Request denied");
	}
	//price to be charged
	$price = $data[0]['section_title'];

	//fetch tokens
	$element->comparisons = [["section_id", " = ", $token_index]];
	/*get_data*/
	$data = $element->getData();
	if (count($data) === 0) {
		$validation->report("Request denied");
	}
	$tokens = $data[0]['section_title'];

	//fetch days
	$element->comparisons = [["section_id", " = ", $days_index]];
	/*get_data*/
	$data = $element->getData();
	if (count($data) === 0) {
		$validation->report("Request denied");
	}
	$days = $data[0]['section_title'];


	//confirm if everything is okay 
	// $validation->report($price." ".$tokens." ".$days);

	//fetch user account balance
	$element->activeTable = "single_payment_receipts";
	$element->comparisons = [["client_id", " = ", $_SESSION['email']]];
	$element->cols = "*";
	$data = $element->getData();
	if (count($data) > 0) {
		$balance = $data[0]["amount"];
	} else{
		$balance = 0;
	}

	// check if price required is greater that token 
	if ($price > $balance) {
		die("
		        $(`input[name='csrf_token']`).val(`" . $_SESSION['csrf_token'] . "`);
				form.prepend(`Your account balance is insufficient. <a id='wallet' href='" . base_path . "purchase'>Please click here to top up</a>`); 
		");
	}

	

	//calculate expire date
    $date = date_create(date("Y-m-d"));
    date_add($date, date_interval_create_from_date_string($days." days"));
    $expire_date = date_format($date, "Y-m-d");

	//insert new subscription for this user
	$element->activeTable = "lentec_user_tokens";
	$element->insertData = [
		[
			"client_id" => $_SESSION['email'],
            "tokens" => $tokens,
            "expire" => $expire_date,

		]
	];
	if (($save = $element->saveData("tokens")) !== "success") {
		//report somethig is not right
		$validation->report("Something is not right! Please try again");
	}

	// now lets update the user balance 
	//sutract balance by token price
	$balance -= $price;

	// updating the remaining balance 
	$element->activeTable = "single_payment_receipts";
	$element->insertData = [
		[
			"client_id" => $_SESSION['email'],
			"amount" => $balance,

		]
	];
	if (($save = $element->saveData("amount")) === "success") {
		//all operations done
		if(isset($_SESSION['tokens'])){
			unset($_SESSION['tokens']);
		}

		if(isset($_SESSION['active_subscription'])){
			unset($_SESSION['active_subscription']);
		}

		if(isset($_SESSION['balance'])){
			unset($_SESSION['balance']);
		}
	
		$validation->report("You have purchased ".$tokens." tokens valid till ".$expire_date.".", "success");
	}

	//report somethig is not right
	$validation->report("Something is not right! Please try againddddd" . $save);
}

$element = new Element();
$element->activeTable = "lentec_subscribe";
$element->comparisons = [];
$element->joiners = [''];
$element->order = " BY id DESC ";
$element->cols = "section_id, section_title";
$element->limit = 1000;
$element->offset = 0;
/*get_data*/
$data = $element->GetElementData();
