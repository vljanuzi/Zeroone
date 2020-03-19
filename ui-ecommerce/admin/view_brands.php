<?php
include("../initialize.php");     
?>
<!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.php">Admin area</a>
          </li>
          <li class="breadcrumb-item active">View brands</li>
        </ol>

<div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Brands table</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Brand Title</th>
                    <th>Image</th>   

                    <th></th>
                  </tr>
                </thead>
                <tfoot>
                </tfoot>
                <tbody>
                  <tr>

                  	<?php
                  	global $db;
                  		$get_brands = "select * from brands";
	
						$run_brands = mysqli_query($db, $get_brands); 
	

						$i = 0;
	
						while ($row_brands=mysqli_fetch_array($run_brands)){
							$brand_id = $row_brands['brand_id'];
							$brand_title = $row_brands['brand_title'];
              $brand_image = $row_brands['brand_image'];


							$i++;
	
					?>
					<tr>
				<td><?php echo $brand_title;?></td>
        <td><img src="../images/brands/<?php echo $brand_image;?>" width="60" height="60"> </td>


				<td><button type="button" class="btn btn-primary"><a href="index.php?edit_brand=<?php echo $brand_id;?>" style="color: #fff"><i class="fa fa-pen"></i></a></button>
					<button type="button" class="btn btn-danger"><a href="index.php?delete_brand=<?php echo $brand_id;?>" style="color: #fff"><i class="fa fa-trash"></i></a></button></td>
	</tr>
	
	<?php } ?>
				
               
                </tbody>
              </table>
            </div>
          </div>
        </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>