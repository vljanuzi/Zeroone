<?php
  

  require_once('initialize.php');
  include("header.php");



  if(is_post()){
  	$email = db_escape($db,$_POST['email']);
  	$result = find_customer_by_email($email);
  	if(exists($email)){
  		//inefficient here
  		$customer = find_customer_by_email($email);		
  		$hash = $customer['hashed_password'];
  		$name  = $customer['first_name'];
  		//SESSION MESSAGE 
  		$to =$email;
  		$subject = 'Password Reset';
 		  $message_body = '
        Hi '. $name . ',

        You have requested password reset!

        Please click this link to reset your password:

        http://localhost/ecommerce/ui-ecommerce/reset.php?email='.$email.'&hash='.$hash;

        mail($to,$subject,$message_body);
        redirect_to("http://localhost/ecommerce/ui-ecommerce/index.php");

  	}else{
  		//$_SESSION['message']= "USER WITH THAT EMIAL DOES NOT EXIST"
		  $errors[]="User do not exist with that email";  		
  	}
  	
  }


?>

<br>
<br>
<div class="card col-lg-4 center">
<article class="card-body">
<h2 class="card-title mb-4 mt-1">Forgot your password?</h2>
    <form process="forgot.php" method="post">
    <div class="form-group">
      <label>Your email</label>
        <input name="email" name="email" class="form-control" placeholder="Email" type="email">
    </div> <!-- form-group// -->
    <?php echo display_errors($errors); ?>

    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block"> Reset password  </button>
    </div> <!-- form-group// -->                                                           
</form>
</article>
</div> <!-- card.// -->
<br>
<br>

<?php
include("footer.php");

?>