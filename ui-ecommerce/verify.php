<?php
	  
	require_once('initialize.php');

	

	if(!is_blank($_GET['email']) && !is_blank($_GET['hash'])){
		$email = $_GET['email'];
		$hash  =  $_GET['hash'];


		if(exists($email,$hash)){
			/*
			$_SESSION['message'] = "Account has been activated";
			*/
		}else{
			/*
			$_SESSION['message'] = "Account good";
			*/

			set_active_customer($email);
			redirect_to("http://localhost/ecommerce/ecommerce-ui/activated.php");

		}

	}else{
		/* Invald parameters */
		redirect_to("http://localhost/Phase1/index.php");

	}


	


?>