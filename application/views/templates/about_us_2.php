<div class="container contentPage">
    <?php if (isset($this->data["article"]) && !empty($this->data["article"])): ?>
        <?php $article = $this->data["article"]; ?>
        <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <h1><?php echo isset($article["name"]) ? $article["name"] : "" ?></h1>
                <div class="row">
                    <div class="col-xs-12 col-md-4 rightSide">
                        <div class="list-group listSideMenu">
                            <?php if (!empty($this->data["list_article_menu"]) && count($this->data["list_article_menu"]) > 0): ?>

                                <?php foreach ($this->data["list_article_menu"] as $item): ?>
                                    <a href="<?= base_url("Aboutus/sub/" . $item["id"]) ?>" class="list-group-item"
                                       style="<?php echo ($item['id'] == $article["id"]) ? "font-weight: bold" : "" ?>">
                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                        <?php echo $item["name"]; ?>
                                    </a>
                                <?php endforeach; ?>

                            <?php endif; ?>
                        </div>
                        <!-- Single button -->
                    </div>
                    <div class="col-xs-12 col-md-8">
                        <?php if (!empty($article["file_name"])): ?>
                            <img class="img-responsive" src="<?= base_url("uploads/thumb_" . $article["file_name"]) ?>" alt="">
                        <?php endif; ?>
                    </div>

                </div>
            </div>
            <div class="col-xs-12 contentData">
                <p><?php echo isEnglishLang() ? $article["body_en"] : $article["body_th"] ?></p>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php // dump($this->data["article"]["body_th"])?>