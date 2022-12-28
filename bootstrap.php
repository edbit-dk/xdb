<?php

// Folder path
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

defined('BASE_PATH') ? null : define("BASE_PATH", __DIR__);

defined('APP_PATH') ? null : define ('APP_PATH',BASE_PATH.DS.'app');

// load config files
require_once(APP_PATH.DS."session.php");
require_once(APP_PATH.DS."functions.php");
require_once(APP_PATH.DS."config.php");

$db = new DB([
	'dbname' => DB_NAME,
	'dbuser' => DB_USER,
	'dbpass' => DB_PASS,
	'dbhost' => DB_HOST
]);