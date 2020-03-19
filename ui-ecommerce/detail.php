<?php
require_once('initialize.php');
require_once('header.php');
/*if(!isset($_GET['pro_id'])) {
  redirect_to('error.php');
} */
$id = $_GET['pro_id'];
if (!exist_product($id)) {
  redirect_to("error.php");
}

$product = getProduct($id);
$uData = 0;
function getAvgRating($id)
{
  global $db;
  $result = mysqli_query($db,"select round(AVG(rate),1) from review where product_id = $id ");
  $uData=mysqli_fetch_array($result);
  return $uData[0]  ;
}

if(isset($_SESSION['user_email'])){
	$email = $_SESSION['user_email'];
		addToCart($email);
	function is_favorite($id,$email) {
    return exist_in_wish($id,$email);
    //return in_array($id, $_SESSION['favorites']);
	}
}

?>

  <head>
    <style>
      /*
      button.favorite-button, button.unfavorite-button {
        background: #0000FF;
        color: white;
        text-align: center;
        width: 70px;
      }

      button.favorite-button:hover, button.unfavorite-button:hover {
        background: #000099;
      }
	  */	
      button.favorite-button {
        display: inline;
      }
      .favorite button.favorite-button {
        display: none;
      }
      button.unfavorite-button {
        display: none;
      }
      .favorite button.unfavorite-button {
        display: inline;
      }

      .favorite-heart {
        display: none;
      }
      .favorite .favorite-heart {
        display: inline;
      }
      .unfavorite-heart {
        display: none;
      }
      .unfavorite .unfavorite-heart {
        display: inline;
      }
      
    </style>
  </head>


<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content bg padding-y-sm">
<div class="container">
<div class="row">
<div class="col-xl-12 col-md-12 col-sm-12">


<main class="card">
	<div class="row no-gutters">
		<aside class="col-sm-6 border-right">
<article class="gallery-wrap"> 
<div class="img-big-wrap">
  <div><img src="images/items/<?php echo $product['product_image']?>"></div>
</div> <!-- slider-product.// -->
</article> <!-- gallery-wrap .end// -->
		</aside>
		<aside class="col-sm-6">
<article class="card-body">
<!-- short-info-wrap -->
<form id="add_to_cart_form" action='ajax.php' method="get">
	<input type="hidden" name="prod_id" value="<?php echo $id ?>" />
                        <input type="hidden" name="add_cart" value="<?php echo $id ?>" />
                        <input type="hidden" name="add_order" value="<?php echo $id ?>" />
	<h3 class="title mb-3"><?php echo $product['product_title']?></h3>
 
<div class="mb-3"> 
	<var class="price h3 text-warning"> 
		<span class="currency">US $</span><span class="num"><?php echo $product['product_price']?></span>
	</var>
</div> <!-- price-detail-wrap .// -->
<dl>
  <dt>Description</dt>
  <dd><p><?php echo $product['product_description']?></p></dd>
</dl>

<div class="rating-wrap">


<h4>Already have this product? Rate it!</h4>
	<ul class="rating-stars">
    <i class="fa fa-star fa-2x" data-index="0"></i>
    <i class="fa fa-star fa-2x" data-index="1"></i>
    <i class="fa fa-star fa-2x " data-index="2"></i>
    <i class="fa fa-star fa-2x " data-index="3"></i>
    <i class="fa fa-star fa-2x " data-index="4"></i>
  
		
	</ul><br><br>
	 <!-- rating-wrap.// -->
   <i class="fa fa-star fa-5x  " style="font-size:30px;color:orange;"></i>
<div class ="label-rating" ><b>
<h2 align="center"style="color:black">
<?=getAvgRating($id) ?></h2></b>
</div>

</div>

