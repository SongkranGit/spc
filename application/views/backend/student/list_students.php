<?php $this->load->view("components/backend/header"); ?>
<?php $this->load->view("components/backend/navbar"); ?>
<style>
     td:nth-child(2) {
        text-align: center;
    }​

</style>
<div class="content-wrapper">

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
                    <div class="box-body">
                        <form id="form_search_user" class="form-horizontal">
                            <div class="col-md-3 col-sm-3">
                                <div class="form-group">
                                    <label
                                        class="col-md-4 control-label"><?= $this->lang->line("full_name"); ?></label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="full_name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 ">
                                <div class="form-group">
                                    <label class="col-md-4  control-label"><?= $this->lang->line("last_name"); ?></label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="last_name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 ">
                                <div class="form-group">
                                    <label class="col-md-4 control-label"><?= $this->lang->line("nick_name"); ?></label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="nick_name">
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-md-3 col-sm-3 ">
                                <div class="form-group">
                                    <label
                                        class="col-md-5 control-label"><?= $this->lang->line("table_created_date"); ?></label>
                                    <div class='col-md-7 input-group date' id='datetimepicker'>
                                        <input type='text' class="form-control" name="published_date"/>
                                             <span class="input-group-addon">
                                             <span class="glyphicon glyphicon-calendar"></span>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div><!-- /.box-body-->

                    <div class="box-footer">
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
                            <table class="table table-striped table-bordered table-hover" id="Student_datatable">
                                <thead>
                                <tr>
                                    <th><?= $this->lang->line("table_seq"); ?></th>
                                    <th>รูปโปรไฟล์</th>
                                    <th><?= $this->lang->line("full_name"); ?></th>
                                    <th><?= $this->lang->line("nick_name"); ?></th>
                                    <th><?= $this->lang->line("table_created_date"); ?></th>
                                    <th><?= $this->lang->line("table_updated_date"); ?></th>
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

    var dataTable;

    $(document).ready(function () {
        loadStudentDataTable();
        initDateTimePicker();
    });

    function initDateTimePicker() {
        $('#datetimepicker').datetimepicker({
            locale: 'th',
            format: "DD-MM-YYYY"
        });

    }

    function loadStudentDataTable() {
        var columns = [
            {data: null, "sClass": "right", "bSortable": false, "sWidth": "3%"}, //1st column
            {
                orderable: false, "sWidth": "7%",
                mRender: function (data, type, row) {
                    var img_src = '';
                    if (row.picture_profile != null && row.picture_profile != '') {
                        img_src = '<?=base_url("uploads/user-profile/")?>' +'/'+ row.picture_profile;
                    } else {
                        img_src = '<?=base_url("assets/spc/images/blank_person.png")?>';
                    }
                    return '<img style="height: 50px;width: 45px" src=' + img_src + ' class=\"img-responsive\" >';
                }
            },
            {data: "full_name", "sClass": "text", "sWidth": "15%"},
            {data: "nick_name", "sClass": "text", "sWidth": "10%"},
            {data: "created_date", "sClass": "text", "sWidth": "10%"},
            {data: "updated_date", "sClass": "text", "sWidth": "10%"},
            {
                orderable: false, "sWidth": "15%",
                mRender: function (data, type, row) {
                    var buttons = '<div class="text-center"> ';
                    buttons += '<a  href=<?=base_url(ADMIN_STUDENT)?>/printStudentInfo/' + row.id + '  class="btn btn-success glyphicon glyphicon-print" data-toggle="tooltip" data-placement="top" title="ปริ้นข้อมูล" target="_blank"></a>&nbsp;';
                    buttons += '<a  href=<?=base_url(ADMIN_STUDENT)?>/update/' + row.id + '  class="btn btn-warning glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="แก้ไขข้อมูล"></a>';
                    buttons += ' <a href="javascript:void(0)" onclick=deleteData(' + row.id + ') class="button_delete btn btn-danger glyphicon glyphicon-trash" data-toggle="tooltip" data-placement="top" title="ลบข้อมูล"></a>';
                    buttons += '</div>'
                    return buttons;
                }
            }
        ];

        dataTable = $('#Student_datatable').DataTable({
            'ajax': {
                type: "GET",
                url: BASE_URL + 'admin/Student/loadStudentDataTable',
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
        var targetUrl = BASE_URL + 'admin/Student/delete/' + id;
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
        var full_name = $('#full_name').val();
        var nick_name = $('#nick_name').val();
        dataTable
            .column(2).search(full_name)
            .column(4).search(nick_name)
            .column(5).search(datetimepicker)
            .draw();
    }

    function clearTextSearch() {
        $('#full_name').val('');
        $('#nick_name').val('');
        $('#datetimepicker input').val('');
    }

</script>

<?php $this->load->view("components/backend/footer"); ?>
