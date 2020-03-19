<?php
include("initialize.php");
if(isset($_SESSION['user_email'])) {

if(isset($_POST['save'])){
    $uID=$_POST['uID'];
    $product_id = $_POST['pid'];
    $email = $_SESSION['user_email'];
    $ratedIndex=$_POST['ratedIndex'];
    $ratedIndex++;
   
    

     
      

        
       $sql="INSERT INTO review (product_id,email,rate) VALUES ($product_id,'$email',$ratedIndex) ";
     

        $result = mysqli_query($db, $sql);
        $result = mysqli_query($db,"SELECT review_id FROM review ORDER BY review_id DESC LIMIT 1");
        $uData=mysqli_fetch_assoc($result);
        $uID=$uData['id'];
        
        exit(json_encode(array('id'=>$uID)));

    }
}

