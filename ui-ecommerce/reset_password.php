<?php


  require_once('initialize.php');
  if(is_post()){
    global $db;

    $new_password = db_escape($db,$_POST['new_password']);
    $confirm_password = db_escape($db,$_POST['confirm_password']);

    $email = $_POST['email'];
    $hash = $_POST['hash'];

    if(validate_password($new_password,$confirm_password) ){
      $new = password_hash($new_password,PASSWORD_BCRYPT);


      // you need + the hash or AND PLUS PASSWORD HAS TO BE WITH LIMITS
      //VALIDATE THE NEW PASSWORD
      update_password($email,$new);
      redirect_to("http://localhost/Phase1/password_valid");
      echo "password changed sucessfully";
    }else{
      // seession message
      redirect_to("http://localhost/Phase1/password_not_valid");
    }
  }



?>