 <?php

include("../initialize.php");
$output = '';    

          if(isset($_POST["export_excel"])) {
            $sql = "select product_id, product_title, product_price, product_description, product_quantity from products order by product_id ASC";
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
                    <td>'.$results["product_id"].'</td>
                    <td>'.$results["product_title"].'</td>
                    <td>'.$results["product_price"].'</td>
                    <td>'.$results["product_description"].'</td> 
                    <td>'.$results["product_quantity"].'</td> 
  
                  </tr>
                 ';
                }
                $output .= '</table>';
                header('Content-Type: application/xls');
                header('Content-Disposition: attachment; filename=products.xls');
                echo $output;
              }
          }

          ?>