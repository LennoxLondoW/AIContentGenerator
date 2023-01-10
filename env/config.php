<?php

/*server configuration*/

/*server configuration*/
define('server', 'localhost');
define('user', 'root');
define('password', '');
define('database', 'task_ai');


// define('server', 'localhost');
// define('user', 'memehubc_task_ai');
// define('password', 'memehubc_task_ai');
// define('database', 'memehubc_task_ai');

// define('server', 'localhost');
// define('user', 'scrybrco_scrybr');
// define('password', 'scrybrco_scrybr');
// define('database', 'scrybrco_scrybr');

//paypall callback
function paypal_callback($arr_body = [], $client_id = "")
{
    //any additional paypal functions are done here
    $payment_id = $arr_body['id'];
    $payer_id = $arr_body['payer']['payer_info']['payer_id'];
    $payer_email = $cc[0] = $arr_body['payer']['payer_info']['email'];
    $amount = $arr_body['transactions'][0]['amount']['total'];
    $currency = 'usd';
    $payment_status = $arr_body['state'];
}

//validating card callback
function validate_card_callback($email="")
{
    //any additional paypal functions are done here
    //fetch free user tokens to be awarded
    $free_tokens = new App();
    $free_tokens->activeTable = "lentec_subscribe";
    $free_tokens->comparisons = [["section_id", " = ", 'free_tokens']];
    $free_tokens->joiners = [''];
    $free_tokens->order = " BY id DESC ";
    $free_tokens->cols = "*";
    $free_tokens->limit = 1;
    $free_tokens->offset = 0;
    //here fetches the free data set by admin
    $token_data = $free_tokens->getData()[0]['section_title'];
    //here we fetch the days to last the free tokens
    $free_tokens->comparisons = [["section_id", " = ", 'free_tokens_last']];
    $days_data = $free_tokens->getData()[0]['section_title'];

    //lets increse date by required days
    $date = date_create(date("Y-m-d"));
    date_add($date, date_interval_create_from_date_string($days_data." days"));
    $expire_date = date_format($date, "Y-m-d");


    //insert this data to user as token
    $free_tokens->activeTable = "lentec_user_tokens";
    $free_tokens->insertData = [
        [
            "client_id" => $email,
            "tokens" => $token_data,
            "expire" => $expire_date,

        ]
    ];
    if ($free_tokens->saveData("tokens") !== "success") {
        //report somethig is not right
        return ("statusContainer.innerHTML =  `<p style='color:red;'> Error! Something is not right, please try again!</p>`;");
    }

    return ("statusContainer.innerHTML = `<p style='color:green;'>Success! Your've been given free trial 1000 tokens that expires in 10 days!</p>`;");
}



// email for contact us 
define('webmaster_email', 'lennoxlondow3@gmail.com');
