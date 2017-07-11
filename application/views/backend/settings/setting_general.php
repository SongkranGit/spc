<?php $this->load->view("components/backend/header"); ?>
<?php $this->load->view("components/backend/navbar"); ?>

<?php echo js_asset('load-image.all.min.js'); ?>
<?php echo js_asset('exif.js'); ?>

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
                            <div class="col-md-8">
                                <input type="text" id="website_name" name="website_name" class="form-control" placeholder="<?= $this->lang->line("settings_website_name"); ?>"
                                       value="<?php echo isset($row["website_name"]) ? $row["website_name"] : "" ?>">
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="control-label col-md-2" for="website_short_name"><?= $this->lang->line("settings_website_short_name"); ?></label>
                            <div class="col-md-8">
                                <input type="text" id="website_short_name" name="website_short_name" class="form-control"
                                       placeholder="<?= $this->lang->line("settings_place_holder_website_short_name"); ?>"
                                       value="<?php echo isset($row["website_short_name"]) ? $row["website_short_name"] : "" ?>">
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="control-label col-md-2" for="email"><?= $this->lang->line("settings_owner_email"); ?></label>
                            <div class="col-md-8">
                                <input type="text" id="email" name="email" class="form-control"
                                       placeholder="<?= $this->lang->line("settings_placeholder_email"); ?>"
                                       value="<?php echo isset($row["email"]) ? $row["email"] : "" ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2" for="phone"><?= $this->lang->line("settings_owner_phone"); ?></label>
                            <div class="col-md-8">
                                <input type="text" id="phone" name="phone" class="form-control"
                                       placeholder="<?= $this->lang->line("settings_placeholder_phone"); ?>"
                                       value="<?php echo isset($row["phone"]) ? $row["phone"] : "" ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2" for="phone"><?= $this->lang->line("settings_mobile"); ?></label>
                            <div class="col-md-8">
                                <input type="text" id="mobile" name="mobile" class="form-control"
                                       placeholder="<?= $this->lang->line("settings_placeholder_mobile"); ?>"
                                       value="<?php echo isset($row["mobile"]) ? $row["mobile"] : "" ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2"><?= $this->lang->line("settings_default_language"); ?></label>
                            <div class="col-md-8">
                                <select class="form-control" id="default_language" name="default_language">
                                    <option value="thai" <?= (!isset($row) && strcasecmp($row["default_language"], "thai") == 0) ? "selected" : "" ?>> Thai</option>
                                    <option value="english" <?= (!isset($row) && strcasecmp($row["default_language"], "english") == 0) ? "selected" : "" ?>>English</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2"><?= $this->lang->line("settings_owner_address"); ?></label>
                            <div class="col-md-8">
                                <ul class="nav nav-tabs">
                                    <li role="presentation" class="active"><a href="#tab1" data-toggle="tab">Thai</a></li>
                                    <li role="presentation"><a href="#tab2" data-toggle="tab">English</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab1">
                                        <br>
                                    <textarea name="address_th" id="body" class="form-control"
                                              rows="5"><?= (isset($row["address_th"]) ? $row["address_th"] : "") ?></textarea>
                                    </div>
                                    <div class="tab-pane fade" id="tab2">
                                        <br>
                                   <textarea name="address_en" id="body" class="form-control"
                                             rows="5"><?= (isset($row["address_en"]) ? $row["address_en"] : "") ?></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <span><i class="fa fa-gear"></i> <?= $this->lang->line("settings_title_social_network"); ?></span>
                </div>
                <div class="panel-body">
                    <div class="row col-md-12">
                        <div class="form-group">
                            <label for="facebook_link" class="col-md-2  control-label"><?= $this->lang->line("settings_facebook_link"); ?></label>
                            <div class="col-md-8">
                                <input type="text" id="facebook_link" name="facebook_link" class="form-control"
                                       value="<?php echo isset($row["facebook_link"]) ? $row["facebook_link"] : "" ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2" for="twitter_link"><?= $this->lang->line("settings_twitter_link"); ?></label>
                            <div class="col-md-8">
                                <input type="text" id="twitter_link" name="twitter_link" class="form-control"
                                       value="<?php echo isset($row["twitter_link"]) ? $row["twitter_link"] : "" ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2" for="instargram_link"><?= $this->lang->line("settings_instargram_link"); ?></label>
                            <div class="col-md-8">
                                <input type="text" id="instagram_link" name="instagram_link" class="form-control"
                                       value="<?php echo isset($row["instagram_link"]) ? $row["instagram_link"] : "" ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2" for="line_id"><?= $this->lang->line("settings_line_id"); ?></label>
                            <div class="col-md-8">
                                <input type="text" id="line_id" name="line_id" class="form-control"
                                       value="<?php echo isset($row["line_id"]) ? $row["line_id"] : "" ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <span><i class="fa fa-gear"></i> <?= $this->lang->line("settings_title_messages"); ?></span>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="facebook_link" class="col-md-2  control-label"><?= $this->lang->line("settings_vision"); ?></label>
                        <div class="col-md-8">
                            <ul class="nav nav-tabs">
                                <li role="presentation" class="active"><a href="#tab_vision_1" data-toggle="tab">Thai</a></li>
                                <li role="presentation"><a href="#tab_vision_2" data-toggle="tab">English</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_vision_1">
                                    <br>
                                     <textarea name="vision_th" id="vision_th" class="form-control"
                                               rows="3"><?= (isset($row["vision_th"]) ? $row["vision_th"] : "") ?></textarea>
                                </div>
                                <div class="tab-pane fade" id="tab_vision_2">
                                    <br>
                                   <textarea name="vision_en" id="vision_en" class="form-control"
                                             rows="3"><?= (isset($row["vision_en"]) ? $row["vision_en"] : "") ?></textarea>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <div class="box-footer clearfix no-border" style="background: none">
                <div class="pull-right">
                    <?= buttonSubmit(); ?>
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
        initTinyFileManager();
    });

    function initTinyFileManager() {
        var external_filemanager_path = '<?=base_url("assets")?>/libraries/filemanager/';
        var filemanager = '<?=base_url("assets/libraries/filemanager/plugin.min.js")?>';
        tinymce.init({
            selector: "#vision_en", theme: "modern", height: 200,
            relative_urls: false,
            remove_script_host: false,
            convert_urls: true,
            setup: function (editor) {
                editor.on('change', function () {
                    editor.save();
                });
            },
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
            ],
            toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
            toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
            image_advtab: true,
            external_filemanager_path: external_filemanager_path,
            filemanager_title: "Responsive Filemanager",
            external_plugins: {"filemanager": filemanager}
        });

        tinymce.init({
            selector: "#vision_th", theme: "modern", height: 200,
            relative_urls: false,
            remove_script_host: false,
            convert_urls: true,
            setup: function (editor) {
                editor.on('change', function () {
                    editor.save();
                });
            },
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
            ],
            toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
            toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
            image_advtab: true,
            external_filemanager_path: external_filemanager_path,
            filemanager_title: "Responsive Filemanager",
            external_plugins: {"filemanager": filemanager}
        });
    }

    function validateForm() {
        validator = form_entry.validate({
            rules: {
                website_name: "required",
                website_short_name: {
                    required: true,
                    maxlength: 4
                },
                email: {
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
                email: {
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

