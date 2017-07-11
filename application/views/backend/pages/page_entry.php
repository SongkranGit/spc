<?php $this->load->view("components/backend/header"); ?>
<?php $this->load->view("components/backend/navbar"); ?>

<?php
$gallery_selected = (isset($data["row"]["gallery_id"])) ? $data["row"]["gallery_id"] : '';
$article_selected = (isset($data["row"]["article_id"])) ? $data["row"]["article_id"] : '';
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <span><?= $this->lang->line("pages_title_information"); ?></span>
        </h1>
        <div class="group-buttons-right">
            <ul class="nav nav-pills">
                <li>
                    <a href="<?= base_url(ADMIN_PAGE) ?>"> <i class="fa fa-list"></i><?= $this->lang->line("pages_list_of_pages"); ?></a>
                </li>
            </ul>
        </div>
    </section>

    <section class="content">
        <form id="form_page_entry" role="form" class="form-horizontal">
            <div class="panel panel-default">
                <div class="panel-heading <?php echo ($data["action"] === "create") ? "heading-create" : "heading-update"; ?>">
                <span>
                    <i class="<?php echo ($data["action"] === "create") ? "fa fa-plus-circle " : "fa fa-edit"; ?>"></i>
                    <?= $data["heading_text"] ?>
                </span>
                </div>

                <div class="panel-body">
                    <div class="form-group required " id="wrap_parent_id">
                        <label class="col-sm-2 control-label"><?= $this->lang->line("pages_parent"); ?></label>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-5">
                                    <select class="form-control" id="parent_id" name="parent_id">
                                        <?php
                                        if (isset($data["pages_no_parent"])) {
                                            foreach ($data["pages_no_parent"] as $key => $value) {
                                                $option = "<option value=\"$key\" ";
                                                $option .= (isset($data["row"]["parent_id"]) && $data["row"]["parent_id"] == $key) ? "selected" : "";
                                                $option .= ">" . $value . "</option>";
                                                echo $option;
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group required " id="wrap_template">
                        <label class="col-md-2 control-label"><?= $this->lang->line("pages_template"); ?></label>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-5">
                                    <select class="form-control" id="template_id" name="template_id">
                                        <?php foreach ($data["templates"] as $item): ?>
                                            <option value="<?= $item["id"] ?>" <?= isset($data["row"]["template_id"]) && $data["row"]["template_id"] == $item["id"] ? "selected" : "" ?> >
                                                <?php echo $item["name"] ?></option>
                                        <?php endforeach; ?>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group required " id="wrap_page_name">
                        <label class="col-md-2  control-label"><?= $this->lang->line("pages_name"); ?></label>
                        <div class="col-md-8">
                                <input type="text" id="name" name="name" pattern="[A-Za-z0-9]" class="form-control"
                                       value="<?php echo setFormData($data, $key = "name") ?>">
                        </div>
                    </div>

                    <div class="form-group required ">
                        <label class="col-md-2  control-label"><?= $this->lang->line("pages_title"); ?></label>
                        <div class="col-md-8">
                            <input type="text" id="title" name="title" class="form-control" value="<?php echo setFormData($data, $key = "title") ?>">
                        </div>
                    </div>

                    <div id="div_cbx_enable_article" class="form-group">
                        <label class="col-md-2 control-label"><?= $this->lang->line("article_title"); ?></label>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-2 col-sm-6">
                                    <input type="checkbox" id="cbx_enable_article" name="enable_article">
                                </div>

                            </div>
                        </div>
                    </div>

                    <div id="div_list_articles" class="form-group">
                        <label class="control-label col-md-2" for="body"><?= $this->lang->line("article_list"); ?></label>
                        <div class="col-md-8">
                            <?php if (isset($data["articles"]) && count($data["articles"]) > 0): ?>
                                <ul class="list-group">
                                    <?php foreach ($data["articles"] as $item): ?>
                                        <li class="list-group-item"><?= (isEnglishLang())?$item["name_en"]:$item["name_th"] ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?= $this->lang->line("gallery_title"); ?></label>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-2 col-sm-6">
                                    <input type="checkbox" id="cbx_enable_gallery" name="cbx_enable_gallery">
                                </div>
                                <div class="col-md-10">
                                    <div id="div_list_galleries">
                                        <?php if (isset($data["galleries"]) && count($data["galleries"]) > 0): ?>
                                            <select class="form-control" id="gallery_id" name="gallery_id">
                                                <?php foreach ($data["galleries"] as $item): ?>
                                                    <option
                                                        value="<?= $item["id"] ?>" <?= ($item["id"] == $gallery_selected) ? "Selected" : "" ?> ><?= $item["name"] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="div_page_body" class="form-group">
                        <label class="control-label col-md-2" for="body"><?= $this->lang->line("pages_body"); ?></label>
                        <div class="col-md-8">
                             <textarea name="body" id="body" class="form-control"
                                       rows="5"><?php echo setFormData($data, $key = "body") ?></textarea>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label class="col-md-2 control-label text-right"><?= $this->lang->line("form_field_published"); ?></label>
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
                        <?= buttonCancelWithRedirectPage("admin/Page/index"); ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </form>
    </section>

</div><!-- /.content-wrapper -->

<script type="text/javascript">
    var validator;
    var isSystemAdmin = (parseInt('<?php echo $this->session->userdata('role_id');?>') == 0) ? true : false;

    $(document).ready(function () {

        initView();

        setupTinyFileManager();

        validateForm();

        enableGallery();

        enableArticle();

    });


    function initView() {
        // Permission of System Admin
        if (!isSystemAdmin) {
            $('#wrap_page_name , #wrap_parent_id , #wrap_template').hide();
        }
    }


    function enableGallery() {
        // Gallery
        var gallery_id = '<?=(isset($data["row"]["gallery_id"])) ? $data["row"]["gallery_id"] : ''?>';
        if (gallery_id != null && gallery_id != "" ) showGallery(); else hideGallery();

        $('#cbx_enable_gallery').on('switchChange.bootstrapSwitch', function (event, state) {
            if (state) {
                showGallery();
                hideArticle();
            } else {
                hideGallery();
            }
        });
    }

    function enableArticle() {
        // Article
        var hasArticle = '<?= (!empty($data["articles"])) ?true : false;?>';
        if (hasArticle) {
            showArticle();
            hidePageBody();
        } else {
            hideArticle();
            showPageBody();
            $('#div_cbx_enable_article').hide();
        }

        $('#cbx_enable_article').on('switchChange.bootstrapSwitch', function (event, state) {
            if (state) {
                showArticle();
                hideGallery();
                hidePageBody();
            } else {
                hideArticle();
                showGallery();
                showPageBody();
            }
        });
    }
    

    function setupTinyFileManager() {
        var external_filemanager_path = '<?=base_url("assets")?>/libraries/filemanager/';
        var filemanager = '<?=base_url("assets/libraries/filemanager/plugin.min.js")?>';
        tinymce.init({
            selector: "textarea", theme: "modern", height: 300,
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
        validator = $('#form_page_entry').validate({
            rules: {
                title_en: "required",
                title_th: "required",
                name: {
                    required: true,
                    letterEnglishOnly: true
                }
            },
            messages: {
                title_en: '<?php echo $this->lang->line("message_this_field_is_require");?>',
                title_th: '<?php echo $this->lang->line("message_this_field_is_require");?>',
                name: {
                    required: '<?php echo $this->lang->line("message_this_field_is_require");?>'
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
                save();
            }
        });
    }


    function save() {
        var targetUrl;
        var id = '<?=$this->uri->segment(4)?>';

        if (id === "") {
            targetUrl = BASE_URL + 'admin/Page/create';
        } else {
            targetUrl = BASE_URL + 'admin/Page/update/' + id;
        }

        showSpinner();

        $.ajax({
            type: 'POST',
            url: targetUrl,
            data: $("#form_page_entry").serialize(),
            dataType: 'json',
            success: function (response) {
                hideSpinner();
                if (response.success == true) {
                    alertSuccessMessageDialog(
                        '<?=$this->lang->line("message_dialog_title_success");?>',
                        '<?=$this->lang->line("message_save_complete");?>', function () {
                            var id = '<?=$this->uri->segment(4)?>';
                            if (id != 0 && id != '') {
                                window.location = BASE_URL + 'admin/Page/index';
                            } else {
                                window.location.reload();
                                //  clearForm();
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


    function showArticle() {
        $("#cbx_enable_article").bootstrapSwitch('state', true);
        $("#article_id").removeAttr('disabled');
        $("#div_list_articles").show();
    }

    function hideArticle() {
        $("#cbx_enable_article").bootstrapSwitch('state', false);
        $("#article_id").attr('disabled', 'disabled');
        $("#div_list_articles").hide();
    }

    function showGallery() {
        $("#cbx_enable_gallery").bootstrapSwitch('state', true);
        $("#gallery_id").removeAttr('disabled');
        $("#div_list_galleries").show();
    }

    function hideGallery() {
        $("#cbx_enable_gallery").bootstrapSwitch('state', false);
        $("#gallery_id").attr('disabled', 'disabled');
        $("#div_list_galleries").hide();
    }

    function showPageBody() {
        $('#div_page_body').show();
    }

    function hidePageBody() {
        $('#div_page_body').hide();
    }

    function hidePageBody() {
        $("#div_page_body").hide();
    }

    function clearForm() {
        validator.resetForm();
        $('#form_page_entry')[0].reset();
    }


</script>

<?php $this->load->view("components/backend/footer"); ?>

