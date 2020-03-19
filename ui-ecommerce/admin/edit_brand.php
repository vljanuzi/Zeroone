<?php
include("../initialize.php"); 


if(isset($_GET['edit_brand'])){

	global $db;

	$brand_id = $_GET['edit_brand']; 
	
	$get_brand = "select * from brands where brand_id='$brand_id'";

	$run_brand = mysqli_query($db, $get_brand); 
	
	$row_brand = mysqli_fetch_array($run_brand); 
	
	$brand_id = $row_brand['brand_id'];
	$brand_title = $row_brand['brand_title'];
	$brand_image = $row_brand['brand_image'];
	//echo $brand_image;
}

 ?>

 <form action="" method="post" enctype="multipart/form-data">
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="brand_title">Brand title</label>
      <input type="text" class="form-control" id="brand_title" name="brand_title" value="<?php echo $brand_title;?>">
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="brand_image">Brand image</label>
      <input type="file" class="form-control" id="brand_image" name="brand_image"><img height="100" width="100" accept="image/jpg, image/jpeg, image/png" src="../images/brands/<?php echo $brand_image?>" required>
    </div>
  </div>


    <button class="btn btn-primary" name="edit_brand" type="submit">Edit brand</button>

</form>

<?
	

	if(isset($_POST['edit_brand'])){
	global $db;
	$update_id = $brand_id;
	
	$new_brand = $_POST['brand_title'];
 	
      
       $brand_image = $_POST['brand_image'];
 		echo $brand_image;
       //getting the image from the field
       $brand_image = $_FILES['brand_image']['name'];
       $brand_image_tmp = $_FILES['brand_image']['tmp_name'];
       move_uploaded_file($brand_image_tmp, "../images/brands/$brand_image");

		$update_brand = "update brands set 
						brand_title='$new_brand'
						brand_image = '$brand_image'
		 				where brand_id='$update_id'";

	$run_brand = mysqli_query($db, $update_brand); 
	
	if($run_brand){
	
	echo "<script>alert(' Brand has been updated!')</script>";
    echo "<script>window.open('index.php?view_brands', '_self')</script";

	}
	}



?>