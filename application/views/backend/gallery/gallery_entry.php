<?php $this->load->view("components/backend/header"); ?>
<?php $this->load->view("components/backend/navbar"); ?>

<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <span><?= $this->lang->line("gallery_title"); ?></span>
        </h1>
        <div class="group-buttons-right">
            <ul class="nav nav-pills">
                <li>
                    <a href="<?= base_url(ADMIN_GALLERY) ?>"> <i class="fa fa-list"></i><?= $this->lang->line("gallery_list"); ?></a>
                </li>
            </ul>
        </div>

    </section>

    <section class="content">
        <form id="form_gallery_entry" role="form" class="form-horizontal">
            <div class="panel panel-default">
                <div class="panel-heading <?php echo ($data["action"] === "create") ? "heading-create" : "heading-update"; ?>">
                <span>
                    <i class="<?php echo ($data["action"] === "create") ? "fa fa-plus-circle " : "fa fa-edit"; ?>"></i>
                    <?= $data["heading_text"] ?>
                </span>
                </div>

                <div class="panel-body">
                    <div class="form-group required ">
                        <label class="col-md-2  control-label"><?= $this->lang->line("gallery_name"); ?></label>
                        <div class="col-md-8">
                            <input type="text" id="name" name="name" class="form-control"
                                   value="<?php echo isset($data["row"]["name"]) ? $data["row"]["name"] : "" ?>">
                        </div>
                    </div>

                    <div class="form-group required ">
                        <label class="col-md-2  control-label"><?= $this->lang->line("gallery_description"); ?></label>
                        <div class="col-md-8">
                            <textarea rows="5" class="form-control" name="description"><?php echo isset($data["row"]["description"]) ? $data["row"]["description"] : "" ?></textarea>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label class="col-md-2 control-label"><?= $this->lang->line("form_field_published"); ?></label>
                        <div class="col-md-2">
                            <select class="form-control" id="published" name="published">
                                <option value="1" <?= isset($data["row"]["published"]) && $data["row"]["published"] == 1 ? "selected" : "" ?>>
                                    <?= $this->lang->line("form_field_published"); ?></option>
                                <option value="0" <?= isset($data["row"]["published"]) && $data["row"]["published"] == 0 ? "selected" : "" ?>>
                                    <?= $this->lang->line("form_field_unpublished"); ?></option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="panel-footer">
                    <div class="pull-right">
                        <?= buttonSubmitCreateOrUpdate($data["action"]); ?>
                        <?= buttonCancelWithRedirectPage("admin/Gallery/index"); ?>
                    </div>
                    <div class="clearfix"></div>
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
        validator = $('#form_gallery_entry').validate({
            rules: {
                name: "required",
                description: "required"
            },
            messages: {
                name: '<?php echo $this->lang->line("message_this_field_is_require");?>',
                description: '<?php echo $this->lang->line("message_this_field_is_require");?>'
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
                save();
            }
        });
    }


    function save() {
        var targetUrl;
        var id = '<?=$this->uri->segment(4)?>';

        if (id === "") {
            targetUrl = BASE_URL + 'admin/Gallery/create';
        } else {
            targetUrl = BASE_URL + 'admin/Gallery/update/' + id;
        }


        showSpinner();
        $.ajax({
            type: 'POST',
            url: targetUrl,
            data: $("#form_gallery_entry").serialize(),
            dataType: 'json',
            success: function (response) {
                hideSpinner();
                if (response.success == true) {
                    alertSuccessMessageDialog(
                        '<?=$this->lang->line("message_dialog_title_success");?>',
                        '<?=$this->lang->line("message_save_complete");?>', function(){
                            var id = '<?=$this->uri->segment(4)?>';
                            if (id != 0 && id != '') {
                                window.location = BASE_URL + 'admin/Gallery/index';
                            } else {
                                clearForm();
                            }
                    } );
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
                alert(request.responseText);
            }
        });
    }



    function clearForm() {
        validator.resetForm();
        $('#form_gallery_entry')[0].reset();
    }


</script>

<?php $this->load->view("components/backend/footer"); ?>

