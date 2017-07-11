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
            <h1><?= $this->lang->line("knowledge"); ?></h1>

            <div class="row">
                <div class="col-xs-12 text-right">
                    <?php echo $pagination ?>
                </div>
            </div>
        </div>
    </div>

    <?php //dump($article_list)?>

    <?php if (isset($article_list) && count($article_list) > 0): ?>
        <?php for ($i = 0; $i < count($article_list); $i++): ?>
            <?php
            $index = $i;
            $row = $article_list[$i];
            ?>
            <div class="row hoverRow">
                <a href="<?=base_url("Article/knowledge_detail/".$row["id"])?>">
                <div class="col-md-12"> <i class="fa fa-book"></i>  <?php echo isEnglishLang() ? character_limiter($row["title_en"], 100) : character_limiter($row["title_th"], 100); ?></div>
                </a>
            </div>
        <?php endfor; ?>
    <?php endif; ?>

    <div style="margin-bottom: 20px">&nbsp;</div>

</div>

<script>
    fbq('track', 'ViewContent');
</script>

