<?php
require_once('initialize.php'); 
require_login();
require_once('header.php');

$email = $_SESSION['user_email'];
//get_id
$get_user = "select hashed_password, email,first_name from user where email = '$email'";
$run_user = mysqli_query($db, $get_user); 
$row_user = mysqli_fetch_array($run_user);

$hashed_password = $row_user['hashed_password'];
$email = $row_user['email'];
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
  <button type="button" class="list-group-item list-group-item-action"><a href="#">Order history and details</a></button> 
  <button type="button" class="list-group-item list-group-item-action"><a href="deactivate.php">Deactivate account</a></button>

</div>
</div>
<div class="col-10">
<form action="" method="post" enctype="multipart/form-data">
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="current_password">Current password</label>
      <input type="password" class="form-control" id="current_password" name="current_password" value=""required>
    </div>
  </div>
    
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="last_name">New password</label>
      <input type="password" class="form-control" id="new_password" name="new_password" value="" required>
         
    </div>
  </div>


  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="email">Confirm new password </label>
      <div class="input-group">
        <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="" required>
      </div>
      <button class="btn btn-primary mt-4" name="change_password" type="submit">Change password</button>
    </div>

  </div>

</form>


<?php

if (isset($_POST['change_password'])) {
      global $db;
       //getting text data from the fields
       $current_password = $_POST['current_password'];
       $new_password = $_POST['new_password'];
       $confirm_password = $_POST['confirm_password'];

       if(password_verify($current_password, $hashed_password) && validate_password($new_password,$confirm_password)) {

        $new = password_hash($new_password,PASSWORD_BCRYPT);

        update_password($email,$new);
        echo "<div class='alert alert-success col-md-4' role='alert'>
      Password succesfully changed!
    </div>";
       } else {
        echo "<div class='alert alert-danger col-md-4' role='alert'>
      Invalid format!</div>";
       } 

   }

 ?>
</div>
</div> 
        
   
<?php
include("footer.php");
?>
</html>

