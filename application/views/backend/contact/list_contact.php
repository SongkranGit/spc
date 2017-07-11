<?php $this->load->view("components/backend/header"); ?>
<?php $this->load->view("components/backend/navbar"); ?>

<div class="content-wrapper">
    <!-- Content Header (contact header) -->
    <section class="content-header">
        <h1>
            <span><?= $this->lang->line("contact_title_list_of_contact"); ?></span>
        </h1>

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
                                <i class="fa fa-plus" style="font-size: large"></i></button>
                        </div><!-- /. tools -->
                        <i class="fa fa-search"></i>
                        <h3 class="box-title">
                            <?= $this->lang->line("button_search"); ?>
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-5 ">
                            <div class="form-group">
                                <label
                                    class="col-md-5 control-label"><?= $this->lang->line("contact_full_name"); ?></label>
                                <div class="col-md-7">
                                    <input class="form-control" type="text" id="full_name">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label class="col-md-3 control-label text-right"><?= $this->lang->line("contact_email"); ?></label>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" id="email">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 ">
                            <label class="col-md-4 control-label text-right"><?= $this->lang->line("contact_approve"); ?></label>
                            <div class="col-md-8">
                                <select class="form-control" id="status" name="status">
                                    <option value=""></option>
                                    <option value="0">ยังไม่ได้รับ</option>
                                    <option value="1">รับแล้ว</option>
                                </select>
                            </div>
                        </div>
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
                            <table class="table table-striped table-bordered table-hover" id="contacts_datatable">
                                <thead>
                                <tr>
                                    <th><?= $this->lang->line("table_seq"); ?></th>
                                    <th><?= $this->lang->line("contact_full_name"); ?></th>
                                    <th><?= $this->lang->line("contact_email"); ?></th>
                                    <th><?= $this->lang->line("contact_phone"); ?></th>
                                    <th><?= $this->lang->line("table_created_date"); ?></th>
                                    <th><?= $this->lang->line("contact_approve"); ?></th>
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

    var dataTable = $('#contacts_datatable');

    $(document).ready(function () {
        loadContactsDataTable();
    });

    function loadContactsDataTable() {
        var columns = [
            {data: null, "sClass": "right", "bSortable": false, "sWidth": "3%"}, //1st column
            {data: "full_name", "sClass": "text", "sWidth": "20%"},
            {data: "email", "sClass": "text", "sWidth": "10%"},
            {data: "phone", "sClass": "text", "sWidth": "15%"},
            {data: "created_date", "sClass": "text", "sWidth": "25%"},
            {
                orderable: false,
                mRender: function (data, type, row) {
                    var label_role = '';
                    var label_text = '';
                    switch (parseInt(row.is_approve)) {
                        case 0 :
                            label_role = 'class="label label-danger"';
                            label_text = 'ยังไม่ได้อนุมัติ';
                            break;
                        case 1  :
                            label_role = 'class="label label-success"';
                            label_text = 'อนุมัติแล้ว';
                            break;
                    }
                    return '<h4><span ' + label_role + ' >' + label_text + '</span></h4>';
                }
            },
            {
                orderable: false, "sWidth": "15%",
                mRender: function (data, type, row) {
                    var btnEdit = '<a href=<?=base_url(ADMIN_CONTACT)?>/detail/' + row.id + '  class="btn btn-info fa fa-info" data-toggle="tooltip" data-placement="top" title="รายละเอียดข้อมูล"></a>';
                    var btnDelete = ' <a href="javascript:void(0)" onclick=deleteData(' + row.id + ') class="button_delete btn btn-danger fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="ลบข้อมูล"></a>';
                    return btnEdit + '&nbsp;' + btnDelete;
                }
            },
            {data: "is_approve", "sClass": "text", "visible": false},
        ];

        dataTable = $('#contacts_datatable').DataTable({
            'ajax': {
                type: "GET",
                url: BASE_URL + 'admin/Contact/loadContactsDataTable',
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
        var targetUrl = BASE_URL + 'admin/Contact/delete/' + id;
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
        var email = $('#email').val();
        var full_name = $('#full_name').val();
        var status = $("#status option:selected").val();

        dataTable
            .column(1).search(full_name)
            .column(2).search(email)
            .column(8).search(status)
            .draw();
    }

    function clearTextSearch() {
        $('#status').prop('selectedIndex', 0);
        $('#email').val('');
        $('#full_name').val('');
    }

</script>

<?php $this->load->view("components/backend/footer"); ?>
