<section class="pb-5 pt-5 sec-cat border-bottom border-secondary">
<h1 class="gray-text">Categories/Sub-categories <i class="fa fa-tags"></i></h1>
<!-- category  -->
<div class="row mt-5">
	<div class="col-md-4 col-centered">
		<ul class="nav nav-pills">
			<li>
				<input type="text" class="form-control cat-name" placeholder="Category name">
			</li>
			<li>
				<input type="button" class="btn btn-secondary wave-effect add-category" value="Add Category">
			</li>
		</ul>
		<div class="row">
			<div class="col-md-12 col-centered cat-jar">
				<?php foreach ($viewmodel['categories'] as $value): ?>
					<button data-cat-id="<?php echo $value['cat_id'] ?>" class="p-1 btn btn-sm btn-default cat-delete" title="Click to delete" data-toggle="tooltip"><?php echo $value['name']; ?> <i class="fa fa-close" aria-hidden="true"></i></button>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
<!-- sub category -->
	<div class="col-md-6 col-centered">
		<ul class="nav nav-pills">
			<li>
				<select class="form-control choose-cat-name">
					<option value="0" selected="">Select Category</option>
					<?php foreach ($viewmodel['categories'] as $value): ?>
						<option value="<?php echo $value['cat_id']; ?>"><?php echo $value['name']; ?></option>
					<?php endforeach; ?>
				</select>
			</li>
			<li>
				<input type="text" class="form-control sub-cat-name " placeholder="Sub-category name">
			</li>
			<li>
				<input type="button" class="btn btn-secondary wave-effect add-sub-category " value="Add Sub-category">
			</li>
		</ul>
		<div class="row">
			<div class="col-md-12 col-centered sub-cat-jar">
			<?php $catName="";
				foreach ($viewmodel['sub_categories'] as $row): 
					if($row['name'] != $catName):
						$catName = $row['name'];
					?>
						<button data-cat-id="<?php echo $row['cat_id']; ?>" class="p-1 btn btn-sm btn-default"><?php echo $catName; ?></button>

				<?php endif;
					if($row['sub_name'] != null || !empty($row['sub_name'])):
				?>
						<i data-sub-cat-id="<?php echo $row['sub_cat_id']; ?>" data-cat-id="<?php echo $row['cat_id']; ?>" class="fa fa-arrow-right" aria-hidden="true"></i>
						<button onclick="bindEventRemoveSubCats(this)" data-cat-id="<?php echo $row['cat_id']; ?>" data-sub-cat-id="<?php echo $row['sub_cat_id']; ?>" class="p-1 btn btn-sm btn-info sub-cat-delete" data-toggle="tooltip"><?php echo $row['sub_name']; ?> <i class="fa fa-close" aria-hidden="true"></i></button>
			<?php 
				endif;
				endforeach; ?>
			</div>
		</div>
	</div>
</div>
</section>






<script>
	
 


