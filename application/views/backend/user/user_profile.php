<?php $this->load->view("components/backend/header"); ?>
<?php $this->load->view("components/backend/navbar"); ?>
<style>

</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <span><?= $this->lang->line("user_title_user_profile"); ?></span>
        </h1>
    </section>

    <?php
    //  dump($data);
    $first_name = isset($data["firstname"]) ? $data["firstname"] : "";
    $last_name = isset($data["lastname"]) ? $data["lastname"] : "";
    $full_name = $first_name . " " . $last_name;
    ?>

    <section class="content">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span>
                    <i class="fa fa-user"></i>
                    <?= $this->lang->line("user_title_user_profile"); ?>
                </span>
            </div>
            <div class="panel-body">
                <div class="container form-horizontal">
                    <div class="row">
                        <label class="control-label" style="font-size: x-large"><?= $full_name ?></label>
                        <span class="divider"></span>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group ">
                            <label class="control-label"><?= $this->lang->line("user_username"); ?></label>
                        </div>
                        <div class="col-md-8 form-group ">
                            <label class="control-label"><?= isset($data["username"]) ? $data["username"] : "" ?></label>
                        </div>
                        <span class="divider"></span>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group ">
                            <label class="control-label"><?= $this->lang->line("user_email"); ?></label>
                        </div>
                        <div class="col-md-8 form-group ">
                            <label class="control-label"><?= isset($data["email"]) ? $data["email"] : "" ?></label>
                        </div>
                        <span class="divider"></span>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group ">
                            <label class="control-label"><?= $this->lang->line("user_phone"); ?></label>
                        </div>
                        <div class="col-md-8 form-group ">
                            <label class="control-label"><?= isset($data["phone"]) ? $data["phone"] : "" ?></label>
                        </div>
                        <span class="divider"></span>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group ">
                            <label class="control-label"><?= $this->lang->line("user_role"); ?></label>
                        </div>
                        <div class="col-md-8 form-group ">
                            <label class="control-label"><?= (isset($data["facebook_id"]))?getRoleName($data["role_id"]): getRoleName(0) ?></label>
                        </div>
                        <span class="divider"></span>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group ">
                            <label class="control-label"><?= $this->lang->line("user_external_login"); ?></label>
                        </div>
                        <div class="col-md-8 form-group ">
                            <?php if ( isset($data["facebook_id"]) && ($data["facebook_id"] != NULL && $data["facebook_id"] !="")): ?>
                               <img src="<?=base_url("assets/images/facebook_icon.png")?>">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="pull-right">
                    <a class="btn btn-custom btn-primary" href="<?=base_url("admin/User/update/".$this->session->userdata('user_id'))?>">
                        <?= $this->lang->line("user_edit_profile"); ?>
                    </a>
                </div>
                <span class="clearfix">
            </div>
        </div>

    </section>


</div><!-- /.content-wrapper -->

<?php $this->load->view("components/backend/footer"); ?>
