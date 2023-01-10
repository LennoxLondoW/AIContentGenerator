<?php
session_start();
/*main operation file*/
require_once '../app/extensions/app.migration.php';

/*creting migrations*/
$migration = new Migration();

/* adjust tables*/
$migration ->tables = [
          "lentec_subscribe" => [
          "id int(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY",
          "section_id varchar(255) NOT NULL UNIQUE KEY",
          "section_title longtext NOT NULL"
          ],
      // stores the user tokens 
          "lentec_user_tokens" => [
            "id int(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY",
            "client_id varchar(255) NOT NULL",
            "tokens int(255) NOT NULL",
            "expire varchar(255) NOT NULL"
           ]
      ];

/*migrate the tables */
echo $migration->migrate($delete=false);

session_unset();
session_destroy();
