<body class="animated fadeIn login">
<section id="login-container">
    <div class="row">
        <!--        Login part-->
        <div class="col-md-3" id="login-wrapper">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Sign In
                    </h3>
                </div>
                <div class="panel-body">
                    <p> Login to access your account.</p>

                    <p class="alert alert-danger hidden" id="errorAlertLogin">Invalid combination of Callsign/E-mail and
                            password
                    </p>

                    <?php validation_errors();

                    $attributes = array('class' => 'form-horizontal', 'role' => 'form', 'id' => 'frm_login');
                    echo form_open('Authentication/validateForm', $attributes) ?>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="userID" name="user"
                                   placeholder="Callsign / E-mail" required>
                            <i class="fa fa-user"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="password" class="form-control" id="password" name="password"
                                   placeholder="Password" required>
                            <i class="fa fa-lock"></i>
                            <a href="javascript:void(0)" class="help-block">Forgot Your Password?</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                            <hr>
                            <a id="signUpBtn" class="btn btn-default btn-block">Not a member? Sign Up</a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!--        End Login part-->
        <!--        Start SignUp part-->
        <div class="col-md-4 hidden" id="signUp-wrapper">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Sign Up
                    </h3>
                </div>
                <div class="panel-body">
                    <p>Already a member? <a href="javascript:void(0)" id="loginBtn""><strong>Sign In</strong></a></p>

                    <p class="alert alert-danger hidden" id="errorAlert"></p>
                    <p class="alert alert-success hidden" id="successAlert"></p>
                    <?php validation_errors();

                    $attributes = array('role' => 'form', 'id' => 'frm_signUp');
                    echo form_open('sign_up/validateForm', $attributes) ?>
                        <div class="form-group">
                            <div class="col-sm-4 margin-bottom-15">
                                <input type="text" class="form-control" name="firstName" placeholder="First name*"
                                       required>
                            </div>
                            <div class="col-sm-3 margin-bottom-15">
                                <input type="text" class="form-control" name="prefix" placeholder="Prefix">
                            </div>
                            <div class="col-sm-5 margin-bottom-15">
                                <input type="text" class="form-control" name="lastName" placeholder="Last name*"
                                       required>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="eMail"
                                   placeholder="Enter your email*" required>
                        </div>
                        <div class="form-group" id="password1">
                            <input type="password" class="form-control" name="password" id="password1Input"
                                   placeholder="Password*" required>
                            <span id="password1Icon" class="glyphicon glyphicon-ok form-control-feedback hidden"></span>
                        </div>
                        <div class="form-group" id="password2">
                            <input type="password" class="form-control" id="password2Input"
                                   placeholder="Retype your password*" required>
                            <span id="password2Icon" class="glyphicon glyphicon-ok form-control-feedback hidden"></span>
                        </div>
                        <div class="form-group">
                            <?php echo $this->recaptcha->render(); ?>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!--    End SignUp part-->
</section>

