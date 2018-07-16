<div class="col-md-8 card col-centered mt-5 mb-5  pb-5 animated bounceIn">
    <div class="card-body">
        <!-- Material form register -->
        <form method="post">
            <h1 class="text-center mb-4"><i class="fa fa-user-plus"></i> Sign Up</h1>
            <div class="row">
                <div class="col-md-6">
                    <!-- Material input text -->
                    <div class="md-form">
                        <i class="fa fa-user prefix "></i>
                        <input type="text" autocomplete="off" name="username" id="materialFormRegisterNameEx" class="form-control">
                        <label for="materialFormRegisterNameEx">Your username</label>
                    <small id="materialFormRegisterNameEx" class="form-text text-muted">Choose username</small></div>
                </div>
                <div class="col-md-6">
                    <!-- Material input email -->
                    <div class="md-form">
                        <i class="fa fa-envelope prefix "></i>
                        <input type="email" name="email" id="materialFormRegisterEmailEx" class="form-control">
                        <label for="materialFormRegisterEmailEx">Your email</label>
                        <small id="materialFormRegisterEmailEx" class="form-text text-muted">Put valid email</small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="md-form">
                        <i class="fa fa-user-circle prefix "></i>
                        <input type="text" autocomplete="off" name="first_name" id="materialFormRegisterfirstname" class="form-control">
                        <label for="materialFormRegisterfirstname">Firstname</label>
                        <small id="materialFormRegisterfirstname" class="form-text text-muted">Input your firstname</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="md-form">
                        <i class="fa fa-user-circle-o prefix "></i>
                        <input type="text" autocomplete="off" name="last_name" id="materialFormRegisterfirstnae" class="form-control">
                        <label for="materialFormRegisterfirstnae">Lastname</label>
                        <small id="materialFormRegisterfirstnae" class="form-text text-muted">Input your lastname</small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="md-form">
                        <i class="fa fa-lock prefix "></i>
                        <input type="password" name="password1" id="materialFormRegisterPasswordEx" class="form-control">
                        <label for="materialFormRegisterPasswordEx">Your password</label>
                        <small id="materialFormRegisterPasswordEx" class="form-text text-muted">Password should have at least 8 letters</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="md-form">
                        <i class="fa fa-lock prefix "></i>
                        <input type="password" name="password2" id="materialFormRegisterConfirmEx" class="form-control">
                        <label for="materialFormRegisterConfirmEx">Confirm your password</label>
                        <small id="materialFormRegisterConfirmEx" class="form-text text-muted">Confirm Your password</small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="md-form">
                        <i class="fa fa-calendar prefix "></i>
                        <input type="date" name="birth_date" id="materialFormRegisterbirthday" class="form-control">
                        <small id="materialFormRegisterbirthday"  class="form-text text-muted">input Your birthday</small>
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="md-form">
                        <i class="fa fa-android prefix "></i>
                        <input type="text" autocomplete="off" name="captcha" id="captchas" class="form-control">
                        <label for="captchas">Confirm that you are human</label>

                        <small id="captchas"  class="form-text text-muted"><?php echo $viewmodel; ?></small>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <button class="btn btn-lg btn-primary form-control" name="signup" type="submit">Register</button>
            </div>
        </form>
    </div>
</div>