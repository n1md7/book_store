<section class="book-search pb-5">
	<h3 class=" text-center py-5"><i class="fa fa-search"></i> Search/ <i class="fa fa-filter"></i> Filter</h3>
	<div class="row">
		<div class="col-lg-6 col-centered">
			<form action="" method="post">
		        <div class="form-group">
		            <div class="input-group btn-group">
		                <input type="search" name="text" placeholder="Search here..." class="form-control py-0">
		                <select name="cat" class="cat btn btn-blue" id="book_category">
		                	<option value="">Category</option>
		                </select>
		                <select name="sub_cat" id="book_sub_cat" class="sub-cat btn btn-blue">
		                	<option value="">Sub-category</option>
		                </select>
		                <button name="search" type="submit" class="btn btn-blue"><i class="fa fa-search"></i></button>
		            </div>
		        </div>
			</form>
		</div>
	</div>
</section>

  <!-- Grid row -->
  	<?php if($viewmodel['search'] != null): ?>
	<section class="book-search-result pb-5">

	    <h3 class=" text-center pb-4">Search result(s): <?php echo sizeof($viewmodel['search']); ?></h3>
	    <div class="row text-center">
	    <?php foreach ($viewmodel['search'] as $key => $value): ?>
			<!-- Grid column -->
			<div class="col-md-4 mb-4 animated fadeInLeft col-centered wow">
				<div class="card card-body">
					<div class="mb-3">
						<img src="<?php echo $value['cover']; ?>" class="thumbnail card-img-top mx-auto">
					</div>
					<h5 class="font-weight-bold">
					<strong><?php echo $value['title']; ?></strong>
					</h5>
					<p class=""><?php echo $value['description']; ?></p>
					<br>
					<p><b>Author:</b> <?php echo $value['author'];?></p>
					<ul class="list-unstyled">
						<!-- <input type="button" data-id="" class="delete btn btn-sm btn-danger waves-effect upperKa" value="delete"> -->
						<button class="btn btn-sm float-left green" disabled=""><?php echo $value['price']; ?> <i class="fa fa-euro"></i></button>
						<button class="btn btn-sm blue waves-effect add-item-to-cart float-right" data-book-id="<?php echo $value['book_id']; ?>"><i class="fa fa-cart-plus"></i> Add2Cart</button>
					</ul>
				</div>
			</div>
	        <!-- Grid column -->
		<?php endforeach; ?>
		</div>
	</section>
	<?php endif; ?>


<section class="featured-books pb-5">

	<!--Section heading-->
    <h3 class="text-center py-5  upperKa">Featured Books</h3>
    <!--Section description-->
    <div class="col-md-6 col-centered">
	    <p class=" pb-5 text-center ">This Book: A priceless Shakespearean First Folio is stolen from an English manor house. A man is dead. Oxford student Stephanie Cooper is drawn into the dangerous criminal world of art theft wh...</p>
    </div>

    <!-- Grid row -->
    <div class="row text-center">
    <?php foreach ($viewmodel['books'] as $key => $value): ?>
		<!-- Grid column -->
		<div class="col-md-4 mb-4 animated fadeInLeft col-centered wow">
			<div class="card card-body">
				<div class="mb-3">
					<img src="<?php echo $value['cover']; ?>" class="thumbnail card-img-top mx-auto">
				</div>
				<h5 class="font-weight-bold">
				<strong><?php echo $value['title']; ?></strong>
				</h5>
				<p class=""><?php echo $value['description']; ?></p>
				<br>
				<p><b>Author:</b> <?php echo $value['author'];?></p>
				<ul class="list-unstyled">
					<!-- <input type="button" data-id="" class="delete btn btn-sm btn-danger waves-effect upperKa" value="delete"> -->
					<button class="btn btn-sm float-left green" disabled=""><?php echo $value['price']; ?> <i class="fa fa-euro"></i></button>
					<button class="btn btn-sm blue waves-effect add-item-to-cart float-right" data-book-id="<?php echo $value['book_id']; ?>"><i class="fa fa-cart-plus"></i> Add2Cart</button>
				</ul>
			</div>
		</div>
        <!-- Grid column -->
	<?php endforeach; ?>


    </div>
    <!-- Grid row -->

