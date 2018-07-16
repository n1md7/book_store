<section for="adding-balance" class="py-5">
	<h3 class="text-center grey-text"><i class="fa fa-credit-card"></i> Your balance</h3>
	<form action="" method="post">
		<div class="row mt-5">
			<div class="col-lg-6 col-centered">
				<div class="col-md-4 float-left">
					<input type="text" class="form-control card-number" required="" minlength="12" maxlength="12" autofocus="on" placeholder="Card number">
				</div>
				<div class="col-md-4 float-left">
					<input type="text" minlength="3" maxlength="3" required="" class="form-control card-csv" placeholder="CSV code">
				</div>
				<div class="col-md-4 float-left">
					<input type="number" name="addbalance" required="" min="5" max="100" class="form-control amount2add" placeholder="Amount2Charge">
				</div>
			</div>
		</div> 
		<div class="row pt-3">
			<div class="col-md-3 col-centered">
				<button type="submit" class="btn btn-md btn-primary form-control">Proceed</button>
			</div>
		</div>
	</form>
</section>