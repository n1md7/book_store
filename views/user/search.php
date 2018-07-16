

<section class="user-area pt-5 pb-5 border-bottom border-info">
<h1>Users <i class="fa fa-users"></i></h1> 
<div class="row">
	<div class="col-centered col-md-6">
		<div class="md-form">
            <i class="fa fa-search prefix "></i>
            <input autocomplete="off" type="search" type="text" name="username" id="materialFormSearchField" class="user-search form-control">
            <label for="materialFormSearchField">Search any user</label>
            <small id="materialFormSearchField" class="form-text text-muted">
            <i class="fa fa-code"></i>
            	<code>:active</code> - search active users;
            	<code>:disabled</code> - disabled users;
            	<code>:isadmin</code> - only admins;
            	<code>:user</code> - only !admins;
            </small>
        </div>
	</div>
</div>
<div class="col-md-12 col-centered user-area-col">
	<!--Table-->
		<table class="table table-hover table-sm">

		    <!--Table head-->
		    <thead>
		        <tr>
		            <th class="align">#</th>
		            <th class="align">First Name</th>
		            <th class="align">Last Name</th>
		            <th class="align">Username</th>
		            <th class="align">Email</th>
		            <th class="align">Balance <i class="fa fa-euro"></i></th>
		            <th class="align">Who</th>
		            <th class="align">+/- Admin</th>
					<th class="align">Deactivate users </th>
		        </tr>
		    </thead>
		    <!--Table head-->

		    <!--Table body-->
		    <tbody class="users_jar text-center">
		    <?php foreach ($viewmodel['users'] as $key => $value):  ?>
		         <tr>
			          <th scope="row" class="align"><?php echo $value['user_id'];?></th>
			          <td class="align"><?php echo $value['first_name'];?></td>
			          <td class="align"><?php echo $value['last_name'];?></td>
			          <td class="align"><?php echo $value['username'];?></td>
			          <td class="align"><?php echo $value['email'];?></td>
			          <td class="align"><?php echo $value['balance'];?></td>
			          <td class="align isAdmin"><?php echo $value['is_admin'] == 1? "Admin" : "User";  ?></td>
			          <td class="align">
			          	<button onclick="bindEventToUSerAdmin(this)"  value="<?php echo $value['is_admin']; ?>" data-user-id="<?php echo $value['user_id'];?>" class="user_admin btn btn-sm p-1 <?php echo $value['is_admin']==0? "green" : "btn-danger" ?>">
			          <?php echo $value['is_admin'] == 1? "Demote" : "Promote";  ?>
			          </button>
			          </td>
			          <td class="align"><button data-user-id="<?php echo $value['user_id'];?>" onclick="bindEventToUserDeactivate(this)" value="<?php echo $value['active'] ;?>" class="user_delete btn btn-sm p-1 <?php echo $value['active']==0? "btn-default" : "red" ?>">
			          <?php echo $value['active'] == 0? "Activate" : "Deactivate";  ?></button></td>
			      </tr> 
		    <?php  endforeach;   ?>
		    </tbody>
		    <!--Table body-->

		</table>
	<!--Table-->
</div>
</section>


<script>
/* user search */

$(".user-search").on("keydown", function(e){
	let code = e.keycode || e.which;
	if(code==13){
		$.ajax({
			url: "<?php echo AJAX; ?>",
			method: 'POST',
			data: {
				'search_user': true,
				'username': $(this).val()
			},
			success:function(resp){
				if(undefined !== resp.error){
					console.log(resp.error)
					wobbleIt($('.user-search').parent())
					return
				}
				$('.users_jar').empty()
				.append(function(){
					if(resp.users[0]==undefined){
						return `
							<tr>
								<td colspan="9">Nothing to show!</td>
							</tr>
						`
					}else{
						return `
							<tr>
								<td colspan="9">${resp.users.length} row(s) returned!</td>
							</tr>
						`
					}
				})
				resp.users.forEach(function(e, i){
					var fname = e.first_name.replace(new RegExp(resp.keyword, "ig"), `<span class="deep-orange-text">${resp.keyword}</span>`);
					var lname = e.last_name.replace(new RegExp(resp.keyword, "ig"), `<span class="deep-orange-text">${resp.keyword}</span>`);
					var email = e.email.replace(new RegExp(resp.keyword, "ig"), `<span class="deep-orange-text">${resp.keyword}</span>`);
					var user  = e.username.replace(new RegExp(resp.keyword, "ig"), `<span class="deep-orange-text">${resp.keyword}</span>`);

					$('.users_jar').append(`
						<tr>
				            <th scope="row" class="align">${e.user_id }</th>
				            <td class='align'>${fname }</td>
				            <td class='align'>${lname}</td>
				            <td class='align'>${user}</td>
				            <td class='align'>${email}</td>
				            <td class='align'>${e.balance}</td>
				            <td class='align'>${e.is_admin==1 ? "Admin" : "User"}</td>
				            <td class='align'><button onclick="bindEventToUSerAdmin(this)" value="${e.is_admin}" data-user-id="${e.user_id}" class="p-1 user_admin btn btn-sm ${e.is_admin ==0 ? 'green':'btn-danger'}">${e.is_admin==1 ? "Demote" : "Promote"}</button></td>
				            <td class='align'><button data-user-id="${e.user_id}" value="${e.active}" onclick="bindEventToUserDeactivate(this)" class="p-1 user_delete btn btn-sm ${e.active ==0 ? 'btn-default':'red'}">${e.active==0 ? "Activate" : "Deactivate" }</button></td>
				        </tr>	
					`)
				})


			}, fail:function(){
				alert('Ajax Failed!')
			}
		})
	}
});



function bindEventToUSerAdmin(obj){
	$.ajax({
		url: "<?php echo AJAX; ?>",
		method: 'POST',
		data: {
			'toogle_admin': true,
			'user_id': $(obj).data('user-id')
		},success:function(response){
			if(undefined !== response.error){
				alert(response.error)
				return
			}
			if($(obj).val() == 1){
				$(obj).val(0)
			}else{
				$(obj).val(1)
			}
			$(obj).removeClass('green btn-danger')
				.addClass(function(){
					return $(obj).val() == 1?"btn-danger":"green"
				})
			$(obj).html($(obj).val() == 1?"Demote":"Promote")
			$(obj).parent().parent().find('.isAdmin').html($(obj).val() == 1?"Admin":"User")

		},fail:function(){
			alert('Ajax Failed')
		}
	})
}



function bindEventToUserDeactivate(obj){
	$.ajax({
		url: "<?php echo AJAX; ?>",
		method: 'POST',
		data: {
			'toogle_admin_activate': true,
			'user_id': $(obj).data('user-id')
		},success:function(response){
			if(undefined !== response.error){
				alert(response.error)
				return
			}
			if($(obj).val() == 1){
				$(obj).val(0)
			}else{
				$(obj).val(1)
			}
			$(obj).removeClass('red btn-default')
				.addClass(function(){
					return $(obj).val() == 1?"red":"btn-default"
				})
			$(obj).html($(obj).val() == 1?"Deactivate":"Activate")

		},fail:function(){
			alert('Ajax Failed')
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