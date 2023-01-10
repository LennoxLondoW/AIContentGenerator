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




if (isset($_POST['restore'])) {
	//check forgery
	$validation = new Validation();
	$validation->csrf();


	//lets fetch this document and move it to recycle bin 
	$element = new Element();
	$element->activeTable = "lentec_trash_document";
	$element->comparisons = [["document_id", "=", $_POST['restore']], ["user_email", "=", $_SESSION['email']]];
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
		$element->activeTable = "lentec_user_document";
		$element->insertData = $data;
		// store data in the database 
		$element->saveData(false);
	}


	// for the purpose of restoring 

	$validation->activeTable = "lentec_trash_document";
	$validation->comparisons = [["document_id", "=", $_POST['restore']], ["user_email", "=", $_SESSION['email']]];
	$validation->joiners = ['', '&&'];
	if ($validation->deleteData()) {
		if (isset($_SESSION['my_documents'])) {
			unset($_SESSION['my_documents']);
		}

		if (isset($_SESSION['trash'])) {
			unset($_SESSION['trash']);
		}
		die("  $(`input[name='csrf_token']`).val(`" . $_SESSION['csrf_token'] . "`);
		        form.parents('button').fadeOut()");
	} else {
		$validation->report("Error! Something is not right, please try again.");
	}
}


if (isset($_POST['delete'])) {
	//check forgery
	$validation = new Validation();
	$validation->csrf();

	$validation->activeTable = "lentec_trash_document";
	$validation->comparisons = [["document_id", "=", $_POST['delete']], ["user_email", "=", $_SESSION['email']]];
	$validation->joiners = ['', '&&'];
	if ($validation->deleteData()) {
		if (isset($_SESSION['my_documents'])) {
			unset($_SESSION['my_documents']);
		}

		if (isset($_SESSION['trash'])) {
			unset($_SESSION['trash']);
		}
		die("   $(`input[name='csrf_token']`).val(`" . $_SESSION['csrf_token'] . "`);
		        form.parents('button').fadeOut()");
	} else {
		$validation->report("Error! Something is not right, please try again.");
	}
}







if (isset($_GET['search'])) {
	//search  20 documents based on user
	$frontEnd->sql_extra = " && user_email = '" . $_SESSION['email'] . "' ";
	$documents_data = $frontEnd->search(
		$table = "lentec_trash_document",
		$cols = "*",
		$match = "document_name",
		$term = $_GET['search'],
		$order = " id DESC ",
		$limit = 20
	);
} else {
	// fetch latest 20 documents 
	$element = new Element();
	$element->activeTable = "lentec_trash_document";
	$element->comparisons = [['user_email', ' = ', $_SESSION['email']]];
	$element->joiners = [''];
	$element->order = " BY id DESC ";
	$element->cols = "*";
	$element->limit = 20;
	$element->offset = 0;
	/*get_data*/
	$documents_data = $element->getData();
}

$element = new Element();
$element->activeTable = "lentec_trash";
$element->comparisons = [];
$element->joiners = [''];
$element->order = " BY id DESC ";
$element->cols = "section_id, section_title";
$element->limit = 1000;
$element->offset = 0;
/*get_data*/
$data = $element->GetElementData();
