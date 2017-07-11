<?php $this->load->view("components/backend/header"); ?>
<?php $this->load->view("components/backend/navbar"); ?>

<div class="content-wrapper">
    <!-- Content Header (clip header) -->
    <section class="content-header">
        <h1>
            <span><?=$this->lang->line("clip_list");?></span>
        </h1>
        <div class="group-buttons-right">
            <ul class="nav nav-pills">
                <li>
                    <a href="<?= base_url(ADMIN_CLIP."/create") ?>"> <i class="fa fa-plus-circle fa-1x"></i><?=$this->lang->line("clip_button_add");?></a>
                </li>
            </ul>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <!--Row Search-->
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info box-solid ">
                    <div class="box-header">
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button class="btn btn-default btn-sm pull-right" data-widget='collapse'
                                    data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
                                <i class="fa fa-plus" style="font-size: large"></i></button>
                        </div><!-- /. tools -->
                        <i class="fa fa-search"></i>
                        <h3 class="box-title">
                            <?= $this->lang->line("button_search"); ?>
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label class="col-md-5 control-label text-right"><?= $this->lang->line("menu_clip_categories"); ?></label>
                                <div class="col-md-7">
                                    <select class="form-control" id="clip_category" >
                                        <?php if (!empty($data["clip_categories"]) && count($data["clip_categories"]) > 0): ?>
                                            <option></option>
                                            <?php foreach ($data["clip_categories"] as $item): ?>
                                                <option value="<?= $item["id"] ?>"  ><?php echo isEnglishLang() ? $item["name_en"] : $item["name_th"] ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label class="col-md-5 control-label text-right"><?= $this->lang->line("show_on_home_page"); ?></label>
                                <div class="col-md-7">
                                    <select class="form-control" id="show_on_home_page" >
                                        <option value=""></option>
                                        <option value="1"><?= $this->lang->line("show"); ?></option>
                                        <option value="0"><?= $this->lang->line("not_show"); ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label class="col-md-4 control-label text-right"><?= $this->lang->line("form_field_published"); ?></label>
                                <div class="col-md-7">
                                    <select class="form-control" id="published" name="published">
                                        <option value=""></option>
                                        <option value="1"><?= $this->lang->line("form_field_published"); ?></option>
                                        <option value="0"><?= $this->lang->line("form_field_unpublished"); ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body-->

                    <div class="box-footer">
                        <div class="pull-right">
                            <button id="btn_search" type="button" onclick="search()" class="btn btn-primary "><i
                                        class="fa fa-search"></i> <?= $this->lang->line("button_search"); ?>
                            </button>
                            <button id="btn_clear_search" onclick="clearTextSearch()" type="button" class="btn btn-default">
                                <i class="fa fa-refresh"></i>
                                <?= $this->lang->line("button_clear"); ?>
                            </button>
                        </div>
                    </div>
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
                            <table class="table table-striped table-bordered table-hover" id="clips_datatable">
                                <thead>
                                <tr>
                                    <th class="text-center"><?=$this->lang->line("table_seq");?></th>
                                    <th class="text-center"><?=$this->lang->line("clip_title");?></th>
                                    <th class="text-center"><?=$this->lang->line("menu_clip_categories");?> </th>
                                    <th class="text-center"><?=$this->lang->line("clip_description");?> </th>
                                    <th class="text-center"><?=$this->lang->line("show_on_home_page");?></th>
                                    <th class="text-center"><?=$this->lang->line("table_record_status");?></th>
                                    <th class="text-center"><?=$this->lang->line("table_order");?></th>
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

    var dataTable = $('#clips_datatable');

    $(document).ready(function () {
        loadclipsDataTable();
    });

    function youtube_parser(url){
        var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
        var match = url.match(regExp);
        return (match&&match[7].length==11)? match[7] : false;
    }

    function loadclipsDataTable() {
        var columns = [
            {data: null, "sClass": "right", "bSortable": false, "sWidth": "3%"}, //1st column
            {
                orderable: false, "sWidth": "15%",
                mRender: function (data, type, row) {
                    var ycode = youtube_parser(row.youtube_link);
                    var url = 'http://www.youtube.com/embed/' + ycode + '?rel=0';
                    var youtube = '<iframe height="100" src="'+url+' " frameborder="0" allowfullscreen></iframe>';
                    return youtube;
                }
            },
            {data: "category_name", "sClass": "text", "sWidth": "15%"},
            {data: "description", "sClass": "text", "sWidth": "25%"},
            {
                orderable: false, "sWidth": "8%",
                mRender: function (data, type, row) {
                    var label_text = '<div class="text-left"> ';
                    if(parseInt(row.is_show_on_home_page) == 1){
                        label_text += '<h4 class="text-center"><span class=\"label label-info\" >' + '<?=$this->lang->line("show");?>' + '</span></h4>';
                    }
                    label_text += '</div>'
                    return label_text;
                }
            },
            {
                orderable: false, "sWidth": "8%",
                mRender: function (data, type, row) {
                    var label_text = '<div class="text-left"> ';
                    if(parseInt(row.published) == 1){
                        label_text += '<h4 class="text-center"><span class=\"label label-success\" >' + '<?=$this->lang->line("form_field_published");?>' + '</span></h4>';
                    }else{
                        label_text += '<h4 class="text-center"><span class=\"label label-danger\" >' + '<?=$this->lang->line("form_field_unpublished");?>'+ '</span></h4>';
                    }
                    label_text += '</div>'
                    return label_text;
                }
            },
            {
                orderable: false, "sWidth": "5%",
                mRender: function (data, type, row) {
                    var value_order = (row.order_seq!=null && row.order_seq != '')?row.order_seq:1;
                    return  '<input type="number" onblur="updateOrderSeq(this , '+row.id+')" value="'+value_order+'" class="form-control" name="order" step="1" min="1" style="width: 60px" >';
                }
            },
            {
                orderable: false, "sWidth": "10%",
                mRender: function (data, type, row) {
                    var buttons = '<div class="text-center"> ';
                    buttons += '<a href=<?=base_url(ADMIN_CLIP)?>/update/' + row.id + '  class="btn btn-warning glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="แก้ไขข้อมูล"></a>';
                    buttons += ' <a href="javascript:void(0)" onclick=deleteData(' + row.id + ') class="button_delete btn btn-danger glyphicon glyphicon-trash" data-toggle="tooltip" data-placement="top" title="ลบข้อมูล"></a>';
                    buttons += '</div>'
                    return buttons;
                }
            },
            {data: "category_id", "sClass": "text" , "visible": false},
            {data: "is_show_on_home_page", "sClass": "text" , "visible": false},
            {data: "published", "sClass": "text" , "visible": false},
        ];

        dataTable = $('#clips_datatable').DataTable({
            'ajax': {
                type: "GET",
                url: BASE_URL + 'admin/clip/loadclipsDataTable',
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

    function updateOrderSeq(element , rowId){
        var targetUrl = BASE_URL+'admin/Clip/updateOrderSeq';
        if(rowId != null && rowId != ''){
            showSpinner();
            $.ajax({
                type: 'POST',
                url: targetUrl,
                data : {rowId : rowId , order_seq:element.value} ,
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

    function deleteData(id) {
        var targetUrl = BASE_URL + 'admin/clip/delete/' + id;
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

    function search() {
        var clipCategory = $("#clip_category option:selected").val();
        var isShowOnHomePage = $("#show_on_home_page option:selected").val();
        var published = $("#published option:selected").val();

        dataTable
            .column(8).search(clipCategory)
            .column(9).search(isShowOnHomePage)
            .column(10).search(published)
            .draw();
    }

    function clearTextSearch() {
        $('#clip_category').prop('selectedIndex', 0);
        $('#show_on_home_page').prop('selectedIndex', 0);
        $('#published').prop('selectedIndex', 0);
    }

</script>

<?php $this->load->view("components/backend/footer"); ?>
