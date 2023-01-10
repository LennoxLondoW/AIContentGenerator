<?php
session_start();
/*main operation file*/
$__path__ = "../../";
require_once '../../app/extensions/app.validation.php';
$validation = new Validation();
// Note this line needs to change if you don't use Composer:
// require('square-php-sdk/autoload.php');
require_once __DIR__ . '/vendor/autoload.php';
include  __DIR__ . '/utils/location-info.php';

use Dotenv\Dotenv;
use Square\SquareClient;
use Square\Models\Money;
use Square\Models\CreatePaymentRequest;
use Square\Exceptions\ApiException;

// dotenv is used to read from the '.env' file created for credentials
$dotenv = Dotenv::createImmutable((__DIR__));
$dotenv->load();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  error_log('Received a non-POST request');
  echo 'Request not allowed';
  http_response_code(405);
  return;
}

// check csrf 
if (!$validation->same_origin()) {
  error_log('Received a non-same origin request');
  echo 'Request not allowed';
  http_response_code(405);
  return;
}

$json = file_get_contents('php://input');
$data = json_decode($json);
$token = $data->token;
$amount = $data->amount;
$account_id = $data->account_id;
$idempotencyKey = $data->idempotencyKey;

$square_client = new SquareClient([
  'accessToken' => $_ENV['SQUARE_ACCESS_TOKEN'],
  'environment' => $_ENV['ENVIRONMENT'],
  'userAgentDetail' => 'sample_app_php_payment', // Remove or replace this detail when building your own app
]);

$payments_api = $square_client->getPaymentsApi();

// To learn more about splitting payments with additional recipients,
// see the Payments API documentation on our [developer site]
// (https://developer.squareup.com/docs/payments-api/overview).

$money = new Money();
// Monetary amounts are specified in the smallest unit of the applicable currency.
// This amount is in cents. It's also hard-coded for $1.00, which isn't very useful.
$money->setAmount($amount);
// Set currency to the currency for the location
$money->setCurrency($location_info->getCurrency());

try {
  // Every payment you process with the SDK must have a unique idempotency key.
  // If you're unsure whether a particular payment succeeded, you can reattempt
  // it with the same idempotency key without worrying about double charging
  // the buyer.
  $create_payment_request = new CreatePaymentRequest($token, $idempotencyKey, $money);
  $create_payment_request->setLocationId($location_info->getId());

  $response = $payments_api->createPayment($create_payment_request);

  if ($response->isSuccess()) {
    $json = json_encode($response->getResult());
    // table to store cards 
    $validation->activeTable = "lentec_card_payments";
    $validation->insertData = [
      [
        "account_id" => $account_id,
        "_date" => date("Y/m/d H:i:s"),
        "data" => $json,
      ]
    ];
    $save = $validation->saveData(false);
    if ($save === "success") {
      // check if this client exist and add total to his cash
      $this_user = new App();
      $this_user->activeTable = "single_payment_receipts";
      $this_user->comparisons = [["client_id", " = ",  $account_id]];
      $this_user->joiners = [''];
      $this_user->order = " BY id DESC ";
      $this_user->cols = "*";
      $this_user->limit = 1;
      $this_user->offset = 0;

      $data = $this_user->getData();
      //table does not exist // lets create
      if ($this_user->database_error && !$this_user->is_table($this_user->activeTable)) {
        // table doent exist// 
        require_once '../../app/extensions/app.migration.php';
        /*creting migrations*/
        $migration = new Migration();
        /* adjust tables*/
        $migration->tables =
          [
            $this_user->activeTable =>
            [
              "id int(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY",
              "client_id varchar(255)  NOT NULL UNIQUE KEY",
              "amount float(10,2) NOT NULL",
            ]
          ];

        $status = $migration->migrate();
        if ($status === "success") {
          $prev_cash = 0;
        } else {
          die(json_encode([
            'errors' => "Error! Something is not right, please try again!"
          ]));
        }
      } else {
        $prev_cash = count($data) === 0 ? 0 : $data[0]['amount'];
      }
      $this_user->activeTable = "single_payment_receipts";
      //save data for this user 
      $this_user->insertData = [
        [
          "client_id" => $account_id,
          "amount" => $prev_cash + $amount
        ]
      ];
      $save = $this_user->saveData('amount');
      if ($save === "success") {
        // report success 
        die(json_encode([
          'errors' => false
        ]));
      } else {
        // report error 
        die(json_encode([
          'errors' => "Error! Something is not right, please try again!"
        ]));
      }
    } elseif (strstr(strtolower($save), "lentec_card_payments' doesn't exist") !== false) {
      // table doesn't exist// we import migration module to create this table
      require_once '../../app/extensions/app.migration.php';
      $migration = new Migration();
      /* adjust tables*/
      $migration->tables = [
        "lentec_card_payments" => [
          "id int(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY",
          "account_id varchar(255) NOT NULL",
          "_date varchar(255) NOT NULL",
          "data varchar(255) NOT NULL",
          "FULLTEXT(data)"
        ]
      ];
      /*migrate the tables */
      $status = $migration->migrate();
      if ($status === "success") {
        $save = $validation->saveData(false);
        if ($status === "success") {
          // check if this client exist and add total to his cash
          $this_user = new App();
          $this_user->activeTable = "single_payment_receipts";
          $this_user->comparisons = [["client_id", " = ",  $account_id]];
          $this_user->joiners = [''];
          $this_user->order = " BY id DESC ";
          $this_user->cols = "*";
          $this_user->limit = 1;
          $this_user->offset = 0;

          $data = $this_user->getData();
          //table does not exist // lets create
          if ($this_user->database_error && !$this_user->is_table($this_user->activeTable)) {
            // table doent exist// 
            require_once '../../app/extensions/app.migration.php';
            /*creting migrations*/
            $migration = new Migration();
            /* adjust tables*/
            $migration->tables =
              [
                $this_user->activeTable =>
                [
                  "id int(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY",
                  "client_id varchar(255)  NOT NULL UNIQUE KEY",
                  "amount float(10,2) NOT NULL",
                ]
              ];

            $status = $migration->migrate();
            if ($status === "success") {
              $prev_cash = 0;
            } else {
              die(json_encode([
                'errors' => "Error! Something is not right, please try again!"
              ]));
            }
          } else {
            $prev_cash = count($data) === 0 ? 0 : $data[0]['amount'];
          }
          $this_user->activeTable = "single_payment_receipts";
          //save data for this user 
          $this_user->insertData = [
            [
              "client_id" => $account_id,
              "amount" => $prev_cash + $amount
            ]
          ];
          $save = $this_user->saveData('amount');
          if ($save === "success") {
            // report success 
            die(json_encode([
              'errors' => false
            ]));
          } else {
            // report error 
            die(json_encode([
              'errors' => "Error! Something is not right, please try again!"
            ]));
          }
        } else {
          // error state 
          die(json_encode([
            'errors' => "Error! Something is not right, please try again!"
          ]));
        }
      }
    }

    //payment successfull
  } else {
    //errorrs 
    echo json_encode(array('errors' => $response->getErrors()));
  }
} catch (ApiException $e) {
  echo json_encode(array('errors' => $e));
}
