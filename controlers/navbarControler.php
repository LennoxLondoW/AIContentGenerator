<?php
/*main operation file*/
require_once '../app/extensions/app.element.php';
// $_SESSION['admin_edits'] = 'set';
//loging in


if (isset($_GET['logout'])) {
	session_unset();
	session_destroy();
	header('location:' . base_path . "home");
	die();
}

$element = new Element();
//fetch this page data
$element->activeTable = "lentec_navbar";
$element->comparisons = [];
$element->joiners = [''];
$element->order = " BY id DESC ";
$element->cols = "section_id, section_title";
$element->limit = 1000;
$element->offset = 0;


/*get_data*/
$data = $element->GetElementData();

if(isset($_GET['cancel'])){
	$_SESSION['sub'] = "done";
}

///you can check if this user has subscribed 
if (isset($_SESSION['email']) && !isset($_SESSION['sub'])) {
	$sub_data = new Element();
	//fetch this page data
	$sub_data->activeTable = "lentec_user_cards";
	$sub_data->comparisons = [['account_email', ' = ', $_SESSION['email']]];
	$sub_data->joiners = [''];
	$sub_data->order = " BY id DESC ";
	$sub_data->cols = "*";
	$sub_data->limit = 1;
	$sub_data->offset = 0;


	/*get_data*/
	$data = $sub_data->getData();


	if(count($data) === 0){
		$_SESSION['sub'] = "set";
	} else{
		$_SESSION['sub'] = "done";
	}
}
