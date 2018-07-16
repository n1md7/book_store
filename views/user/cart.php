<?php 
	$total = 0; 
	$history = Array(); 
?>
<section class="section-for-cart-items mt-5">
	<h2 class="grey-text mb-2 text-center">Your Cart Items</h2>
	<?php foreach ($viewmodel['items'] as $key => $value): ?>
	<?php if($value['paid'] == 1){ array_push($history, $value); continue; } ?>	
	<?php $total += $value['price']; ?>
	<div class="col-md-8 my-3 col-centered cart-item cart-purchase-items">
		<div class="card">
		    <div class="card-body">
			    <div class="avatar float-left col-sm-4">
			  	    <img src="<?php echo $value['cover']; ?>" class="img-fluid" alt="">
			    </div>
			    <div class="float-right col-sm-8">
			    	<h5 class="card-title"><?php echo $value['title']; ?></h5>
			    	<h5 class="card-title text-green"><?php echo $value['price']; ?> <i class="fa fa-euro"></i> </h5>
			    	<!-- if len > 100 then substring it for description later we should add it -->
			    	<p class="card-text"><?php echo $value['description']; ?></p>
			    	<a href="#" class="btn btn-danger remove-item-from-cart" data-cart-id="<?php echo $value['cart_id']; ?>" data-item-price="<?php echo $value['price']; ?>"><i class="fa fa-remove"></i> Remove from cart</a>
			    </div>
		    </div>
		</div>
	</div>
	<?php endforeach; ?>
	<?php if($total !== 0 ): ?>
	<div class="col-md-4 my-3 col-centered text-center cart-actions">
		<h3 class="text-center">Sum Total: <span class="sum-total"><?php echo $total; ?></span> <i class="fa fa-euro"></i></h3>
	</div>
	<div class="col-md-4 col-centered my-5 div-checkout">
		<form action="" method="post">
			<button type="submit" name="checkout" class="btn btn-secondary form-control">Check Out</button>
		</form>
	</div>
	<?php else: ?>
	<div class="col-md-4 my-3 col-centered text-center">
		<h5 class="text-center">cart status: <span class="badge red"> Empty</span></h5>
	</div>
	<?php endif; ?>
</section>




<section class="section-for-paid-cart-items mt-5">
	<h2 class="grey-text mb-2 text-center">History</h2>
	<?php foreach ($history as $key => $value): ?>
	<div class="col-md-8 my-3 col-centered cart-item">
		<div class="card">
		    <div class="card-body">
			    <div class="avatar float-left col-sm-4">
			  	    <img src="<?php echo $value['cover']; ?>" class="img-fluid" alt="">
			    </div>
			    <div class="float-right col-sm-8">
			    	<h5 class="card-title"><?php echo $value['title']; ?></h5>
			    	<h5 class="card-title"><span class="text-green"><?php echo $value['price']; ?> <i class="fa fa-euro"></i></span> <i class="slash"></i> <span>date: <?php echo $value['date_modified']; ?></span></h5>
			    	<!-- if len > 100 then substring it for description later we should add it -->
			    	<p class="card-text"><?php echo $value['description']; ?></p>
			    	<a target="_blank" href="<?php echo ROOT_URL . 'uploads/'. $value['file_name'];?>" class="btn green download-book" data-cart-id="<?php echo $value['cart_id']; ?>"><i class="fa fa-cloud-download"></i> Download</a>
			    </div>
		    </div>
		</div>
	</div>
	<?php endforeach; ?>
	<?php echo sizeof($history) == 0? '<h5 class="text-center">history status: <span class="badge red"> Empty</span></h5>':''; ?>
</section>



<script>
	$('.remove-item-from-cart').click(function(){
		let self = this
		$.ajax({
			method: 'post',
			url: ajax_url,
			data: {
				"remove_this_item": true,
				"cart_id": $(self).data('cart-id')  
			},
			success:function(resp){
				if( undefined !== resp.deleted){
					animRemove($(self).closest('.cart-item'), function(){
						if( $('.cart-purchase-items').length === 0 ){
							$('.cart-actions, .div-checkout').empty()
							$('.section-for-cart-items').append(`
								<div class="col-md-4 my-3 col-centered text-center">
									<h3 class="text-center">cart status: <span class="badge red"> Empty</span></h3>
								</div>
								`)
						}
						$('.sum-total').html(function(){
							return (parseFloat($(this).html()) - $(self).data('item-price')).toFixed(2)
						})
						$('.cart-counter').html(function(){
							return parseInt($(this).html()) - 1
						})
					})//.remove()
				}
			},
			fail:function(){
				console.warn('Ajax failed')
			}
		})
	})



function animRemove(e, doAfter){
	$(e).addClass('animated zoomOut').css('transition','all 0.5s')
	setTimeout(function(){
		$(e).removeClass('animated zoomOut').remove()
		doAfter()
	},500)
}

</script>