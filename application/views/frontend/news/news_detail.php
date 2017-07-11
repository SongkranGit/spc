<div class="container contentPage" style="min-height: 500px">
    <?php
    if (!empty($this->data["news_detail"])):
        $row = $this->data["news_detail"];
        ?>
        <div class="row">
            <div class="col-xs-12">
                <h1><?= isset($row["name"]) ? $row["name"] : "" ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="col-xs-12" style="height:20px;"></div>
                <div class="row">
                    <div class="col-xs-12">
                        <?php echo isEnglishLang() ? $row["body_en"] : $row["body_th"]; ?>
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
    fbq('track', 'ViewContent');
</script>
