<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url("assets/adminlte2") ?>/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url("assets/") ?>/bootstrap/css/bootstrap-social.css">
    <link rel="stylesheet" href="<?= base_url("assets/") ?>/font-awesome/css/font-awesome.min.css">
    <link href="<?= base_url() ?>assets/css/login.css" rel="stylesheet" type="text/css"/>
    <!-- Javascript -->
    <script src="<?= base_url() ?>assets/js/jquery-1.11.1.min.js"></script>
    <script src="<?= base_url() ?>assets/libraries/jquery-validation/jquery.validate.min.js"></script>

    <style>

        html, body, .container-table {
            height: 100%;
        }

        body {
            background-color: #444;
        }

        .vertical-offset-100 {
            padding-top: 100px;
        }

        .panel-heading {
            padding: 5px 15px;
        }

        .panel-footer {
            padding: 20px
            color: #A0A0A0;
            font-size: 12px;
        }

        .container-table {
            display: table;
        }

        .vertical-center-row {
            display: table-cell;
            vertical-align: middle;
        }
    </style>


    <script type="text/javascript">

        var BASE_URL = '<?=base_url()?>';

        $(document).ready(function () {
            validateUserLogin();

        });

        function showErrorMessage(message){
            $("#verifyFailed").show();
            $("#verifyFailed #error_message").html(message);
        }

        function validateUserLogin() {
            $('#formSubmitLogin').validate({
                rules: {
                    username: {
                        required: true
                    },
                    password: {
                        required: true
                    }
                },
                highlight: function (element) {
                    $(element).closest('.form-group').addClass('has-error');
                },
                unhighlight: function (element) {
                    $(element).closest('.form-group').removeClass('has-error');
                },
                errorElement: 'span',
                errorClass: 'help-block',
                errorPlacement: function (error, element) {
                },
                submitHandler: function (form) {
                    login();
                }
            });

        }

        function login() {
            var targetUrl = BASE_URL + 'admin/Login/performLogin';
            $.ajax({
                url: targetUrl,
                type: "POST",
                dataType: 'json',
                data: $("#formSubmitLogin").serialize(),
                success: function (response) {
                    if (response.success == true) {
                        window.location = "<?=base_url()?>admin/dashboard";
                    } else {
                        showErrorMessage(response.message);
                    }
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
            });
        }

        function loginWithFacebook(){
            var targetUrl = BASE_URL + 'Admin/Login/performLoginWithFacebook';
            $.ajax({
                url: targetUrl,
                type: "POST",
                dataType: 'json',
                success: function (response) {
                    if (response.success == true) {
                        window.location = "<?=base_url()?>admin/dashboard";
                    } else {
                        if(response.message=='expire'){
                            window.location = response.facebook_login_url;
                        }

                        showErrorMessage(response.message);
                    }
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
            });
        }
    </script>

</head>

<body>
<div class="container container-table">
    <div class="row vertical-center-row">
        <div class="col-sm-12 col-md-5 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <p align="center">Welcome to Admin Panel</p>
                </div>
                <div class="panel-body">
                    <form role="form" id="formSubmitLogin">
                        <div class="row">
                            <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                                <div id="verifyFailed" class="alert alert-danger" hidden="hidden">
                                    <span class="glyphicon glyphicon-warning-sign"></span>
                                    <span id="error_message" style="margin-left: 10px"></span>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
												<span class="input-group-addon">
													<i class="glyphicon glyphicon-user"></i>
												</span>
                                        <input class="form-control" placeholder="Username" id="username"
                                               name="username"
                                               type="text" autofocus>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
												<span class="input-group-addon">
													<i class="glyphicon glyphicon-lock"></i>
												</span>
                                        <input class="form-control" placeholder="Password" id="password"
                                               name="password"
                                               type="password">
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                                <div class="checkbox icheck rememberMe">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary btn-block text-uppercase" value="Log in">
                                </div>
                            </div>
                        </div>

                       <!-- <div class="row">
                            <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                                <div class="form-group">
                                    <?php /*if($this->facebook->logged_in()):*/?>
                                        <a href="javascript:loginWithFacebook();" class="btn btn-block btn-social btn-facebook">
                                            <span class="fa fa-facebook"></span> Login
                                        </a>
                                    <?php /*else:*/?>
                                        <a href="<?php /*echo $this->facebook->login_url()*/?>" class="btn btn-block btn-social btn-facebook">
                                            <span class="fa fa-facebook"></span> Login
                                        </a>
                                    <?php /*endif;*/?>

                                </div>
                            </div>
                        </div>-->

                    </form>
                </div>
                <div class="panel-footer ">
                    <p class="copyright">
                        Powered by <a href="http://www.modernsofttech.com/" title="ModernSoftTech">ModernSoftTech CMS</a><br>
                        Copyright © 2016
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>