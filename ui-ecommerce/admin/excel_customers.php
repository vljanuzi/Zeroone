 <?php

include("../initialize.php");
$output = '';    

          if(isset($_POST["export_excel"])) {
            $sql = "select first_name, last_name, email, country, address from user order by first_name ASC";
              $result = mysqli_query($db, $sql);
             if(mysqli_num_rows($result) > 0)
                {
                $output .= '
                 <table class="table" bordered="1">  
                    <tr>  
                     <th>ID</th>  
                     <th>Product title</th>  
                     <th>Product price</th>  
                     <th>Product description</th>
                     <th>Product quantity</th>
                    </tr>
                ';
                while($results = mysqli_fetch_array($result))
                {
                 $output .= '
                  <tr>  
                    <td>'.$results["first_name"].'</td>
                    <td>'.$results["last_name"].'</td>
                    <td>'.$results["email"].'</td>
                    <td>'.$results["country"].'</td> 
                    <td>'.$results["address"].'</td> 
  
                  </tr>
                 ';
                }
                $output .= '</table>';
                header('Content-Type: application/xls');
                header('Content-Disposition: attachment; filename=customers.xls');
                echo $output;
              }
          }

          ?>