<?php

    require_once('initialize.php');
    require_once('header.php');

    if (is_logged_in()) {
     redirect_to("index.php");
    }
    global $db;


    if(is_post()){

      $customer=[];
      $customer['first_name'] = $_POST['first_name'] ?? '';
      $customer['last_name']  = $_POST['last_name']  ?? '';
      $customer['email'] = $_POST['email'] ?? '';
      $customer['password']  = $_POST['password'] ?? '';
      $customer['confirm_password'] = $_POST['confirm_password'] ?? '';
      $customer['address'] = $_POST['address'] ?? '';
      $customer['country'] = $_POST['country'] ?? '';      

      $result = insert_customer($customer);


      if($result === true){

          $email = $customer['email'];
          $hash = password_hash($customer['password'], PASSWORD_BCRYPT);

          $_SESSION['active'] = 0;
          $_SESSION['logged_in'] = true;
          $_SESSION['message'] = "Confirmation link has been sent to " . $customer['email'] . ", please verify your account!";

          $to = $email;
          $subject = 'Account verification';
          
          $message_body = 'Hello ' . $customer['first_name'] . ' Please click this link to activate your account: http://localhost/ecommerce/ui-ecommerce/verify.php?email=' .$email . '&hash=' . $hash;

          mail($to,$subject,$message_body); 
          /*work on it*/
          $_SESSION['user_email'] = $email;
          redirect_to("http://localhost/ecommerce/ui-ecommerce/index.php");

      }else{

          $errors = $result;
      }

    }else{
      $customer = [];
      $customer["first_name"] = '';
      $customer["last_name"] = '';
      $customer["email"] = '';
      $customer['password'] = '';
      $customer['confirm_password'] = '';    
    }
          

?>

<br>
<br>
<div class="card col-6 center">
<header class="card-header">
  <h4 class="card-title mt-2">Sign up</h4>
</header>
<article class="card-body">
<form action="register.php" method="post">
  <div class="form-row">
    <div class="col form-group">
      <label>First name</label>
        <input name="first_name" type="text" class="form-control" required="required" value="<?php echo $customer['first_name']; ?>">
    </div> <!-- form-group end.// -->
    <div class="col form-group">
      <label>Last name</label>
        <input name="last_name" type="text" class="form-control" required="required" value="<?php echo $customer['last_name']; ?>">
    </div> <!-- form-group end.// -->
  </div> <!-- form-row end.// -->
  <div class="form-group">
    <label>Email address</label>
    <input name="email" type="email"  required="required" class="form-control" placeholder="" value="<?php echo $customer['email']; ?>">
    <small class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div> <!-- form-group end.// -->

  <!--
  <div class="form-group">
      <label class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="gender" value="option1">
      <span class="form-check-label"> Male </span>
    </label>
    <label class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="gender" value="option2">
      <span class="form-check-label"> Female</span>
    </label>
  </div> --> <!-- form-group end.// -->
  <div class="form-row">
    <div class="form-group col-md-6">
      <label>Address</label>
      <input name="address" required="required" type="text" class="form-control"  >
    </div>
    <div class="form-group col-md-6">
      <label>Country</label>
      <input name="country" required="required" type="text" class="form-control"  >
    </div>
     <!-- form-group end.// -->
    <!--
    <div class="form-group col-md-6">
      <label>Country</label>
      <select id="inputState" class="form-control">
        <option> Choose...</option>
          <option>Uzbekistan</option>
          <option>Russia</option>
          <option selected="">United States</option>
          <option>India</option>
          <option>Afganistan</option>
      </select>
    </div> 
    -->
  </div> <!-- form-row.// -->
  <div class="form-group">
    <label>Password</label>
      <input name="password" required="required" class="form-control" type="password">
  </div> <!-- form-group end.// -->
  <div class="form-group">
    <label>Confirm Password</label>
      <input name="confirm_password" required="required" class="form-control" type="password">
  </div> <!-- form-group end.// -->
   <small class="form-text text-muted">Your password must contain at least 7 characters, 1 uppercase letter, 1 lowercase letter, and 1 number.</small>

  <?php echo display_errors($errors); ?>
      
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block"> Sign Up  </button>
    </div> <!-- form-group// -->      
    <small class="text-muted">By clicking the 'Sign Up' button, you confirm that you accept our <br> <a href="terms.php">Terms of use and Privacy Policy.</a></small>                                          
</form>
</article> <!-- card-body end .// -->
<div class="border-top card-body text-center">Have an account? <a href="login.php">Log In</a></div>
</div> <!-- card.// -->
<br>
<br>

<?php
include('footer.php');
?>