</section>
<!--Section: Featured books-->



<section class="last-added-books pb-5">

	<!--Section heading-->
    <h3 class="text-center py-5  upperKa">Last Added</h3>
    <!--Section description-->
    <div class="col-md-6 col-centered">
	    <p class=" pb-5 text-center ">This Book: A priceless Shakespearean First Folio is stolen from an English manor house. A man is dead. Oxford student Stephanie Cooper is drawn into the dangerous criminal world of art theft wh...</p>
    </div>

    <!-- Grid row -->
    <div class="row text-center">
    <?php foreach ($viewmodel['lastAdded'] as $key => $value): ?>
		<!-- Grid column -->
		<div class="col-md-4 mb-4 animated fadeInLeft col-centered wow">
			<div class="card card-body">
				<div class="mb-3">
					<img src="<?php echo $value['cover']; ?>" class="thumbnail card-img-top mx-auto">
				</div>
				<h5 class="font-weight-bold">
				<strong><?php echo $value['title']; ?></strong>
				</h5>
				<p class=""><?php echo $value['description']; ?></p>
				<br>
				<p><b>Author:</b> <?php echo $value['author'];?></p>
				<ul class="list-unstyled">
					<!-- <input type="button" data-id="" class="delete btn btn-sm btn-danger waves-effect upperKa" value="delete"> -->
					<button class="btn btn-sm float-left green" disabled=""><?php echo $value['price']; ?> <i class="fa fa-euro"></i></button>
					<button class="btn btn-sm blue waves-effect add-item-to-cart float-right" data-book-id="<?php echo $value['book_id']; ?>"><i class="fa fa-cart-plus"></i> Add2Cart</button>
				</ul>
			</div>
		</div>
        <!-- Grid column -->
	<?php endforeach; ?>


    </div>
    <!-- Grid row -->

</section>
<!--Section: Team v.1-->
<!-- 
Section 2-->



<script type="text/javascript">
/* function for sliding efects*/
$(document).ready(function(){
	new WOW().init();
})


/* add to cart */
$('.add-item-to-cart').click(function(){
	let self = this
	$.ajax({
		success:function(response){
			if( undefined !== response.error){
				console.log('Error: ', response.error)
				swal('Error, unauthorized!', 'Please sign in to perform this action.','error')
				return
			}
			if( undefined !== response.success){
				$(self).html('Added').attr('disabled','')
				$('.cart-counter').html(function(){
					if(!isNaN($(this).html())){
						return parseInt($(this).html())+1
					}else{
						return 1
					}
				})
			}
		},
		fail:function(){
			console.log('Ajax failed')
		},
		method:'post',
		url: "<?php echo AJAX; ?>",
		data: {
			'add_item_to_cart':true,
			'book_id': $(self).data('book-id')
		}
	})
})




/* book category selection*/

$(document).ready(function(){
    $.ajax({
        type: "POST",
        url: "<?php echo AJAX; ?>",
        success:function(resp){
            if( undefined !== resp){
                resp.categories.forEach(function(e){
                    $("#book_category")
                        .append(`
                                <option value="${e.cat_id}">${e.name}</option>
                            `)
                })
                
            }else{
                console.warn('Ajax error')
            }
        },
        data:{
            'gimme_all_cats':true
        },
        error:function(){
            console.warn('Ajax error')
        }
    })

    $("#book_category").on('change', function(){
        let self = this
        $("#book_sub_cat").empty()
        var cat_id = self.options[self.selectedIndex].value;
        console.log(cat_id)
        $.ajax({
        type: "POST",
        url: "<?php echo AJAX; ?>",
        success:function(resp){
            if( undefined !== resp){
                resp.sub_categories.forEach(function(e){
                    $("#book_sub_cat")
                        .append(`
                                <option value="${e.sub_cat_id}">${e.name}</option>
                            `)
                })
                
            }else{
                console.warn('Ajax error')
            }
        },
        data:{
            'gimme_all_sub_cats':true,
            'sub_cat_id': cat_id
        },
        error:function(){
            console.warn('Ajax error')
        }
    })
    })

})
</script>