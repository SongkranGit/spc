<?php echo js_asset('functions.js') ?>

<div class="loading-spinner">
    <img src="<?= base_url("assets/images/spinner.gif") ?>">
</div>

<div class="container contentPage" style="min-height: 580px">
    <div class="container-fluid">
        <div class="row">
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
<!--        <div class="row">
            <div class="container-fluid contactContainer">
                <div class="container">
                    <div class="col-xs-12 col-md-4 col-lg-4">
                        <div class="contactInfo">
                            <div class="media">
                                <div class="media-left media-top">
                                    <div class="contactIcon img-circle">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    </div>

                                </div>
                                <div class="media-body">
                                    <h3 class="media-heading"><?/*= $this->lang->line("contact_address"); */?></h3>

                                    <p><?php /*echo isset($this->data["settings"]["address_th"]) ? (isEnglishLang()) ? $this->data["settings"]["address_en"] : $this->data["settings"]["address_th"] : "" */?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-4 col-lg-4">
                        <div class="contactInfo">
                            <div class="media">
                                <div class="media-left media-top">
                                    <div class="contactIcon img-circle">
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h3 class="media-heading"><?/*= $this->lang->line("contact_tel"); */?></h3>
                                    <p><?php /*echo isset($this->data["settings"]["phone"]) ? $this->data["settings"]["phone"] : "" */?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-4 col-lg-4">
                        <div class="contactInfo">
                            <div class="media">
                                <div class="media-left media-top">
                                    <div class="contactIcon img-circle">
                                        <i class="fa fa-mobile" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h3 class="media-heading"><?/*= $this->lang->line("contact_mobile"); */?></h3>

                                    <p><?php /*echo isset($this->data["settings"]["mobile"]) ? $this->data["settings"]["mobile"] : "" */?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-4 col-lg-4">
                        <div class="contactInfo">
                            <div class="media">
                                <div class="media-left media-top">
                                    <div class="contactIcon img-circle">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h3 class="media-heading"><?/*= $this->lang->line("contact_email"); */?></h3>

                                    <p><?php /*echo isset($this->data["settings"]["email"]) ? $this->data["settings"]["email"] : "" */?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-4 col-lg-4">
                        <div class="contactInfo">
                            <div class="media">
                                <div class="media-left media-top">
                                    <div class="contactIcon img-circle">
                                        <i class="fa fa-comment" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h3 class="media-heading"><?/*= $this->lang->line("contact_line_id"); */?></h3>

                                    <p><?php /*echo isset($this->data["settings"]["line_id"]) ? $this->data["settings"]["line_id"] : "" */?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
    </div>
   <!-- <div class="formContainer">
        <div class="row">
            <div class="container">
                <form id="form_contact">
                    <div class="col-md-12">
                        <h1><?/*= $this->lang->line("contact_title_input_form"); */?> </h1>
                    </div>
                    <div class="col-md-12">

                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?/*= $this->lang->line("contact_name"); */?></label>
                            <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1"><?/*= $this->lang->line("contact_tel"); */?></label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Number Phone">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?/*= $this->lang->line("contact_email"); */?></label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1"><?/*= $this->lang->line("contact_age"); */?></label>
                            <input type="number" class="form-control" id="age" name="age" max="99" placeholder="Age">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?/*= $this->lang->line("contact_education"); */?></label>
                            <select class="form-control" name="education" style="height: 37px">
                                <?php /*if (!empty($this->data["educations"]) && count($this->data["educations"]) > 0): */?>
                                    <?php /*foreach ($this->data["educations"] as $item): */?>
                                        <option value="<?/*= $item["id"] */?>">
                                            <?php /*echo isEnglishLang() ? $item["education_en"] : $item["education_th"] */?></option>
                                    <?php /*endforeach; */?>
                                <?php /*endif; */?>
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label><?/*= $this->lang->line("contact_line_id"); */?></label>
                            <input type="text" class="form-control" id="line_id" name="line_id" placeholder="Line Id">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label><?/*= $this->lang->line("contact_interest_in_course"); */?></label>

                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group checkboxContainer">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="courses[]" value="1">GED หรือ IGCSE (เทียบวุฒิ ม.6)
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group checkboxContainer">
                                        <div class="checkbox" >
                                            <label>
                                                <input type="checkbox" name="courses[]" value="2">TOEFL หรือ IELTS
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group checkboxContainer">
                                        <div class="checkbox" >
                                            <label>
                                                <input type="checkbox" name="courses[]" value="3">CU-TEP หรือ TU-GET
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group checkboxContainer">
                                        <div class="checkbox" >
                                            <label>
                                                <input type="checkbox" name="courses[]" value="4">SAT, PHYSICS, MATH, CHEM
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="hd_courses_list" name="courses_list">

                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="note"><?/*= $this->lang->line("contact_note"); */?></label>
                            <textarea class="form-control" rows="3" name="note"></textarea>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary"><?/*= $this->lang->line("btn_send"); */?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>-->
</div>

<!--<div class="topButtonBox">-->
<!--    <a href="#" class="img-circle topButton"><i class="fa fa-angle-up" aria-hidden="true"></i></a>-->
<!--</div>-->
<script type="text/javascript">

    var validator;
    var form_input = $('#form_contact');

    $(document).ready(function () {
        validateForm();
    });

    function validateForm() {
        validator = form_input.validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                full_name: "required",
                note: "required",
                "courses[]" :"required"
            },
            messages: {
                full_name: '<?php echo $this->lang->line("message_this_field_is_require");?>',
                email: {
                    required: '<?php echo $this->lang->line("message_this_field_is_require");?>',
                    email: '<?php echo $this->lang->line("message_email_not_valid");?>'
                },
                note: '<?php echo $this->lang->line("message_this_field_is_require");?>'
            },
            highlight: function (element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function (element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function (error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form) {
                save();
            }
        });
    }


    function save() {
        var targetUrl = BASE_URL + 'Contactus/create';
        setValueCheckbox();
        showSpinner();
        $.ajax({
            type: 'POST',
            url: targetUrl,
            data: form_input.serialize(),
            dataType: 'json',
            success: function (response) {
                hideSpinner();
                if (response.success == true) {
                    alert('บันทึกข้อมูลสำเร็จ');
                    clearForm();
                } else {
                    $.each(response.messages, function (key, value) {
                        var element = $('#' + key);
                        element.closest('div.form-group')
                            .removeClass('has-error')
                            .addClass(value.length > 0 ? 'has-error' : 'has-success')
                            .find('.text-danger')
                            .remove();
                        element.after(value);
                    });
                }
            },
            error: function (request, status, error) {
                hideSpinner();
                clearForm();
                alert(request.responseText);
            }
        });
    }

    function clearForm() {
        validator.resetForm();
        form_input[0].reset();
    }
    
    function setValueCheckbox() {
        var values = new Array();
        $.each($("input[name='courses[]'] "), function() {
            if ($(this).is(':checked')) {
                values.push($(this).val());
            }else{
                values.push(0);
            }
        });

        $('#hd_courses_list').val(values);
    }

</script>

<script>
    fbq('track', 'Lead');
</script>

