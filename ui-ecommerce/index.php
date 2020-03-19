<?php
include("initialize.php");
include("header.php");
?>
<!-- ========================= SECTION MAIN ========================= -->
<section class="section-main bg padding-y-sm">
<div class="container">
<div class="card">
	<div class="card-body">
<div class="row row-sm">
	
	<div class="col-md-12">

<!-- ================= main slide ================= -->
<div class="owl-init slider-main owl-carousel" data-items="1" data-nav="true" data-dots="false">
	<div class="item-slide">
		<img src="images/banner1.jpg">
	</div>
	<div class="item-slide">
		<img src="images/banner2.jpeg">
	</div>
	<div class="item-slide">
		<img src="images/banner1.jpeg">
	</div>
</div>
<!-- ============== main slidesow .end // ============= -->

	</div> <!-- col.// -->

</div> <!-- row.// -->
	</div> <!-- card-body .// -->
</div> <!-- card.// -->


</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION MAIN END// ========================= -->


<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y-sm bg">
<div class="container">

<header class="section-heading heading-line">
	<h4 class="title-section bg">BRANDS</h4>
</header>

<div class="card">
<div class="row no-gutters">
	<div class="col-md-3">
	
<article href="#" class="card-banner h-100 bg2">
	<div class="card-body zoom-wrap">
		<h5 class="title">Brands</h5>
		<p>Consectetur adipisicing elit</p>
	</div>
</article>


	</div> <!-- col.// -->
	<div class="col-md-9">
<ul class="row no-gutters border-cols">
	
<?php getBrands(); ?>
</ul>
	</div> <!-- col.// -->
</div> <!-- row.// -->
	
</div> <!-- card.// -->

</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->

<!-- ========================= SECTION CONTENT ========================= -->



<!-- ========================= SECTION ITEMS ========================= -->
<section class="section-request bg padding-y-sm">
<div class="container">
<header class="section-heading heading-line">
	<h4 class="title-section bg text-uppercase">Items</h4>
</header>

<div class="row-sm">

<?php getProducts(); ?>
</div> <!-- row.// -->


</div><!-- container // -->
</section>

</section>
<!-- ========================= SECTION SUBSCRIBE END.//========================= -->
<?php
include("footer.php");

?>