<?php $this->load->view("components/backend/header"); ?>
<?php $this->load->view("components/backend/navbar"); ?>
<link href="<?= base_url("assets/libraries/jquery-filer/css/jquery.filer.css") ?>" type="text/css" rel="stylesheet">
<link href="<?= base_url("assets/libraries/jquery-filer/css/themes/jquery.filer-dragdropbox-theme.css") ?>"
      type="text/css" rel="stylesheet">
<script type="text/javascript"
        src="<?= base_url("assets/libraries/jquery-filer/js/jquery.filer.min.js?v=1.0.5") ?>"></script>

<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <span><?= $this->lang->line("news_title"); ?></span>
        </h1>
        <div class="group-buttons-right">
            <ul class="nav nav-pills">
                <li>
                    <a href="<?= base_url(ADMIN_NEWS) ?>"> <i
                                class="fa fa-list"></i><?= $this->lang->line("news_list"); ?></a>
                </li>
            </ul>
        </div>

    </section>

    <section class="content">
        <form id="form_news_entry" role="form" class="form-horizontal">
            <div class="panel panel-default">
                <div class="panel-heading <?php echo ($data["action"] === "create") ? "heading-create" : "heading-update"; ?>">
                    <span>
                        <i class="<?php echo ($data["action"] === "create") ? "fa fa-plus-circle " : "fa fa-edit"; ?>"></i>
                        <?= $data["heading_text"] ?>
                    </span>
                </div>

                <div class="panel-body">

                    <div class="form-group required">
                        <label class="col-md-2  control-label"><?= $this->lang->line("news_publish_date"); ?></label>
                        <div class="col-md-7">
                            <div class='col-md-5 input-group date' id='datetimepicker_published_date'>
                                <input type='text' class="form-control" name="published_date"
                                       value="<?php echo isset($data["row"]["published_date"]) ? $data["row"]["published_date"] : "" ?>"/>
                                <span class="input-group-addon">
                                     <span class="glyphicon glyphicon-calendar"></span>
                            </div>
                        </div>
                    </div>


                    <div class="form-group required ">
                        <label class="col-md-2  control-label"><?= $this->lang->line("news_name"); ?></label>
                        <div class="col-md-8">
                            <input type="text" id="name" name="name" class="form-control"
                                   value="<?php echo setFormData($data, $key = "name"); ?>">
                        </div>
                    </div>

                    <div class="form-group required ">
                        <label class="col-md-2  control-label"><?= $this->lang->line("news_title"); ?></label>
                        <div class="col-md-8">
                       <textarea name="title" id="title" class="form-control"
                                 rows="3"><?php echo setFormData($data, $key = "title"); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="col-md-2  control-label"><?= $this->lang->line("news_image"); ?></label>
                        <div class="col-md-8">
                            <input class="form-control" type="file" name="user_files" id="filer_input"
                                   multiple="multiple"
                                   value="<?= (isset($data["row"]["file_name"]) ? $data["row"]["file_name"] : "") ?>">
                            <?php if (isset($data["row"]["file_name"]) && $data["row"]["file_name"] != ""): ?>
                                <div id="div_image">
                                    <?php if ($data["action"] == "update"): ?>
                                        <div class="jFiler-items jFiler-row">
                                            <ul class="jFiler-items-list jFiler-items-grid">
                                                <li class="jFiler-item">
                                                    <div class="jFiler-item-container">
                                                        <div class="jFiler-item-inner">
                                                            <div class="jFiler-item-thumb" style="width:100%">
                                                                <img src="<?= isset($data["row"]["file_name"]) ? base_url("uploads/news/" . $data["row"]["file_name"]) : "" ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="col-md-2  control-label"><?= $this->lang->line("news_body"); ?></label>
                        <div class="col-md-8">
                         <textarea name="body" id="body" class="form-control"
                                   rows="3"><?php echo setFormData($data, $key = "body"); ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?= $this->lang->line("show_on_home_page"); ?></label>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-2 col-sm-6">
                                    <input type="checkbox" id="cbx_enable_show_on_home_page"
                                           name="is_show_on_home_page">
                                </div>
                            </div>
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
                        <?= buttonCancelWithRedirectPage("admin/News/index"); ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </form>
    </section>

</div><!-- /.content-wrapper -->

<style>
    .form-vertical .form-horizontal .control-group > label {
        text-align: left;
    }

</style>