let bindCatEvents = function(obj){
	if(!confirm('Are you Sure?')) return
	/*delete category by id*/
	$.ajax({
			url: "<?php echo AJAX; ?>",
			method: 'POST',
			data: {
				"Delete_category": true,
				"cat_id": $(obj).data('cat-id')
			},success:function(response){
				console.log(response)
				if(response.error !== undefined){
					alert(response.error)
					return
				}
				if(response.deleted !== undefined){
					$(obj).addClass('animated zoomOut')

					/*remove all subcats*/
					$(`.sub-cat-jar [data-cat-id=${$(obj).data('cat-id')}]`).addClass('animated zoomOut')
					setTimeout(()=>{
						$(obj).hide()
						$(`.sub-cat-jar [data-cat-id=${$(obj).data('cat-id')}]`).hide()
					},500)
					/* remoeve element from select*/
					$(`select.choose-cat-name option[value=${$(obj).data('cat-id')}]`).remove()
				}
			},fail:function(){
				alert("AJAX failed!")
			}
		})
	/*update tooltips for new elements*/
	$('[data-toggle="tooltip"]').tooltip()

}
$(document).ready(function(){
	/*bind events to cats*/
	$('.cat-delete').click(function(){bindCatEvents(this)})
	$('.add-sub-category').click(bindSubCatEvents)

	$('.add-category').click(function(){
		$(this).attr('disable')
		$.ajax({
			url: "<?php echo AJAX; ?>",
			method: 'POST',
			data: {
				"Add_category": true,
				"cat_name": $('.cat-name').val()
			},success:function(response){
				console.log(response)
				if(response.error !== undefined){
					console.log(response.error)
					wobbleIt($('.cat-name').get())
					return
				}
				if(response.id == 0){
					alert("ERROR!");
					return;
				}
				$('.cat-jar').append(`<button onclick="bindCatEvents(this)" data-cat-id="${response.id}" class="p-1 btn btn-sm btn-default cat-delete" title="Delete" data-toggle="tooltip">${$(".cat-name").val()} <i class="fa fa-close" aria-hidden="true"></i></button>`)
				$(this).removeAttr('disable')
				$('select.choose-cat-name').append(`<option value="${response.id}">${$('.cat-name').val()}</option>`)
				$('.sub-cat-jar').append(`<button data-cat-id="${response.id}" class="p-1 btn btn-sm btn-default">${$(".cat-name").val()}</button>`)
				$('.cat-name').val('')
				/* bind event to new elements*/
				// $('.add-sub-category').click(bindSubCatEvents)
				$('.cat-name').trigger('focus')
			},fail:function(){
				alert("AJAX Failed!")
			}
		})
	})

})


function bindSubCatEvents(){
	$.ajax({
		url: "<?php echo AJAX; ?>",
		method: 'POST',
		data: {
			"Add_sub_category": true,
			"sub_cat_name": $('.sub-cat-name').val(),
			"cat_id": $('.choose-cat-name').val()
		},success:function(resp){
			console.log(resp)
			if(undefined !== resp.error){
				console.log(resp.error)
				wobbleIt($('.choose-cat-name').get())
				wobbleIt($('.sub-cat-name').get())
				return
			}
			$(`.sub-cat-jar [data-cat-id=${$('.choose-cat-name').val()}]`)
				.last().after(function(){
					return `<i data-sub-cat-id="${resp.sub_cat_id}" data-cat-id="${$('.choose-cat-name').val()}" class="fa fa-arrow-right" aria-hidden="true"></i>
							<button onclick="bindEventRemoveSubCats(this)" data-cat-id="${$('.choose-cat-name').val()}" data-sub-cat-id="${resp.sub_cat_id}" class="p-1 btn btn-sm btn-info sub-cat-delete" data-toggle="tooltip">${resp.sub_name} <i class="fa fa-close" aria-hidden="true"></i></button>`
				})
				$('.sub-cat-name').val('').trigger('focus')
		},fail:function(){
			alert('Ajax failed!')
		}
	})	
}


function bindEventRemoveSubCats(obj){
	if(!confirm('Are you Sure?')) return
	$.ajax({
		url: "<?php echo AJAX; ?>",
		method: 'POST',
		data: {
			"Delete_sub_category": true,
			"sub_cat_id": $(obj).data('sub-cat-id')
		},success:function(resp){
			if(undefined !== resp.error){
				alert(resp.error)
				return
			}
			$(obj).addClass('animated hinge')
			$(`i[data-sub-cat-id='${$(obj).data('sub-cat-id')}'][data-cat-id='${$(obj).data('cat-id')}']`).addClass('animated hinge')
			/*remove all subcats*/
			$(obj).addClass('animated hinge')
			setTimeout(()=>{
				$(obj).hide()
				$(`i[data-sub-cat-id='${$(obj).data('sub-cat-id')}'][data-cat-id='${$(obj).data('cat-id')}']`).hide()
			},500)
			
		},fail:function(){
			alert('Ajax Failed!')
		}
	})
}

function wobbleIt(e){
	$(e).addClass('animated wobble border-danger text-danger').css('transition','all 0.5s')
	setTimeout(function(){
		$(e).removeClass('animated wobble border-danger text-danger')
	},500)
}

</script>