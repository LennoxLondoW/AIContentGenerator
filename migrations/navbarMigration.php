<?php
session_start();
/*main operation file*/
require_once '../app/extensions/app.migration.php';

/*creting migrations*/
$migration = new Migration();

/* adjust tables*/
$migration->tables = [
  "lentec_navbar" => [
    "id int(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY",
    "section_id varchar(255) NOT NULL UNIQUE KEY",
    "section_title longtext NOT NULL"
  ],
  "lentec_iptracker" => [
    "id int(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY",
    "_ip varchar(255) NOT NULL UNIQUE KEY",
    "_date VARCHAR(255) NOT NULL",
    "_times INT(255) NOT NULL"
  ],

];




$migration->insertData = [
  /*Page meta*/
  [
    "section_id" => "site_primary_color",
    "section_title" => "#2dcdbc"
  ],
  [
    "section_id" => "site_secondary_color",
    "section_title" => "#283552"
  ],
  [
    "section_id" => "site_tertiary_color",
    "section_title" => "#fff"
  ],

  [
    "section_id" => "site_more_color_1",
    "section_title" => "light-blue"
  ],

  [
    "section_id" => "site_more_color_2",
    "section_title" => "#fff"
  ],

  [
    "section_id" => "site_more_color_3",
    "section_title" => "#fff"
  ],





  [
    "section_id" => "nav_link_1",
    "section_title" => "sign_up"
  ],
  [
    "section_id" => "nav_link_2",
    "section_title" => "verify_account"
  ],
  [
    "section_id" => "nav_link_3",
    "section_title" => "sign_in"
  ],
  [
    "section_id" => "nav_link_4",
    "section_title" => "reset_password"
  ],
  [
    "section_id" => "nav_link_5",
    "section_title" => "change_password"
  ],

  [
    "section_id" => "nav_link_6",
    "section_title" => "home"
  ],

  [
    "section_id" => "nav_link_7",
    "section_title" => "privacy_policy"
  ],

  [
    "section_id" => "nav_link_8",
    "section_title" => "terms_and_conditions"
  ],

  [
    "section_id" => "nav_link_9",
    "section_title" => "admin"
  ],

  [
    "section_id" => "nav_link_12",
    "section_title" => "donate"
  ],

  [
    "section_id" => "nav_link_13",
    "section_title" => "contact"
  ],
  [
    "section_id" => "nav_link_14",
    "section_title" => "about"
  ],



  [
    "section_id" => "nav_link_18",
    "section_title" => "view_users"
  ],

  [
    "section_id" => "nav_link_30",
    "section_title" => "my_account"
  ],

  [
    "section_id" => "nav_link_31",
    "section_title" => "documents"
  ],

  [
    "section_id" => "nav_link_32",
    "section_title" => "new_document"
  ],
  [
    "section_id" => "nav_link_33",
    "section_title" => "view_document"
  ],
  [
    "section_id" => "nav_link_34",
    "section_title" => "trash"
  ],
  [
    "section_id" => "nav_link_35",
    "section_title" => "purchase"
  ],
  [
    "section_id" => "nav_link_36",
    "section_title" => "subscribe"
  ],
  [
    "section_id" => "nav_link_37",
    "section_title" => "paypal"
  ],

  [
    "section_id" => "nav_link_38",
    "section_title" => "pricing"
  ],


  [
    "section_id" => "nav_link_39",
    "section_title" => "square_setup"
  ],
  [
    "section_id" => "nav_link_40",
    "section_title" => "square_payment"
  ],






];

/*migrate the tables */
echo $migration->migrate($delete = false);
session_unset();
session_destroy();
