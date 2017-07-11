<?php $this->load->view("components/backend/header"); ?>
<?php $this->load->view("components/backend/navbar"); ?>
<style type="text/css">

    .videoWrapper {
        position: relative;
        padding-bottom: 56.25%;
        padding-top: 35px;
        height: 0;
    }
    .videoWrapper iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
</style>

<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <span><?= $this->lang->line("clip_title"); ?></span>
        </h1>
        <div class="group-buttons-right">
            <ul class="nav nav-pills">
                <li>
                    <a href="<?= base_url(ADMIN_CLIP) ?>"> <i class="fa fa-list"></i><?= $this->lang->line("clip_list"); ?></a>
                </li>
            </ul>
        </div>
    </section>

    <section class="content">
        <form id="form_clip_entry" role="form" class="form-horizontal">
            <div class="panel panel-default">
                <div class="panel-heading <?php echo ($data["action"] === "create") ? "heading-create" : "heading-update"; ?>">
                <span>
                    <i class="<?php echo ($data["action"] === "create") ? "fa fa-plus-circle " : "fa fa-edit"; ?>"></i>
                    <?= $data["heading_text"] ?>
                </span>
                </div>

                <div class="panel-body">
                    <div class="form-group required ">
                        <label class="col-md-2  control-label"><?= $this->lang->line("menu_clip_categories"); ?></label>
                        <div class="col-md-8">
                            <div class="col-md-5 row">
                                <select class="form-control" id="category_id" name="category_id">
                                    <?php if (!empty($data["clip_categories"]) && count($data["clip_categories"]) > 0): ?>
                                        <?php foreach ($data["clip_categories"] as $item): ?>
                                            <option value="<?= $item["id"] ?>" <?= isset($data["row"]["category_id"]) && $data["row"]["category_id"] == $item["id"] ? "selected" : "" ?> >
                                                <?php echo isEnglishLang() ? $item["name_en"] : $item["name_th"] ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="form-group required ">
                        <label class="col-md-2  control-label"><?= $this->lang->line("clip_link"); ?></label>
                        <div class="col-md-8">
                            <input type="text" id="youtube_link" name="youtube_link" class="form-control"
                                   value="<?php echo isset($data["row"]["youtube_link"]) ? $data["row"]["youtube_link"] : "" ?>">
                            <div class="videoWrapper" >
                                <iframe id="iframe_youtube" src="" frameborder="0" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2" for="body"><?= $this->lang->line("clip_description"); ?></label>
                        <div class="col-md-8">
                            <ul class="nav nav-tabs">
                                <li role="presentation" class="active"><a href="#tab1" data-toggle="tab">Thai</a></li>
                                <li role="presentation"><a href="#tab2" data-toggle="tab">English</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab1">
                                    <br>
                                    <textarea name="description_th" id="body" class="form-control"
                                              rows="5"><?= (isset($data["row"]["description_th"]) ? $data["row"]["description_th"] : "") ?></textarea>
                                </div>
                                <div class="tab-pane fade" id="tab2">
                                    <br>
                                   <textarea name="description_en" id="body" class="form-control"
                                             rows="5"><?= (isset($data["row"]["description_en"]) ? $data["row"]["description_en"] : "") ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?= $this->lang->line("show_on_home_page"); ?></label>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-2 col-sm-6">
                                    <input type="checkbox" id="cbx_enable_show_on_home_page" name="is_show_on_home_page" >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label class="col-md-2 control-label"><?= $this->lang->line("form_field_published"); ?></label>
                        <div class="col-md-2">
                            <select class="form-control" id="published" name="published">
                                <option value="1" <?= isset($data["row"]["published"]) && intval( $data["row"]["published"]) == 1 ? "selected" : "" ?>>
                                    <?= $this->lang->line("form_field_published"); ?></option>
                                <option value="0" <?= isset($data["row"]["published"]) && intval( $data["row"]["published"]) == 0 ? "selected" : "" ?>>
                                    <?= $this->lang->line("form_field_unpublished"); ?></option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="panel-footer">
                    <div class="pull-right">
                        <?= buttonSubmitCreateOrUpdate($data["action"]); ?>
                        <?= buttonCancelWithRedirectPage("admin/Clip"); ?>
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

        setupToggleEnableShowOnHomePage();

        initialYoutubeLink();

        validateForm();

    });


    function setupToggleEnableShowOnHomePage() {
        $("#cbx_enable_show_on_home_page").bootstrapSwitch();
        $("#cbx_enable_show_on_home_page").bootstrapSwitch('state', false);

        var clip_id = '<?=$this->uri->segment(4)?>';
        if(clip_id != ''){
            var is_show_on_home_page = '<?= (isset($data["row"]["is_show_on_home_page"]) && $data["row"]["is_show_on_home_page"] == 1)?true:false ?>';
            if(is_show_on_home_page){
                $("#cbx_enable_show_on_home_page").bootstrapSwitch('state', true);
            }
        }
    }

    function initialYoutubeLink(){
        $('.videoWrapper').hide();

        $('#youtube_link').on('paste', function () {
            var element = this;
            setTimeout(function () {
                var youtubeLink = $(element).val();
                if(youtubeLink != ''){
                    var youtubeCode =  youtube_parser(youtubeLink);
                    autoPlayVideo(youtubeCode, 400 , 300);
                    $('.videoWrapper').show();
                }
            }, 100);
        });

        $('#youtube_link').on('keyup', function () {
            var element = this;
            setTimeout(function () {
                var youtubeLink = $(element).val();
                if(youtubeLink == ''){
                    $('.videoWrapper').hide();
                }
            }, 100);
        });

        var action = '<?=$data["action"]?>';
        if(action==='update'){
            var youtubeLink = '<?= (isset($data["row"]["youtube_link"]) ? $data["row"]["youtube_link"] : "") ?>';
            if(youtubeLink != '') {
                var youtubeCode = youtube_parser(youtubeLink);
                $('.videoWrapper').show();
                autoPlayVideo(youtubeCode, 400, 300);
            }
        }

    }

    function youtube_parser(url){
        var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
        var match = url.match(regExp);
        return (match&&match[7].length==11)? match[7] : false;
    }

    function autoPlayVideo(ycode, width, height){
        $("#iframe_youtube").attr("src", "http://www.youtube.com/embed/"+ ycode +"?rel=0");
    }

    function validateForm() {
        validator = $('#form_clip_entry').validate({
            rules: {
                youtube_link: "required",
                description_en: "required",
                description_th: "required"
            },
            messages: {
                link: '<?php echo $this->lang->line("message_this_field_is_require");?>',
                description_th: '<?php echo $this->lang->line("message_this_field_is_require");?>',
                description_en: '<?php echo $this->lang->line("message_this_field_is_require");?>'
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
            targetUrl = BASE_URL + 'admin/Clip/create';
        } else {
            targetUrl = BASE_URL + 'admin/Clip/update/' + id;
        }

        showSpinner();
        $.ajax({
            type: 'POST',
            url: targetUrl,
            data: $("#form_clip_entry").serialize(),
            dataType: 'json',
            success: function (response) {
                hideSpinner();
                if (response.success == true) {
                    alertSuccessMessageDialog(
                        '<?=$this->lang->line("message_dialog_title_success");?>',
                        '<?=$this->lang->line("message_save_complete");?>', function(){
                            var id = '<?=$this->uri->segment(4)?>';
                            if (id != 0 && id != '') {
                                window.location = BASE_URL + 'admin/Clip/index';
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
        window.location = BASE_URL + 'admin/Clip/create';
    }


</script>

<?php $this->load->view("components/backend/footer"); ?>

