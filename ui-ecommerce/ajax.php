<?php
require_once("initialize.php");
if(!isset($_SESSION['user_email'])) die('not authorized');



function addToCartAjax($email){

    if(isset($_GET['add_cart']) && isset($_SESSION['user_email'])){

        global $db;

        $pro_id = $_GET['add_cart'];

        $check_pro = "SELECT * from cart where email='".$email."' AND product_id='$pro_id'";

        $run_check = mysqli_query($db, $check_pro);

        if(mysqli_num_rows($run_check)>0){
            
          
             response(400,'','This product is already in your cart','danger');
          }
          else {
            $insert_pro = "INSERT into cart (product_id,email, quantity_ordered) values ('$pro_id','" . $email . "','".$_GET['quantity']."')";

            $run_pro = mysqli_query($db, $insert_pro);

            if ($run_pro) {

                response(200,'Success !','Product was inserted','success');

            }
          }

        }
        else {
             
             die('test');

            $insert_pro = "INSERT into cart (product_id,email, quantity_ordered) values ('$pro_id','" . $email . "','$_GET[quantity]')";

            $run_pro = mysqli_query($db, $insert_pro);

            if ($run_pro) {

                echo "<script>window.open('cart.php','_self')</script>";

            }

        }
    }

    $email = $_SESSION['user_email'];

    addToCartAjax($email);

    function response($status=200,$title="",$message="", $extra=""){
       $object = new stdClass();
       $object->status = $status;
       $object->title = $title;
       $object->message = $message;
       $object->extra = $extra;
           die(json_encode($object));
    }
?>

