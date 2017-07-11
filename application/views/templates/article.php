<div class="container contentPage">
    <div class="row">
        <div class="container">
            <?php
            if (isset($this->data["page"]["body_th"])) {
                if (isEnglishLang()) {
                    echo $this->data["page"]["body_en"];
                } else {
                    echo $this->data["page"]["body_th"];
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