<hr>
	<div class="row">
		<div class="col-sm-5">
			<dl class="dlist-inline">
			  <dt>Quantity: </dt>
			  <dd> 
			  	 <select name="quantity" class="form-control form-control-sm" style="width:70px;">
			  		<option> 1 </option>
			  		<option> 2 </option>
			  		<option> 3 </option>
			  		<option> 4 </option>
			  	</select>
			  <!--	<input type='text' name='quantity' class='form-control' value='1'> -->
			  </dd>
			</dl>  <!-- item-property .// -->
		</div> <!-- col.// -->
	</div> <!-- row.// -->
	<hr>
	<!--add to cart -->
	<!--<button type="submit"id="add_button" name="add" class="btn btn-outline-warning" data-toggle="modal" data-target="#exampleModal">Add to cart</button> --></form> 
	
  <?php 
		if(isset($_SESSION['user_email'])){
			echo "<!--<div class='col-lg-3'><input type='submit' id='add_button' name='add'style='margin-top: 5px;' class='btn  btn-outline-warning' value='Add to Cart'></div>
				<button type='submit' id='add_button' name='add' style='margin-top: 5px; display: none' class='btn btn-primary'
                                                                  >Add to cart</button> -->

					<button type='submit'id='add_button' name='add' style='margin-top: 5px;'' class='btn btn-outline-warning' >
 						 Add to cart
					</button>";
      ?>
      <div style="display:inline" id="<?php echo $id; ?>" class="<?php if(is_favorite($id,$email)) { echo 'favorite'; }else{echo 'unfavorite';} ?>">
	<span class="favorite-heart"><img src="images/icons/like.png" style="margin-left: 12px;" ></span>
	<span class="unfavorite-heart"><img src="images/icons/unlike.png" style="margin-left: 12px;" ></span>
	
	<button type="button" class="btn btn-primary-outline favorite-button" style="background-color: transparent; border-color: white">Add to favorites</button>
	<button type="button"  class="btn btn-primary-outline unfavorite-button" style="background-color: transparent; border-color: white">Remove from favorites</button>
	<!-- ajaxbox -->
	<div class="ajax-box" style="display: none; margin-top:10px;"></div>
	
		<!-- share buttons -->
		<div class="row" style="margin-top: 100px; margin-left: 3px">
        <iframe src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Flocalhost%2Fecommerce%2Fui-ecommerce%2Fdetails.php%3Fpro_id%3D%3C%3Fphp%20echo%20%24id%20%3F%3E&layout=button&size=large&width=73&height=28&appId" width="73" height="28" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media" ></iframe><br>
 
		<a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-size="large" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8" style="margin-left: 2px"></script><br>

		<a href="https://www.pinterest.com/pin/create/button/" data-pin-do="buttonBookmark" data-pin-tall="true" style="margin-left: 2px"></a></div>
	</div>
  <?php


		}
		else{
			echo '
					<button type="button" id="add_button" name="add" style="margin-top: 5px; display: none" class="btn btn-primary"
                                                                  >Add to cart</button> 

					<button type="button"id="add_button" name="add" style="margin-top: 5px;" class="btn btn-outline-warning" data-toggle="modal" data-target="#exampleModal">
 						 Add to cart
					</button>

					<div style="display:inline" id="<?php echo $id; ?>" class="<?php if(is_favorite($id,$email)) { echo "favorite"; }else{echo "unfavorite";} ?>
					
					<span class="favorite-heart"><img src="images/icons/like.png" style="margin-left: 12px;" ></span>
					<span class="unfavorite-heart"><img src="images/icons/unlike.png" style="margin-left: 12px;" ></span>
	
					<button type="button" class="btn btn-primary-outline favorite-button" style="background-color: transparent; border-color: white" data-toggle="modal" data-target="#exampleModal">Add to wish</button>
					<button type="button"  class="btn btn-primary-outline unfavorite-button" style="background-color: transparent; border-color: white" data-toggle="modal" data-target="#exampleModal">Remove from wish</button>
					<!-- ajaxbox -->
					<div class="ajax-box" style="display: none; margin-top:10px;"></div>
	
					<!-- share buttons -->
					<div class="row" style="margin-top: 100px; margin-left: 3px">
       				 <iframe src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Flocalhost%2Fecommerce%2Fui-ecommerce%2Fdetails.php%3Fpro_id%3D%3C%3Fphp%20echo%20%24id%20%3F%3E&layout=button&size=large&width=73&height=28&appId" width="73" height="28" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media" ></iframe><br>
 
					<a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-size="large" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8" style="margin-left: 2px"></script><br>

					<a href="https://www.pinterest.com/pin/create/button/" data-pin-do="buttonBookmark" data-pin-tall="true" style="margin-left: 2px"></a></div>
					</div>

				
					<!-- Modal -->
					<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Please log in</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
					        Please log in first!
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					       <a href="login.php"> <button type="button" class="btn btn-primary" style="">Log In</button></a>
					      </div>
					    </div>
					  </div>
					</div>';
						}

	?>
	

