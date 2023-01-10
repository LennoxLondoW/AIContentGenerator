<?php
session_start();
/*main operation file*/
require_once '../app/extensions/app.migration.php';

/*creting migrations*/
$migration = new Migration();

/* adjust tables*/
$migration->tables = [
      "lentec_new_document" => [
            "id int(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY",
            "section_id varchar(255) NOT NULL UNIQUE KEY",
            "section_title longtext NOT NULL"
      ],
      "lentec_user_document" => [
            "id int(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY",
            "document_id varchar(255) NOT NULL UNIQUE KEY",
            "document_name varchar(255) NOT NULL",
            "user_email varchar(255) NOT NULL",
            "tokens int(255) NOT NULL",
            "total_tokens int(255) NOT NULL", //tokens used by ai
            "finish_reason varchar(255) NOT NULL",//reason for content termination
            "document_question longtext NOT NULL", //question that the user asks
            "document_content longtext NOT NULL", //ai content generated
            "FULLTEXT(document_name)" // will enable full text searching
      ],
      "lentec_trash_document" => [
            "id int(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY",
            "document_id varchar(255) NOT NULL UNIQUE KEY",
            "document_name varchar(255) NOT NULL",
            "user_email varchar(255) NOT NULL",
            "tokens int(255) NOT NULL",
            "total_tokens int(255) NOT NULL", //tokens used by ai
            "finish_reason varchar(255) NOT NULL",//reason for content termination
            "document_question longtext NOT NULL", //question that the user asks
            "document_content longtext NOT NULL", //ai content generated
            "FULLTEXT(document_name)" // will enable full text searching
      ]
];


/*migrate the tables */
echo $migration->migrate($delete = false);

session_unset();
session_destroy();
