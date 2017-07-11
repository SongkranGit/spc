<script>
    fbq('track', 'PageView');
</script>

<!-- ========================= Carousel  ========================= -->
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <?php
        if (isset($this->data["slide_show"])) {
            for ($i = 0; $i < count($this->data["slide_show"]); $i++):?>
                <li data-target="#carousel-example-generic" data-slide-to="0"
                    class="<?php echo ($i == 0) ? "active" : "" ?>"></li>
            <?php endfor;
        } ?>
    </ol>
    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <?php
        if (isset($this->data["slide_show"])) {
            for ($i = 0; $i < count($this->data["slide_show"]); $i++) { ?>
                <div class="item <?php echo ($i == 0) ? "active" : "" ?>">
                    <img src="<?= base_url("uploads/" . $this->data["slide_show"][$i]["file_name"]) ?>" alt="">
                    <?php
                    if (!empty($this->data["slide_show"][$i]["description_en"]) && isEnglishLang()) {
                        echo "<div class=\"carousel-caption\"><div>" . $this->data["slide_show"][$i]["description_en"] . "</div></div>";
                    } else if (!empty($this->data["slide_show"][$i]["description_th"]) && !isEnglishLang()) {
                        echo "<div class=\"carousel-caption\"><div>" . $this->data["slide_show"][$i]["description_th"] . "</div></div>";
                    }
                    ?>
                </div>
            <?php };
        } ?>

    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<!-- /.carousel -->


<!-- Marketing messaging and featurettes
================================================== -->
<!-- Wrap the rest of the page in another container to center all the content. -->

