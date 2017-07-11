<?php $this->load->view("components/backend/header"); ?>
<?php $this->load->view("components/backend/navbar"); ?>

<link href="<?= base_url("assets/libraries/jquery-filer/css/jquery.filer.css") ?>" type="text/css" rel="stylesheet">
<link href="<?= base_url("assets/libraries/jquery-filer/css/themes/jquery.filer-dragdropbox-theme.css") ?>" type="text/css" rel="stylesheet">
<link href="<?= base_url("assets/libraries/dropzone/min/dropzone.min.css") ?>" type="text/css" rel="stylesheet">
<script type="text/javascript" src="<?= base_url("assets/libraries/dropzone/min/dropzone.min.js") ?>"></script>
<script type="text/javascript" src="<?= base_url("assets/libraries/jquery-filer/js/jquery.filer.min.js?v=1.0.5") ?>"></script>
<style>
    .dropzone {
        background: #fff;
        border: 2px dashed #ddd;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <span><?= $this->lang->line("article_title"); ?></span>
        </h1>
        <div class="group-buttons-right">
            <ul class="nav nav-pills">
                <li>
                    <a href="<?= base_url(ADMIN_ARTICLE) ?>"> <i class="fa fa-list"></i><?= $this->lang->line("article_list"); ?></a>
                </li>
            </ul>
        </div>
    </section>

    <section class="content">
        <form id="form_article_entry" role="form" class="form-horizontal">
            <div class="panel panel-default">
                <div class="panel-heading <?php echo ($data["action"] === "create") ? "heading-create" : "heading-update"; ?>">
                <span>
                    <i class="<?php echo ($data["action"] === "create") ? "fa fa-plus-circle " : "fa fa-edit"; ?>"></i>
                    <?= $data["heading_text"] ?>
                </span>
                </div>

                <div class="panel-body">
                    <div class="form-group ">
                        <label class="col-sm-2 control-label"><?= $this->lang->line("pages_title"); ?></label>
                        <div class="col-md-7">
                            <div class="col-md-5 input-group dateinput-group date">
                                <select class="form-control" id="page_id" name="page_id">
                                    <?php if (!empty($data["pages"]) && count($data["pages"]) > 0): ?>
                                        <?php foreach ($data["pages"] as $item): ?>
                                            <option value="<?= $item["id"] ?>" <?= isset($data["row"]["page_id"]) && $data["row"]["page_id"] == $item["id"] ? "selected" : "" ?> >
                                                <?php echo isEnglishLang() ? $item["title_en"] : $item["title_th"] ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2  control-label"><?= $this->lang->line("article_publish_date"); ?></label>
                        <div class="col-md-7">
                            <div class='col-md-5 input-group date' id='datetimepicker_published_date'>
                                <input type='text' class="form-control" name="published_date"
                                       value="<?php echo setFormData($data , $key="published_date") ?>"/>
                                 <span class="input-group-addon">
                                     <span class="glyphicon glyphicon-calendar"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group required ">
                        <label class="col-md-2  control-label"><?= $this->lang->line("article_name"); ?></label>
                        <div class="col-md-8">
                            <input type="text" id="name" name="name" placeholder="<?=isEnglishLang()?"Article name":"ชื่อบทความ"?>" class="form-control"
                                   value="<?php echo setFormData( $data ,  $key="name" ); ?>">
                        </div>
                    </div>

                    <div class="form-group required ">
                        <label class="col-md-2  control-label"><?= $this->lang->line("short_description"); ?></label>
                        <div class="col-md-8">
                              <textarea id="title" name="title" placeholder="<?=isEnglishLang()?"Short description of Article":"รายละเอียดบทความแบบย่อ"?>" class="form-control"
                                                             rows="3"><?php echo setFormData( $data ,  $key="title"); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="col-md-2  control-label"><?= $this->lang->line("upload_image"); ?></label>
                        <div class="col-md-8">
                            <div id="dZUpload" class="dropzone">
                                <div class="dz-default dz-message"></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group required">
                        <label class="control-label col-md-2" for="body"><?= $this->lang->line("content"); ?></label>
                        <div class="col-md-8">
                           <textarea name="body" id="body" class="form-control"
                                     rows="5"><?php echo setFormData( $data ,  $key="body"); ?>
                                    </textarea>
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
                            </select>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="pull-right">
                        <?= buttonSubmitCreateOrUpdate($data["action"]); ?>
                        <?= buttonCancelWithRedirectPage("admin/Article/index"); ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <input type="hidden" id="hd_list_image_uuid" name="list_image_uuid"/>
        </form>
    </section>


</div><!-- /.content-wrapper -->

<script type="text/javascript">

    var validator;

    $(document).ready(function () {

        setupTinymce();

        setupDropzone();

        setupDatePicker();

        validateForm();

    });

    function setupDatePicker() {
        $('#datetimepicker_published_date').datetimepicker({
            locale: 'th',
            format: "YYYY-MM-DD",
            defaultDate: new Date()
        });
    }

    function setupTinymce() {
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

    function validateForm() {
        validator = $('#form_article_entry').validate({
            rules: {
                published_date: "required",
                title: "required",
                name: "required"
            },
            messages: {
                published_date: '<?php echo $this->lang->line("message_this_field_is_require");?>',
                title: '<?php echo $this->lang->line("message_this_field_is_require");?>',
                name: '<?php echo $this->lang->line("message_this_field_is_require");?>'
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

    function setupDropzone() {
        Dropzone.autoDiscover = false;
        var fileList = new Array();
        var listSelectedFile = new Array();
        var i = 0;
        var myDropzone = $("#dZUpload").dropzone({
            url: "<?php echo base_url("admin/Article/uploadImages")?>",
            addRemoveLinks: true,
            RemoveLinkTemplate: "<div class=\"btn btn-default\" data-dz-remove><i class=\"icon-cross\"></i></div>",
            init: function () {
                var thisDropzone = this;
                var article_id = '<?= isset($data["article_id"]) ? $data["article_id"] : "" ?>';
                if (article_id != '') {
                    $.getJSON('<?= base_url("admin/Article/getImagesByArticleId")?>' + '/' + article_id, function (data) {
                        $.each(data, function (index, val) {
                            var mockFile = {name: val.image_name, size: val.size};
                            thisDropzone.createThumbnailFromUrl(mockFile, BASE_URL + "uploads/article/" + val.image_name);
                            thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                            thisDropzone.options.thumbnail.call(thisDropzone, mockFile, BASE_URL + "uploads/article/" + val.image_name);
                            mockFile.previewElement.classList.add('dz-success');
                            mockFile.previewElement.classList.add('dz-complete');

                            // Add file from server to list
                            fileList[i] = {"serverFileName": val.image_name, "fileName": val.image_name, "fileId": i};
                            i++;
                        });
                    });
                }
            },
            removedfile: function (file) {
                var rmvFile = "";
                for (var f = 0; f < fileList.length; f++) {
                    if (fileList[f].fileName == file.name) {
                        rmvFile = fileList[f].serverFileName;
                    }
                }

                $.ajax({
                    type: "post",
                    url: "<?php echo base_url("admin/Article/deleteImage")?>",
                    data: {file: rmvFile},
                    dataType: 'html'
                });

                listSelectedFile.remove(rmvFile);
                $('#hd_list_image_uuid').val(listSelectedFile.join(", "));

                var _ref;
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
            },
            success: function (file, response) {
                var responseObject = JSON.parse(response);
                fileList[i] = {"serverFileName": responseObject.serverFileName, "fileName": file.name, "fileId": i};
                listSelectedFile.push(responseObject.image_uuid);
                $('#hd_list_image_uuid').val(listSelectedFile.join(", "));
                i++;

                // Rename after upload
                var elFileName = file.previewElement.querySelector("[data-dz-name]");
                elFileName.innerHTML = responseObject.serverFileName;
                // console.log(responseObject);
                return file.previewElement.classList.add("dz-success");
            },
            error: function (file, response) {
                file.previewElement.classList.add("dz-error");
            }
        });

        //Sort images
        myDropzone.sortable({
            items: '.dz-preview',
            cursor: 'move',
            opacity: 0.5,
            containment: '#dZUpload',
            distance: 20,
            tolerance: 'pointer',
            stop: function () {
                var listOfFileNames = new Array();
                $('#dZUpload .dz-preview .dz-filename [data-dz-name]').each(function (count, el) {
                    var name = el.innerHTML;
                    var remove_extension = name.replace(/\.[^/.]+$/, "");
                    listOfFileNames.push(remove_extension.trim())
                    //console.log(listOfFileNames);
                });

                $('#hd_list_image_uuid').val(listOfFileNames.join(", "));
                //console.log(listOfFileNames);
            }
        });

        $('div.dz-preview .dz-size').hide();
    }

    function save() {
        var targetUrl;
        var id = '<?=$this->uri->segment(4)?>';

        if (id === "") {
            targetUrl = BASE_URL + 'admin/article/create';
        } else {
            targetUrl = BASE_URL + 'admin/article/update/' + id;
        }

        showSpinner();

        $.ajax({
            type: 'POST',
            url: targetUrl,
            data: $("#form_article_entry").serialize(),
            dataType: 'json',
            success: function (response) {
                hideSpinner();
                if (response.success == true) {
                    alertSuccessMessageDialog(
                        '<?=$this->lang->line("message_dialog_title_success");?>',
                        '<?=$this->lang->line("message_save_complete");?>', function () {
                            var id = '<?=$this->uri->segment(4)?>';
                            if (id != 0 && id != '') {
                                window.location = BASE_URL + 'admin/Article/index';
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
        window.location = BASE_URL + 'admin/Article/create';
    }

</script>


<?php $this->load->view("components/backend/footer"); ?>

