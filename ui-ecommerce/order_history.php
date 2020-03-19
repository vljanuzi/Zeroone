<?php
include("header.php");
require_login();
include("initialize.php");
$email = $_SESSION['user_email'];

$orders = find_all_orders($email);
$get_user = "select * from user where email = '$email'";
$run_user = mysqli_query($db, $get_user); 
$row_user = mysqli_fetch_array($run_user);

$user_firstname = $row_user['first_name'];
?>


<html>
<style>
button a:link {
  text-decoration: none;
}
</style>
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">Hi, <?php echo $user_firstname?></h1>
    <p class="lead">Welcome to your account. Here you can manage all of your personal information and orders.
</p>
  </div>
</div>

<div class="row pl-3">
  <div class="col-2">
<div class="list-group">
  <button type="button" class="list-group-item list-group-item-action" id="test"><a href="profile.php">Personal info</a></button>
  <button type="button" class="list-group-item list-group-item-action"><a href="order_history.php">Order history and details</a></button> 
  <button type="button" class="list-group-item list-group-item-action"><a href="deactivate.php">Deactivate account</a></button>

</div>
</div>
<div class="col-9">
<table class="table table-responsive table-hover">
  <thead>
    <tr style="color: #212529">
      <th scope="col">Product title</th>
      <th scope="col">Description</th>
      <th scope="col">Price</th>
      <th scope="col">Image</th>
    </tr>
  </thead>
  <tbody>

  <?php  while ($order = mysqli_fetch_assoc($orders)) {  ?>
    <tr>
        <td><a href=""><?php echo $order['product_title'];?></a></td>
        <td><?php echo $order['product_description'];?></td>
        <td>$<?php echo $order['product_price'];?></td>
        <td><img src="images/items/<?php echo $order['product_image'];?>" width="60" height="60"> </td>

  </tr>
      <?php } ?> 




  </tbody>
</table>

   <?php if (!exist_product_orders($email)) {
    echo '<p class="alert alert-danger">You have not made any orders yet!</p>';
}
?>
</div>
</div>

<br>

<?php 
include("footer.php");

?>