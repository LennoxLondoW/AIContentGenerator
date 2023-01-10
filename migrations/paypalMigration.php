<?php
session_start();
/*main operation file*/
require_once '../app/extensions/app.migration.php';

/*creting migrations*/
$migration = new Migration();

/* adjust tables*/
$migration ->tables = [
          "lentec_paypal" => [
          "id int(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY",
          "section_id varchar(255) NOT NULL UNIQUE KEY",
          "section_title longtext NOT NULL"
          ],
          "lentec_paypal_credentials" => [
            "id int(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY",
            "section_id varchar(255) NOT NULL UNIQUE KEY",
            "section_title longtext NOT NULL"
           ]
      ];

/*migrate the tables */
echo $migration->migrate($delete=false);

/*set migration sections*/
$migration->insertData = [

      [
        "section_id" => "paypal_client_id",
        "section_title" => "AUJryX_LXl_s8FTjGkPKDI4gLTBsONkyWswqiTMoU6UbgPdXerCzc7DGAm7TtPOOySm-bRcMJFAacB2a"
      ],
      [
        "section_id" => "paypal_client_secret",
        "section_title" => "ECetDC2UjCqjXsmykfRw601QfhZD6dHAGxgdObf1meHFCHhYiE9fI0um4y761iLyJJ3YhJxc3LHivvMk"
      ],
      [
        "section_id" => "paypal_is_test_mode",
        "section_title" => true
      ],
      [
        "section_id" => "paypal_admin_email",
        "section_title" => "lennoxlondow3@gmail.com"
      ],
      [
        "section_id" => "paypal_admin_contacts",
        "section_title" => "+254708889764"
      ],
    
    ];
    
    
    /*set table name*/
    $migration->activeTable = "lentec_paypal_credentials";
    
    /*save data into the migrated table*/
    echo $migration->saveData("section_title");

session_unset();
session_destroy();
