<?php

	function url($path = ''){
		return sprintf(
		"%s://%s",
		isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
		$_SERVER['SERVER_NAME'] . WEB_PATH . $path
		);
	}

	function clean_input($input) {
		return trim($input);
	}

	function strip_zeros_from_date($marked_string="") {
		//first remove the marked zeros
		$no_zeros = str_replace('*0','',$marked_string);
		$cleaned_string = str_replace('*0','',$no_zeros);
		return $cleaned_string;
	}
	function redirect_to($location = NULL) {
		if($location != NULL){
			$web_root = url();
			header("Location: {$web_root}{$location}");
			exit;
		}
	}
	function redirect($location=Null){
		if($location!=Null){
			$web_root = url();
			echo "<script>
					window.location='{$web_root}{$location}'
				</script>";	
		}else{
			echo 'error location';
		}
		 
	}
	function output_message($message="") {
	
		if(!empty($message)){
		return "<p class=\"message\">{$message}</p>";
		}else{
			return "";
		}
	}
	function date_toText($datetime=""){
		$nicetime = strtotime($datetime);
		return strftime("%B %d, %Y at %I:%M %p", $nicetime);	
					
	}
	function load_class($class_name) {
		$class_name = strtolower($class_name);
		$path = APP_PATH.DS."classes/{$class_name}.class.php";
		if(file_exists($path)){
			require_once($path);
		}else{
			die("The file {$class_name}.php could not be found.");
		}
					
	}
	spl_autoload_register('load_class');

	function currentpage_public(){
		$this_page = $_SERVER['SCRIPT_NAME']; // will return /path/to/file.php
	    $bits = explode('/',$this_page);
	    $this_page = $bits[count($bits)-1]; // will return file.php, with parameters if case, like file.php?id=2
	    $this_script = $bits[0]; // will return file.php, no parameters*/
		 return $bits[2];
	  
	}

	function currentpage_admin(){
		$this_page = $_SERVER['SCRIPT_NAME']; // will return /path/to/file.php
	    $bits = explode('/',$this_page);
	    $this_page = $bits[count($bits)-1]; // will return file.php, with parameters if case, like file.php?id=2
	    $this_script = $bits[0]; // will return file.php, no parameters*/
		 return $bits[4];
	  
	}
 // echo "string " .currentpage_admin()."<br/>";

	function curPageName() {
 return substr($_SERVER['REQUEST_URI'], 21, strrpos($_SERVER['REQUEST_URI'], '/')-24);
}

  // echo "The current page name is ".curPageName();

function currentpage(){
		$this_page = $_SERVER['SCRIPT_NAME']; // will return /path/to/file.php
	    $bits = explode('/',$this_page);
	    $this_page = $bits[count($bits)-1]; // will return file.php, with parameters if case, like file.php?id=2
	    $this_script = $bits[0]; // will return file.php, no parameters*/
		 return $bits[3];
	  
	}
	function publiccurrentpage(){
		$this_page = $_SERVER['SCRIPT_NAME']; // will return /path/to/file.php
	    $bits = explode('/',$this_page);
	    $this_page = $bits[count($bits)-1]; // will return file.php, with parameters if case, like file.php?id=2
	    $this_script = $bits[0]; // will return file.php, no parameters*/
		 return $bits[2];
	  
	}
	
	function current_url()
	{
		$pageURL = 'http';
		if(isset($_SERVER["HTTPS"]))
		if ($_SERVER["HTTPS"] == "on") {
			$pageURL .= "s";
		}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}
		
function post($name) {
	if(isset($_POST[$name])) {
		return trim($_POST[$name]);
	} else {
		return false;
	}
}

function get($name) {
	if(isset($_GET[$name])) {
		return trim($_GET[$name]);
	} else {
		return false;
	}
}

function csrf_token($name = 'csrf') {
	return $_SESSION[$name] = uniqid();
}

function pagination($name = 'pages', $num_per_page = 5) {

	if(isset($_GET[$name])) {
		$pages = $_GET[$name];
	} else {
		$pages = 1;
	}

	$start_from = ($pages - 1)*$num_per_page;

	return $start_from;
}

function average_grade($array) {

	$final_grade = array_sum($array) / count($array);

	if($final_grade>=12){
		$remarks = "Fremragende præstation!";	
		$final_grade = 12;
	} elseif($final_grade>=10) {
		$remarks = "Fortrinlig præstation!";
		$final_grade = 10;
	} elseif($final_grade>=7) {
		$remarks = "God præstation!";
		$final_grade = 7;
	} elseif($final_grade>=4) {
		$remarks = "Jævn præstation!";
		$final_grade = 4;
	} elseif($final_grade>=2) {
		$remarks = "Tilstrækkelig præstation!";
		$final_grade = 2;
	} elseif($final_grade>=0) {
		$remarks = "Utilstrækkelig præstation!";
		$final_grade = 0;
	} elseif($final_grade<0) {
		$remarks = "Ringe præstation!";
		$final_grade = -3;
	}

	return [
		'avg' => $final_grade,
		'remarks' => $remarks
	];
}
