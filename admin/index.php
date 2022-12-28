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

		if (post('csrf') && post('create')) {

			User::create([
				'fullname' => post('fullname'),
				'username' => post('username'),
				'password' => post('password'),
				'team_id' => post('team_id'),
				'admin' => post('admin')
			]);
			
			redirect_to('/admin?page=users&team_id=' . post('team_id'));
			message("Bruger oprettet!", 'info');
		}
		
		if(post('csrf') && post('update')) {
			
		   $status = User::update([
				'team_id' => post('team_id'),
				'fullname' => post('fullname'),
				'password' => post('password')
			], 
			[
				'id', '=', post('user_id')
			]);
		
			redirect_to('/admin?page=users&team_id=' . post('team_id'));
			message('Oplysninger opdateret!', 'info');
		}
		
		$team_id  = '';
		$user_id = '';
		$teams = Team::list();
		
		if (isset($_GET['user_id'])) {
			$user_id = $_GET['user_id'];
			$users = User::data($user_id)->results();
		
		} elseif(isset($_GET['team_id'])) {
			$team_id = $_GET['team_id'];
			$users = User::teams($team_id);
		
		} else {
			$users = User::list();
		}

		$title="Brugere";	
		$content ='users.php';
		break;

	case 'records':
		confirm_logged_in();

		if(post('csrf') && post('create')) {

			$status = Record::create([
				'subject_id' => post('subject_id'),
				'user_id' => post('user_id'),
				'admin_id' => post('admin_id'),
				'team_id' => post('team_id'),
				'avg_grade' => post('avg_grade'),
				'winter_grade' => post('winter_grade'),
				'summer_grade' => post('summer_grade'),
				'feedback' => post('feedback')
			]);
		
			redirect_to('/admin?page=records&user_id=' . post('user_id'));
			message('Karakterblad oprettet!', 'info');
		}
		
		if(post('csrf') && post('update')) {
		
			$status = Record::update([
				'subject_id' => post('subject_id'),
				'admin_id' => post('admin_id'),
				'team_id' => post('team_id'),
				'avg_grade' => post('avg_grade'),
				'winter_grade' => post('winter_grade'),
				'summer_grade' => post('summer_grade'),
				'feedback' => post('feedback')
			 ], 
			 [
				 'user_id', '=', post('user_id')
			 ]);
		 
			 redirect_to('/admin?page=records&user_id=' . post('user_id'));
			 message('Karakterblad opdateret!', 'info');
		 }
		
		$team_id = '';
		$user_id = '';
		$admins = User::admins();
		$teams = Team::list();
		$subjects = Subject::list();
		
		if (isset($_GET['user_id'])) {
			$user_id = $_GET['user_id'];
			$records = Record::user($user_id);
			$user = User::data($user_id)->first();
		
		} elseif(isset($_GET['team_id'])) {
			$team_id = $_GET['team_id'];
			$records = Record::teams($team_id);
		
		}else {
			$records = Record::list();
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
?>
