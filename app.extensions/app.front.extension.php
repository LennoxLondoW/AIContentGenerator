<?php
if (!defined('__path__')) {
	define('__path__', isset($__path__) ? $__path__ : "../");
}

require_once __path__ . 'app/app.php';
class FrontEnd extends App
{
	
}

$frontEnd = new FrontEnd();
