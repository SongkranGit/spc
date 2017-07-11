<div class="container contentPage" style="min-height: 450px">
    <div class="div_blank"></div>
    <div class="row">
        <div class="container">
        <?php
        $page_gallery = isset($this->data["page"]["page_gallery_detail"])?$this->data["page"]["page_gallery_detail"]:'';
        if (!empty($page_gallery)) {
            if (isEnglishLang()) {
                echo $page_gallery["description_en"];
            } else {
                echo $page_gallery["description_th"];
            }
        }
        ?>
        </div>
    </div>
</div>

<div class="topButtonBox">
    <a href="#" class="img-circle topButton"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
</div>

<script>
    fbq('track', 'ViewContent');
</script>
