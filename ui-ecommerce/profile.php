<?php
require_once('initialize.php'); 
require_login();
require_once('header.php');

$email = $_SESSION['user_email'];
//get_id
$get_user = "select * from user where email = '$email'";
$run_user = mysqli_query($db, $get_user); 
$row_user = mysqli_fetch_array($run_user);

$user_firstname = $row_user['first_name'];
$user_lastname = $row_user['last_name'];
$user_email = $row_user['email'];
$user_address = $row_user['address'];

$user_country = $row_user['country'];
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
<div class="col-10">
<form action="" method="post" enctype="multipart/form-data">
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="first_name">First name</label>
      <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $user_firstname;?>"required>
    </div>
  </div>
    
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="last_name">Last name</label>
      <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $user_lastname;?>"required>
         
    </div>
  </div>

 <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="last_name">Country</label>
      <input type="text" class="form-control" id="country" name="country" value="<?php echo $user_country;?>"required>
         
    </div>
  </div>

   <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="last_name">Address</label>
      <input type="text" class="form-control" id="address" name="address" value="<?php echo $user_address;?>"required>
         
    </div>
  </div>

  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="email">Email </label>
      <div class="input-group">
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $user_email;?>" required>
      </div>
      <button class="btn btn-primary mt-4" name="edit_info" type="submit">Edit personal info</button>
  <a href="change_password.php" class="float-right mt-4">Change password</a>

    </div>


  </div>


</form>

<?php 

  if (isset($_POST['edit_info'])) {
      global $db;

       $user_firstname = test_input($_POST['first_name']);
       $user_lastname = test_input($_POST['last_name']);
       $email_test = test_input($_POST['email']);
       $user_country = test_input($_POST['country']);
       $user_address = test_input($_POST['address']);

       $edit_info = "update user set
                       first_name = '$user_firstname',
                       last_name = '$user_lastname',
                       email = '$email_test',
                       country = '$user_country',
                       address = '$user_address'
                       where email = '$email';
                       
       ";
       $run_info = mysqli_query($db, $edit_info);
        $_SESSION['user_email'] = $email_test;
       if ($run_info) {
            echo "<script>alert('Information has been updated!')</script>";
            echo "<script>window.open('profile.php', '_self')</script>";          
       }
       else {
            echo "<script>alert('Information has not been updated!')</script>";
            echo "<script>window.open('profile.php', '_self')</script";
       }   
   }

   ?>
</div>


</div> 
        
   
<?php
include("footer.php");
?>
</html>

