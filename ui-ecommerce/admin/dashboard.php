<?php
include("../initialize.php");
?>
<!-- Sidebar -->
    <ul class="sidebar navbar-nav">
     
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>Manage database</span>
        </a>
        
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <h6 class="dropdown-header">Products</h6>
          <a class="dropdown-item" href="index.php?add_product">Add new product</a>
          <a class="dropdown-item" href="index.php?view_products">View products</a>
          <div class="dropdown-divider"></div>
          <h6 class="dropdown-header">Brands</h6>
          <a class="dropdown-item" href="index.php?add_brand">Add new brand</a>
          <a class="dropdown-item" href="index.php?view_brands">View brands</a>
           <div class="dropdown-divider"></div>
          <h6 class="dropdown-header">Customers</h6>
          <a class="dropdown-item" href="index.php?view_customers">View customers</a>

        </div>
      </li>

    </ul>