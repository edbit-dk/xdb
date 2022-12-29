<?php

require_once("bootstrap.php");

$content='home.php';

$view = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';
switch ($view) {

	case 'home' :
        $title="XDB";	
		$content='home.php';
		break;

	case 'records' :
		studconfirm_logged_in();
		$title="Karakterblad";	
		$content ='records.php';
		break;

	case 'login' && 'error':
		if(post('csrf')) {

			$auth = User::auth(post('username'), post('password'));
		  
			if($auth) {
			$_SESSION['user'] = $auth;
			redirect_to('?page=records');
			} else {
			  message('Fejl i loginoplysninger. <br> Prøv igen eller kontakt skolens IT-vejleder.','error');
			  redirect_to('?page=login?error=1');
			}
		  
		}
        $title="Log på";	
		$content='login.php';
		break;
				
	default :
	    $title="XDB";	
		$content ='home.php';		
}

require_once 'assets/theme/templates.php';

