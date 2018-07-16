$(document).ready(function(){
	$.ajax({
		success:function(resp){
			if( undefined !== resp){
				console.log(resp)
				let flt = parseFloat(resp.balance.balance).toFixed(2)
				let items = resp.balance.balance
				$('.user-money').html(flt)
				$('.cart-counter').html(function(){
					return resp.items.items
				})
			}
		},
		url: ajax_url,
		data:{'gmmemoney': true},
		method:'post'
	})
})