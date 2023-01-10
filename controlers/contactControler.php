<?php
/*main operation file*/
require_once '../app/extensions/app.element.php';
require_once '../app/extensions/app.validation.php';
require_once '../app.extensions/app.front.extension.php';

//loging in check
if (!isset($_SESSION['username'])) {
	//do something
} else {
	//do something
}


if (isset($_POST['ask_email'])) {
	$validation = new Validation();
	$validation->csrf();
	$admin_email = $_POST['ask_admin_email'];
	unset($_POST['ask_admin_email']);
	unset($_POST['csrf_token']);
	unset($_POST['acceptance']);
	$validation->activeTable = "lentec_ask";
	$validation->comparisons = array_map(function ($val) {
		return [$val, " = ", strip_tags($_POST[$val])];
	}, array_keys($_POST));
	$validation->joiners = array_merge([''], array_fill(0, count($_POST) - 1, " && "));
	$validation->order = " BY id DESC ";
	$validation->cols = "*";
	$validation->limit = 1;
	$validation->offset = 0;
	$data = $validation->getData();
	//already posted
	if (count($data) > 0) {
		die("$(`input[name='csrf_token']`).val(`" . $_SESSION['csrf_token'] . "`); Swal.fire({icon:'info',text: 'Thank you. We are working on your already received query! We will get back to you.'})");
	}

	$validation->email_username = "Admin";
	$validation->email_message = $_POST['ask_message'] .
		'<br>
   								<h3>Client Details</h3>
   							 <br>
   							 <table>
   							 	<tbody>
   							 		<tr>
   							 			<td>Name:</td>
   							 			<td>' . $_POST['ask_name'] . '</td>
   							 		</tr>
   							 		<tr>
   							 			<td>Email: </td>
   							 			<td>' . $_POST['ask_email'] . '</td>
   							 		</tr>
   							 		<tr>
   							 			<td>Contacts: </td>
   							 			<td>' . $_POST['ask_tel'] . '</td>
   							 		</tr>
   							 	</tbody>
   							 </table>';
	$validation->email_subject = $_POST['ask_subject'];
	$validation->email_to = $admin_email;
	$validation->email_cc = [];
	$validation->email_attachment = false;
	// send email
	if (!$validation->send_email()) {
		$validation->report($validation->email_error);
	}

	$validation->insertData = [$_POST];
	if (($reply = $validation->saveData()) === 'success') {
		echo "$('.clr').val('');";
		$validation->report($validation->email_success, "success");
	} else {
		$validation->report($validation->email_success, "danger");
	}
}



// empain template preview
if (isset($_GET['preview'])) {
	$validation = new Validation();
	// email template
	$validation->email_username = "Preview";
	$validation->email_message = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
	$validation->email_subject = "Your subject here";

	die("<br><br>" . $validation->send_email());
}


$element = new Element();
$element->activeTable = "lentec_contact";
$element->comparisons = [];
$element->joiners = [''];
$element->order = " BY id DESC ";
$element->cols = "section_id, section_title";
$element->limit = 200;
$element->offset = 0;
/*get_data*/
$data = $element->GetElementData();
