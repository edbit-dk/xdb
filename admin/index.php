<?php

require_once("../bootstrap.php");

$content='home.php';

$view = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';
switch ($view) {

	case 'home' :
        $title="XDB";	
		$content='home.php';
		break;
	
	case 'login' :
        $title="Log på";	
		$content='login.php';
		break;

	case 'users':
		$title="Brugere";	
		$content ='users.php';
		break;
		
	case 'records':
	    $title="Karakterblad";	
		$content ='records.php';
		break;
				
	default:
	    $title="XDB";	
		$content ='home.php';		
}

require_once '../assets/theme/templates.php';
?>
