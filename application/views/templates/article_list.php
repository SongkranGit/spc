<style type="text/css">

    div.hoverRow {
        cursor: pointer;
        border: 1px solid rgba(174, 174, 174, 0.08);
        padding: 3px;
    }

    div.hoverRow:hover {
        background-color: #e3e3e3;
    }
</style>

<div class="container contentPage" style="min-height: 50px">
    <!--Paggination row-->
    <div class="row">
        <div class="col-xs-12">
            <h1><?= $this->lang->line("news_list"); ?></h1>

            <div class="row">
                <div class="col-xs-12 text-right">
                    <?php echo $this->data["news"]["pagination"] ?>
                </div>
            </div>
        </div>
    </div>

    <?php if (isset($this->data["articles"]["news_list"]) && count($this->data["news"]["news_list"]) > 0): ?>
        <?php for ($i = 0; $i < count($this->data["news"]["news_list"]); $i++): ?>
            <?php
            $index = $i;
            $news_data = $this->data["news"]["news_list"][$i];
            ?>
            <div class="row hoverRow">
                <a href="<?=base_url("News/"."detail/".$news_data["id"])?>">
                    <div class="col-md-3"><img class="img-responsive" src="<?= base_url("uploads/thumb_" . $news_data["file_name"]) ?>"></div>
                    <div class="col-md-9">  <?php echo isEnglishLang() ? character_limiter($news_data["title_en"], 500) : character_limiter($news_data["title_th"], 500); ?></div>
                </a>
            </div>
        <?php endfor; ?>
    <?php endif; ?>

    <div style="margin-bottom: 20px">&nbsp;</div>

</div>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
//        $(".clickable-row").click(function () {
//            window.document.location = $(this).data("href");
//        });
    });

</script>

<script>
    fbq('track', 'ViewContent');
</script>
