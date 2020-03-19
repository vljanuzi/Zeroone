<?php
include("../initialize.php");
?>

   <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.php">Admin area</a>
          </li>
          <li class="breadcrumb-item active">Add new brand</li>
   </ol>

<form action="" method="post" enctype="multipart/form-data">
	<div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="brand_title">Brand title</label>
      <input type="text" class="form-control" id="brand_title" name="brand_title" required>
    </div>
  </div>

  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="product_image">Brand image</label>
      <input type="file" class="form-control" id="brand_image" name="brand_image"  accept="image/jpg, image/jpeg, image/png" required>
    </div>
  </div>
 <button class="btn btn-primary" name="add_brand" type="submit">Add brand</button>
</form>

<?php


	if(isset($_POST['add_brand'])){
	 global $db;

	$brand_title = test_input($_POST['brand_title']);
	$brand_image = $_FILES['brand_image']['name'];
    $brand_image_tmp = $_FILES['brand_image']['tmp_name'];
    move_uploaded_file($brand_image_tmp, "../images/brands/$brand_image");
	
	$insert_brand = "insert into brands (brand_title, brand_image) values ('$brand_title', '$brand_image')";

	$run_brand = mysqli_query($db, $insert_brand); 
	
	if($run_brand){
	
	echo "<script>alert('New brand has been inserted!')</script>";
  header('location: index.php?add_brand');

	}
	}


?>