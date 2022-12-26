<?php

// Folder path
defined('WEB_PATH') ? null : define("WEB_PATH", basename(__DIR__));

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

defined('SITE_ROOT') ? null : define ('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'].DS.WEB_PATH);

defined('LIB_PATH') ? null : define ('LIB_PATH',SITE_ROOT.DS.'includes');

// load config file first 
require_once(SITE_ROOT . "/includes/config.php");

require_once(LIB_PATH.DS."session.php");
require_once(LIB_PATH.DS."functions.php");

$db = new DB([
	'dbname' => DB_NAME,
	'dbuser' => DB_USER,
	'dbpass' => DB_PASS,
	'dbhost' => DB_HOST
]);