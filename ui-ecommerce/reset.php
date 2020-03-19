<?php
  require_once('initialize.php');
  include("header.php");


  if(!is_blank($_GET['email']) && !is_blank($_GET['hash'])){
    $email = db_escape($db,$_GET['email']);
    $hash  =  db_escape($db,$_GET['hash']);
    if(!exists($email,$hash)){
        //$_session['message']="You have entered invalid url";
        redirect_to("http://localhost/ecommerce/ui-ecommerce/error.php");
       //echo "You have entered invalid url";
    }

  }


?>


<br>
<br>
<div class="card col-lg-4 center">
<article class="card-body">
<h2 class="card-title mb-4 mt-1">Confirm password</h2>
    <form action="reset_password.php" method="post">
    <!--/*Trick to keep the email */-->
    <input type="hidden" name="email" value="<?php  echo $email ?>">    
    <input type="hidden" name="hash" value="<?php echo $hash ?>">

    <div class="form-group">
      <label>New password</label>
        <input name="new_password" class="form-control" name="password" required="required" type="password">
    </div> <!-- form-group// --> 
    <div class="form-group">
      <label>Confirm password</label>
        <input name="confirm_password" class="form-control" name="password" required="required" type="password">
    </div> <!-- form-group// --> 
 
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