<!-- short-info-wrap .// -->
</article> <!-- card-body.// -->
		</aside> <!-- col.// -->
	</div> <!-- row.// -->
</main> <!-- card.// -->

</div> <!-- col // -->

</div> <!-- row.// -->



</div><!-- container // -->
</section>



    <script>
    
      function favorite() {
        var parent = this.parentElement;
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'favorite.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onreadystatechange = function () {
          if(xhr.readyState == 4 && xhr.status == 200) {
            var result = xhr.responseText;
            console.log('Result: ' + result);
            if(result == 'true') {
              parent.classList.add("favorite");
              parent.classList.remove("unfavorite");

            }
          }
        };
        xhr.send("id=" + parent.id);
      }

      var buttons = document.getElementsByClassName("favorite-button");
      for(i=0; i < buttons.length; i++) {
        buttons.item(i).addEventListener("click", favorite);
      }

      function unfavorite() {
      	console.log("unfave");
        var parent = this.parentElement;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'unfavorite.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onreadystatechange = function () {
          if(xhr.readyState == 4 && xhr.status == 200) {
            var result = xhr.responseText;
            console.log('Result: ' + result);
            if(result == 'true') {
              parent.classList.add("unfavorite");              
              parent.classList.remove("favorite");
            }
          }
        };
        xhr.send("id=" + parent.id);
      }

      var buttons = document.getElementsByClassName("unfavorite-button");
      for(i=0; i < buttons.length; i++) {
        buttons.item(i).addEventListener("click", unfavorite);
      }
    </script>


    <script>
    $(document).ready(function() {
      
         $("#add_button").click(function(e) {
             e.preventDefault();
           
              $.ajax({
                url: $("#add_to_cart_form").attr('action') +"?"+$("#add_to_cart_form").serialize(), 
                dataType: "json", 
                success: function(result){
                    console.log(result);
                            $(".ajax-box").html('<div class="alert alert-'+result.extra+'"><strong>'+result.title+'</strong> '+result.message+'</div>');
                            $(".ajax-box").fadeIn();

            setTimeout(function() {$(".ajax-box").fadeOut();},4000);
           }
  });
             return false;
         });
    });
</script>
<!-- ========================= SECTION CONTENT .END// ========================= -->

<script>

$(document).ready(function(){
    
    resetStartColors();
    if(localStorage.getItem('ratedIndex')!=null){
        setStars(parseInt(localStorage.getItem('ratedIndex')));
        uID=localStorage.getItem('uID');

    }
        

    $('.fa-star').on('click',function(){
        ratedIndex=parseInt($(this).data('index'));
        localStorage.setItem('ratedIndex',ratedIndex);
        
        saveToTheDB();
       
       
        
    });
    $('.fa-star').mouseover(function(){
        
            resetStartColors();
            var currentIndex=parseInt($(this).data('index'));
            setStars(currentIndex);
    });

    $('.fa-star').mouseleave(function(){
        resetStartColors();
        if(ratedIndex!=-1)
        {
            setStars(ratedIndex);
        }
    });

});
function saveToTheDB(){
    
    
    $.ajax({
        url:"rating.php",
        method:"POST",
        dataType:'json',
        data:{
            save:1,
            uID:uID,
            ratedIndex:ratedIndex,
            pid:<?=$_GET['pro_id'];?>
        },success: function(r){
            uID=r.id;
            localStorage.setItem('uID',uID);
            
        }
        
    });
}
function setStars(max){
    for(var i=0;i<=max;i++ )
            $('.fa-star:eq('+i+')').css('color','orange');
}
function resetStartColors(){
    $('.fa-star').css('color','grey');
}
</script>
<?php
include("reviews.php");
?>
<?php require_once('footer.php'); ?>

