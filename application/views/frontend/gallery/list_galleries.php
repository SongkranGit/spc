<div class="container galleryPage">
    <!--Paggination row-->
    <div class="row">
        <div class="col-xs-12">
            <h1>แกลลอรี่ทั้งหมด</h1>
            <div class="row">
                <div class="col-xs-12 text-right">
                    <?php // echo $this->data["gallery"]["pagination"] ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row_generated" >
        <?php if (!empty($this->data["gallery"])): ?>
            <?php foreach ($this->data["gallery"]["list_galleries"] as $item): ?>
                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <div>
                                <a rel="<?= $item["name"] ?>" href="<?= base_url("Gallery/detail/".$item["gallery_id"] ) ?>" class="swipebox">
                                    <div class="bgImg"><i class="fa fa-external-link" aria-hidden="true"></i></div>
                                    <?php if(!empty($item["file_name"])): ?>
                                        <img class="img-responsive" src="<?= base_url("uploads/gallery/".$item["gallery_id"]."/thumb_" . $item["file_name"]) ?>" alt="image">
                                     <?php else: ?>
                                        <img class="img-responsive" src="<?= base_url("assets/images/image-not-found.png") ?>" alt="image">
                                     <?php endif?>
                                </a>
                        </div>
                        <div class="caption">
                            <a href="<?= base_url("Gallery/detail/".$item["gallery_id"]) ?>">
                                <p><?php // echo isEnglishLang() ? $item["description_en"] : $item["description_th"] ?></p>
                                <p><?php echo  $item["name"]  ?></p>
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
