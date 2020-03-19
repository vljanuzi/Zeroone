<?php


	function is_post(){
  		return $_SERVER['REQUEST_METHOD'] == 'POST';
	}

	function redirect_to($location){
		header("Location: " . $location);
		exit;
	}


	function display_errors($errors=array()) {
	  $output = '';
	  if(!empty($errors)) {
	    $output .= "<div class=\"errors\">";
	    foreach($errors as $error) {
	      $output .= "<p class='alert alert-danger'>" . $error . "</p>";
	    }
	    $output .= "</div>";
	  }
	  return $output;
	}



	function test_input($data) {
  		$data = trim($data);
  		$data = stripslashes($data);
  		$data = htmlspecialchars($data);
  		return $data;
}


?>