<script type="text/javascript">
    var validator;

    $(document).ready(function () {

        initView()

        setupFileInput();

        validateForm();

        setupDatePicker();

        setupTinyMCE();

        setupToggleEnableShowOnHomePage();

    });

    function initView() {
        var news_id = '<?php echo $this->uri->segment(4)?>';
        if (news_id != null && news_id != '') {
            $('#div_image').show();
        } else {
            $('#div_image').hide();
        }

        $("input:file").change(function () {
            $('#div_image').hide();
        });
    }

    function setupDatePicker() {
        $('#datetimepicker_published_date').datetimepicker({
            locale: 'th',
            format: "YYYY-MM-DD",
            defaultDate: new Date()
        });
    }

    function setupTinyMCE() {
        var external_filemanager_path = '<?=base_url("assets")?>/libraries/filemanager/';
        var filemanager = '<?=base_url("assets/libraries/filemanager/plugin.min.js")?>';
        tinymce.init({
            selector: "#body", theme: "modern", height: 300,
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

    function setupFileInput() {
        $('#filer_input').filer({
            limit: null,
            maxSize: null,
            extensions: null,
            extensions: ['jpg', 'jpeg', 'png'],
            changeInput: true,
            showThumbs: true,
            captions: {button: 'Browse', feedback: ''},
            addMore: false,
            templates: {
                box: '<ul class="jFiler-items-list jFiler-items-grid"></ul>',
                item: '<li class="jFiler-item">\
                        <div class="jFiler-item-container">\
                            <div class="jFiler-item-inner">\
                                <div class="jFiler-item-thumb">\
                                    <div class="jFiler-item-status"></div>\
                                    <div class="jFiler-item-info">\
                                        <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                        <span class="jFiler-item-others">{{fi-size2}}</span>\
                                    </div>\
                                    {{fi-image}}\
                                </div>\
                                <div class="jFiler-item-assets jFiler-row">\
                                    <ul class="list-inline pull-left">\
                                        <li>{{fi-progressBar}}</li>\
                                    </ul>\
                                    <ul class="list-inline pull-right">\
                                        <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                    </ul>\
                                </div>\
                            </div>\
                        </div>\
                    </li>',
                itemAppend: '<li class="jFiler-item">\
                            <div class="jFiler-item-container">\
                                <div class="jFiler-item-inner">\
                                    <div class="jFiler-item-thumb">\
                                        <div class="jFiler-item-status"></div>\
                                        <div class="jFiler-item-info">\
                                            <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                            <span class="jFiler-item-others">{{fi-size2}}</span>\
                                        </div>\
                                       \
                                    </div>\
                                    <div class="jFiler-item-assets jFiler-row">\
                                        <ul class="list-inline pull-left">\
                                            <li><span class="jFiler-item-others">{{fi-icon}}</span></li>\
                                        </ul>\
                                        <ul class="list-inline pull-right">\
                                            <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                        </ul>\
                                    </div>\
                                </div>\
                            </div>\
                        </li>',
                progressBar: '<div class="bar"></div>',
                itemAppendToEnd: false,
                removeConfirmation: true,
                _selectors: {
                    list: '.jFiler-items-list',
                    item: '.jFiler-item',
                    progressBar: '.bar',
                    remove: '.jFiler-item-trash-action'
                }
            }
        });
    }

    function setupToggleEnableShowOnHomePage() {
        $("#cbx_enable_show_on_home_page").bootstrapSwitch('state', false);
        var news_id = '<?=$this->uri->segment(4)?>';
        if (news_id != '') {
            var is_show_on_home_page = '<?= (isset($data["row"]["is_show_on_home_page"]) && $data["row"]["is_show_on_home_page"] == 1) ? true : false ?>';
            if (is_show_on_home_page) {
                $("#cbx_enable_show_on_home_page").bootstrapSwitch('state', true);
            }
        }
    }

    function validateForm() {
        validator = $('#form_news_entry').validate({
            rules: {
                published_date: "required",
                title: "required",
                name: "required",
                body: "required"
            },
            messages: {
                published_date: '<?php echo $this->lang->line("message_this_field_is_require");?>',
                title: '<?php echo $this->lang->line("message_this_field_is_require");?>',
                name: '<?php echo $this->lang->line("message_this_field_is_require");?>',
                body: '<?php echo $this->lang->line("message_this_field_is_require");?>'
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
            targetUrl = BASE_URL + 'admin/News/create';
        } else {
            targetUrl = BASE_URL + 'admin/News/update/' + id;
        }


        showSpinner();
        $.ajax({
            type: 'POST',
            url: targetUrl,
            data: $("#form_news_entry").serializefiles(),
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                hideSpinner();
                if (response.success == true) {
                    alertSuccessMessageDialog(
                        '<?=$this->lang->line("message_dialog_title_success");?>',
                        '<?=$this->lang->line("message_save_complete");?>', function () {
                            var id = '<?=$this->uri->segment(4)?>';
                            if (id != 0 && id != '') {
                                window.location = BASE_URL + 'admin/News/index';
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
                alert(request.responseText);
            }
        });
    }

    function clearForm() {
        window.location = BASE_URL + 'admin/News/create';
    }


</script>

<?php $this->load->view("components/backend/footer"); ?>

