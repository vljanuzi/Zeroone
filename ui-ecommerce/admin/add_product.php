<?php
include("../initialize.php");     
?>
   <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.php">Admin area</a>
          </li>
          <li class="breadcrumb-item active">Add new product</li>
        </ol>

<form action="add_product.php" method="post" enctype="multipart/form-data">
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="product_title">Product title</label>
      <input type="text" class="form-control" id="product_title" name="product_title" required>
    </div>
  </div>
    
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="product_brand">Product brand</label>
      <select class="browser-default custom-select" name="product_brand">
  <option selected>Select brand</option>
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
        <input type="number" class="form-control" id="product_price" name="product_price" required>
      </div>
    </div>
  </div>


   <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="product_description">Product description</label>
      <input type="text" class="form-control" id="product_description" name="product_description" required>
    </div>
  </div>


  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="product_keywords">Product quantity</label>
      <input type="number" class="form-control" id="product_quantity" name="product_quantity" required>
    </div>
  </div>

  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="product_image">Product image</label>
      <input type="file" class="form-control" id="product_image" name="product_image"  accept="image/jpg, image/jpeg, image/png" required>
    </div>
  </div>

  <button class="btn btn-primary" name="add_product" type="submit">Add product</button>
</form>

<?php 

  if (isset($_POST['add_product'])) {
      global $db;
       //getting text data from the fields
       $product_title = test_input($_POST['product_title']);
       $product_brand = test_input($_POST['product_brand']);
       $product_price = test_input($_POST['product_price']);
       $product_description = test_input($_POST['product_description']);
       $product_quantity = test_input($_POST['product_quantity']);
 
       //getting the image from the field
       $product_image = $_FILES['product_image']['name'];
       $product_image_tmp = $_FILES['product_image']['tmp_name'];
       move_uploaded_file($product_image_tmp, "../images/items/$product_image");
       
         $add_product= "INSERT INTO products (product_brand, product_title, product_price, product_description, product_image, product_quantity) VALUES ('$product_brand', '$product_title', '$product_price', ' $product_description ', '$product_image', '$product_quantity')";

       $add_pro = mysqli_query($db, $add_product);
 
       if ($add_pro) {
            header('location: index.php?add_product');
            echo "<script>alert('Product has been inserted!')</script>";
            echo "<script>window.open('index.php?add_product', '_self')</script>";          
       }
       else {
            echo "<script>alert('Product has not been inserted!')</script>";
            echo "<script>window.open('index.php?add_product')</script";
       }   
   }








?>