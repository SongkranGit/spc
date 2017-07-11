<?php $this->load->view("components/backend/header"); ?>
<?php $this->load->view("components/backend/navbar"); ?>

<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <span><?= $this->lang->line("member_information"); ?></span>
        </h1>
        <div class="group-buttons-right">
            <ul class="nav nav-pills">
                <li>
                    <a href="<?= base_url(ADMIN_MEMBER) ?>"> <i class="fa fa-list"></i><?= $this->lang->line("member_button_list_member"); ?></a>
                </li>
            </ul>
        </div>
    </section>

    <section class="content">
        <form id="form_member_detail" role="form" class="form-horizontal">
            <div class="panel panel-default">
                <div class="panel-heading heading-create">
                <span>
                    <i class="fa fa-user"></i>
                    <?= $this->lang->line("member_detail"); ?>
                </span>
                </div>

                <div class="panel-body">

                    <div class="form-group  ">
                        <label class="col-md-2  control-label"><?= $this->lang->line("member_full_name"); ?></label>
                        <div class="col-md-8">
                            <input type="text" id="full_name" name="full_name" class="form-control"
                                   value="<?php echo isset($data["full_name"]) ? $data["full_name"] : "" ?>">
                        </div>
                    </div>

                    <div class="form-group ">
                        <label class="col-md-2  control-label"><?= $this->lang->line("member_email"); ?></label>
                        <div class="col-md-8">
                            <input type="text" id="title" name="title" class="form-control"
                                   value="<?php echo isset($data["email"]) ? $data["email"] : "" ?>">
                        </div>
                    </div>

                    <div class="form-group ">
                        <label class="col-md-2  control-label"><?= $this->lang->line("member_phone"); ?></label>
                        <div class="col-md-8">
                            <input type="text" id="title" name="title" class="form-control"
                                   value="<?php echo isset($data["phone"]) ? $data["phone"] : "" ?>">
                        </div>
                    </div>

                    <div class="form-group ">
                        <label class="col-md-2  control-label"><?= $this->lang->line("member_address"); ?></label>
                        <div class="col-md-8">
                            <input type="text" id="title" name="title" class="form-control"
                                   value="<?php echo isset($data["address"]) ? $data["address"] : "" ?>">
                        </div>
                    </div>



                    <div class="form-group ">
                        <label class="col-md-2 control-label"><?= $this->lang->line("form_field_status"); ?></label>
                        <div class="col-md-2">
                            <select class="form-control" id="published" name="published">
                                <option value="1" <?= isset($data["status"]) && $data["status"] == 1 ? "selected" : "" ?>>
                                    <?= $this->lang->line("form_field_active"); ?></option>
                                <option value="0" <?= isset($data["title"]) && $data["status"] == 0 ? "selected" : "" ?>>
                                    <?= $this->lang->line("form_field_inactive"); ?></option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="panel-footer">
                    <div class="clearfix"></div>
                </div>
            </div>
        </form>
    </section>


</div><!-- /.content-wrapper -->

<script type="text/javascript">

    $(document).ready(function () {
        $("#form_member_detail :input").attr("disabled", true);
    });

</script>

<?php $this->load->view("components/backend/footer"); ?>

