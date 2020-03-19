<?php
include("../initialize.php");
if(isset($_GET['delete_product'])) {
	global $db;

	$delete_id = $_GET['delete_product'];

	$delete_product = "delete from products where product_id = '$delete_id'";

	$run_delete = mysqli_query($db, $delete_product);

	if($run_delete) {
		echo "<script>alert('Product has been deleted!')</script>";
		echo "<script>window.open('index.php?view_products', '_self')</script";
	} else {
		echo "<script>alert('Product has not been deleted!')</script>";
		echo "<script>window.open('index.php?view_products', '_self')</script";
	}
}
?>