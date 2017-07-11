<link rel="stylesheet" href="<?= base_url("assets/libraries/jquery-bxslider/jquery.bxslider.css") ?>">
<script src="<?= base_url("assets/libraries/jquery-bxslider/jquery.bxslider.min.js") ?>"></script>


<div class="container contentPage">
    <?php if ($record != null): ?>
        <div class="row">
            <div class="col-xs-12 text-center">
                <h1><?php echo isEnglishLang() ? $record["title_en"] : $record["title_th"] ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <?php if ($images != null): ?>
                            <ul class="bxslider">
                                <?php foreach ($images as $item): ?>
                                    <li><img src=<?= base_url("uploads/gallery/".$item["gallery_id"] ."/". $item["file_name"]) ?>></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="container">
                        <div id="bx-pager">
                            <?php if ($images != null): $count = 0; ?>
                                <?php foreach ($images as $item): ?>
                                    <a data-slide-index=<?= $count++ ?> href=""><img height="100" src=<?= base_url("uploads/gallery/".$item["gallery_id"]."/thumb_" . $item["file_name"]) ?>></a>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12" style="height:20px;"></div>
                <div class="row">
                    <div class="col-xs-12">
                        <?php echo isEnglishLang() ? $record["body_en"] : $record["body_th"]; ?>
                    </div>
                </div>

                    <div class="container">
                        <div class="fb-like" data-href="<?php base_url("Article/visit") ?>" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                    </div>


                <div class="row">
                    <div class="container">
                        <div class="fb-comments" data-href="<?php base_url("Article/visit") ?>" data-width="100%" data-numposts="15"
                             data-colorscheme="light" data-mobile="false" data-order-by="reverse_time"></div>
                    </div>
                </div>

            </div>
        </div>

    <?php endif; ?>
</div>

<div class="topButtonBox">
    <a href="#" class="img-circle topButton"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
</div>

<script>
    $('.bxslider').bxSlider({
        pagerCustom: '#bx-pager'
    });

</script>

<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.8&appId=1721568341449462";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<script>
    fbq('track', 'ViewContent');
</script>