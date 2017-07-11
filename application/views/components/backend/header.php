<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo isset($this->data["settings"]["website_name"])?$this->data["settings"]["website_name"]:"" ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!--======================== CSS ==========================-->
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?= base_url("assets/adminlte2/bootstrap/css/bootstrap.min.css") ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url("assets/font-awesome/css/font-awesome.min.css") ?>">

    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?= base_url("assets/adminlte2/dist/css/skins/_all-skins.min.css") ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url("assets/adminlte2/plugins/iCheck/flat/blue.css") ?>">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?= base_url("assets/adminlte2/plugins/morris/morris.css") ?>">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?= base_url("assets/adminlte2/plugins/jvectormap/jquery-jvectormap-1.2.2.css") ?>">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?= base_url("assets/adminlte2/plugins/datepicker/datepicker3.css") ?>">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url("assets/adminlte2/plugins/daterangepicker/daterangepicker-bs3.css") ?>">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?= base_url("assets/adminlte2/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css") ?>">
    <!-- DataTables-->
    <link rel="stylesheet" href="<?= base_url("assets/libraries/dataTables/media/css/dataTables.bootstrap.css") ?>">
    <link rel="stylesheet" href="<?= base_url("assets/libraries/dataTables/extensions/Responsive/css/responsive.bootstrap.css") ?>">
    <!--Bootstrap dialog-->
    <link rel="stylesheet" href="<?= base_url("assets/libraries/bootstrap-dialog/css/bootstrap-dialog.css") ?>">
    <link rel="stylesheet" href="<?= base_url("assets/libraries/nprogress/nprogress.css") ?>">
    <link rel="stylesheet" href="<?= base_url("assets/libraries/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css") ?>">
    <link href="<?= base_url("assets/libraries/bootstrap-switch/css/bootstrap-switch.min.css") ?>" type="text/css" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url("assets/adminlte2/plugins/select2/select2.min.css") ?>">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url("assets/adminlte2/dist/css/AdminLTE.css") ?>">

    <link rel="stylesheet" href="<?= base_url("assets/css/admin.css") ?>">
    <!--======================== Scripts ==========================-->

    <!-- jQuery 2.1.4 -->
    <script src="<?= base_url("assets/adminlte2/plugins/jQuery/jQuery-2.1.4.min.js") ?>"></script>
    <!--JQuery 1.12.0-->
<!--    <script src="--><?//= base_url("assets/js/jquery-1.12.0.min.js") ?><!--"></script>-->

    <!-- File style  -->
    <script src="<?= base_url("assets/js/bootstrap-filestyle.min.js") ?>"></script>

    <script src="<?= base_url("assets/libraries/spiner/spin.min.js") ?>"></script>

    <script src="<?= base_url("assets/libraries/nprogress/nprogress.js") ?>"></script>

    <script src="<?= base_url("assets/libraries/tinymce/tinymce.min.js") ?>"></script>

    <script src="<?= base_url("assets/js/moment-with-locales.js") ?>"></script>

    <script src="<?= base_url("assets/libraries/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js") ?>"></script>

    <!-- jQuery UI 1.11.4 -->
