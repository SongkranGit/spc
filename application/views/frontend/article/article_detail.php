<?php
$module = $this->uri->segment(1);
$page = $this->uri->segment(2);
?>
<link rel="stylesheet" href="<?= base_url("assets/libraries/jquery-bxslider/jquery.bxslider.css") ?>">
<script src="<?= base_url("assets/libraries/jquery-bxslider/jquery.bxslider.min.js") ?>"></script>

<div class="container contentPage" style="min-height: 580px">
    <?php if (!empty($article)): ?>
        <div class="row">
            <div class="col-xs-12">
                <h1><?php echo isEnglishLang() ? $article["name_en"] : $article["name_th"] ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <?php if(!empty($images)): ?>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <?php if ($images != null): ?>
                            <ul class="bxslider">
                                <?php foreach ($images as $item): ?>
                                    <li><img src=<?= base_url("uploads/article/" . $item["image_name"]) ?>></li>
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
                                    <a data-slide-index=<?= $count++ ?> href=""><img height="100" src=<?= base_url("uploads/article/thumb_" . $item["image_name"]) ?>></a>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="col-xs-12" style="height:20px;"></div>
                <div class="row">
                    <div class="col-xs-12">
                        <?php if (isset($article["body_th"])): ?>
                            <?php echo isEnglishLang() ? $article["body_en"] : $article["body_th"]; ?>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="container">
        <div class="fb-like" data-href="<?php base_url($module . "/" . $page) ?>" data-layout="standard" data-action="like" data-size="small" data-show-faces="true"
             data-share="true"></div>
    </div>

    <div class="row">
        <div class="container">
            <div class="fb-comments" data-href="<?php base_url($module . "/" . $page) ?>" data-width="100%" data-numposts="15"
                 data-colorscheme="light" data-mobile="false" data-order-by="reverse_time"></div>
        </div>
    </div>

</div>

<div class="topButtonBox">
    <a href="#" class="img-circle topButton"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
</div>

<script>
    $('.bxslider').bxSlider({
        pagerCustom: '#bx-pager'
    });

</script>
<script>
    fbq('track', 'ViewContent');
</script>