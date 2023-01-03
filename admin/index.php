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
		if(post('csrf')) {

			$auth = User::auth(post('username'), post('password'), 1);
		  
			if($auth) {
			$_SESSION['user'] = $auth;
			redirect_to('/admin/home');
			} else {
			  message('Fejl i loginoplysninger. <br> Prøv igen eller kontakt skolens IT-vejleder.','error');
			  redirect_to('/admin/login?error=1');
			}
		  
		}
        $title="Log på";	
		$content='login.php';
		break;

	case 'users':
		confirm_logged_in();

		$users = '';
		$admin = '';
		$team_id  = '';
		$user_id = '';
		$teams = Team::list();

		if (post('csrf') && post('create')) {

			User::create([
				'fullname' => post('fullname'),
				'username' => post('username'),
				'password' => post('password'),
				'team_id' => post('team_id'),
				'admin' => post('admin')
			]);
			
			redirect_to('/admin/users?team_id=' . post('team_id'));
			message("Bruger oprettet!", 'info');
		}
		
		if(post('csrf') && post('update')) {
			
		   $status = User::update([
				'team_id' => post('team_id'),
				'fullname' => post('fullname'),
				'password' => post('password'),
				'admin' => post('admin')
			], 
			[
				'id', '=', post('user_id')
			]);
		
			redirect_to('/admin/users?team_id=' . post('team_id'));
			message('Oplysninger opdateret!', 'info');
		}
		
		if (isset($_GET['filter'])) {
			$user_id = $_GET['user_id'];
			$team_id = $_GET['team_id'];
			$admin = $_GET['admin'];
			$users = User::data($team_id, $user_id, $admin)->results();
		
		}

		$title="Brugere";	
		$content ='users.php';
		break;

	case 'records':
		confirm_logged_in();

		$records = '';
		$admins = User::admins();
		$teams = Team::list();
		$subjects = Subject::list();

		$team_id = 0;
		$subject_id = 0;
		$user_id = 0;
		$count = 0;

		if(post('csrf') && post('create')) {

			$status = Record::create([
				'subject_id' => post('subject_id'),
				'user_id' => post('user_id'),
				'admin_id' => post('admin_id'),
				'team_id' => post('team_id'),
				'winter_grade' => post('winter_grade'),
				'winter_feedback' => post('winter_feedback'),
				'summer_grade' => post('summer_grade'),
				'summer_feedback' => post('summer_feedback')
			]);
		
			redirect_to('/admin/records?user_id=' . post('user_id'));
			message('Karakterblad oprettet!', 'info');
		}
		
		if(post('csrf') && post('update')) {
		
			$status = Record::update([
				'subject_id' => post('subject_id'),
				'admin_id' => post('admin_id'),
				'team_id' => post('team_id'),
				'winter_grade' => post('winter_grade'),
				'winter_feedback' => post('winter_feedback'),
				'summer_grade' => post('summer_grade'),
				'summer_feedback' => post('summer_feedback')
			 ], 
			 [
				 'id', '=', post('record_id')
			 ]);
		 
			 redirect_to('/admin/records?user_id=' . post('user_id'));
			 message('Karakterblad opdateret!', 'info');
		 }

		if (isset($_GET['filter'])) {

			$data = Record::data(get('user_id'), get('admin_id'), get('subject_id'), get('team_id'));
			$records = $data->results();
			$count = $data->row_count();

			$team_id = $_GET['team_id'];
			$subject_id = $_GET['subject_id'];
			$user_id = $_GET['user_id'];
			$user = User::data($team_id, $user_id)->first();

		} 
		
	    $title="Karakterblad";	
		$content ='records.php';
		break;

	default:
		confirm_logged_in();
	    $title="XDB";	
		$content ='home.php';		
}

require_once '../assets/theme/templates.php';

