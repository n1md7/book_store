

<section class="book-upload pt-5 pb-5 border-bottom border-danger">


<h1 class="gray-text text-center">Upload new Book <i class="fa fa-plus"></i></h1>
	<div class="row">
		<div class="col-md-3 col-centered">
			<div class="md-form">
				<input type="text" class="form-control" id="labelForBookTitle">
				<label for="labelForBookTitle">Enter Book Title</label>
			</div>
		</div>
		<div class="col-md-4 col-centered">
			<div class="md-form">
				<textarea class="form-control md-textarea" rows="5" id="labelForDescription" ></textarea>
				<label for="labelForDescription">Enter Description here</label>
			</div>
		</div>
		<div class="col-md-3 col-centered">
			<div class="md-form">
				<input type="text" class="form-control" id="labelForAuthor">
				<label for="labelForAuthor">Enter Book Author</label>
			</div>
		</div>
	</div>
    <div class="row my-5">
        <div class="col-md-3 col-centered">
            <!-- <div class="md-form"> -->
                <input placeholder="Book price" type="number" id="book_price" class="form-control"   min="0" max="100">
            <!-- </div> -->
        </div>
        <div class="col-md-3 col-centered">
            <!-- <div class="md-form"> -->
                <select id="book_category"   class="form-control">
                    <option value="">Choose category</option>
                </select>
            <!-- </div> -->
        </div>
        <div class="col-md-3 col-centered">
            <!-- <div class="md-form"> -->
                <select id="book_sub_cat"  class="form-control">
                    <option value="">Choose sub-category</option>
                </select>
            <!-- </div>     -->
        </div>
    </div>
	<div class="row mt-5">
		<div class="col-md-3 col-centered text-center">
			<img src="../assets/img/bible.png" id="cover-img-placeholder" class="img-thumbnail hidden mx-auto" alt="">
			<button class="btn book-cover btn-danger"><i class="fa fa-file-image-o"></i> Select Cover Image</button>
			<input type="file" id="bookCover" class="hidden">
		</div>
		<div class="col-md-4 col-centered text-center">
			<!-- <div id="progress-wrp">
                <div class="progress-bar"></div>
                <div class="status"></div>
            </div> -->
			<!-- droebitaa aq zeda 4 laini -->
			<button class="btn orange pdf-file-upload-trigger"><i class="fa fa-file-pdf-o "></i> Select PDF file</button>
			<input type="file" class="hidden upload-pdf-file">
		</div>
		<div class="col-md-3 col-centered text-center">
			<button class="btn green upload-all-bitch"><i class="fa fa-cloud-upload"></i> Upload All
            <span class="badge red progress-book"></span>
            </button>
		</div>
	</div>
</section>


<script>
	

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


/* Upload new Book parts are below */
jQuery(document).ready(function(){
	jQuery('.book-cover').on('click', () => {$('#bookCover').trigger('click')})

	function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();            
            reader.onload = function (e) {
                $('#cover-img-placeholder').removeClass('hidden').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#bookCover").change(function(){
        readURL(this);
    });
})



/* AJAX file upload*/

var Upload = function (file) {
    this.file = file
}

Upload.prototype.getType = function() {
    return this.file.type
}
Upload.prototype.getSize = function() {
    return this.file.size
}
Upload.prototype.getName = function() {
    return this.file.name
}
Upload.prototype.doUpload = function () {
    var that = this;
    var formData = new FormData()

    // add assoc key values, this will be posts values
    formData.append("file", this.file, this.getName())
    formData.append("upload_file", true)
    formData.append("book_cover", $('#cover-img-placeholder').attr('src'))
    formData.append("book_title", $('#labelForBookTitle').val())
    formData.append("book_author", $('#labelForAuthor').val())
    formData.append("book_description", $('#labelForDescription').val())
    formData.append("book_price", $('#book_price').val())
    formData.append("book_category", $('#book_category').val())
    formData.append("book_sub_cat", $('#book_sub_cat').val())

    $.ajax({
        type: "POST",
        url: "<?php echo AJAX; ?>",
        xhr: function () {
            var myXhr = $.ajaxSettings.xhr()
            if (myXhr.upload) {
                myXhr.upload.addEventListener('progress', that.progressHandling, false)
            }
            return myXhr
        },
        success: function (data) {
            // your callback here
            if(data.success){
                swal('Success','Yay, new book added','success')
                setTimeout(function(){
                    window.location.reload()
                },1500)
            }else{
            	alert('something wrong')
            }
        },
        error: function (error) {
            alert('something wrong')
            // handle error
        },
        async: true,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        timeout: 60000
    });
};

Upload.prototype.progressHandling = function (event) {
    var percent = 0
    var position = event.loaded || event.position
    var total = event.total
    var progress_bar_id = "#progress-wrp"
    if (event.lengthComputable) {
        percent = Math.ceil(position / total * 100)
    }
    // update progressbars classes so it fits your code
    // $(progress_bar_id + " .progress-bar").css("width", +percent + "%");
    // $(progress_bar_id + " .status").text(percent + "%")
    $('.progress-book').text(percent + ' %')
};

/* end of AJAX file upload*/

$('.upload-all-bitch').click(function(){
    console.log(
         $('#book_sub_cat').get(0).selectedIndex,
        $('#book_category').get(0).selectedIndex,
        $('#labelForBookTitle').val().length,
        $('#labelForAuthor').val().length,
        $('#labelForDescription').val().length,
        $('#book_price').val().length,
        $('#cover-img-placeholder')[0].src.length
        )
    if(
        $('#book_sub_cat').get(0).selectedIndex != 0 &&
        $('#book_category').get(0).selectedIndex != 0 &&
        $('#labelForBookTitle').val().length != 0 &&
        $('#labelForAuthor').val().length != 0 &&
        $('#labelForDescription').val().length != 0 &&
        $('#book_price').val().length != 0 &&
        $('#cover-img-placeholder')[0].src.length > 0
        ){

        var file = $(".upload-pdf-file")[0].files[0]
        var upload = new Upload(file)

        // maby check size or type here with upload.getSize() and upload.getType()

        // execute upload
        upload.doUpload();

    }else{
        swal('Error','Empty values','error')
    }
})


$('.pdf-file-upload-trigger').click(() => {$('.upload-pdf-file').trigger('click')})
 


 function wobbleIt(e){
	$(e).addClass('animated wobble border-danger text-danger').css('transition','all 0.5s')
	setTimeout(function(){
		$(e).removeClass('animated wobble border-danger text-danger')
	},500)
}


</script>