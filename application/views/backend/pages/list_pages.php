<?php $this->load->view("components/backend/header"); ?>
<?php $this->load->view("components/backend/navbar"); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <span><?= $this->lang->line("pages_list_of_pages"); ?></span>
        </h1>
        <div class="group-buttons-right">
            <ul class="nav nav-pills">
                <li>
                    <?php if($this->session->userdata('role_id') == ROLE_SYSTEM_ADMIN): ?>
                    <a href="<?= base_url(ADMIN_PAGE . "/create") ?>"> <i
                            class="fa fa-plus-circle fa-1x"></i><?= $this->lang->line("pages_button_add"); ?></a>
                    <?php endif;?>
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
                                <label class="col-md-5 control-label text-right"><?= $this->lang->line("pages_title"); ?>
                                    </label>
                                <div class="col-md-7">
                                    <input class="form-control" type="text" id="title">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label class="col-md-5 control-label text-right"><?= $this->lang->line("last_update_date"); ?></label>
                                <div class='col-md-7'>
                                    <div class="input-group date" id='datetimepicker'>
                                        <input type='text' class="form-control" name="published_date"/>
                                        <span class="input-group-addon">
                                     <span class="glyphicon glyphicon-calendar"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="form-group ">
                                <label
                                    class="col-md-5 control-label text-right"><?= $this->lang->line("form_field_published"); ?></label>
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
                            <button type="button" id="btn_search" onclick="search()" class="btn btn-primary "><i
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
                            <table class="table table-striped table-bordered table-hover" id="pages_datatable">
                                <thead>
                                <tr>
                                    <th class="text-center"><?= $this->lang->line("table_seq"); ?></th>
                                    <th class="text-center"><?= $this->lang->line("pages_title"); ?></th>
                                    <?php if($this->session->userdata('role_id') == ROLE_SYSTEM_ADMIN): ?><th><?= $this->lang->line("pages_name"); ?></th><?php endif;?>
                                    <?php if($this->session->userdata('role_id') == ROLE_SYSTEM_ADMIN): ?><th><?= $this->lang->line("pages_parent"); ?></th><?php endif;?>
                                    <th class="text-center"><?= $this->lang->line("table_last_update"); ?></th>
                                    <th class="text-center"><?= $this->lang->line("table_record_status"); ?></th>
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

    var dataTable = $('#pages_datatable');

    $(document).ready(function () {

        initDateTimePicker();

        loadPagesDataTable();

        setupKeyEnterSearch();
    });

    function initDateTimePicker() {
        $('#datetimepicker').datetimepicker({
            locale: 'th',
            format: "DD-MM-YYYY"
        });
    }

    function setupKeyEnterSearch() {
        $("#title").keyup(function (e) {
            if (e.keyCode == 13) {
                $("#btn_search").trigger("click");
            }
        });
    }


    function loadPagesDataTable() {


        var columns = [
            {data: null, "sClass": "right", "bSortable": false, "sWidth": "3%"}, //1st column
            {data: "title", "sClass": "text", "sWidth": "20%"},
            <?php if($this->session->userdata('role_id') == ROLE_SYSTEM_ADMIN):  ?> {data: "name", "sClass": "text", "sWidth": "15%"},<?php endif;?>
            <?php if($this->session->userdata('role_id') == ROLE_SYSTEM_ADMIN):  ?>{data: "parent_title", "sClass": "text", "sWidth": "15%"},<?php endif;?>
            {data: "updated_date", "sClass": "text-center", "sWidth": "10%"},
            {
                orderable: false, "sWidth": "7%",
                mRender: function (data, type, row) {
                    if (parseInt(row.published) == 1) {
                        return '<h4 class="text-center"><span class=\"label label-success\" >' + '<?=$this->lang->line("form_field_published");?>' + '</span></h4>';
                    }
                    return '<h4 class="text-center"><span class=\"label label-danger\" >' + '<?=$this->lang->line("form_field_unpublished");?>' + '</span></h4>';
                }
            },
            {
                orderable: false, "sWidth": "10%",
                mRender: function (data, type, row) {
                    var btnEdit = '<a href=<?=base_url(ADMIN_PAGE)?>/update/' + row.id + '  class="btn btn-warning glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="แก้ไขข้อมูล"></a>';
                    var btnDelete = ' <a href="javascript:void(0)" onclick=deleteData(' + row.id + ') class=\"button_delete btn btn-danger glyphicon glyphicon-trash\" data-toggle="tooltip" data-placement="top" title="ลบข้อมูล"></a>';
                    return '<div class="text-center">'+ btnEdit + '&nbsp;' + btnDelete +'</div>';
                }
            },
            {data: "published", "sClass": "text", "visible": false},

        ];

        dataTable = $('#pages_datatable').DataTable({
            'ajax': {
                type: "GET",
                url: BASE_URL + 'admin/page/loadPagesDataTable',
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
        var targetUrl = BASE_URL + 'admin/page/delete/' + id;
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
        var datetimepicker = $('#datetimepicker input').val();
        var title = $('#title').val();
        var published = $("#published option:selected").val();
        var columnCont = $('#pages_datatable thead th').length;

        dataTable
            .column(1).search(title)
            .column(columnCont-3).search(datetimepicker)
            .column(columnCont).search(published)
            .draw();
    }

    function clearTextSearch() {
        $('#published').prop('selectedIndex', 0);
        $('#datetimepicker input').val('');
        $('#title').val('');
    }

</script>

<?php $this->load->view("components/backend/footer"); ?>
