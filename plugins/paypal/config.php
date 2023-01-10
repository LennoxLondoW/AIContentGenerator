<?php
// configuration file
$__path__ = '../../';
require_once '../../app/app.php';
require_once "vendor/autoload.php";
$app = new App();
//check connection to database
$app->use_database();
$app->release_database();
// lets fetch paypal credentials
$app->activeTable = "lentec_paypal_credentials";
$app->comparisons = [];
$app->joiners = [''];  
$app->order = " BY id DESC ";
$app->cols = "section_id, section_title"; 
$app->limit = 1000;
$app->offset = 0;
/*get_data*/
// define paypal credentials stored in the database 
foreach ($app->getData() as $row) {
    define($row['section_id'], $row['section_title']);
}

//paypal base url 
define("paypal_base",scheme.$_SERVER['SERVER_NAME'].base_path."paypal/" );


use Omnipay\Omnipay;
//get this from paypal developers
define('CLIENT_ID', paypal_client_id);
define('CLIENT_SECRET', paypal_client_secret);
define('PAYPAL_RETURN_URL', paypal_base ."success.php".(  isset($_POST['client_id']) && !empty($_POST['client_id'])  ?"?client_id=".$_POST['client_id']:""));
define('PAYPAL_CANCEL_URL', (paypal_base."cancel.php"));
define('PAYPAL_CURRENCY', 'USD'); // set your currency here
$gateway = Omnipay::create('PayPal_Rest');
$gateway->setClientId(CLIENT_ID);
$gateway->setSecret(CLIENT_SECRET);
$gateway->setTestMode(paypal_is_test_mode); //set it to 'false' when go live

     
?>

