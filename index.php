<?php
require_once("includes/bootstrap.php");
$content='login.php';
$view = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';
switch ($view) {
	case 'login' :
        $title="Log på";	
		$content='login.php';
		break;
		
	case 'records' :
	    $title="Karakterblad";	
		$content ='records.php';
		break;
				
	default :
	    $title="xDB";	
		$content ='home.php';		
}

require_once 'theme/templates.php';
?>