<div class="container-fluid">
    <div class="row greyBG">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2 text-center roundGroup">
            <div class="roundBG ">
                <a href="<?= base_url("Curricula/show/igcse") ?>" class="roundData round1 img-circle">
                    <i class="fa fa-book" aria-hidden="true"></i>
                    <p>IGCSE</p>
                </a>
            </div>
            <div class="roundBG">
                <a href="<?= base_url("Curricula/show/ged") ?>" class="roundData round2 img-circle" href="#">
                    <i class="fa fa-flask" aria-hidden="true"></i>
                    <p>GED</p>
                </a>
            </div>
            <div class="roundBG ">
                <a href="<?= base_url("Curricula/show/toefl") ?>" class="roundData round3 img-circle" href="#">
                    <i class="fa fa-pagelines" aria-hidden="true"></i>
                    <p>TOEFL</p>
                </a>
            </div>
            <div class="roundBG ">
                <a href="<?= base_url("Curricula/show/ielst") ?>" class="roundData round4 img-circle" href="#">
                    <i class="fa fa-adn" aria-hidden="true"></i>
                    <p>IELTS</p>
                </a>
            </div>
            <div class="roundBG ">
                <a href="<?= base_url("Curricula/show/sat") ?>" class="roundData round5 img-circle" href="#">
                    <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                    <p>SAT</p>
                </a>
            </div>
            <div class="roundBG ">
                <a href="<?= base_url("Curricula/show/cu-tep") ?>" class="roundData round6 img-circle" href="#">
                    <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                    <p>CU-TEP</p>
                </a>
            </div>
            <div class="roundBG ">
                <a href="<?= base_url("Curricula/show/tu-get") ?>" class="roundData round7 img-circle" href="#">
                    <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                    <p>TU-GET</p>
                </a>
            </div>
            <div class="roundBG ">
                <a href="<?= base_url("Curricula/show/physic") ?>" class="roundData round8 img-circle" href="#">
                    <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                    <p>PHYSIC</p>
                </a>
            </div>
            <div class="roundBG ">
                <a href="<?= base_url("Curricula/show/math") ?>" class="roundData round9 img-circle" href="#">
                    <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                    <p>MATH</p>
                </a>
            </div>
            <div class="roundBG ">
                <a href="<?= base_url("Curricula/show/chem") ?>" class="roundData round10 img-circle" href="#">
                    <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                    <p>CHEM</p>
                </a>
            </div>
        </div>
        <div class="col-xs-12 presentContent">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center">
                    <?php
                    if (isEnglishLang()) {
                        echo isset($this->data["settings"]["vision_en"]) ? $this->data["settings"]["vision_en"] : "";
                    } else {
                        echo isset($this->data["settings"]["vision_th"]) ? $this->data["settings"]["vision_th"] : "";
                    }
                    ?>
                    <a href="<?php echo base_url("Home/vision") ?>"
                       class="btn btn-primary"><?= $this->lang->line("read_more"); ?></a>
                    <div class="socialBox">
                        <a target="_blank"
                           href="<?php echo isset($this->data["settings"]["facebook_link"]) ? $this->data["settings"]["facebook_link"] : "#" ?>"
                           class="img-circle socialIcon"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="cartoon1">
            <img class="featurette-image img-responsive" src="<?= base_url("assets/spc") ?>/images/cartoon1.png" alt="">
        </div>
    </div>
    <div class="triangle"></div>
    <?php if (!empty($this->data['clips'])): ?>
        <div class="row presentVideo">
            <div class="container">
                <div class="row">
                    <div style="height: 40px">&nbsp;</div>

                    <div class="col-xs-12 col-md-2">
                        <div class="cartoon2">
                            <img class="featurette-image img-responsive"
                                 src="<?= base_url("assets/spc") ?>/images/cartoon2.png" alt="">
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-10">
                        <?php foreach ($this->data['clips'] as $clip): ?>
                            <div class="col-xs-12 col-sm-12 col-md-6 form-group">
                                <!-- 16:9 aspect ratio -->
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item"
                                            src="https://www.youtube.com/embed/<?= isset($clip["youtube_link"]) ? get_youtube_id_from_url($clip["youtube_link"]) : "" ?>"></iframe>
                                </div>
                                <div class="roundContent">
                                    <p>
                                        <?php echo (isEnglishLang()) ? character_limiter($clip['description_en'], 50) : character_limiter($clip['description_th'], 50) ?>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="container">
            <!-- GALLERY -->
            <div class="row">
                <?php if (!empty($this->data['gallery_images'])): ?>
                    <div class="col-xs-12">
                        <h1><?php echo isset($this->data["gallery_images"][0]["gallery_name"]) ? $this->data["gallery_images"][0]["gallery_name"] : ""; ?></h1>
                        <?php if (!empty($this->data["gallery_images"][0]["description"])): ?>
                            <div class="container">
                                <div class="row">
                                    <?php echo isset($this->data["gallery_images"][0]["description"]) ? $this->data["gallery_images"][0]["description"] : ""; ?>
                                </div>
                            </div>
                            <div class="div_blank"></div>
                        <?php endif; ?>

                        <div class="row">
                            <?php if (isset($this->data["gallery_images"]) && count($this->data["gallery_images"]) > 0): ?>
                                <?php foreach ($this->data["gallery_images"] as $item): ?>
                                    <?php $directory_image = "uploads/gallery/" . $this->data['gallery_images'][0]["gallery_id"]; ?>
                                    <div class="col-xs-6 col-sm-4 col-md-3 form-group">
                                        <a href="<?= base_url($directory_image . "/" . $item["file_name"]) ?>"
                                           class="teasorBox swipebox">
                                            <div class="center-cropped">
                                                <img class="featurette-image img-responsive crop"
                                                     src="<?= base_url($directory_image . "/thumb_" . $item["file_name"]) ?>" alt="">
                                            </div>
                                            <span class="mediaHeading"><?php echo (isEnglishLang()) ? character_limiter($item['description_en'], 10) : $item['description_th'] ?></span>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <div class="pull-right">
                            <a href="<?php echo base_url("Gallery/listGalleries") ?>"
                               class="btn btn-primary"><?= $this->lang->line("read_more"); ?></a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- PROMOTION -->

            <!-- Hall of Success -->
            <div class="row">
                <?php if (!empty($this->data['hall_of_success'])): ?>
                    <div class="col-xs-12">
                        <h1><?php echo isset($this->data["hall_of_success"][0]["gallery_name"]) ? $this->data["hall_of_success"][0]["gallery_name"] : ""; ?></h1>
                        <div class="row">
                            <?php if (isset($this->data["hall_of_success"]) && count($this->data["hall_of_success"]) > 0): ?>
                                <?php foreach ($this->data["hall_of_success"] as $item): ?>
                                    <div class="col-xs-6 col-sm-3 col-md-3">
                                        <div class="bgChange" style="text-align: center">
                                            <?php $directory_image = "uploads/gallery/" . $this->data['hall_of_success'][0]["gallery_id"]; ?>
                                            <a href="<?= base_url($directory_image . "/" . $item["file_name"]) ?>"
                                               class="teasorBox swipebox">
                                                <div class="center-cropped text-center">
                                                    <img class="featurette-image img-responsive crop"
                                                         src="<?= base_url($directory_image . "/" . $item["file_name"]) ?>" alt="">
                                                    <p style="color: black; font-weight: bold"><?php echo (isEnglishLang()) ? character_limiter($item['description_en'], 10) : $item['description_th'] ?></p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="topButtonBox">
    <a href="#" class="img-circle topButton"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
</div>

<div class="container-fluid">
    <?php if (!empty($this->data["news"]) && count($this->data["news"]) > 0): ?>
        <div class="row profileFooter">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="col-xs-12 col-md-2 ">
                            <div class="studentImageBox ">
                                <img src="<?= base_url("uploads/news/" . $this->data["news"][0]["file_name"]) ?>"
                                     class="img-circle studentImage">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-8">
                            <p><?php echo (isEnglishLang()) ? character_limiter($this->data["news"][0]["title_en"], 400) : character_limiter($this->data["news"][0]["title_th"], 400); ?></p>
                            <a href="<?php echo base_url("News/detail/" . $this->data["news"][0]["id"]) ?>"
                               class="btn btn-primary"><?= $this->lang->line("read_more"); ?></a>
                        </div>
                        <div class="col-xs-12 col-md-2 footerLogo">
                            <img alt="" class="img-responsive pull-right"
                                 src="<?= base_url("assets/spc/images/logo_footer.png") ?>"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<script type="text/javascript">

    $(document).ready(function () {
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

        $('.carousel').carousel({
            interval: 4000
        });
    });

</script>




