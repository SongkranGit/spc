<?php $this->load->view("components/backend/header"); ?>
<?php $this->load->view("components/backend/navbar"); ?>

<?php echo js_asset('load-image.all.min.js'); ?>
<?php echo js_asset('exif.js'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <span><?= $this->lang->line("user_title_user_info"); ?></span>
        </h1>
        <div class="group-buttons-right">
            <ul class="nav nav-pills">
                <li>
                    <a href="<?= base_url(ADMIN_USER) ?>"> <i class="fa fa-list"></i><?= $this->lang->line("user_button_list_user"); ?></a>
                </li>
            </ul>
        </div>

    </section>

    <section class="content">
        <form id="form_user_entry" role="form">
            <div class="panel panel-default">
                <div class="panel-heading <?php echo ($data["action"] === "create") ? "heading-create" : "heading-update"; ?>">
                <span>
                    <i class="<?php echo ($data["action"] === "create") ? "fa fa-plus-circle " : "fa fa-edit"; ?>"></i>
                    <?= $data["heading_text"] ?>
                </span>
                </div>
                <div class="panel-body">
                    <div class="row-fluid">
                        <div class="col-md-6 form-group required-vertical">
                            <label class=" control-label"><?= $this->lang->line("user_first_name"); ?></label>
                            <input type="text" id="firstname" name="firstname" class="form-control"
                                   value="<?php echo isset($data["result"]["firstname"]) ? $data["result"]["firstname"] : "" ?>">
                        </div>
                        <div class="col-md-6 form-group required-vertical">
                            <label class="control-label"><?= $this->lang->line("user_last_name"); ?></label>
                            <input type="text" id="lastname" name="lastname" class="form-control"
                                   value="<?php echo isset($data["result"]["lastname"]) ? $data["result"]["lastname"] : "" ?>">
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="col-md-6  form-group required-vertical">
                            <label class="control-label"><?= $this->lang->line("user_username"); ?></label>
                            <input type="text" id="username" name="username" class="form-control"
                                   value="<?php echo isset($data["result"]["username"]) ? $data["result"]["username"] : "" ?>">
                        </div>
                        <div class="col-md-6 form-group required-vertical">
                            <label class="control-label"><?= $this->lang->line("user_password"); ?></label>
                            <input id="password" type="password" name="password" class="form-control"
                                <?php echo ($data["action"] === "update") ? "disabled" : "required" ?> >
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="col-md-6  form-group required-vertical">
                            <label class="control-label"><?= $this->lang->line("user_email"); ?></label>
                            <input type="email" id="email" name="email" class="form-control"
                                   value="<?php echo isset($data["result"]["email"]) ? $data["result"]["email"] : "" ?>">
                        </div>
                        <div class="col-md-6 form-group required-vertical">
                            <label class="control-label"><?= $this->lang->line("user_password_confirm"); ?></label>
                            <input type="password" id="password_confirm" name="password_confirm" class="form-control"
                                <?php echo ($data["action"] === "update") ? "disabled" : "required" ?> >
                        </div>
                    </div>

                    <div class="row-fluid">
                        <div class="col-md-6  form-group">
                            <label class="control-label"><?= $this->lang->line("user_phone"); ?></label>
                            <input type="tel" id="phone" name="phone" class="form-control"
                                   value="<?php echo isset($data["result"]["phone"]) ? $data["result"]["phone"] : "" ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="control-label"><?= $this->lang->line("user_role"); ?></label><br>
                            <div class="col-md-6">
                                <?php
                                if (isset($data["roles"])) {
                                    foreach ($data["roles"] as $row) {
                                        $radio = "<label class=\"radio-inline\" >";
                                        $radio .= "<input type=\"radio\" name=\"role_id\" value=" . $row["role_id"] . " ";
                                        //bind data
                                        if (isset($data["result"]["role_id"]) && $data["result"]["role_id"] != 0) {
                                            if ($row["role_id"] == $data["result"]["role_id"]) {
                                                $radio .= "checked";
                                            }
                                        } else {
                                            if ($row["role_id"] == 1) {
                                                $radio .= "checked";
                                            }
                                        }
                                        $radio .= " >" . $row["role_name"];
                                        $radio .= "</label>";

                                        echo $radio;
                                    }
                                }
                                ?>
                            </div>
                            <div class="col-md-6">
                                <?php if (($data["action"] === "update")) { ?>
                                    <button onclick="editPassword()" class="btn btn-primary pull-right" type="button">
                                        <i class="fa fa-edit"></i> <?= $this->lang->line("user_button_edit_password"); ?>
                                    </button>
                                    <input type="hidden" id="isEditPassword" name="isEditPassword" value="true"
                                           disabled>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
<!--                    <?php /*if (($data["action"] === "update")) { */?>
                        <div class="row-fluid">
                            <span class="divider"></span>
                            <div class="col-md-4  form-group">
                                <label class="control-label"><?/*= $this->lang->line("user_external_login"); */?></label>
                                    <?php /*if ($data["result"]["facebook_id"] != NULL && $data["result"]["facebook_id"] != '') : */?>
                                        <a id="btn_facebook_connect" href="#"
                                           class="btn btn-block btn-social btn-facebook text-right" disabled="disable">  <span class="fa fa-facebook"></span>  Connected  </a>
                                    <?php /*else: */?>
                                        <a id="btn_facebook_connect" href="<?/*= base_url("admin/User/connectToFacebook/" . $this->uri->segment(4)) */?>"
                                           class="btn btn-block btn-social btn-facebook text-right">  <span class="fa fa-facebook"></span>  Not Connect to facebook  </a>
                                    <?php /*endif */?>
                            </div>
                        </div>
                    --><?php /*} */?>
                    <span class="clearfix">
                </div>
                <div class="panel-footer">
                    <div class="pull-right">
                        <?= buttonSubmitCreateOrUpdate($data["action"]); ?>
                        <?= buttonCancelWithRedirectPage(ADMIN_USER); ?>
                    </div>
                   <span class="clearfix">
                </div>
            </div>
        </form>
    </section>


</div><!-- /.content-wrapper -->

<script type="text/javascript">
    var validator;

    $(document).ready(function () {
        validateForm();
    });

    function validateForm() {
        validator = $('#form_user_entry').validate({
            rules: {
                firstname: "required",
                lastname: "required",
                email: {
                    required: true,
                    email: true
                },
                username: "required",
                password: {
                    required: true
                },
                password_confirm: {
                    required: true,
                    equalTo: "#password"
                }

            },
            messages: {
                firstname: '<?php echo $this->lang->line("message_this_field_is_require");?>',
                lastname: '<?php echo $this->lang->line("message_this_field_is_require");?>',
                email: {
                    required: '<?php echo $this->lang->line("message_this_field_is_require");?>',
                    email: '<?php echo $this->lang->line("message_email_not_valid");?>'
                },
                username: '<?php echo $this->lang->line("message_this_field_is_require");?>',
                password: '<?php echo $this->lang->line("message_this_field_is_require");?>',
                password_confirm: {
                    required: '<?php echo $this->lang->line("message_this_field_is_require");?>',
                    equalTo: '<?php echo $this->lang->line("message_password_is_not_match");?>'
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
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form) {
                saveUser();
            }
        });
    }


    function saveUser() {
        var targetUrl;
        var user_id = '<?=$this->uri->segment(4)?>';

        if (user_id === "") {
            targetUrl = BASE_URL + 'admin/User/create';
        } else {
            targetUrl = BASE_URL + 'admin/User/update/' + user_id;
        }

        showSpinner();

        $.ajax({
            type: 'POST',
            url: targetUrl,
            data: $("#form_user_entry").serialize(),
            dataType: 'json',
            success: function (response) {
                hideSpinner();
                if (response.success == true) {
                    alertSuccessMessageDialog(
                        '<?=$this->lang->line("message_dialog_title_success");?>',
                        '<?=$this->lang->line("message_save_complete");?>', function () {
                            var id = '<?=$this->uri->segment(4)?>';
                            if (id != 0 && id != '') {
                                window.location = BASE_URL + 'admin/User';
                            } else {
                                clearForm();
                            }
                        });
                } else {
                    $.each(response.messages, function (key, value) {
                        var element = $('#' + key);
                        element.closest('div.form-group')
                            .removeClass('has-error')
                            .addClass(value.length > 0 ? 'has-error' : 'has-success')
                            .find('.text-danger')
                            .remove();

                        element.after(value);
                    });
                }
            },
            error: function (request, status, error) {
                hideSpinner();
                clearForm();
                clearValidation();
                alert(request.responseText);
            }
        });
    }

    function clearForm() {
        validator.resetForm();
        $('#form_user_entry')[0].reset();
    }

    function editPassword() {
        $('#password').attr('disabled', false);
        $('#password_confirm').attr('disabled', false);
        $('#password').attr('required', true);
        $('#password_confirm').attr('required', true);
        $('#isEditPassword').prop('disabled', false);
    }


</script>

<?php $this->load->view("components/backend/footer"); ?>

