<?php
include("../initialize.php");
if(isset($_GET['delete_customer'])) {
	global $db;

	$delete_email = $_GET['delete_customer'];
	
	$delete_customer = "delete from user where email = '$delete_email'";

	$run_delete = mysqli_query($db, $delete_customer);

	if($run_delete) {
		echo "<script>alert('Customer has been deleted!')</script>";
		echo "<script>window.open('index.php?view_customers', '_self')</script";
	} else {
		echo "<script>alert('Customer has not been deleted!')</script>";
		echo "<script>window.open('index.php?view_customers', '_self')</script";
	}
}
?>