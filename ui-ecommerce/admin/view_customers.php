<?php
include("../initialize.php"); 
?>
<!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.php">Admin area</a>
          </li>
          <li class="breadcrumb-item active">View customers</li>
        </ol>
      <form method="post" action="excel_customers.php">
        <button type="submit" class="btn btn-success" name="export_excel"> Export to Excel</button>
      </form>
        <br>

   <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Customers table</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Address</th>
                    <th>Country</th>
                    <th></th>                    
                    
                  </tr>
                </thead>
                <tfoot>
                  <tr>

                    <th>First name</th>
                    <th>Last name</th>
                    <th>Address</th>
                    <th>Country</th>

					         <th></th>
                   
                  </tr>
                </tfoot>
                <tbody>
                  <tr>

              <?php
                  	global $db;
                  		$get_user = "select * from user";
	
						  $run_user = mysqli_query($db, $get_user); 
	            //$row_user = mysqli_fetch_array($run_user);
              
              while ($row_user=mysqli_fetch_array($run_user)){
              $email = $row_user['email'];
							$first_name = $row_user['first_name'];
							$last_name = $row_user['last_name'];
							$address = $row_user['address'];
							$country = $row_user['country'];

					?>
         
					
				<td><?php echo $first_name;?></td>
				<td><?php echo $last_name;?></td>
				<td><?php echo $address;?></td>
				<td><?php echo $country;?></td>

					<td><button type="button" class="btn btn-danger"><a href="index.php?delete_customer=<?php echo $email;?>" style="color: #fff"><i class="fa fa-trash"></i></a></button></td>
	</tr>
    <?php } ?>
               
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>