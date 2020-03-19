<?php
require_once("initialize.php");
require_login();
include('header.php'); 

$email = $_SESSION['user_email'];
addToCart($email);
deleteFromCart($email);

//checkOut($email);

$inCarts = find_all_in_cart($email);
$total = 0;
?>

<body>

<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content bg padding-y border-top">
<div class="container">

<div class="row">
    <main class="col-sm-10">

<div class="card">
<table class="table table-hover shopping-cart-wrap">
<thead class="text-muted">
<tr>
  <th scope="col">Product</th>
  <th scope="col" width="120">Quantity</th>
  <th scope="col" width="120">Price</th>
  <th scope="col" class="text-right" width="200">Action</th>
</tr>
</thead>

<?php

        while($item=mysqli_fetch_assoc($inCarts)){?>

            <tr>

    <td>
<figure class="media">
    <div class="img-wrap"><img src="images/items/<?php echo $item['product_image'] ?>" class="img-thumbnail img-sm"></div>
    <figcaption class="media-body">
        <h6 class="title text-truncate"><a href="detail.php?pro_id=<?php echo $item['product_id'] ?>"><?php echo $item['product_title'] ?> </a></h6>
        <dl class="dlist-inline small">
          <dt>Size: </dt>
          <dd>XXL</dd>
        </dl>
        <dl class="dlist-inline small">
          <dt>Color: </dt>
          <dd>Orange color</dd>
        </dl>
    </figcaption>
</figure> 
    </td>
    <td><?php echo $item['quantity_ordered'] ?></td>
    <td> 
        <div class="price-wrap"> 
            <var class="price">$ <?php

                            $subtotal = $item['product_price']*$item['quantity_ordered'];
                            $total+=$subtotal;
                            echo $subtotal;

                            ?></var> 
            <small class="text-muted">Single price-$ <?php echo $item['product_price'] ?></small> 
        </div> <!-- price-wrap .// -->
    </td>
    <td class="text-right"> 
    <a href="cart.php?delete&id=<?php echo $item['product_id'] ?>" class="btn btn-outline-danger"> × Remove</a>
    </td>
</tr> 


        <?php } ?>
    


    </aside> 
 


<tbody>
</tbody>

</table>
   <?php if (!exist_product_cart($email)) {
    echo '<p class="alert alert-danger">You do not have any products in your cart!</p>';
}
?>
</div>

</main>
<aside class="col-sm-2">

<dl class="dlist-align h4">
  <dt>Total:</dt>
  <dd class="text-right"><strong>$ <?php echo $total ?></strong></dd>
</dl>
<hr>
<div class='col-sm-2 float-left'>

<a href="checkout.php?checkout">             
                <input type='submit' name='add' style='margin-left: 75px;' class='btn btn-danger'
                       value='Buy Now'></a>
</div>
</div>
</section>

</body>
          
</html>



<?php include('footer.php'); ?>
