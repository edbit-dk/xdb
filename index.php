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

		$records = '';
		$team_id = -1;
		$subject_id = -1;
		$user_id = session('user')->id;
		$teams = Team::list();
		$subjects = Subject::list();

		if(isset($_GET['filter'])) {
			$team_id = $_GET['team_id'];
			$subject_id = $_GET['subject_id'];
			$records = Record::user($user_id, $team_id, $subject_id)->results();

		} else {
			$records = Record::list($user_id)->results();
		}


		if(post('csrf') && post('update')) {

			$status = User::update([
				'password' => post('password')
			], 
			[
				'id', '=', post('user_id')
			]);

			session('user')->password = post('password');

			message('Oplysninger opdateret!', 'info');

			redirect_to('/records');

		}

		$title="Karakterblad";	
		$content ='records.php';
		break;

	case 'login' && 'error':
		if(post('csrf')) {

			$auth = User::auth(post('username'), post('password'));
		  
			if($auth) {
			$_SESSION['user'] = $auth;
			redirect_to('/records');
			} else {
			  message('Fejl i loginoplysninger. <br> Prøv igen eller kontakt skolens IT-vejleder.','error');
			  redirect_to('/login?error=1');
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

