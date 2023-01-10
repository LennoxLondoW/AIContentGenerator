<?php
session_start();
/*main operation file*/
$__path__ = "../../";
require_once '../../app/extensions/app.validation.php';
$validation = new Validation();


if (isset($_POST['add_cards'])) {
    // check loging in 
    if (!isset($_SESSION['email'])) {
        die("statusContainer.innerHTML = 'Error! Please log in to proceed!';");
    }

    // validation object 
    $validation = new Validation();
    // table to store cards 
    $validation->activeTable = "lentec_user_cards";
    //check forgery
    if (!$validation->same_origin()) {
        die("statusContainer.innerHTML = 'Error! This request has been rejected!';");
    }
    // decode response 
    $array = json_decode($_POST['response'], true);
    // check for response status 
    if ($array['status'] !== 'OK') {
        die("statusContainer.innerHTML = 'Error! This request has been rejected!';");
    }
    // data to be inserted into square table 
    if (!isset($array['details']['billing']['postalCode'])) {
        $array['details']['billing']['postalCode'] = "";
    }
    $array['details']['card']['expMonth'] = $array['details']['card']['expMonth'] < 10 ? "0" . $array['details']['card']['expMonth'] : $array['details']['card']['expMonth'];
    $validation->insertData = [
        [
            "account_email" => $_SESSION['email'],
            "token" => $array["token"],
            "brand" => $array['details']['card']['brand'],
            "expMonth" => $array['details']['card']['expMonth'],
            "expYear" => $array['details']['card']['expYear'],
            "expDate" => $array['details']['card']['expYear'] . "/" . $array['details']['card']['expMonth'],
            "last4" => $array['details']['card']['last4'],
            "method" => $array['details']['method'],
            "postalCode" => $array['details']['billing']['postalCode'],
            "unique_feature" => $array['details']['billing']['postalCode'] . '_' . $array['details']['method'] . '_' . $array['details']['card']['last4'] . '_' . $array['details']['card']['brand']
        ]
    ];

    $save = $validation->saveData(false);

    if ($save === "success") {
        die(validate_card_callback($_SESSION['email']));
    } elseif (strstr(strtolower($save), "lentec_user_cards' doesn't exist") !== false) {
        // table doesn't exist// we import migration module to create this table
        require_once '../../app/extensions/app.migration.php';
        $migration = new Migration();
        /* adjust tables*/
        $migration->tables = [
            "lentec_user_cards" => [
                "id int(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY",
                "account_email varchar(255) NOT NULL",
                "token varchar(255) NOT NULL",
                "brand varchar(255) NOT NULL",
                "expMonth varchar(255) NOT NULL",
                "expYear varchar(255) NOT NULL",
                "expDate varchar(255) NOT NULL",
                "last4 varchar(255) NOT NULL",
                "method varchar(255) NOT NULL",
                "postalCode varchar(255)",
                "unique_feature varchar(255) NOT NULL UNIQUE KEY",

            ]
        ];
        /*migrate the tables */
        $status = $migration->migrate();
        if ($status === "success") {
            $save = $validation->saveData(false);
            if ($status === "success") {
                die(validate_card_callback($_SESSION['email']));
            } elseif (strstr(strtolower($save), "duplicate entry") !== false) {
                die("statusContainer.innerHTML = `<p style='color:red;'>Error! This card is already registered with us!</p>`;");
            } else {
                // error state 
                die("statusContainer.innerHTML =  `<p style='color:red;'> Error! Something is not right, please try again!</p>`;");
            }
        }
        // table creation failed 
        die("statusContainer.innerHTML =  `<p style='color:red;'> Error! Something is not right, please try again!</p>`;");
    } elseif (strstr(strtolower($save), "duplicate entry") !== false) {
        die("statusContainer.innerHTML =  `<p style='color:red;'> Error! This card is already registered with us!</p>`;");
    } else {
        // just another unexpected error 
        die("statusContainer.innerHTML =  `<p style='color:red;'> Error! Something is not right, please try again!</p>`;");
    }
}
