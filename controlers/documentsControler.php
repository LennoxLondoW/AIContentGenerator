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

if (isset($_GET['search'])) {
	//search  20 documents based on user
	$frontEnd->sql_extra = " && user_email = '" . $_SESSION['email'] . "' ";
	$documents_data = $frontEnd->search(
		$table = "lentec_user_document",
		$cols = "*",
		$match = "document_name",
		$term = $_GET['search'],
		$order = " id DESC ",
		$limit = 20
	);
} else {
	// fetch latest 20 documents 
	$element = new Element();
	$element->activeTable = "lentec_user_document";
	$element->comparisons = [['user_email', ' = ', $_SESSION['email']]];
	$element->joiners = [''];
	$element->order = " BY id DESC ";
	$element->cols = "*";
	$element->limit = 20;
	$element->offset = 0;
	/*get_data*/
	$documents_data = $element->getData();
}


// fetch this page dynamic data 
$element = new Element();
$element->activeTable = "lentec_documents";
$element->comparisons = [];
$element->joiners = [''];
$element->order = " BY id DESC ";
$element->cols = "section_id, section_title";
$element->limit = 1000;
$element->offset = 0;
/*get_data*/
$data = $element->GetElementData();
