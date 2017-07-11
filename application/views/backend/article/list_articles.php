<?php $this->load->view("components/backend/header"); ?>
<?php $this->load->view("components/backend/navbar"); ?>

<div class="content-wrapper">
    <!-- Content Header (article header) -->
    <section class="content-header">
        <h1>
            <span><?= $this->lang->line("article_list"); ?></span>
        </h1>
        <div class="group-buttons-right">
            <ul class="nav nav-pills">
                <li>
                    <a href="<?= base_url(ADMIN_ARTICLE . "/create") ?>"> <i class="fa fa-plus-circle fa-1x"></i><?= $this->lang->line("article_button_add"); ?></a>
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
                                <label class="col-md-4 control-label text-right"><?= $this->lang->line("pages_title"); ?></label>
                                <div class="col-md-8">
                                    <select class="form-control" id="page_id" name="page_id">
                                        <option value=""></option>
                                        <?php if (!empty($pages) && count($pages) > 0): ?>
                                            <?php foreach ($pages as $item): ?>
                                                <option value="<?= $item["id"] ?>"><?php echo isEnglishLang() ? $item["title_en"] : $item["title_th"] ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label class="col-md-4 control-label text-right"><?= $this->lang->line("article_name"); ?></label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" id="name">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label class="col-md-3 control-label text-right"><?= $this->lang->line("form_field_published"); ?></label>
                                <div class="col-md-9">
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
                            <table class="table table-striped table-bordered table-hover" id="articles_datatable">
                                <thead>
                                <tr>
                                    <th><?= $this->lang->line("table_seq"); ?></th>
                                    <th><?= $this->lang->line("pages_title"); ?></th>
                                    <th><?= $this->lang->line("article_name"); ?></th>
                                    <th><?= $this->lang->line("short_description"); ?></th>
                                    <th><?= $this->lang->line("article_publish_date"); ?></th>
                                    <th><?= $this->lang->line("table_order"); ?></th>
                                    <th><?= $this->lang->line("table_record_status"); ?></th>
                                    <th style="150px" class="text-center"></th>
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

    var dataTable;

    $.fn.dataTable.render.ellipsis = function () {
        return function ( data, type, row ) {
            if(data != null && data != ''){
                return type === 'display' && data.length > 10 ? data.substr( 0, 100 ) +'…' : data;
            }
            return '';
        }
    };

    $(document).ready(function () {

        loadArticlesDataTable();

        setupKeyEnterSearch();
    });

    function setupKeyEnterSearch() {
        $("#name").keyup(function (e) {
            if (e.keyCode == 13) {
                $("#btn_search").trigger("click");
            }
        });
    }

    function loadArticlesDataTable() {
        var columns = [
            {data: null, "sClass": "right", "bSortable": false, "sWidth": "3%"}, //1st column
            {data: "page_name", "sClass": "text", "sWidth": "10%"},
            {data: "name", "sClass": "text", "sWidth": "15%"},
            {data: "title", "sClass": "text", "sWidth": "20%"},
            {data: "published_date", "sClass": "text", "sWidth": "10%"},
            {data: "sequence", "sClass": "text", "sWidth": "5%"},
            {data: "status", "sClass": "text", "sWidth": "5%"},
            {sClass: "text", "sWidth": "7%"},
            {data: "published", "sClass": "text", "visible": false},
            {data: "page_id", "sClass": "text", "visible": false},
        ];

        var columnDefs = [
            {targets: 3, render: $.fn.dataTable.render.ellipsis()},
            {targets: 4, render: $.fn.dataTable.render.ellipsis()},
            {targets: 5, render: function (data, type, row) {
                var value_order = (row.order_seq != null && row.order_seq != '') ? row.order_seq : 1;
                return '<input type="number" onblur="updateOrderSeq(this , ' + row.id + ')" value="' + value_order + '" class="form-control" name="order" step="1" min="1" style="width: 60px" >';
            }},
            {targets: 6, render: function (data, type, row) {
                var label_text = '<div class="text-left"> ';
                if (parseInt(row.published) == 1) {
                    label_text += '<h4><span class=\"label label-success\" >' + '<?=$this->lang->line("form_field_published");?>' + '</span></h4>';
                } else {
                    label_text += '<h4><span class=\"label label-danger\" >' + '<?=$this->lang->line("form_field_unpublished");?>' + '</span></h4>';
                }
                label_text += '</div>'
                return label_text;
            }},
            {targets: 7, render: function (data, type, row) {
                var buttons = '<div class="btn-toolbar"> ';
                buttons += '<a href=<?=base_url(ADMIN_ARTICLE)?>/update/' + row.id + '  class="btn btn-warning glyphicon glyphicon-pencil " data-toggle="tooltip" data-placement="top" title="แก้ไขข้อมูล"></a>';
                buttons += ' <a href="javascript:void(0)" onclick=deleteData(' + row.id + ') class="button_delete btn btn-danger glyphicon glyphicon-trash" data-toggle="tooltip" data-placement="top" title="ลบข้อมูล"></a>';
                buttons += '</div>'
                return buttons;
            }},
        ];


        dataTable = $('#articles_datatable').DataTable({
            'ajax': {
                type: "GET",
                url: BASE_URL + 'admin/article/loadArticlesDataTable',
                dataSrc: 'data'
            },
            "language": {
                "emptyTable": '<?=$this->lang->line("table_no_records");?>',
                "zeroRecords": '<?=$this->lang->line("table_no_records");?>'
            },
            columnDefs: columnDefs,
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

    function updateOrderSeq(element, rowId) {
        var targetUrl = BASE_URL + 'admin/Article/updateOrderSeq';
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

    function deleteData(id) {
        var targetUrl = BASE_URL + 'admin/Article/delete/' + id;
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
        var name = $('#name').val();
        var published = $("#published option:selected").val();
        var page = $("#page_id option:selected").val();

        dataTable.column(2).search(name);
        dataTable.column(8).search(published);
        dataTable.column(9).search(page);
//        if(published != '')dataTable.column(8).search("^" + published + "$", true, false, true);
//        if(page != '')dataTable.column(9).search("^" + page + "$", true, false, true);
        dataTable.draw();
    }

    function clearTextSearch() {
        $('#published').prop('selectedIndex', 0);
        $('#page_id').prop('selectedIndex', 0);
        $('#name').val('');
    }

</script>

<?php $this->load->view("components/backend/footer"); ?>
