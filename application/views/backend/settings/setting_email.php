<?php $this->load->view("components/backend/header"); ?>
<?php $this->load->view("components/backend/navbar"); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <span> <?= $this->lang->line("settings_title"); ?> </span>
        </h1>

    </section>

    <section class="content">
        <form id="form_settings_general" role="form" class="form-horizontal">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span><i class="fa fa-gear"></i> <?= $this->lang->line("settings_title_general"); ?></span>
                </div>
                <div class="panel-body">
                    <div class="row col-md-12">
                        <div class="form-group required ">
                            <label for="website_name" class="col-md-2  control-label"><?= $this->lang->line("settings_website_name"); ?></label>
                            <div class="col-md-6">
                                <input type="text" id="website_name" name="website_name" class="form-control" placeholder="<?= $this->lang->line("settings_website_name"); ?>"
                                       value="<?php echo isset($row["website_name"]) ? $row["website_name"] : "" ?>">
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="control-label col-md-2" for="website_short_name"><?= $this->lang->line("settings_website_short_name"); ?></label>
                            <div class="col-md-6">
                                <input type="text" id="website_short_name" name="website_short_name" class="form-control"
                                       placeholder="<?= $this->lang->line("settings_place_holder_website_short_name"); ?>"
                                       value="<?php echo isset($row["website_short_name"]) ? $row["website_short_name"] : "" ?>">
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="control-label col-md-2" for="owner_email"><?= $this->lang->line("settings_owner_email"); ?></label>
                            <div class="col-md-6">
                                <input type="text" id="owner_email" name="owner_email" class="form-control"
                                       placeholder="<?= $this->lang->line("settings_placeholder_owner_email"); ?>"
                                       value="<?php echo isset($row["owner_email"]) ? $row["owner_email"] : "" ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2" for="owner_phone"><?= $this->lang->line("settings_owner_phone"); ?></label>
                            <div class="col-md-6">
                                <input type="text" id="owner_phone" name="owner_phone" class="form-control"
                                       placeholder="<?= $this->lang->line("settings_placeholder_owner_phone"); ?>"
                                       value="<?php echo isset($row["owner_phone"]) ? $row["owner_phone"] : "" ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2"><?= $this->lang->line("settings_default_language"); ?></label>
                            <div class="col-md-6">
                                <select class="form-control" id="default_language" name="default_language">
                                    <option value="thai" <?= (!isset($row) && strcasecmp($row["default_language"], "thai") == 0) ? "selected" : "" ?>> Thai</option>
                                    <option value="english" <?= (!isset($row) && strcasecmp($row["default_language"], "english") == 0) ? "selected" : "" ?>>English</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2" for="owner_address"><?= $this->lang->line("settings_owner_address"); ?></label>
                            <div class="col-md-6">
                                <textarea name="owner_address" class="form-control" rows="5"
                                          placeholder="<?= $this->lang->line("settings_placeholder_owner_address"); ?>"><?= (isset($row["owner_address"]) ? $row["owner_address"] : "") ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="pull-right">
                        <?= buttonSubmit(); ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </form>
    </section>


</div><!-- /.content-wrapper -->

<script type="text/javascript">

    var form_entry = $("#form_settings_general");
    var validator;

    $(document).ready(function () {
        validateForm();
    });

    function validateForm() {
        validator = form_entry.validate({
            rules: {
                website_name: "required",
                website_short_name: {
                    required: true,
                    maxlength: 4
                },
                owner_email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                website_name: '<?php echo $this->lang->line("message_this_field_is_require");?>',
                website_short_name: {
                    required: '<?php echo $this->lang->line("message_this_field_is_require");?>',
                    maxlength: '<?php echo $this->lang->line("message_validate_website_short_name_max_length");?>'
                },
                owner_email: {
                    required: '<?php echo $this->lang->line("message_this_field_is_require");?>',
                    email: '<?php echo $this->lang->line("message_email_not_valid");?>'
                },
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
                saveSettings();
            }
        });
    }

    function saveSettings() {
        var targetUrl = BASE_URL + 'admin/setting/save';

        showSpinner();

        $.ajax({
            type: 'POST',
            url: targetUrl,
            data: form_entry.serialize(),
            dataType: 'json',
            success: function (response) {
                hideSpinner();
                if (response.success == true) {
                    alertSuccessMessageDialog('<?=$this->lang->line("message_save_complete");?>');
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
                alert(request.responseText);
            }
        });
    }

    function clearForm() {
        validator.resetForm();
        form_entry[0].reset();
    }

    function alertSuccessMessageDialog(message) {
        BootstrapDialog.show({
            title: '<?=$this->lang->line("message_dialog_title_success");?>',
            size: BootstrapDialog.SIZE_SMALL,
            closable: false,
            message: message,
            buttons: [{
                id: 'btn-ok',
                icon: 'glyphicon glyphicon-check',
                label: 'OK',
                cssClass: 'btn-primary',
                autospin: false,
                action: function (dialogRef) {
                    dialogRef.close();
                }
            }]
        });
    }

</script>

<?php $this->load->view("components/backend/footer"); ?>

