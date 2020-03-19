<?php

	ob_start();
	
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

 

	require_once('functions.php');
	require_once('database.php');
	require_once('query_functions.php');
	require_once('validation.php');
	require_once('auth_functions.php');


	$db = db_connect();
	$errors = [];





?>