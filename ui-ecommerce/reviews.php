<?php
$product_id = $_GET['pro_id'];

if(isset($_SESSION['user_email'])){ 
	$email = $_SESSION['user_email'];


if (isset($_POST['review'])) {
	$review_text = test_input($_POST['review']);

	insert_review($email, $product_id,$review_text);
}
}

$reviews = find_reviews($product_id);
$id = 0;
?>
<br>
<?php 
if (isset($_SESSION['user_email'])) { ?>
<div class="container col-9">
<div class="card">
  <h5 class="card-header">Review this product</h5>
  <div class="card-body">
    <div class="form-group">
  <label for="comment">Comment:</label>
  <form action="" method="post">
  <textarea name="review" class="form-control" rows="5" id="comment"></textarea>
</div>

    <button class="btn btn-warning" type="submit" >Leave a review</button>
    </form>
  </div>
</div>

<br>

<?php
} else {
	echo '<div class="container col-9">
<div class="card">
  <h5 class="card-header">Review this product</h5>
  <div class="card-body">
    <div class="form-group">
  <label for="comment">Comment:</label>
  <textarea name="review" class="form-control" rows="5" id="comment"></textarea>
</div>

    <button class="btn btn-warning" type="submit" data-toggle="modal" data-target="#exampleModal1">Leave a review</button>
  </div>
</div>

<br>
	<!-- Modal -->
					<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel1">Log in to leave a review</h5>
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
					</div>

';

}
?>

<div class="list-group">
	<?php while($review = mysqli_fetch_assoc($reviews)) { 
		 $id++;
		?>
  <article class="list-group-item">
		<header class="filter-header">
			<a href="#" data-toggle="collapse" data-target="<?php echo '#' . $id;?>">

				<i class="icon-action fa fa-chevron-down"></i>
				<h6 class="title" style="color: #212529">Review by <i style="color: #ffc107"><?php echo $review['first_name'] ?></i></h6>
			</a>
		</header>
		<div class="filter-content collapse" id="<?php echo $id;?>">
				
			<p><?php echo $review['text_review']?>	</p>
		</div>
	</article>

<?php 


 } ?>
 <br>
</div> <!-- list-group.// -->

</div>
