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

<div class="container contentPage" style="min-height: 580px">
    <!--Paggination row-->
    <div class="row">
        <div class="col-xs-12">

            <?php if (isset($this->data["clip"]["clips"][0])): ?>
                <h1><?php echo isEnglishLang() ? $this->data["clip"]["clips"][0]["category_name_en"] : $this->data["clip"]["clips"][0]["category_name_th"] ?></h1>

                <div class="row">
                    <div class="col-xs-12 text-right">
                        <?php echo $this->data["clip"]["pagination"] ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if (isset($this->data["clip"]["clips"]) && count($this->data["clip"]["clips"]) > 0): ?>
        <?php foreach ($this->data["clip"]["clips"] as $item): ?>
            <a href="http://www.youtube.com/watch?v=<?= get_youtube_id_from_url($item["youtube_link"]) ?>" class="swipebox-video">
                <div class="row hoverRow">
                    <div class="col-md-4">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item"
                                    src="https://www.youtube.com/embed/<?= get_youtube_id_from_url($item["youtube_link"]) ?>"></iframe>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <?php echo isEnglishLang() ? character_limiter($item["description_en"], 500) : character_limiter($item["description_th"], 500); ?>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    <?php endif; ?>

    <div style="margin-bottom: 20px">&nbsp;</div>

</div>
<script type="text/javascript">

    jQuery(function ($) {
        $('.swipebox-video').swipebox();
    });

</script>
<script>
    fbq('track', 'ViewContent');
</script>


