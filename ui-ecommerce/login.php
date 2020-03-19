<?php
  require_once('initialize.php');
  include("header.php");

  if (is_logged_in()) {
     redirect_to("index.php");
  }

  $errors = [];
  $email = '';
  $password = '';

  if(is_post()){
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(is_blank($email)) {
      $errors[] = "Email cannot be blank.";
    }

    if(is_blank($password)) {
      $errors[] = "Password cannot be blank.";
    }

    if(empty($errors)){
        $login_failure_msg = "Log in was unsuccessful.";

        $customer = find_customer_by_email($email);

        if($customer){
            if(password_verify($password,$customer['hashed_password'])){
              if($email == 'admin@gmail.com' && $password == 'Admin123@'){
                log_in_admin($customer);
                redirect_to('admin/index.php?view_products');
              }
              else{
                log_in_user($customer);
                redirect_to("http://localhost/ecommerce/ui-ecommerce/index.php");
              }

              
                
            }else{
              $errors[] = $login_failure_msg;
            }

        }else{


          $errors[] = $login_failure_msg ;
        }
    }else{
      $errors[] = "No username found";
    }
  }

?>

<br>
<br>
<div class="card col-lg-4 center">
<article class="card-body">
<a href="register.php" class="float-right btn btn-outline-primary">Sign up</a>
<h4 class="card-title mb-4 mt-1">Sign in</h4>
   <form action="login.php" method="post">
    <div class="form-group">
      <label>Your email</label>
        <input name="email" class="form-control" required="required" value="<?php echo $email; ?>" placeholder="Email" type="email">
    </div> <!-- form-group// -->
    <div class="form-group">
      <a class="float-right" href="forgot.php">Forgot?</a>
      <label>Your password</label>
        <input class="form-control" name="password" required="required" placeholder="Password" type="password">
    </div> <!-- form-group// --> 
    <div class="form-group"> 
    <div class="checkbox">
      <label> <input type="checkbox"> Save password </label>
    </div> <!-- checkbox .// -->
    </div> <!-- form-group//
     -->
    <?php echo display_errors($errors); ?>

    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block"> Login  </button>
    </div> <!-- form-group// -->                                                           
</form>
</article>
</div> <!-- card.// -->
<br>
<br>
<?php
include("footer.php");

?>