<!--    <script src="--><?//=base_url("assets/libraries/jquery-ui-1.11.4/jquery-ui.min.js")?><!--"></script>-->

    <script src="<?=base_url("assets/adminlte2/plugins/jQueryUI/jquery-ui.min.js")?>"></script>
    <script src="<?= base_url("assets/js/jquery.ui.nestedSortable.js") ?>"></script>

    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
        var BASE_URL = '<?=base_url();?>';
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?=base_url("assets/adminlte2/bootstrap/js/bootstrap.min.js")?>"></script>
    <!-- Morris.js charts -->
    <script src="<?=base_url("assets/adminlte2/plugins/morris/morris.min.js")?>"></script>
    <!-- Sparkline -->
    <script src="<?=base_url("assets/adminlte2/plugins/sparkline/jquery.sparkline.min.js")?>"></script>
    <!-- jvectormap -->
    <script src="<?=base_url("assets/adminlte2/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js")?>"></script>
    <script src="<?=base_url("assets/adminlte2/plugins/jvectormap/jquery-jvectormap-world-mill-en.js")?>"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?=base_url("assets/adminlte2/plugins/knob/jquery.knob.js")?>"></script>
    <!-- daterangepicker -->
    <script src="<?=base_url("assets/adminlte2/plugins/daterangepicker/daterangepicker.js")?>"></script>
    <!-- datepicker -->
    <script src="<?=base_url("assets/adminlte2/plugins/datepicker/bootstrap-datepicker.js")?>"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?=base_url("assets/adminlte2/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js")?>"></script>
    <!-- DataTables -->
    <script src="<?=base_url("assets/libraries/dataTables/media/js/jquery.dataTables.min.js")?>"></script>
    <script src="<?=base_url("assets/libraries/dataTables/media/js/dataTables.bootstrap.min.js")?>"></script>
    <script src="<?=base_url("assets/libraries/dataTables/extensions/Responsive/js/dataTables.responsive.min.js")?>"></script>
    <script src="<?=base_url("assets/libraries/dataTables/extensions/Responsive/js/responsive.bootstrap.min.js")?>"></script>
    <script src="<?=base_url("assets/libraries/dataTables/api/fnReloadAjax.js")?>"></script>

    <!-- Slimscroll -->
    <script src="<?=base_url("assets/adminlte2/plugins/slimScroll/jquery.slimscroll.min.js")?>"></script>
    <!-- FastClick -->
    <script src="<?=base_url("assets/adminlte2/plugins/fastclick/fastclick.min.js")?>"></script>

    <!-- Jquery Validate  -->
    <script src="<?=base_url("assets/libraries/jquery-validation/jquery.validate.min.js")?>"></script>
    <!-- Bootstrap Dialog  -->
    <script src="<?=base_url("assets/libraries/bootstrap-dialog/js/bootstrap-dialog.min.js")?>"></script>

    <!-- AdminLTE App -->
    <script src="<?=base_url("assets/adminlte2/dist/js/app.min.js")?>"></script>
    <!-- Select plugin -->
    <script src="<?=base_url("assets/adminlte2/plugins/select2/select2.full.min.js")?>"></script>

    <script type="text/javascript" src="<?= base_url("assets/libraries/bootstrap-switch/js/bootstrap-switch.min.js") ?>"></script>

    <?php echo js_asset('functions.js') ?>

</head>

<body class="hold-transition skin-blue sidebar-mini">


<div class="loading-spinner">
    <img src="<?= base_url("assets/images/spinner.gif") ?>">
</div>

<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><?=isset($this->data["settings"]["website_short_name"])?$this->data["settings"]["website_short_name"]:""?></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b><?=isset($this->data["settings"]["website_name"])?$this->data["settings"]["website_name"]:""?></b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="divider-vertical"></li>
                    <li class="dropdown user user-menu">
                        <a href="<?=base_url("admin/User/userProfile/".$this->session->userdata('user_id'))?>" class="dropdown-toggle" >
                            <i class="glyphicon glyphicon-user"></i>
                            <span class="hidden-xs"><?php echo $this->session->userdata('user_fullname'); ?></span>
                        </a>
                    </li>
                    <li class="divider-vertical"></li>
                    <li class="dropdown tasks-menu">
                        <!--Select Language-->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"  >
                            <?php if($this->session->userdata('language')=="thai"){ ?>
                                <img width="22" height="22" src="<?=base_url("assets/images/flags/th.png")?>">
                            <?php }else{ ?>
                                <img width="22" height="22" src="<?=base_url("assets/images/flags/en.png")?>">
                            <?php } ?>
                            <span class="hidden-xs"> <?=$this->lang->line("language");?></span>
                        </a>
                        <ul class="dropdown-menu lang-selection">
                            <?php if($this->session->userdata('language')=="thai"){ ?>
                                <li><a href="<?=base_url("admin/setting/switchLanguage/english")?>"><img width="22" height="22" src="<?=base_url("assets/images/flags/en.png")?>">&nbsp;Eng</a></li>
                            <?php }else{ ?>
                                <li><a href="<?=base_url("admin/setting/switchLanguage/thai")?>"><img width="22" height="22" src="<?=base_url("assets/images/flags/th.png")?>">&nbsp;ไทย</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li class="divider-vertical"></li>
                    <li>
                        <a href="<?= base_url("home") ?>" target="_blank" >
                            <i class="glyphicon glyphicon-home"></i> <span class="hidden-xs"> <?=$this->lang->line("website");?> </span>
                        </a>
                    </li>
                    <li class="divider-vertical"></li>
                    <li>
                        <a href="<?= base_url("admin/Login/performLogout") ?>"><i class="glyphicon glyphicon-log-out"></i> <span class="hidden-xs"><?=$this->lang->line("sign_out");?> </span></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <script type="text/javascript">
        // Prevent user input enter submit
        $(document).ready(function() {
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
        });

        // Show the progress bar
        NProgress.start();

        // Increase randomly
        var interval = setInterval(function () {
            NProgress.inc();
        }, 1000);

        // Trigger finish when page fully loaded
        jQuery(window).load(function () {
            clearInterval(interval);
            NProgress.done();
        });

        // Trigger bar when exiting the page
        jQuery(window).unload(function () {
            NProgress.start();
        });
    </script>