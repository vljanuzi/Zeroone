<?php
include("../initialize.php");
if(isset($_GET['delete_brand'])) {
	global $db;

	$delete_id = $_GET['delete_brand'];

	$delete_brand = "delete from brands where brand_id = '$delete_id'";

	$run_delete = mysqli_query($db, $delete_brand);

	if($run_delete) {
		echo "<script>alert('Brand has been deleted!')</script>";
		echo "<script>window.open('index.php?view_brands', '_self')</script";
	} else {
		echo "<script>alert('Brand has not been deleted!')</script>";
		echo "<script>window.open('index.php?view_brands', '_self')</script";
	}
}
?>