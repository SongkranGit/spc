<?php $this->load->view("components/backend/header"); ?>
<?php $this->load->view("components/backend/navbar"); ?>
<style type="text/css">
    /*-------------------------
        Basic configurations
    -------------------------*/
    .gallery * {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    /* Thumbs */
    .gallery-row:after,
    .gallery-item:after {
        display: table;
        line-height: 0;
        content: "";
        clear: both;
    }

    .gallery-items ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    /*-------------------------
        Default Theme
    -------------------------*/

    .gallery-theme-default .gallery.dragged .gallery-input * {
        pointer-events: none;
    }

    /*-------------------------
        Thumbnails
    -------------------------*/

    .gallery-items-default .gallery-item {
        position: relative;
        padding: 16px;
        margin-bottom: 16px;
        background: #f7f7f7;
        color: #4d4d4c;
    }

    .gallery-items-default .gallery-item .gallery-item-title {
        /*font-weight: bold;*/
    }

    .gallery-items-default .gallery-item .gallery-item-others span {
        padding-left: 5px;
        padding-right: 5px;
    }

    .gallery-items-default .gallery-item-assets {
        position: absolute;
        display: block;
        right: 16px;
        top: 50%;
        margin-top: -10px;
    }

    .gallery-items-default .gallery-item-assets a {
        padding: 8px 9px 8px 12px;
        cursor: pointer;
        background: #fafafa;
        color: #777;
        border-radius: 4px;
        border: 1px solid #e3e3e3
    }

    /* Thumbnails: Grid */
    .gallery-items-grid .gallery-item {
        float: left;
    }

    .gallery-items-grid .gallery-item .gallery-item-container {
        position: relative;
        margin: 0 20px 30px 0;
        padding: 10px;
        border: 1px solid #e1e1e1;
        border-radius: 3px;
        background: #fff;
        -webkit-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.06);
        -moz-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.06);
        box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.06);
    }

    .gallery-items-grid .gallery-item .gallery-item-container .gallery-item-thumb {
        position: relative;
        width: 275px;
        height: 225px;
        min-height: 115px;
        border: 1px solid #e1e1e1;
        overflow: hidden;
    }

    .gallery-items-grid .gallery-item .gallery-item-container .gallery-item-thumb .gallery-item-thumb-image {
        width: 100%;
        height: 100%;
        text-align: center;
    }

    .gallery-item .gallery-item-container .gallery-item-thumb img {
        width: 100%;
        height: 100%;
        text-align: center;
    }

    .gallery-item .gallery-item-container .gallery-item-thumb a:hover {
        cursor: pointer;
    }

    .gallery-items-grid .gallery-item .gallery-item-container .gallery-item-info {
        position: absolute;
        bottom: -10%;
        left: 0;
        width: 100%;
        color: #000000;
        padding: 6px 10px;
        background-color: #afbdd8;
        z-index: 9;
        opacity: 0;
    }


    .gallery-items-grid .gallery-item .gallery-item-container .gallery-item-thumb:hover .gallery-item-info {
        bottom: 0;
        opacity: 1;
        /*filter: aplpha(opacity(100));*/
    }

    .gallery-items-grid .gallery-item .gallery-item-container .gallery-item-info .gallery-item-title {
        display: block;
        /*font-weight: bold;*/
        word-break: break-all;
        line-height: 1;
    }

    .gallery-items-grid .gallery-item .gallery-item-container .gallery-item-assets {
        margin-top: 10px;
        color: #999;
    }

    .gallery-items-grid .fa-trash-o {
        font-size: 18px;
    }

    .gallery-items-grid .fa-trash-o:hover {
        cursor: pointer;
        color: #d9534f;
    }


</style>
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <span><?= $this->lang->line("gallery_title"); ?></span>
        </h1>
        <div class="group-buttons-right">
            <ul class="nav nav-pills">
                <li>
                    <a href="<?= base_url(ADMIN_GALLERY . "/create") ?>">
                        <span class="fa fa-plus-circle large-font" style=" vertical-align: middle;"></span>
                        <span class="my-text"><?= $this->lang->line("gallery_button_add"); ?></span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url(ADMIN_GALLERY) ?>"> <i class="fa fa-list"></i><?= $this->lang->line("gallery_list"); ?></a>
                </li>
            </ul>
        </div>

    </section>

    <section class="content">
        <div class="panel panel-default">
            <div class="panel-heading heading-create">
                <span>
                    <i class="fa fa-picture-o"></i>
                    <?= isset($gallery_images[0]) ? $gallery_images[0]["gallery_name"] : "" ?>
                </span>
            </div>

            <div class="panel-body">
                <div class="col-md-12">
                    <ul class="gallery-items-list gallery-items-grid">
                        <?php if ($gallery_images != NULL): ?>
                            <?php foreach ($gallery_images as $image) : ?>
                                <li class="gallery-item" data-gallery-index="0" style="margin: 10px">
                                    <div class="gallery-item-container">
                                        <div class="gallery-item-inner">
                                            <div class="gallery-item-thumb">
                                                <div class="gallery-item-status"></div>
                                                <div class="gallery-item-info"><span class="gallery-item-title"><b
                                                            title=""><?php echo ellipsize($image["comment"], 30, .5); ?></b></span></div>
                                                <div class="gallery-item-thumb-image">
                                                   <a title="Click for edit" href="<?=base_url("admin/gallery/updateImage/".$image["id"])?>"> <img src="<?= base_url("uploads/" . $image["file_name"]) ?>" draggable="false"></a>
                                                </div>
                                            </div>
                                            <div class="gallery-item-assets gallery-row">
                                                <ul class="list-inline pull-left">
                                                    <li></li>
                                                </ul>
                                                <ul class="list-inline ">
                                                    <li class="pull-left"><span><?php echo ellipsize($image["file_name"], 15, .5); ?></span></li>
                                                    <li class="pull-right"><a href="javascript:void(0)" onclick="return deleteData ('<?= $image["id"] ?>')"
                                                                              class="fa fa-trash-o"></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-md-6 col-md-4 col-md-offset-5"><b><?= $this->lang->line("message_no_data"); ?></b></div>
                        <?php endif; ?>
                    </ul>
                </div>

            </div>
        </div>
    </section>


</div><!-- /.content-wrapper -->

<script type="text/javascript">


    $(document).ready(function () {

    });

    function deleteData(id) {
        var targetUrl = BASE_URL + 'admin/gallery/deleteImageById/' + id;
        if (id != "") {
            BootstrapDialog.show({
                title: '<i class="glyphicon glyphicon-warning-sign"></i> Warning',
                size: BootstrapDialog.SIZE_SMALL,
                type: BootstrapDialog.TYPE_WARNING,
                message: 'คุณต้องการลบข้อมูลใช่หรือไม่?',
                closable: false, // <-- Default value is false
                draggable: true, // <-- Default value is false
                buttons: [{
                    // icon: 'glyphicon glyphicon-ban-circle',
                    label: 'ตกลง',
                    cssClass: 'btn-warning',
                    action: function (dialog) {
                        showSpinner();
                        $.post(targetUrl, function (response) {
                            hideSpinner();
                            if (response.success == true) {
                                window.location.reload(true);
                            } else {
                                alert('failed');
                            }
                        }, 'json');
                        dialog.close();
                    }
                }, {
                    label: 'ยกเลิก',
                    action: function (dialog) {
                        dialog.close();
                    }
                }]
            });
        }
    }

</script>

<?php $this->load->view("components/backend/footer"); ?>

