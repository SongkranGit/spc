<?php
$controller = $this->uri->segment(2);
$fuc = $this->uri->segment(3);
$role = $this->session->userdata('role_id');


?>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <!--Dashboard-->
            <li class="header"
                style="color:white;font-size: large; text-align: center"><?= $this->lang->line("menu_main"); ?></li>
            <li class="<?= (strcasecmp($controller, DASHBOARD) == 0) ? "active" : "" ?>">
                <a href="<?= base_url(ADMIN_DASHBOARD) ?>">
                    <i class="fa fa-dashboard"></i> <span><?= $this->lang->line("menu_dashboard"); ?></span>
                </a>
            </li>

            <!--Content-->
            <li class="treeview <?= ($controller == PAGE
                || $controller == ARTICLE
                || $controller == GALLERIES
                || $controller == GALLERY_IMAGE
                || $controller == SLIDE_SHOW
                || $controller == CLIP
                || $controller == CLIP_CATEGORY
                || $controller == NEWS) ? "active" : "" ?>">
                <a href="#">
                    <i class="glyphicon glyphicon-pencil"></i> <span><?= $this->lang->line("menu_content"); ?></span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if (intval($role) == ROLE_SUPER_ADMIN || intval($role) == ROLE_SYSTEM_ADMIN): ?>

                        <!--Page-->
                        <li class="<?= (strcasecmp($controller, PAGE) == 0) ? "active" : "" ?>">
                            <a href="<?= base_url(ADMIN_PAGE) ?>">
                                <i class="<?= (strcasecmp($controller, PAGE) == 0) ? "fa fa-circle-o text-orange" : "fa fa-circle-o" ?>"></i>
                                <?= $this->lang->line("menu_content_pages"); ?></a>
                        </li>

                    <?php endif; ?>

                    <!--News-->
                    <li class="<?= (strcasecmp($controller, NEWS) == 0) ? "active" : "" ?>">
                        <a href="<?= base_url(ADMIN_NEWS) ?>">
                            <i class="<?= (strcasecmp($controller, NEWS) == 0) ? "fa fa-circle-o text-orange" : "fa fa-circle-o" ?>"></i>
                            <?= $this->lang->line("menu_news"); ?></a>
                    </li>

                    <!--Article-->
                    <li class="<?= (strcasecmp($controller, ARTICLE) == 0) ? "active" : "" ?>">
                        <a href="<?= base_url(ADMIN_ARTICLE) ?>">
                            <i class="<?= (strcasecmp($controller, ARTICLE) == 0) ? "fa fa-circle-o text-orange" : "fa fa-circle-o" ?>"></i>
                            <?= $this->lang->line("menu_content_articles"); ?></a>
                    </li>

                    <!--Gallery-->
                    <li class="<?= ($controller == GALLERIES || $controller == GALLERY_IMAGE) ? "active" : "" ?>">
                        <a href="#"><i class="<?= (strcasecmp($controller, GALLERIES) == 0) ? "fa fa-circle-o text-green" : "fa fa-circle-o" ?>"></i>
                            <?= $this->lang->line("menu_galleries"); ?> &nbsp;<i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li class="<?= ($controller == GALLERIES) && $fuc == NULL ? "active" : "" ?>">
                                <a href="<?= base_url(ADMIN_GALLERY) ?>">
                                    <i class="<?= (strcasecmp($controller, GALLERIES) == 0 && $fuc == NULL) ? "fa fa-circle-o text-orange" : "fa fa-circle-o" ?>"></i>
                                    <?= $this->lang->line("menu_galleries_list"); ?></a></li>
                            <li class="<?= (strcasecmp($controller, GALLERY_IMAGE) == 0) ? "active" : "" ?>">
                                <a href="#"><i
                                            class="<?= (strcasecmp($controller, GALLERY_IMAGE) == 0) ? "fa fa-circle-o text-green" : "fa fa-circle-o" ?>"></i>
                                    <?= $this->lang->line("upload"); ?> &nbsp;<i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="<?= (strcasecmp($controller, GALLERY_IMAGE) == 0 && $fuc == "index") ? "active" : "" ?>">
                                        <a href="<?= base_url(ADMIN_GALLERY_UPLOAD) ?>">
                                            <i class="<?= (strcasecmp($controller, GALLERY_IMAGE) == 0 && $fuc == "index") ? "fa fa-circle-o text-orange" : "fa fa-circle-o" ?>"></i>
                                            <?= $this->lang->line("menu_galleries_upload"); ?>
                                        </a>
                                    </li>
                                    <li class="<?= (strcasecmp($controller, GALLERY_IMAGE) == 0 && $fuc == "upload") ? "active" : "" ?>">
                                        <a href="<?= base_url(ADMIN_UPLOAD_IMAGE) ?>">
                                            <i class="<?= (strcasecmp($controller, GALLERY_IMAGE) == 0 && $fuc == "upload") ? "fa fa-circle-o text-orange" : "fa fa-circle-o" ?>"></i>
                                            <?= $this->lang->line("upload_image"); ?>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>


                    <!--Slide Show-->
                    <li class="<?= (strcasecmp($controller, SLIDE_SHOW) == 0) ? "active" : "" ?>">
                        <a href="<?= base_url(ADMIN_SLIDE_SHOW) ?>">
                            <i class="<?= (strcasecmp($controller, SLIDE_SHOW) == 0) ? "fa fa-circle-o text-orange" : "fa fa-circle-o" ?>"></i>
                            <?= $this->lang->line("menu_galleries_slideshow"); ?></a>

                        <!--Clip-->
                    <li class="<?= (strcasecmp($controller, CLIP) == 0) ? "active" : "" ?>">
                        <a href="<?= base_url(ADMIN_CLIP) ?>">
                            <i class="<?= (strcasecmp($controller, CLIP) == 0) ? "fa fa-circle-o text-orange" : "fa fa-circle-o" ?>"></i>
                            <?= $this->lang->line("menu_media_clip"); ?>
                        </a>
                </ul>
            </li>

            <!--User-->
            <li class="treeview <?= ($controller == CONTACT || $controller == STUDENT) ? "active" : "" ?>">
                <a href="#">
                    <i class="glyphicon glyphicon-user"></i> <span><?= $this->lang->line("menu_member"); ?></span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">

                    <li class="<?= (strcasecmp($controller, CONTACT) == 0) ? "active" : "" ?>">
                        <a href="<?= base_url(ADMIN_CONTACT) ?>">
                            <i class="<?= (strcasecmp($controller, CONTACT) == 0) ? "fa fa-circle-o text-orange" : "fa fa-circle-o" ?>"></i>
                            <?= $this->lang->line("menu_contact_list"); ?></a>
                    </li>
                    <li class="<?= (strcasecmp($controller, STUDENT) == 0) ? "active" : "" ?>">
                        <a href="<?= base_url(ADMIN_STUDENT) ?>">
                            <i class="<?= (strcasecmp($controller, STUDENT) == 0) ? "fa fa-circle-o text-orange" : "fa fa-circle-o" ?>"></i>
                            <?= $this->lang->line("menu_students"); ?></a>
                    </li>
                </ul>
            </li>
            <!--Settings-->
            <li class="treeview  <?= ($controller == SETTING || $controller == USER) ? "active" : "" ?>">
                <a href="#">
                    <i class="fa fa-gears"></i> <span><?= $this->lang->line("menu_settings"); ?></span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?= (strcasecmp($controller, SETTING) == 0) ? "active" : "" ?>">
                        <a href="<?= base_url(ADMIN_SETTING) ?>">
                            <i class="<?= (strcasecmp($controller, SETTING) == 0) ? "fa fa-circle-o text-orange" : "fa fa-circle-o" ?>"></i> <?= $this->lang->line("menu_settings_general"); ?>
                        </a>
                    </li>

                    <li class="<?= (strcasecmp($controller, USER) == 0) ? "active" : "" ?>">
                        <a href="<?= base_url(ADMIN_USER) ?>">
                            <i class="<?= (strcasecmp($controller, USER) == 0) ? "fa fa-circle-o text-orange" : "fa fa-circle-o" ?>"></i>
                            <?= $this->lang->line("menu_users"); ?></a>
                    </li>
                </ul>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>