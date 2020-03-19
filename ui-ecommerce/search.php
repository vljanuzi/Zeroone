<?php
include("header.php");
include("initialize.php");
$keyword = $_GET['search'];

$products = get_products_search($keyword);

if (is_post()) {
	$min = $_POST['min'];
	$max = $_POST['max'];

	$products = filter($min, $max, $keyword);
}
?>
<body>


<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content bg padding-y-sm">
<div class="container">
<div class="card">
	<div class="card-body">


<div class="row">
	<div class="col-md-3-24"> <strong>Filter by:</strong> </div> <!-- col.// -->
	<div class="col-md-21-24"> 
		<ul class="list-inline">
		  

		  <li class="list-inline-item"><a href="sortascending.php?keyword=<?php echo $keyword;?>">Price Low to High</a></li>
		  <li class="list-inline-item"><a href="sortdescending.php?keyword=<?php echo $keyword;?>">Price High to Low</a></li>

		  <li class="list-inline-item">
		  	<form method="post" action="">
		  	<div class="form-inline">
		  		<label class="mr-2">Price</label>
				<input class="form-control form-control-sm" name="min" placeholder="Min" type="number">
					<span class="px-2"> - </span>
				<input class="form-control form-control-sm" name="max" placeholder="Max" type="number">
				<button type="submit" class="btn btn-warning ml-2">Apply</button>
			</div>
			</form>
		  </li>
		</ul>
	</div> <!-- col.// -->
</div> <!-- row.// -->
	</div> <!-- card-body .// -->
</div> <!-- card.// -->

<div class="padding-y-sm">
</div>
<div class="row-sm">
<?php while($product = mysqli_fetch_assoc($products)) { ?>


<div class="col-md-3 col-sm-6">
	<figure class="card card-product">
		<div class="img-wrap"> <img src="images/items/<?php echo $product['product_image'];  ?>"></div>
		<figcaption class="info-wrap">
			<a href="detail.php?pro_id=<?php echo $product['product_id'];  ?>" class="title"><?php echo $product['product_title'];  ?></a>
			<div class="price-wrap">
				<span class="price-new">$<?php echo $product['product_price'];  ?></span>
			</div> <!-- price-wrap.// -->
		</figcaption>
	</figure> <!-- card // -->
</div> <!-- col // -->


<?php
 }

?>
</div> <!-- row.// -->
</div> <!-- row.// -->


</div><!-- container // -->
</section>
<!-- ========================= SECTION CONTENT .END// ========================= -->

<?php

include("footer.php");
?>