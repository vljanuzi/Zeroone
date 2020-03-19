<?php
	function find_all_users(){
		global $db;

		$sql = "SELECT * FROM user ";
		$sql.= "ORDER BY last_name ASC, first_name ASC ";
		$result = mysqli_query($db,$sql);
		confirm_result_set($result);
		return $result;
	}

  function exists($email,$hash=""){
    global $db;

    $sql = "SELECT * FROM user ";
    $sql .= "WHERE email='" . db_escape($db,$email) . "' ";
    if(!empty($hash) ){
        $sql .= "AND hashed_password='" . db_escape($db,$hash) . "' ";

    }
    $sql .= "AND active = '1'";

    $customers = mysqli_query($db,$sql);
    $customer_count = mysqli_num_rows($customers);
    mysqli_free_result($customers);

    return $customer_count !== 0;

  }


  function find_customer_by_email($email) {
    global $db;

    $sql = "SELECT * FROM user ";
    $sql .= "WHERE email='" . db_escape($db, $email) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $customer = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $customer; // returns an assoc. array
  }

  function set_active_customer($email){
    global $db;

    $sql = "UPDATE user ";
    $sql .= "SET active='1'";
    $sql .= "WHERE email='" . db_escape($db,$email) . "'";


    $result = mysqli_query($db,$sql);
    confirm_result_set($result);
    mysqli_free_result($result);
  }


  function update_password($email,$new_password){

    global $db;

    $sql = "UPDATE user ";
    $sql .= "SET hashed_password = '" .$new_password . "' " ;
    $sql .= "WHERE email='" . db_escape($db,$email) . "'";


    $result = mysqli_query($db,$sql);
    confirm_result_set($result);
  }

  function insert_customer($customer) {
    global $db;

    $errors = validate_customer($customer);

    if (!empty($errors)) {
      return $errors;
    }

    $hashed_password = password_hash($customer['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO user ";
    $sql .= "(first_name,last_name,email,hashed_password,address,country) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $customer['first_name']) . "',";
    $sql .= "'" . db_escape($db, $customer['last_name']) . "',";
    $sql .= "'" . db_escape($db, $customer['email']) . "',";
    $sql .= "'" . db_escape($db, $hashed_password) . "',";
    $sql .= "'" . db_escape($db, $customer['address']) . "',";
    $sql .= "'" . db_escape($db, $customer['country']) . "'";    
    $sql .= ")";
    $result = mysqli_query($db, $sql);

    // For INSERT statements, $result is true/false
    if($result) {
      return true;
    } else {
      // INSERT failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }


 function validate_customer($customer, $options=[]) {
    global $errors;
    $password_required = $options['password_required'] ?? true;

    if(is_blank($customer['first_name'])) {
      $errors[] = "First name cannot be blank.";
    } elseif (!has_length($customer['first_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "First name must be between 2 and 255 characters.";
    }

    if(is_blank($customer['last_name'])) {
      $errors[] = "Last name cannot be blank.";
    } elseif (!has_length($customer['last_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "Last name must be between 2 and 255 characters.";
    }

    if(is_blank($customer['email'])) {
      $errors[] = "Email cannot be blank.";
    } elseif (!has_length($customer['email'], array('max' => 255))) {
      $errors[] = "Last name must be less than 255 characters.";
    } elseif (!has_valid_email_format($customer['email'])) {
      $errors[] = "Email must be a valid format.";
    }

    /*
    if(is_blank($customer['username'])) {
      $errors[] = "Username cannot be blank.";
    } elseif (!has_length($customer['username'], array('min' => 8, 'max' => 255))) {
      $errors[] = "Username must be between 8 and 255 characters.";
    } elseif (!has_unique_username($customer['username'], $customer['id'] ?? 0)) {
      $errors[] = "Username not allowed. Try another.";
    }
    */

    if(!has_unique_email($customer['email']) ){
      $errors[] = "Email already exists";
    }

    if($password_required) {
      if(is_blank($customer['password'])) {
        $errors[] = "Password cannot be blank.";
      } elseif (!has_length($customer['password'], array('min' => 7))) {
        $errors[] = "Password must contain 7 or more characters";
      } elseif (!preg_match('/[A-Z]/', $customer['password'])) {
        $errors[] = "Password must contain at least 1 uppercase letter";
      } elseif (!preg_match('/[a-z]/', $customer['password'])) {
        $errors[] = "Password must contain at least 1 lowercase letter";
      } elseif (!preg_match('/[0-9]/', $customer['password'])) {
        $errors[] = "Password must contain at least 1 number";
      }

      if(is_blank($customer['confirm_password'])) {
        $errors[] = "Confirm password cannot be blank.";
      } elseif ($customer['password'] !== $customer['confirm_password']) {
        $errors[] = "Password and confirm password must match.";
      }
    }

    if(is_blank($customer['address'])) {
      $errors[] = "Address cannot be blank.";
    } 

    if(is_blank($customer['country'])) {
      $errors[] = "Country cannot be blank.";
    }

    return $errors;
  }

  //show brands in the index
  function getBrands(){

    global $db;

    $get_brands = "select * from brands";
    $run_brands = mysqli_query($db,$get_brands);

    while ($row_brands = mysqli_fetch_array($run_brands)){
      $brand_id = $row_brands['brand_id'];
      $brand_title = $row_brands['brand_title'];
      $brand_image = $row_brands['brand_image'];

      echo " <li class='col-6 col-md-3'>
      <a href='brand_products.php?brand=$brand_id' class='itembox'> 
      <div class='card-body'>
      <img class='img-sm' src='images/brands/$brand_image'>

      </div>
      </a>  
      </li>";
    }
  }

   function getBrandsDropdown(){

    global $db;

    $get_brands = "select * from brands";
    $run_brands = mysqli_query($db,$get_brands);

    while ($row_brands = mysqli_fetch_array($run_brands)){
      $brand_id = $row_brands['brand_id'];
      $brand_title = $row_brands['brand_title'];

      echo "<a class='dropdown-item' href='brand_products.php?brand=$brand_id'>$brand_title </a>";
    }
  }

  // collect products by brand
function getBrandPro(){
    global $db;

    if(isset($_GET['brand'])){

        $brand_id = $_GET['brand'];

        $get_brand_pro = "SELECT * FROM products WHERE product_brand='$brand_id'";

        $run_brand_pro = mysqli_query($db, $get_brand_pro);

        $count_brands = mysqli_num_rows($run_brand_pro);

        if($count_brands==0){

            echo "<div class='row'>
            <div class='col-lg-12  ml-3 mb-1'>
            <div style='align-content: center;'>
             <p class='lead'  text-align: right;'>No products of this brand yet</p>
             <a href='index.php'>
             <button class='btn btn-success' style='align: right'>Go back</button></a>
             </div>
            </div>
           </div>
          ";
        }

        while($row_brand_pro=mysqli_fetch_array($run_brand_pro)){

            $pro_id = $row_brand_pro['product_id'];
            $pro_brand = $row_brand_pro['product_brand'];
            $pro_title = $row_brand_pro['product_title'];
            $pro_price = $row_brand_pro['product_price'];
            $pro_desc = $row_brand_pro['product_description'];
            $pro_image = $row_brand_pro['product_image'];

            echo "
                <div class='col-md-3 col-sm-6'>
                  <figure class='card card-product'>
                  <div class='img-wrap'> <a href='detail.php?pro_id=$pro_id'><img src='images/items/$pro_image'></a></div>
                    <figcaption class='info-wrap'>
                      <a href='detail.php?pro_id=$pro_id' class='title'>$pro_title</a>
                        <div class='price-wrap'>
                         <span class='price-new'>$ $pro_price</span>
                        </div> <!-- price-wrap.// -->
                    </figcaption>
                  </figure> <!-- card // -->
                </div> <!-- col // -->
            ";
        } }
      }

  //show products in the index
  function getProducts(){
    global $db;

    if(!isset($_GET['brand'])){

    $get_pro = "SELECT * FROM products ORDER BY rand() LIMIT 8";

      $run_pro = mysqli_query($db, $get_pro);

      while($row_pro=mysqli_fetch_array($run_pro)){

        $pro_id = $row_pro['product_id'];
        $pro_brand = $row_pro['product_brand'];
        $pro_title = $row_pro['product_title'];
        $pro_price = $row_pro['product_price'];
        $pro_desc = $row_pro['product_description'];
        $pro_image = $row_pro['product_image'];

        echo "

          <div class='col-md-3'>
          <figure class='card card-product'>
          <div class='img-wrap'> <a href='detail.php?pro_id=$pro_id'><img src='images/items/$pro_image'></a></div>
          <figcaption class='info-wrap'>
          <h6 class='title'><a href='detail.php?pro_id=$pro_id'>$pro_title</a></h6>
      
          <div class='price-wrap'>
          <span class='price-new'>$ $pro_price</span>
          
          </div> <!-- price-wrap.// -->
      
          </figcaption>
          </figure> <!-- card // -->
          </div> <!-- col // -->
        ";
    } }
  }

  function getProduct($id){
    global $db;
    $sql = "SELECT * FROM products WHERE product_id='".$id ."'";
    $result = mysqli_query($db, $sql);

    $product = mysqli_fetch_assoc($result);
    return $product;
  }

  function getQuantity($id) {
    global $db;
    $sql = "SELECT product_quantity FROM products WHERE product_id='".$id ."'";
    $result = mysqli_query($db, $sql);


    $product = mysqli_fetch_assoc($result);
    return $product;
  }



function addToCart($email){

    if(isset($_GET['add_cart']) && isset($_SESSION['user_email'])){

        global $db;

        $pro_id = $_GET['add_cart'];

        $check_pro = "SELECT * from cart where email='".$email."' AND product_id='$pro_id'";

        $run_check = mysqli_query($db, $check_pro);

        if(mysqli_num_rows($run_check)>0){
            if(!isset($_GET['ajax']))
            echo "<script>window.alert('already inserted')</script>";
          else{
            exit('already inserted');
          }

        }
        else {

            $insert_pro = "INSERT into cart (product_id,email, product_quantity) values ('$pro_id','" . $email . "','$_GET[quantity]')";

            $run_pro = mysqli_query($db, $insert_pro);

            if ($run_pro) {

                echo "<script>window.open('cart.php','_self')</script>";

            }

            }
        } 
    
  }

function deleteFromCart($email){
    global $db;

    if(isset($_GET['delete'])) {

        $pro_id = $_GET['id'];

        $delete_product = "DELETE FROM cart WHERE product_id='$pro_id' AND email='$email'";
        //$delete_product_order = "DELETE FROM orders WHERE product_id='$pro_id' AND email='$email'";

        if (mysqli_query($db, $delete_product)) {
            
        } else {
            echo "Error deleting record: " . mysqli_error($db);
        }

    }
}


function deleteFromWish($email){
    global $db;

    if(isset($_GET['delete'])) {

        $pro_id = $_GET['id'];

        $delete_product = "DELETE FROM wishlist WHERE product_id='$pro_id' AND email='$email'";
        //$delete_product_order = "DELETE FROM orders WHERE product_id='$pro_id' AND email='$email'";
        if (mysqli_query($db, $delete_product)) {
            
        } else {
            echo "Error deleting record: " . mysqli_error($db);
        }

    }
}




function find_all_in_cart($email) {

    global $db;
    /*
    $sql = "SELECT product_id, product_title,product_price, quantity_ordered FROM cart, products,user ";
    $sql .= "WHERE email='" . $email. "' ";
    $sql .= "AND cart.email = user.email ";
    $sql .= "AND cart.product_id = products.product_id";*/
    $sql = "SELECT products.product_id, products.product_title, products.product_price, products.product_image, cart.quantity_ordered FROM cart, products,user WHERE user.email='$email' AND cart.email = user.email AND cart.product_id = products.product_id";    
    //echo $sql;
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

function find_all_wishes($email) {

    global $db;
    /*
    $sql = "SELECT product_id, product_title,product_price, quantity_ordered FROM cart, products,user ";
    $sql .= "WHERE email='" . $email. "' ";
    $sql .= "AND cart.email = user.email ";
    $sql .= "AND cart.product_id = products.product_id";*/
    $sql = "SELECT products.product_id, products.product_title, products.product_price, products.product_image FROM wishlist, products,user WHERE user.email='$email' AND wishlist.email = user.email AND wishlist.product_id = products.product_id";    
    //echo $sql;
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function insertWish($id,$email){
      global $db;

      $sql = "INSERT INTO wishlist ";
      $sql .= "(email,product_id) ";
      $sql .= "VALUES (";
      $sql .= "'" . db_escape($db, $email) . "',";
      $sql .= "'" . db_escape($db, $id) . "'";  
      $sql .= ")";
      $result = mysqli_query($db, $sql);

      // For INSERT statements, $result is true/false
      if($result) {
        return true;
      } else {
        // INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
      }     

  }

  function deleteWish($id,$email){
      global $db;

      $sql = "DELETE FROM wishlist ";
      $sql .= "WHERE product_id='" . db_escape($db, $id) . "' ";
      $sql .= "AND email='" . db_escape($db, $email) . "' ";      
      $sql .= "LIMIT 1";
      $result = mysqli_query($db, $sql);  
      
      // For DELETE statements, $result is true/false
      if($result) {
        return true;
      } else {
        // DELETE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
      } 
  }

   
   function exist_in_wish($id,$email){
   
     global $db;

     $sql = "SELECT * FROM wishlist ";
   
     $sql .= "WHERE product_id='" . db_escape($db,$id) . "' ";
     $sql .= "AND email='" . db_escape($db,$email) . "'";

     $wishes = mysqli_query($db,$sql);
   
     $wishCount = mysqli_num_rows($wishes);
   
     mysqli_free_result($customers);
     return $wishCount !== 0;   
   } 

    function FetchBrands()
  {
    global $db;
    $query = "SELECT * FROM BRANDS";
  
    $result = mysqli_query( $db,$query);
    if ( mysqli_num_rows($result) > 0 ){
      $brands = $result;
    }else {
      $brands = 0;
    }
      
      return $brands;
  }
  
   function getPro($brands,$prices){
      global $db;
      $products = [];
      
      if ($prices["min_price"] == "" && $prices["max_price"] == ""){
        $prices = false;
      }
      else{
        if( $prices["min_price"] > $prices["max_price"] ){
          return 'Invalid Price Range';
        }
      }
      if($brands){
        $filtered = implode(",",$brands);
        $query = "SELECT * FROM products INNER JOIN brands WHERE brands.brand_id = products.product_brand AND (products.product_brand IN ($filtered))";
      }else {
        $query = "SELECT * FROM products";
      }
      if($prices){
        if($brands == false){
          $query .= " WHERE";
        }
        if ($prices["min_price"] != "" && $prices["max_price"] != "" && $brands ==false )
        {
          
          $query .= " products.product_price > " . (string)$prices['min_price'];
          $query .= " AND products.product_price < " . (string)$prices['max_price'];

        }else if($prices["min_price"] != "" && $prices["max_price"] != ""){
          $query .= "AND products.product_price > " . (string)$prices['min_price'];
          $query .= " AND products.product_price < " . (string)$prices['max_price'];
        }
        
        
        else if ($prices["min_price"] != "")
        {
          $query .= " AND products.product_price > " . (string)$prices['min_price'];
        }else if ($prices["max_price"] != ""){
          $query .= " AND products.product_price < " . (string)$prices['max_price'];
        }    
        
      }
   
      $run_pro = mysqli_query($db, $query);
      while($row_pro=mysqli_fetch_array($run_pro)){

        $pro_id = $row_pro['product_id'];
        $pro_brand = $row_pro['product_brand'];
        $pro_title = $row_pro['product_title'];
        $pro_price = $row_pro['product_price'];
        $pro_desc = $row_pro['product_description'];
        $pro_image = $row_pro['product_image'];

        echo "

          <div class='col-md-3'>
          <figure class='card card-product'>
          <div class='img-wrap'> <a href='detail.php?pro_id=$pro_id'><img src='images/items/$pro_image'></a></div>
          <figcaption class='info-wrap'>
          <h6 class='title'><a href='detail.php?pro_id=$pro_id'>$pro_title</a></h6>
      
          <div class='price-wrap'>
          <span class='price-new'>$ $pro_price</span>
          
          </div> <!-- price-wrap.// -->
      
          </figcaption>
          </figure> <!-- card // -->
          </div> <!-- col // -->
        ";
      }
    } 

  function get_products_search($keyword){
     global $db;

     $sql = "SELECT * FROM products ";
   
     $sql .= "WHERE product_title LIKE '%". db_escape($db,$keyword) . "%' ";
     $sql .= "OR product_description LIKE '%". db_escape($db,$keyword) . "%'";

     $result = mysqli_query($db,$sql);
     confirm_result_set($result);
     return $result; 
   }
   
   function find_all_orders($email) {

    global $db;

    $sql = "SELECT products.product_title, products.product_image, products.product_description, products.product_price FROM products,user,orders WHERE user.email='$email' AND orders.email = user.email  AND orders.product_id = products.product_id";    
    //echo $sql;
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function insert_review($email, $product_id, $review) {
    global $db;

    $sql = "INSERT INTO text_review";
    $sql .= "(email, product_id, text_review) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $email) . "',";
    $sql .= "'" . db_escape($db, $product_id) . "',";
    $sql .= "'" . db_escape($db, $review) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if($result) {
      return true;
    } else {
      // INSERT failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function find_reviews($product_id) {
    global $db;

    $sql = "select text_review, first_name
            from text_review, user
            where text_review.email = user.email
            and product_id = '$product_id'
            ";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function filter($min, $max, $keyword) {
    global $db;

    $sql = "SELECT * FROM products ";
    $sql .= "WHERE product_price between '" . db_escape($db, $min) . "' ";
    $sql .= "AND '" . db_escape($db, $max) . "' ";
    $sql .= "AND product_title LIKE '%". db_escape($db,$keyword) . "%' ";
    $sql .= "OR product_description LIKE '%". db_escape($db,$keyword) . "%'";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result; // returns an assoc. array
  }

  function exist_product($id){
    global $db;

    $sql = "SELECT * FROM products ";
    $sql .= "WHERE product_id='" . db_escape($db,$id) . "' ";

    $products = mysqli_query($db,$sql);
    $product_count = mysqli_num_rows($products);
    mysqli_free_result($products);

    return $product_count !== 0;

  }

  function exist_product_cart($email){
    global $db;

    $sql = "SELECT * FROM cart ";
    $sql .= "WHERE email='" . db_escape($db,$email) . "'";

    $products = mysqli_query($db,$sql);
    $product_count = mysqli_num_rows($products);
    mysqli_free_result($products);

    return $product_count !== 0;

  }

  function exist_product_wishlist($email){
    global $db;

    $sql = "SELECT * FROM wishlist ";
    $sql .= "WHERE email='" . db_escape($db,$email) . "'";

    $products = mysqli_query($db,$sql);
    $product_count = mysqli_num_rows($products);
    mysqli_free_result($products);

    return $product_count !== 0;

  }

    function exist_product_orders($email){
    global $db;

    $sql = "SELECT * FROM orders ";
    $sql .= "WHERE email='" . db_escape($db,$email) . "'";

    $products = mysqli_query($db,$sql);
    $product_count = mysqli_num_rows($products);
    mysqli_free_result($products);

    return $product_count !== 0;

  }


  function get_products_ascending($keyword){
     global $db;

     $sql = "SELECT * FROM products ";
   
     $sql .= "WHERE product_title LIKE '%". db_escape($db,$keyword) . "%' ";
     $sql .= "OR product_description LIKE '%". db_escape($db,$keyword) . "%' ";
     $sql .= "ORDER BY product_price ASC";
     $result = mysqli_query($db,$sql);
     confirm_result_set($result);
     return $result; 
   }

  function get_products_descending($keyword){
     global $db;

     $sql = "SELECT * FROM products ";
   
     $sql .= "WHERE product_title LIKE '%". db_escape($db,$keyword) . "%' ";
     $sql .= "OR product_description LIKE '%". db_escape($db,$keyword) . "%' ";
     $sql .= "ORDER BY product_price DESC";
     $result = mysqli_query($db,$sql);
     confirm_result_set($result);
     return $result; 
   }

  function update_product($id,$quantity_ordered){
    global $db;

    $sql = "UPDATE products ";
    $sql .= "SET product_quantity=product_quantity - '" . $quantity_ordered . "' ";
    $sql .= "WHERE product_id='" . db_escape($db,$id) . "'";


    $result = mysqli_query($db,$sql);
    return $result;
  }

?>
