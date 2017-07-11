<?php $this->load->view("components/backend/header"); ?>
<?php $this->load->view("components/backend/navbar"); ?>

<?php
    $arr_courses = (isset($data["courses"]) && $data["courses"] != '')?unserialize($data["courses"]):null;
    $qr_code_id = isset($data["qr_code_id"])?$data["qr_code_id"]:null;
    $is_approve = isset($data["is_approve"])?$data["is_approve"]:0;
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <span><?= $this->lang->line("contact_information"); ?></span>
        </h1>
        <div class="group-buttons-right">
            <ul class="nav nav-pills">
                <li>
                    <a href="<?= base_url(ADMIN_CONTACT) ?>"> <i class="fa fa-list"></i><?= $this->lang->line("contact_button_list_contact"); ?></a>
                </li>
            </ul>
        </div>
    </section>

    <section class="content">
        <form id="form_contact_detail" role="form" class="form-horizontal">
            <div class="panel panel-default">
                <div class="panel-heading heading-create">
                <span>
                    <i class="fa fa-user"></i>
                    <?= $this->lang->line("contact_detail"); ?>
                </span>
                </div>

                <div class="panel-body">

                    <div class="form-group  ">
                        <label class="col-md-2  control-label"><?= $this->lang->line("contact_full_name"); ?></label>
                        <div class="col-md-8">
                            <input type="text" id="full_name" name="full_name" class="form-control"
                                   value="<?php echo isset($data["full_name"]) ? $data["full_name"] : "" ?>">
                        </div>
                    </div>

                    <div class="form-group ">
                        <label class="col-md-2  control-label"><?= $this->lang->line("contact_email"); ?></label>
                        <div class="col-md-8">
                            <input type="text" id="title" name="title" class="form-control"
                                   value="<?php echo isset($data["email"]) ? $data["email"] : "" ?>">
                        </div>
                    </div>

                    <div class="form-group ">
                        <label class="col-md-2  control-label"><?= $this->lang->line("contact_phone"); ?></label>
                        <div class="col-md-8">
                            <input type="text" id="title" name="phone" class="form-control"
                                   value="<?php echo isset($data["phone"]) ? $data["phone"] : "" ?>">
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="col-md-2  control-label"><?= $this->lang->line("contact_age"); ?></label>
                        <div class="col-md-8">
                            <input type="text" id="title" name="phone" class="form-control"
                                   value="<?php echo isset($data["age"]) ? $data["age"] : "" ?>">
                        </div>
                    </div>

                    <div class="form-group ">
                        <label class="col-md-2  control-label"><?= $this->lang->line("contact_line_id"); ?></label>
                        <div class="col-md-8">
                            <input type="text" id="title" name="phone" class="form-control"
                                   value="<?php echo isset($data["line_id"]) ? $data["line_id"] : "" ?>">
                        </div>
                    </div>

                    <div class="form-group ">
                        <label class="col-md-2  control-label"><?= $this->lang->line("contact_education"); ?></label>
                        <div class="col-md-8">
                            <input type="text" id="title" name="address" class="form-control"
                                   value="<?php echo  (isEnglishLang() && isset($data["education_en"]) )?$data["education_en"]: $data["education_th"]?>">
                        </div>
                    </div>

                    <div class="form-group ">
                        <label class="col-md-2  control-label"><?= $this->lang->line("contact_interest_in_course"); ?></label>
                        <div class="col-md-8">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group checkboxContainer">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="courses[]" value="1" <?=($arr_courses != null && $arr_courses[0]== 1 )?"checked":""?> >GED หรือ IGCSE (เทียบวุฒิ ม.6)
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group checkboxContainer">
                                        <div class="checkbox" >
                                            <label>
                                                <input type="checkbox" name="courses[]" value="2" <?=($arr_courses != null && $arr_courses[1]== 2 )?"checked":""?>>TOEFL หรือ IELTS
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group checkboxContainer">
                                        <div class="checkbox" >
                                            <label>
                                                <input type="checkbox" name="courses[]" value="3" <?=($arr_courses != null && $arr_courses[2]== 3 )?"checked":""?>>CU-TEP หรือ TU-GET
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group checkboxContainer">
                                        <div class="checkbox" >
                                            <label>
                                                <input type="checkbox" name="courses[]" value="4" <?=($arr_courses != null && $arr_courses[3]== 4 )?"checked":""?>>SAT, PHYSICS, MATH, CHEM
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if($qr_code_id != null && $qr_code_id != ''):?>
                        <div class="row  ">
                            <div class="col-md-2"></div>
                            <div class="col-md-8"> <a href="<?=base_url("admin/Contact/approveGetCoupon/".$qr_code_id."/1")?>" class="btn btn-success pull-right">อนุมัติรับของ</a></div>
                        </div>
                    <?php endif;?>

                </div>
                <div class="panel-footer">
                    <div class="clearfix"></div>
                </div>
            </div>
        </form>
    </section>


</div><!-- /.content-wrapper -->

<script type="text/javascript">

    $(document).ready(function () {
        $("#form_contact_detail :input").attr("disabled", true);
    });

</script>

<?php $this->load->view("components/backend/footer"); ?>

