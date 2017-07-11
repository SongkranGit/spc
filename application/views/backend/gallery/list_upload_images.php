<?php $this->load->view("components/backend/header"); ?>
<?php $this->load->view("components/backend/navbar"); ?>

<div class="content-wrapper">
    <!-- Content Header (gallery header) -->
    <section class="content-header">
        <h1>
            <span><?= $this->lang->line("gallery_upload_list"); ?></span>
        </h1>
        <div class="group-buttons-right">
            <ul class="nav nav-pills">
                <li>
                    <a href="<?= base_url(ADMIN_UPLOAD_IMAGE) ?>"> <i class="fa fa-plus-circle fa-1x"></i><?= $this->lang->line("upload_image"); ?></a>
                </li>
            </ul>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <!--Row Search-->
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info box-solid">
                    <div class="box-header">
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button class="btn btn-default btn-sm pull-right" data-widget='collapse'
                                    data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
                                <i class="fa fa-minus" style="font-size: large"></i></button>
                        </div><!-- /. tools -->
                        <i class="fa fa-search"></i>
                        <h3 class="box-title">
                            <?= $this->lang->line("button_search"); ?>
                        </h3>
                    </div>

                    <?php // dump($galleries)?>
                    <div class="box-body">
                        <div class="row form-horizontal">
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?= $this->lang->line("gallery_name"); ?></label>
                                    <div class="col-md-9">
                                        <select class="form-control select2" id="select_gallery_id" name="gallery_id">
                                            <?php if (!empty($galleries)): ?>
                                                <?php foreach ($galleries as $key => $value): ?>
                                                    <option value="<?= $value["id"] ?>"> <?= $value["name"] ?> </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 ">
                                <div class="form-group ">
                                    <label
                                            class="col-md-5 control-label"><?= $this->lang->line("form_field_published"); ?></label>
                                    <div class="col-md-7">
                                        <select class="form-control" id="published" name="published">
                                            <option value="1"><?= $this->lang->line("form_field_published"); ?></option>
                                            <option
                                                    value="0"><?= $this->lang->line("form_field_unpublished"); ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="pull-right">
                                    <button type="button" onclick="search()" class="btn btn-primary "><i
                                                class="fa fa-search"></i> <?= $this->lang->line("button_search"); ?>
                                    </button>
                                    <button id="btn_clear_search" onclick="clearTextSearch()" type="button"
                                            class="btn btn-default">
                                        <i class="fa fa-refresh"></i>
                                        <?= $this->lang->line("button_clear"); ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body-->

                </div>
            </div>
        </div>
        <!-- Row Data Table -->
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-info">
                    <!--Header-->
                    <!--  <div class="box-header"></div>-->
                    <!--Body-->
                    <div class="box-body">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="upload_datatable">
                                <thead>
                                <tr>
                                    <th><?= $this->lang->line("table_seq"); ?></th>
                                    <th class="text-center"><?= $this->lang->line("gallery_image"); ?></th>
                                    <th class="text-center"><?= $this->lang->line("gallery_name"); ?></th>
                                    <th class="text-center"><?= $this->lang->line("gallery_description"); ?></th>
                                    <th class="text-center"><?= $this->lang->line("table_published"); ?></th>
                                    <th class="text-center"><?= $this->lang->line("table_order"); ?></th>
                                    <th></th>
                                </tr>
                                </thead>
                            </table>
                        </div>

                    </div><!-- /.box-body-->
                </div>
            </div>
        </div>


    </section>
    <!-- /.content -->
