
<!-- Modal -->
<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="vertical-alignment-helper ">
        <div class="modal-dialog vertical-align-center">
            <div class="modal-content">
                <div class="modal-header" style="height: 60px">
                    <div style="float:left;"><img width="40" src="<?= base_url("assets/spc/images/logo.png") ?>"></div>
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <p align="center" style="font-size: x-large;font-weight: bold">Study Plus Center</p>
                </div>
                <div class="modal-body">
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
                                        <input class="form-control" placeholder="Username" id="username" name="username"
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
                                    <input type="submit" class="btn btn-primary btn-block text-uppercase"
                                           value="Log in">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        validateUserLogin();
    });

    function showErrorMessage(message) {
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
                    if (response.role.toLowerCase() == 'user') {
                        window.location = "<?=base_url()?>admin/Student/create";
                    } else {
                        window.location = "<?=base_url()?>admin/dashboard";
                    }
                } else {
                    showErrorMessage(response.message);
                }
            },
            error: function (request, status, error) {
                alert(request.responseText);
            }
        });
    }

    function loginWithFacebook() {
        var targetUrl = BASE_URL + 'admin/Login/performLoginWithFacebook';
        $.ajax({
            url: targetUrl,
            type: "POST",
            dataType: 'json',
            success: function (response) {
                if (response.success == true) {
                    window.location = "<?=base_url()?>admin/dashboard";
                } else {
                    if (response.message == 'expire') {
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

    function OpenInNewTab(url) {
        var win = window.open(url, '_blank');
        win.focus();
    }
</script>
