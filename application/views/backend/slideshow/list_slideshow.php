<?php $this->load->view("components/backend/header"); ?>
<?php $this->load->view("components/backend/navbar"); ?>
<style>

</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <span><?=$this->lang->line("slideshow_list");?></span>
        </h1>
        <div class="group-buttons-right">
            <ul class="nav nav-pills">
                <li>
                    <a href="<?= base_url(ADMIN_SLIDE_SHOW."/create") ?>"> <i class="fa fa-plus-circle fa-1x"></i><?=$this->lang->line("slideshow_button_add");?></a>
                </li>
            </ul>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Row Data Table -->
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-info">
                    <!--Header-->
                   <!--  <div class="box-header"></div>-->
                    <!--Body-->
                    <div class="box-body">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="slideshows_datatable">
                                <thead>
                                <tr>
                                    <th><?=$this->lang->line("table_seq");?></th>
                                    <th><?=$this->lang->line("slideshow_name");?></th>
                                    <th><?=$this->lang->line("slideshow_description");?>(Thai)</th>
                                    <th><?=$this->lang->line("slideshow_description");?>(Eng)</th>
                                    <th><?=$this->lang->line("table_published");?></th>
                                    <th><?=$this->lang->line("table_order");?></th>
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

    var dataTable = $('#slideshows_datatable');

    $(document).ready(function () {
        loadSlideShowDataTable();
    });

    function loadSlideShowDataTable() {
        var columns = [
            {data: null, "sClass": "right", "bSortable": false, "sWidth": "3%"}, //1st column
            {
                orderable: false, "sWidth": "15%",
                mRender: function (data, type, row) {
                    if(row.file_name != null && row.file_name != ''){
                        var img_src = '<?=base_url("uploads")?>'+'/'+row.file_name;
                        return '<img height="100" src='+img_src+' class=\"img-responsive\" >';
                    }else{
                        return '';
                    }
                }
            },
            {data: "description_th", "sClass": "text", "sWidth": "20%"},
            {data: "description_en", "sClass": "text", "sWidth": "20%"},
            {
                orderable: false, "sWidth": "10%",
                mRender: function (data, type, row) {
                    if(parseInt(row.published) == 1){
                        return '<h4><span class=\"label label-success\" >' + '<?=$this->lang->line("form_field_published");?>' + '</span></h4>';
                    }
                    return '<h4><span class=\"label label-danger\" >' + '<?=$this->lang->line("form_field_unpublished");?>'+ '</span></h4>';
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
                     buttons += '<a href=<?=base_url(ADMIN_SLIDE_SHOW)?>/update/' + row.id + '  class="btn btn-warning glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="แก้ไขข้อมูล"></a>&nbsp;';
                     buttons += ' <a href="javascript:void(0)" onclick=deleteData(' + row.id + ') class="button_delete btn btn-danger glyphicon glyphicon-trash" data-toggle="tooltip" data-placement="top" title="ลบข้อมูล"></a>';
                     buttons += '</div>'
                    return buttons;
                }
            },

            {data: "published", "sClass": "text" , "visible": false},
        ];

        dataTable = $('#slideshows_datatable').DataTable({
            'ajax': {
                type: "GET",
                url: BASE_URL + 'admin/Slideshow/loadSlideShowDataTable',
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
        var targetUrl = BASE_URL+'admin/Slideshow/updateOrderSeq';
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
        var targetUrl = BASE_URL + 'admin/Slideshow/delete/' + id;
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
        var description = $('#description').val();
        var name = $('#name').val();
        var published = $("#published option:selected").val();

        dataTable
            .column(1).search(name)
            .column(2).search(description)
            .column(5).search(published)
            .draw();
    }

    function clearTextSearch() {
        $('#published').prop('selectedIndex', 0);
        $('#description').val('');
        $('#name').val('');
    }

</script>

<?php $this->load->view("components/backend/footer"); ?>
