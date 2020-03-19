<?php
require_once("initialize.php");
require_login();
include('header.php'); 

$email = $_SESSION['user_email'];
deleteFromWish($email);

$wishes = find_all_wishes($email);
?>




<body>

<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content bg padding-y border-top">
<div class="container">

<div class="row">
    <main class="col-sm-12">

<div class="card">
<table class="table table-hover shopping-cart-wrap">
<thead class="text-muted">
<tr>
  <th scope="col">Product</th>
  <th scope="col" width="120">Price</th>
  <th scope="col" class="text-right" width="200">Action</th>
</tr>
</thead>
<tbody>

 
<?php while($wish = mysqli_fetch_assoc($wishes)) { ?>

<tr>
    <td>
<figure class="media">
    <div class="img-wrap"><img src="images/items/<?php echo $wish['product_image']; ?>" class="img-thumbnail img-sm"></div>
    <figcaption class="media-body">
        <h6  class="title text-truncate"><a href="detail.php?pro_id=<?php echo $wish['product_id'] ?>"><?php echo $wish['product_title']; ?></a></h6>
    </figcaption>
</figure> 
    </td>
    <td> 
        <div class="price-wrap"> 
            <var class="price">$<?php echo $wish['product_price']; ?></var> 
        </div> <!-- price-wrap .// -->
    </td>
    <td class="text-right"> 
    <a href="wishlist.php?delete&id=<?php echo $wish['product_id'];?>" class="btn btn-outline-danger"> × Remove</a>
    </td>
</tr>

</tr>
</tbody>
      <?php } ?>

</table>
   <?php if (!exist_product_wishlist($email)) {
    echo '<p class="alert alert-danger">You do not have any products in your favorite items!</p>';
}
?>
</div> <!-- card.// -->

    </main> <!-- col.// -->
    


</section>
<!-- ========================= SECTION CONTENT END// ========================= -->

<!-- ========================= SECTION  ========================= -->

<!-- ========================= SECTION  END// ========================= -->



</body>
</html>



<?php include('footer.php'); ?>
