<?php
include("../initialize.php"); 

?>
<!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.php">Admin area</a>
          </li>
          <li class="breadcrumb-item active">View products</li>
        </ol>
    <form method="post" action="excel_products.php">
        <button type="submit" class="btn btn-success" name="export_excel"> Export to Excel</button>
      </form>
        <br>
   <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Products table</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Title</th>

                    <th>Price</th>
                    <th>Brand</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Image</th>
                    <th></th>
                    
                  </tr>
                </thead>
                <tfoot>
                  <tr>

                    <th>Title</th>
                    <th>Price</th>
                    <th>Brand</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Image</th>
					<th></th>

                  </tr>
                </tfoot>
                <tbody>
                  <tr>

                  	<?php
                  	global $db;
                  		$get_products = "select * from products";
	
						$run_products = mysqli_query($db, $get_products); 
	

						$i = 0;
	
						while ($row_products=mysqli_fetch_array($run_products)){
							$product_id = $row_products['product_id'];
							$product_title = $row_products['product_title'];
							$product_brand = $row_products['product_brand'];
							$product_description = $row_products['product_description'];
							$product_quantity = $row_products['product_quantity'];
							$product_image = $row_products['product_image'];
							$product_price = $row_products['product_price'];

							$get_brand = "select * from brands where brand_id = '$product_brand'";

							$run_brand = mysqli_query($db, $get_brand);

							$row_brand = mysqli_fetch_array($run_brand);

							$brand_title = $row_brand['brand_title'];
							$i++;
	
					?>
					<tr>
				<td><?php echo $product_title;?></td>
				<td>$<?php echo $product_price;?></td>
				<td><?php echo $brand_title;?></td>
				<td><?php echo $product_description;?></td>
				<td><?php echo $product_quantity;?></td>
				<td><img src="../images/items/<?php echo $product_image;?>" width="60" height="60"> </td>

				<td><button type="button" class="btn btn-primary"><a href="index.php?edit_product=<?php echo $product_id;?>" style="color: #fff"><i class="fa fa-pen"></i></a></button>
					<button type="button" class="btn btn-danger"><a href="index.php?delete_product=<?php echo $product_id;?>" style="color: #fff"><i class="fa fa-trash"></i></a></button></td>
	</tr>
	
	<?php } ?>
				
               
                </tbody>
              </table>
            </div>
          </div>
         
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>