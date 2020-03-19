<?php 
require_once("initialize.php");
include('header.php'); 
require_login();
$email = $_SESSION['user_email'];
//deleteFromCart($email);
//checkOut($email);
$inCarts = find_all_in_cart($email);

while($cart = mysqli_fetch_assoc($inCarts) ){

	$sql = "INSERT INTO orders ";
    $sql .= "(product_id, email) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $cart['product_id']) . "',";
    $sql .= "'" . db_escape($db, $email) . "'";    
    $sql .= ")";
	$run_orders = mysqli_query($db, $sql);
  update_product($cart['product_id'], $cart['quantity_ordered']);

}
 $delete_product = "DELETE FROM cart WHERE email='$email'";
 $run_delete = mysqli_query($db, $delete_product);

//get_id
$get_user = "select * from user where email = '$email'";
$run_user = mysqli_query($db, $get_user); 
$row_user = mysqli_fetch_array($run_user);

$user_firstname = $row_user['first_name'];

?>

<div class="jumbotron jumbotron-fluid mt-4" style="padding:100px; margin-left: 20px; margin-right: 20px">
  <div class="container">
    <h1 class="display-4">Hi, <?php echo $user_firstname?>!</h1>
    <p class="lead">Your orders have been successfully processed by us! They will be shipped in <?php echo $row_user['address'] ?> in 4-15 working days. Please be patient!
</p>
<a href="cart.php">
<input type='submit' name='add' class='btn btn-success'
                       value='Back to cart'></a>
  </div>
</div>

<?php include('footer.php'); ?>