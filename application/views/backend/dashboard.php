<?php $this->load->view("components/backend/header"); ?>
<?php $this->load->view("components/backend/navbar"); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?=$this->lang->line("dashboard_title");?>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <ul class="timeline">
                <li>
                    <i class="fa fa-user bg-purple"></i>
                    <div class="timeline-item">
                        <h3 class="timeline-header"><?=$this->lang->line("dashboard_user");?></h3>
                        <div class="timeline-body">
                            <div class="row">
                                <div class="col-lg-3">
                                    <!-- small box -->
                                    <div class="small-box bg-aqua">
                                        <div class="inner">
                                            <h2><?=$this->lang->line("dashboard_users");?></h2>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <a href="<?=base_url("admin/User/index")?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div><!-- ./col -->

                            </div>
                        </div>
                    </div>
                </li>
                <!--Permission Menu -->
                <?php //if($this->session->userdata('is_admin') === true):?>
                <li>
                    <i class="fa fa-gears bg-purple"></i>
                    <div class="timeline-item">
                        <h3 class="timeline-header"><?=$this->lang->line("dashboard_settings");?></h3>
                        <div class="timeline-body">
                            <div class="row">
                                <div class="col-lg-3">
                                    <!-- small box -->
                                    <div class="small-box bg-red-gradient">
                                        <div class="inner">
                                            <h2><?=$this->lang->line("dashboard_setting_general");?></h2>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-gears"></i>
                                        </div>
                                        <a href="<?=base_url("admin/Setting")?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div><!-- ./col -->

                            </div>
                        </div>
                    </div>
                </li>

                <?php // endif;?>
            </ul>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

<?php $this->load->view("components/backend/footer"); ?>