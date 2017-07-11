


<div class="container-fluid">
    <div class="row contentMain contentPage ">
        <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12 text-center roundGroup">
            <div class="roundBG ">
                <a href="<?= base_url("Curricula/show/igcse") ?>" class="roundDataCurricula <?=($this->uri->segment(3)=="igcse"||$this->uri->segment(3)=="")?"round-highlight":"round1"?> img-circle" style="color: <?=($this->uri->segment(3)=="igcse" || ($this->uri->segment(3) == null)) ?"black":"white"?>">
                    <i class="fa fa-book" aria-hidden="true"></i>
                    <p>IGCSE</p>
                </a>
            </div>
            <div class="roundBG">
                <a href="<?= base_url("Curricula/show/ged") ?>" class="roundDataCurricula <?=($this->uri->segment(3)=="ged")?"round-highlight":"round2"?> img-circle" href="#" style="color: <?=($this->uri->segment(3)=="ged")?"black":"white"?>">
                    <i class="fa fa-flask" aria-hidden="true"></i>
                    <p>GED</p>
                </a>
            </div>
            <div class="roundBG">
                <a href="<?= base_url("Curricula/show/toefl") ?>" class="roundDataCurricula <?=($this->uri->segment(3)=="toefl")?"round-highlight":"round3"?> img-circle" href="#" style="color: <?=($this->uri->segment(3)=="toefl")?"black":"white"?>">
                    <i class="fa fa-pagelines" aria-hidden="true"></i>
                    <p>TOEFL</p>
                </a>
            </div>
            <div class="roundBG ">
                <a href="<?= base_url("Curricula/show/ielst") ?>" class="roundDataCurricula <?=($this->uri->segment(3)=="ielst")?"round-highlight":"round4"?> img-circle" href="#" style="color: <?=($this->uri->segment(3)=="ielst")?"black":"white"?>">
                    <i class="fa fa-adn" aria-hidden="true"></i>
                    <p>IELST</p>
                </a>
            </div>
            <div class="roundBG ">
                <a href="<?= base_url("Curricula/show/sat") ?>" class="roundDataCurricula <?=($this->uri->segment(3)=="sat")?"round-highlight":"round5"?> img-circle" href="#" style="color: <?=($this->uri->segment(3)=="sat")?"black":"white"?>">
                    <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                    <p>SAT</p>
                </a>
            </div>
            <div class="roundBG ">
                <a href="<?= base_url("Curricula/show/cu-tep") ?>" class="roundDataCurricula <?=($this->uri->segment(3)=="cu-tep")?"round-highlight":"round6"?> img-circle" href="#" style="color: <?=($this->uri->segment(3)=="cu-tep")?"black":"white"?>">
                    <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                    <p>CU-TEP</p>
                </a>
            </div>
            <div class="roundBG ">
                <a href="<?= base_url("Curricula/show/tu-get") ?>" class="roundDataCurricula <?=($this->uri->segment(3)=="tu-get")?"round-highlight":"round7"?> img-circle" href="#" style="color: <?=($this->uri->segment(3)=="tu-get")?"black":"white"?>">
                    <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                    <p>TU-GET</p>
                </a>
            </div>
            <div class="roundBG ">
                <a href="<?= base_url("Curricula/show/physic") ?>" class="roundDataCurricula <?=($this->uri->segment(3)=="physic")?"round-highlight":"round8"?> img-circle" href="#" style="color: <?=($this->uri->segment(3)=="physic")?"black":"white"?>">
                    <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                    <p>PHYSIC</p>
                </a>
            </div>
            <div class="roundBG ">
                <a href="<?= base_url("Curricula/show/math") ?>" class="roundDataCurricula <?=($this->uri->segment(3)=="math")?"round-highlight":"round9"?> img-circle" href="#" style="color: <?=($this->uri->segment(3)=="math")?"black":"white"?>">
                    <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                    <p>MATH</p>
                </a>
            </div>
            <div class="roundBG ">
                <a href="<?= base_url("Curricula/show/chem") ?>" class="roundDataCurricula <?=($this->uri->segment(3)=="chem")?"round-highlight":"round10"?> img-circle" href="#" style="color: <?=($this->uri->segment(3)=="chem")?"black":"white"?>">
                    <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                    <p>CHEM</p>
                </a>
            </div>
        </div>
        </div>
    </div>
</div>
<?php if(isset($this->data["article"]) && !empty($this->data["article"])): ?>
<div class="container" >
    <div class="row">
        <div class="col-xs-12 contentData" style="min-height: 130px">
            <p><?php echo isEnglishLang()?$this->data["article"]["body_en"]:$this->data["article"]["body_th"];?></p>
        </div>
    </div>
</div>
<?php endif;?>
<script>
    fbq('track', 'ViewContent');
</script>
