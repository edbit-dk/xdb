<?php
require_once("../includes/bootstrap.php");

$content='home.php';

$view = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';
switch ($view) {

	case 'home' :
        $title="xDB";	
		$content='home.php';
		break;
	
	case 'login' :
        $title="Log på";	
		$content='login.php';
		break;

	case 'students' :
		$title="Elever";	
		$content ='students.php';
		break;
		
	case 'records' && 'student':
	    $title="Karakterblad";	
		$content ='records.php';
		break;
				
	default:
	    $title="xDB";	
		$content ='home.php';		
}

require_once '../theme/templates.php';
?>
