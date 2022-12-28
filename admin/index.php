<?php

require_once("../bootstrap.php");

$content='home.php';

$view = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';
switch ($view) {

	case 'home':
		confirm_logged_in(); 
        $title="XDB";	
		$content='home.php';
		break;
	
	case 'login' :
        $title="Log på";	
		$content='login.php';
		break;

	case 'users':
		confirm_logged_in();
		$title="Brugere";	
		$content ='users.php';
		break;

	case 'records':
		confirm_logged_in();
	    $title="Karakterblad";	
		$content ='records.php';
		break;

	default:
		confirm_logged_in();
	    $title="XDB";	
		$content ='home.php';		
}

require_once '../assets/theme/templates.php';
?>
