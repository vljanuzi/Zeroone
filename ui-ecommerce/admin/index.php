<?php
include("../initialize.php");
include("header.php");
require_admin_login();

?>

  <div id="wrapper">

    <?php
    include("dashboard.php");

              global $db;
              $get_user = "select first_name from user where email = 'admin@gmail.com'";
  
              $run_user = mysqli_query($db, $get_user); 
              $row_user = mysqli_fetch_array($run_user);
              $first_name = $row_user['first_name'];
    ?>

    <div id="content-wrapper">

      <div class="container-fluid">
        <div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">Hi, <?php echo $first_name?></h1>
    <p class="lead">Welcome to the dashboard. Here you can manage all of your customers and orders.
</p>
  </div>
</div>


        <?php

        if(isset($_GET['add_product'])) {
          include("add_product.php");
        }

        if(isset($_GET['view_products'])) {
          include("view_products.php");
        }

        if(isset($_GET['edit_product'])) {
          include("edit_product.php");
        }
        if(isset($_GET['delete_product'])) {
          include("delete_product.php");
        }
        if(isset($_GET['add_brand'])) {
          include("add_brand.php");
        }

        if(isset($_GET['view_brands'])) {
          include("view_brands.php");
        }
        if(isset($_GET['edit_brand'])) {
          include("edit_brand.php");
        }
        if(isset($_GET['delete_brand'])) {
          include("delete_brand.php");
        }
        if(isset($_GET['view_customers'])) {
          include("view_customers.php");
        }
        if(isset($_GET['delete_customer'])) {
          include("delete_customer.php");
        }
        ?>


      <!-- /.container-fluid -->
<?php
include("footer.php");
?>
