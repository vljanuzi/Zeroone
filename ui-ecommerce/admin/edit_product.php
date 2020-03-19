<?php
include("../initialize.php"); 

if(isset($_GET['edit_product'])) {
  global $db;
  $get_id = $_GET['edit_product'];

  $get_product = "select * from products where product_id = $get_id";

  $run_product = mysqli_query($db, $get_product); 
  $i = 0;
  
  $row_product=mysqli_fetch_array($run_product);
  $product_title = $row_product['product_title'];
  $product_brand = $row_product['product_brand'];
  $product_description = $row_product['product_description'];
  $product_quantity = $row_product['product_quantity'];
  $product_image = $row_product['product_image'];
  $product_price = $row_product['product_price'];

  $get_brand = "select * from brands where brand_id = $product_brand";

  $run_brand = mysqli_query($db, $get_brand);
  $row_brand =mysqli_fetch_array($run_brand);
  
  $brand_title = $row_brand['brand_title'];
  
}

?>
   <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.php">Admin area</a>
          </li>
          <li class="breadcrumb-item active">Edit product</li>
        </ol>

<form action="" method="post" enctype="multipart/form-data">
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="product_title">Product title</label>
      <input type="text" class="form-control" id="product_title" name="product_title" value="<?php echo $product_title;?>"required>
    </div>
  </div>
    
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="product_brand">Product brand</label>
      <select class="browser-default custom-select" name="product_brand">
  <option selected><?php echo $brand_title;?></option>
 <?php 
          $get_brands = "select * from brands";
  
          $run_brands = mysqli_query($db, $get_brands);
  
          while ($row_brands=mysqli_fetch_array($run_brands)){
  
              $brand_id = $row_brands['brand_id']; 
              $brand_title = $row_brands['brand_title'];
  
              echo "<option value='$brand_id'>$brand_title</option>"; 
            }

  ?>
</select>
         
    </div>
  </div>


  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="product_price">Product price </label>
      <div class="input-group">
        <input type="number" class="form-control" id="product_price" name="product_price" value="<?php echo $product_price;?>" required>
      </div>
    </div>
  </div>


   <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="product_description">Product description</label>
      <input type="text" class="form-control" id="product_description" name="product_description" value="<?php echo $product_description;?>"required>
    </div>
  </div>


  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="product_quantity">Product quantity</label>
      <input type="number" class="form-control" id="product_quantity" name="product_quantity" value="<?php echo $product_quantity;?>"required>
    </div>
  </div>

  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="product_image">Product image</label>
      <input type="file" class="form-control" id="product_image" name="product_image"><img height="100" width="100" accept="image/jpg, image/jpeg" src="../images/items/<?php echo $product_image?>" required>
    </div>
  </div>

  <button class="btn btn-primary" name="edit_product" type="submit">Edit product</button>
</form>

<?php 

  if (isset($_POST['edit_product'])) {
      global $db;
       //getting text data from the fields
       $product_title = test_input($_POST['product_title']);
       $product_brand = test_input($_POST['product_brand']);
       $product_price = test_input($_POST['product_price']);
       $product_description = test_input($_POST['product_description']);
       $product_quantity = test_input($_POST['product_quantity']);
       
       $product_image = test_input($_POST['product_image']);
 
       //getting the image from the field
       $product_image = $_FILES['product_image']['name'];
       $product_image_tmp = $_FILES['product_image']['tmp_name'];
       move_uploaded_file($product_image_tmp, "../images/items/$product_image");
       
       $edit_product= "update products set
                       product_title = '$product_title',
                       product_brand = '$product_brand',
                       product_price = '$product_price',
                       product_description = '$product_description',
                       product_quantity = '$product_quantity',
                       product_image = '$product_image'
                       where product_id='$get_id'
       ";

       $run_product = mysqli_query($db, $edit_product);
 
       if ($run_product) {
            header('location: index.php?view_products');
            echo "<script>alert('Product has been updated!')</script>";
       }
       else {
            header('location: index.php?view_products');
            echo "<script>alert('Product has not been updated!')</script>";
       }   
   }








?>