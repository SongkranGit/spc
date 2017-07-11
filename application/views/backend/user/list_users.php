<?php $this->load->view("components/backend/header"); ?>
<?php $this->load->view("components/backend/navbar"); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <span><?=$this->lang->line("user_title_list_user");?></span>
        </h1>
        <div class="group-buttons-right">
            <ul class="nav nav-pills">
                <li>
                    <a href="<?= base_url(ADMIN_USER."/create") ?>"> <i class="fa fa-plus-circle fa-1x"></i><?=$this->lang->line("user_button_add_user");?></a>
                </li
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
                            <?=$this->lang->line("button_search");?>
                        </h3>
                    </div>
                    <div class="box-body">
                        <form id="form_search_user" class="form-horizontal">

                            <div class="col-md-4 ">
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?=$this->lang->line("user_full_name");?></label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" id="user_fullname">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 ">
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?=$this->lang->line("user_username");?></label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" id="username">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 ">
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?=$this->lang->line("user_role");?></label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="role">
                                            <option value=""></option>
                                            <option value="1">Super Admin</option>
                                            <option value="2">Admin</option>
                                            <option value="3">User</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div><!-- /.box-body-->

                    <div class="box-footer">
                        <div class="pull-right">
                            <button type="button" onclick="search()" class="btn btn-primary "><i
                                    class="fa fa-search"></i> <?=$this->lang->line("button_search");?>
                            </button>
                            <button id="btn_clear_search" onclick="clearTextSearch()" type="button" class="btn btn-default">
                                <i class="fa fa-refresh"></i>
                                <?=$this->lang->line("button_clear");?>
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
                            <table class="table table-striped table-bordered table-hover"  id="users_datatable">
                                <thead>
                                <tr>
                                    <th><?=$this->lang->line("table_seq");?></th>
                                    <th><?=$this->lang->line("user_full_name");?></th>
                                    <th><?=$this->lang->line("user_username");?></th>
                                    <th><?=$this->lang->line("user_email");?></th>
                                    <th><?=$this->lang->line("user_last_logged_in");?></th>
                                    <th><?=$this->lang->line("user_role");?></th>
                                    <th class="text-center">Actions</th>
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

    var dataTable = $('#users_datatable');

    $(document).ready(function () {
        loadUsersDataTable();
    });

    function loadUsersDataTable() {
        var columns = [
            {data: null, "sClass": "right", "bSortable": false}, //1st column
            {data: "user_fullname", "sClass": "text"},
            {data: "username", "sClass": "text"},
            {data: "email", "sClass": "text" },
            {data: "logged_in_date", "sClass": "text" },
            {
                orderable: false ,
                mRender: function (data, type, row) {
                    var label_role = '';
                    switch (parseInt(row.role_id)) {
                        case 1 :
                            label_role = 'class="label label-danger"';
                            break;
                        case 2  :
                            label_role = 'class="label label-success"';
                            break;
                        case 3  :
                            label_role = 'class="label label-info"';
                            break;
                    }
                    return '<h4><span ' + label_role + ' >' + row.role_name + '</span></h4>';
                }
            },
            {
                orderable: false,
                mRender: function (data, type, row) {
                    var buttons = '<div class="text-center"> ';
                    buttons += '<a href=<?=base_url(ADMIN_USER)?>/update/' + row.user_id + '  class="btn btn-warning glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="แก้ไขข้อมูล"></a>';
                    buttons += ' <a href="javascript:void(0)" onclick=deleteData(' + row.user_id + ') class="button_delete btn btn-danger glyphicon glyphicon-trash" data-toggle="tooltip" data-placement="top" title="ลบข้อมูล"></a>';
                    buttons += '</div>'
                    return buttons;
                }
            }
        ];

        dataTable = $('#users_datatable').DataTable({
            'ajax': {
                type: "GET",
                url: BASE_URL + 'admin/user/loadUsersDataTable',
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

    function deleteData(user_id) {
        var targetUrl = BASE_URL + 'admin/user/delete/' + user_id;
        if (user_id != "") {
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
        var role_name = $("#role option:selected").text();
        var username = $('#username').val();
        var user_fullname = $('#user_fullname').val();
        dataTable
            .column(1).search(user_fullname)
            .column(2).search(username)
            .column(5).search(role_name)
            .draw();
    }

    function clearTextSearch() {
        $('#role').prop('selectedIndex', 0);
        $('#username').val('');
        $('#user_fullname').val('');
    }

</script>

<?php $this->load->view("components/backend/footer"); ?>
