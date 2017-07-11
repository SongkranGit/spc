<?php
$page = (isset($this->data["page"]))?$this->data["page"]:'';
$page_gallery = (isset($this->data["page_gallery"]))?$this->data["page_gallery"]: '';
?>

<div class="container contentPage" style="min-height: 450px">
    <div class="div_blank"></div>
    <div class="row">
        <div class="container">
            <?php
            if (isset($page["body_th"])) {
                if (isEnglishLang()) {
                    echo $page["body_en"];
                } else {
                    echo $page["body_th"];
                }
            }
            ?>
        </div>
    </div>
    <!--Gallery-->
    <div class="row_generated">
        <?php if (!empty($page_gallery)): ?>
            <?php foreach ($page_gallery as $item): ?>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <div>
                            <a href="<?php echo base_url("Aboutus/page/" . $page["name"] . '/' . $item["id"]) ?>">
                                <div class="bgImg"><i class="fa fa-external-link" aria-hidden="true"></i></div>
                                <img style="max-height: 150px"
                                     src="<?= base_url("uploads/gallery/".$item["gallery_id"]."/thumb_" . $item["file_name"]) ?>" alt="image">
                            </a>
                        </div>
                        <div class="caption">
                            <a href="<?php echo base_url("Aboutus/page/" . $page["name"] . '/' . $item["id"]) ?>">
                                <p ><?php echo isEnglishLang() ? character_limiter($item["caption_en"], 80) : character_limiter($item["caption_th"], 80)?></p>
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
<script>
    fbq('track', 'ViewContent');
</script>

