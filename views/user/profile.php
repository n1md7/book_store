<br>
<div class="col-md-8 card col-centered mt-5 mb-5  pb-5 animated bounceIn">
    <div class="card-body">
        <!-- Material form register -->
        <form method="post">
            <h1 class="text-center mb-4"><i class="fa fa-edit"></i> Change My Data</h1>
            <div class="row">
                <div class="col-md-6">
                    <!-- Material input text -->
                    <div class="md-form">
                        <i class="fa fa-user prefix "></i>
                        <input type="text" name="username" disabled="" value="<?php echo $_SESSION['user_data']['username']; ?>" id="materialFormRegisterNameEx" class="form-control">
                        <label for="materialFormRegisterNameEx">Your username</label>
                    <small id="materialFormRegisterNameEx" class="form-text text-muted">Choose username</small></div>
                </div>
                <div class="col-md-6">
                    <!-- Material input email -->
                    <div class="md-form">
                        <i class="fa fa-envelope prefix "></i>
                        <input type="email" value="<?php echo $viewmodel['user']['email']; ?>" name="email" id="materialFormRegisterEmailEx" class="form-control">
                        <label for="materialFormRegisterEmailEx">Your email</label>
                        <small id="materialFormRegisterEmailEx" class="form-text text-muted">Put valid email</small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="md-form">
                        <i class="fa fa-user-circle prefix "></i>
                        <input type="text" name="first_name" value="<?php echo $viewmodel['user']['first_name']; ?>" id="materialFormRegisterfirstname" class="form-control">
                        <label for="materialFormRegisterfirstname">Firstname</label>
                        <small id="materialFormRegisterfirstname" class="form-text text-muted">Input your firstname</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="md-form">
                        <i class="fa fa-user-circle-o prefix "></i>
                        <input type="text" name="last_name" value="<?php echo $viewmodel['user']['last_name']; ?>" id="materialFormRegisterfirstnae" class="form-control">
                        <label for="materialFormRegisterfirstnae">Lastname</label>
                        <small id="materialFormRegisterfirstnae" class="form-text text-muted">Input your lastname</small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="md-form">
                        <i class="fa fa-calendar prefix "></i>
                        <?php
                        $date = date_parse($viewmodel['user']['birth_date']);
                        $year = $date['year'];
                        $month = (int)$date['month']<10?'0'.$date['month']:$date['month'];
                        $day = (int)$date['day']<10?'0'.$date['day']:$date['day'];

                        $parsed = vsprintf("%s-%s-%s", array($year, $month, $day));
                        ?>
                        <input type="date" value="<?php echo $parsed; ?>" name="birth_date" id="materialFormRegisterbirthday" class="form-control">
                        <small id="materialFormRegisterbirthday"  class="form-text text-muted">input Your birthday</small>
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="md-form">
                        <i class="fa fa-android prefix "></i>
                        <input type="text" name="captcha" id="captchas" class="form-control">
                        <label for="captchas">Confirm that you are human</label>

                        <small id="captchas"  class="form-text text-muted">ten plus two</small>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <button class="btn btn-lg btn-primary form-control" name="signup" type="submit">Update My Data</button>
            </div>
        </form>
    </div>
</div>

<script>

function wobbleIt(e){
	$(e).addClass('animated wobble border-danger text-danger').css('transition','all 0.5s')
	setTimeout(function(){
		$(e).removeClass('animated wobble border-danger text-danger')
	},500)
}

 

</script>