<div class="container galleryPage">
    <!--Paggination row-->
    <div class="row">
        <div class="col-xs-12">
            <h1><?php echo (isset($this->data["gallery"]["image_list"][0]["gallery_name"])) ? $this->data["gallery"]["image_list"][0]["gallery_name"] : "" ?></h1>
            <div class="row">
                <div class="col-xs-12 text-right">
                    <?php echo $this->data["gallery"]["pagination"] ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row_generated" id="photo_swipe">
        <?php if (!empty($this->data["gallery"])): ?>
            <?php foreach ($this->data["gallery"]["image_list"] as $item): ?>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <div class="bgChange">
                            <a rel="<?= $item["gallery_name"] ?>" href="<?= base_url("uploads/gallery/".$item["gallery_id"]."/".$item["file_name"]) ?>" class="swipebox">
                                <div class="bgImg"><i class="fa fa-external-link" aria-hidden="true"></i></div>
                                <img class="img-responsive" src="<?= base_url("uploads/gallery/".$item["gallery_id"]."/thumb_" . $item["file_name"]) ?>" alt="image">
                            </a>
                        </div>
                        <div class="caption">
                            <a href="#">
                                <p class="text-center"><?php echo isEnglishLang() ? $item["caption_en"] : $item["caption_th"] ?></p>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<div class="topButtonBox">
    <a href="#" class="img-circle topButton"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
</div>

<script type="text/javascript">

    jQuery(function ($) {
        $('.swipebox').swipebox({
            useCSS: true, // false will force the use of jQuery for animations
            useSVG: true, // false to force the use of png for buttons
            initialIndexOnArray: 0, // which image index to init when a array is passed
            hideCloseButtonOnMobile: false, // true will hide the close button on mobile devices
            removeBarsOnMobile: true, // false will show top bar on mobile devices
            hideBarsDelay: 3000, // delay before hiding bars on desktop
            videoMaxWidth: 1140, // videos max width
            beforeOpen: function () {
            }, // called before opening
            afterOpen: null, // called after opening
            afterClose: function () {
            }, // called after closing
            loopAtEnd: false // true will return to the first image after the last image is reached
        });
    });

</script>