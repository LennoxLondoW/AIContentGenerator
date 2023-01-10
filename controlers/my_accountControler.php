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

$balance = $tokens = $my_documents = $trash = 0;
$active_subscription = [];

// fetch dashboard details 
// fetch balance 
if (isset($_SESSION['balance'])) {
	$balance = $_SESSION['balance'];
} else {
	$element = new Element();
	$element->activeTable = "single_payment_receipts";
	$element->comparisons = [["client_id", " = ", $_SESSION['email']]];
	$element->joiners = [''];
	$element->order = " BY id DESC ";
	$element->cols = "*";
	$element->limit = 1;
	$element->offset = 0;
	$data = $element->getData();
	if (count($data) > 0) {
		$balance = $_SESSION['balance'] = $data[0]["amount"];
	}
}
//fetch documents
if (isset($_SESSION['my_documents'])) {
	$my_documents = $_SESSION['my_documents'];
} else {
	$element = new Element();
	$element->activeTable = "lentec_user_document";
	$element->comparisons = [["user_email", " = ", $_SESSION['email']]];
	$element->joiners = [''];
	$element->order = " BY id DESC ";
	$element->cols = "COUNT(id) as total";
	$element->limit = 1001;
	$element->offset = 0;
	$data = $element->getData();
	if (count($data) > 0) {
		$my_documents = $_SESSION['my_documents'] = $data[0]["total"];
	}
}

// fetch trash 
if (isset($_SESSION['trash'])) {
	$trash = $_SESSION['trash'];
} else {
	$element = new Element();
	$element->activeTable = "lentec_trash_document";
	$element->comparisons = [["user_email", " = ", $_SESSION['email']]];
	$element->joiners = [''];
	$element->order = " BY id DESC ";
	$element->cols = "COUNT(id) as total";
	$element->limit = 1001;
	$element->offset = 0;
	$data = $element->getData();
	if (count($data) > 0) {
		$trash = $_SESSION['trash'] = $data[0]["total"];
	}
}

//fetch tokens 
if (isset($_SESSION['tokens'])) {
	$tokens = $_SESSION['tokens'];
} else {
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
	}
}


//fetch active subscriptions
if (isset($_SESSION['active_subscription'])) {
	$active_subscription = $_SESSION['active_subscription'];
} else {
	$element = new Element();
	$element->activeTable = "lentec_user_tokens";
	$element->comparisons = [["client_id", " = ", $_SESSION['email']], ["expire", " > ", date("Y-m-d")]];
	$element->joiners = ['', ' && '];
	$element->order = " BY expire ASC ";
	$element->cols = "tokens, expire";
	$element->limit = 50;
	$element->offset = 0;
	$data = $element->getData();
	if (count($data) > 0) {
		$active_subscription = $_SESSION['active_subscription'] = $data;
	}
}





$element = new Element();
$element->activeTable = "lentec_my_account";
$element->comparisons = [];
$element->joiners = [''];
$element->order = " BY id DESC ";
$element->cols = "section_id, section_title";
$element->limit = 1000;
$element->offset = 0;
/*get_data*/
$data = $element->GetElementData();
