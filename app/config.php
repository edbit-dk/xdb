<?php

// Define folder path
defined('WEB_PATH') ? null : define("WEB_PATH", '/php-xdb');

//Database Constants
defined('DB_HOST') ? null : define("DB_HOST","localhost");//define our database server
defined('DB_USER') ? null : define("DB_USER","root");		  //define our database user	
defined('DB_PASS') ? null : define("DB_PASS","mysql");			  //define our database Password	
defined('DB_NAME') ? null : define("DB_NAME","xdb"); //define our database Name
defined('DB_PREFIX') ? null : define("DB_PREFIX","xdb_"); //define our database prefix
