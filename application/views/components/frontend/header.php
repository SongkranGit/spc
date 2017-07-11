<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?=base_url("assets/spc/images/logo.png")?>" type="image/x-icon" />
    <title><?php echo isset($this->data["settings"]["website_name"]) ? $this->data["settings"]["website_name"] : "" ?></title>
    <!-- Bootstrap -->
    <link href="<?= base_url("assets/spc/css/bootstrap.min.css") ?>" rel="stylesheet">
    <link href="<?= base_url("assets/spc/css/font-awesome.min.css") ?>" rel="stylesheet">
    <link href="<?= base_url("assets/spc/css/Base.css") ?>" rel="stylesheet">
    <link href="<?= base_url("assets/css/frontend.css") ?>" rel="stylesheet">
    <link href="<?= base_url("assets/libraries/swipebox/css/swipebox.css") ?>" rel="stylesheet">

    <script src="<?= base_url("assets/js/jquery-2.1.4.min.js") ?>"></script>
    <script src="<?= base_url("assets/spc/js/bootstrap.min.js") ?>"></script>
    <script src="<?=base_url("assets/libraries/swipebox/js/jquery.swipebox.js")?>"></script>
    <script src="<?=base_url("assets/libraries/jquery-validation/jquery.validate.min.js")?>"></script>
    <?php echo js_asset('functions.js') ?>

    <script type="text/javascript">
        var BASE_URL = '<?=base_url();?>';
        $(document).ready(function(){
            $('.topButtonBox a').click(function() {
                $('html, body').animate({
                    scrollTop: $("body").offset().top
                }, 1000);
            });
        });
    </script>

    <script>
        <!-- Google Web Tracking -->
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-90248747-1', 'auto');
        ga('send', 'pageview');
    </script>

    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
            n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
            document,'script','https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1763661400619877'); // Insert your pixel ID here.

    </script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=1763661400619877&ev=PageView&noscript=1"
        /></noscript>
    <!-- DO NOT MODIFY -->
    <!-- End Facebook Pixel Code -->



</head>

<body>


<!--Header-->
<div class="container">
    <header>
        <?php $this->load->view("components/frontend/navbar"); ?>
    </header>
</div>

<div class="container">
<?php $this->load->view("components/frontend/login"); ?>
</div>