</div>
<script type="text/javascript">

    var dataTable = $('#upload_datatable');

    $(document).ready(function () {
        $(".select2").select2();
        loadDataTable();
    });

    function loadDataTable() {
        var columns = [
            {data: null, "sClass": "right", "bSortable": false, "sWidth": "3%"}, //1st column
            {
                orderable: false, "sWidth": "10%",
                mRender: function (data, type, row) {
                    var img_src = '<?=base_url("uploads/gallery")?>'+'/' + row.gallery_id + '/thumb_' + row.file_name;
                    return '<div align="center"><img width="50" height="50" src=' + img_src + ' class=\"img-responsive\" ></div>';
                }
            },
            {data: "gallery_name", "sClass": "text", "sWidth": "25%"},
            {data: "caption", "sClass": "text", "sWidth": "35%"},
            {
                orderable: false, "sWidth": "10%",
                mRender: function (data, type, row) {
                    if (parseInt(row.published) == 1) {
                        return '<h4 align=center><span class=\"label label-success\" >' + '<?=$this->lang->line("form_field_published");?>' + '</span></h4>';
                    }
                    return '<h4 align=center><span class=\"label label-danger\" >' + '<?=$this->lang->line("form_field_unpublished");?>' + '</span></h4>';
                }
            },
            {
                orderable: false, "sWidth": "5%",
                mRender: function (data, type, row) {
                    var value_order = (row.order_seq != null && row.order_seq != '') ? row.order_seq : 1;
                    return '<div align="center"><input type="number" onblur="updateOrderSeq(this , ' + row.id + ')" value="' + value_order + '" class="form-control" name="order" step="1" min="1" style="width: 60px" ></div>';
                }
            },
            {
                orderable: false, "sWidth": "20%",
                mRender: function (data, type, row) {
                    var buttons = '<div class="text-center"> ';
                    buttons += '<a href=<?=base_url("admin/GalleryImage/editImage")?>/' + row.gallery_id + '/' + row.id + '  class="btn btn-warning glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="แก้ไขข้อมูล"></a>&nbsp;';
                    buttons += ' <a href="javascript:void(0)" onclick=deleteData(' + row.id + ') class="button_delete btn btn-danger glyphicon glyphicon-trash" data-toggle="tooltip" data-placement="top" title="ลบข้อมูล"></a>';
                    buttons += '</div>'
                    return buttons;
                }
            },
            {data: "published", "sClass": "text", "visible": false},
            {data: "gallery_id", "sClass": "text", "visible": false}
        ];

        var gallery_id = $("#select_gallery_id option:selected").val();
        var published = 1;
        dataTable = $('#upload_datatable').DataTable({
            'ajax': {
                type: "GET",
                url: BASE_URL + 'admin/GalleryImage/loadUploadImageDataTable/' + gallery_id+'/'+published,
                dataSrc: 'data'
            },
            "language": {
                "emptyTable": '<?=$this->lang->line("table_no_records");?>',
                "zeroRecords": '<?=$this->lang->line("table_no_records");?>'
            },
            columns: columns,
            pageLength: 10,
            bJQueryUI: true,
            bLengthChange: false,
            bFilter: true,
            bInfo: false,
            bSort: false,
            autoWidth: false,
            responsive: true
        });

        dataTable.on('order.dt search.dt', function () {
            dataTable.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

    }

    function deleteData(id) {
        var targetUrl = BASE_URL + 'admin/GalleryImage/deleteImageById/' + id;
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
                        $.post(targetUrl, function (response) {
                            if (response.success == true) {
                                dataTable.ajax.reload();
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

    function updateOrderSeq(element, rowId) {
        var targetUrl = BASE_URL + 'admin/GalleryImage/updateOrderSeq';
        if (rowId != null && rowId != '') {
            showSpinner();
            $.ajax({
                type: 'POST',
                url: targetUrl,
                data: {rowId: rowId, order_seq: element.value},
                dataType: 'json',
                success: function (response) {
                    hideSpinner();
                    dataTable.ajax.reload();
                },
                error: function (request, status, error) {
                    hideSpinner();
                    alert(request.responseText);
                }
            });
        }
    }

    function search() {
        var gallery_id = $("#select_gallery_id option:selected").val();
        var published = $("#published option:selected").val();
        var targetUrl = BASE_URL + 'admin/GalleryImage/loadUploadImageDataTable/' + gallery_id + '/' + published;
        var refreshedDataTable = $('#upload_datatable').dataTable();
        refreshedDataTable.fnReloadAjax(targetUrl);
    }

    function clearTextSearch() {
        location.reload();
//        $('#select_gallery_id').prop('selectedIndex', 0);
//        $('#select_gallery_id').trigger("chosen:updated");
//        $('#published').prop('selectedIndex', 0);
    }

</script>

<?php $this->load->view("components/backend/footer"); ?>
