<?php
	require_once("bootstrap.php");

	message('Du er logget ud!', 'success');
	
	session_start();
	session('user','');	
	session_destroy();

	redirect_to('/');
