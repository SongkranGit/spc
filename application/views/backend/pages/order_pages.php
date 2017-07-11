<?php $this->load->view("components/backend/header"); ?>
<?php $this->load->view("components/backend/navbar"); ?>

<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <span><?= $this->lang->line("pages_title_order_pages"); ?></span>
        </h1>
        <div class="group-buttons-right">
            <ul class="nav nav-pills">
                <li>
                    <a href="<?= base_url(ADMIN_PAGE) ?>"> <i class="fa fa-list"></i><?= $this->lang->line("pages_list_of_pages"); ?></a>
                </li>
            </ul>
        </div>
    </section>

    <section class="content">
        <form id="form_page_entry" role="form">
            <div class="panel panel-default">
                <div class="panel-heading heading-create">
                <span>
                    <i class="fa fa-sort"></i>
                    <?= $this->lang->line("pages_heading_order_pages"); ?>
                </span>
                </div>

                <div class="panel-body">
                    <p class="alert alert-info"> Drag to order pages</p>
                    <div class="col-md-12">
                        <div id="orderResult"></div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="pull-right">
                        <button type="button" class="btn btn-custom btn-success" id="btn_save" ><i class="fa fa-save"></i> <?= $this->lang->line("button_save") ?></button>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </form>
    </section>

</div><!-- /.content-wrapper -->

<script type="text/javascript">
    $(document).ready(function () {

        var targetUrl = BASE_URL + 'admin/page/orderPageAjax';

        $.get(targetUrl, {}, function (data) {
            $("#orderResult").html(data);
        });

        $('#btn_save').click(function () {
            var oSortable = $('ol.sortable').nestedSortable('toArray');
            if (oSortable != null && oSortable.length > 0) {
                showSpinner();
                $.ajax({
                    type: 'POST',
                    url: targetUrl,
                    data: {sortable: oSortable},
                    dataType: 'json',
                    success: function (response) {
                        hideSpinner();
                        if (response.success == true) {
                            alertSuccessMessageDialog(
                                '<?=$this->lang->line("message_dialog_title_success");?>',
                                '<?=$this->lang->line("message_save_complete");?>', null);
                        }
                    },
                    error: function (request, status, error) {
                        hideSpinner();
                        alert(request.responseText);
                    }
                });
            }
        });

    });


</script>

<?php $this->load->view("components/backend/footer"); ?>

