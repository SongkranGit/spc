<script src="<?= base_url("assets/js/moment-with-locales.js") ?>"></script>
<script src="<?= base_url("assets/libraries/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js") ?>"></script>
<script src="<?= base_url("assets/js/bootstrap-filestyle.min.js") ?>"></script>
<?php echo js_asset('functions.js') ?>
<div class="loading-spinner">
    <img src="<?= base_url("assets/images/spinner.gif") ?>">
</div>

<div class="formContainer loginPage">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <form id="form_student_application">
                    <div class="row highlight">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h1>กรอกข้อมูลแบบฟอร์ม</h1>

                            <div class="row">

                                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">วันที่</label>
                                        <div class='col-sm-12 input-group date' id='datetime_picker_register_date'>
                                            <input type='text' class="form-control" name="registered_date"
                                                   value="<?php echo isset($data["row"]["registered_date"]) ? $data["row"]["registered_date"] : "" ?>"/>
                                             <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                        </div>
                                    </div>

                                    <div class="form-group required ">
                                        <label class="control-label">ชื่อ</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name">
                                    </div>

                                    <div class="form-group required">
                                        <label class="control-label">Name in English : Capital Letter</label>
                                        <input type="text" class="form-control" id="eng_name" name="eng_name">
                                    </div>

                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-6 ">
                                    <div class="form-group required">
                                        <div class="profile">
                                            <img id="img_picture_profile" width="170" src="<?= base_url("assets/spc/images/blank_person.png") ?>" alt="..."
                                                 class="img-thumbnail crop">
                                            <div class="form-group ">
                                                <input type="file" id="picture_profile" name="user_files">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group required ">
                                        <label class="control-label">นามสกุล</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name">
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label">เกิดเมื่อ</label>
                                        <div class='col-sm-12 input-group date' id='datetime_picker_birth_date'>
                                            <input type='text' class="form-control" name="birth_date"
                                                   value="<?php echo isset($data["row"]["birth_date"]) ? $data["row"]["birth_date"] : "" ?>"/>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                                    <div class="form-group required">
                                        <label class="control-label">ชื่อเล่น</label>
                                        <input type="text" class="form-control" id="exampleInputtext1">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">อายุ</label>
                                        <input type="number" class="form-control" name="age">
                                    </div>

                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">เลขที่บัตรประชาชน หรือ Passport</label>
                                        <input type="text" class="form-control" name="personal_id">
                                    </div>

                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group checkboxContainer">
                                        <label class="control-label">ศาสนา</label>

                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="1" name="religion"> พุทธ
                                            </label>

                                            <label>
                                                <input type="checkbox" value="2" name="religion"> คริสต์
                                            </label>

                                            <label>
                                                <input type="checkbox" value="3" name="religion"> อิสลาม
                                            </label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>ที่อยู่ (Address)</label>
                                        <textarea class="form-control" rows="3" name="address"></textarea>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>รหัสไปรษณีย์ (Area code)</label>
                                        <input type="text" class="form-control" name="post_code">
                                    </div>
                                    <div class="form-group">
                                        <label>โทรศัพท์ที่บ้าน (Home Phone)</label>
                                        <input type="text" class="form-control" name="phone">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>มือถือ (Mobile Phone)</label>
                                        <input type="text" class="form-control" name="mobile">
                                    </div>

                                    <div class="form-group">
                                        <label>อีเมล์</label>
                                        <input type="text" class="form-control" name="email">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>ID Line</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Facebook ID</label>
                                        <input type="text" class="form-control" name="facebook_id">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>กำลังเรียนอยู่เกรด</label>
                                        <input type="text" class="form-control" name="study_grade">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>โรงเรียน</label>
                                        <input type="text" class="form-control" name="school_name">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>ประเทศ</label>
                                        <input type="text" class="form-control" name="country">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>รู้จัก Study Plus จาก</label>
                                        <input type="text" class="form-control" name="how_know_spc">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row highlight">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h1>กรณีฉุกเฉิน บุคคลที่สามารถติดต่อได้ </h1>

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>คุณพ่อชื่อ</label>
                                        <input type="text" class="form-control" name="father_name">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>โทรศัพท์</label>
                                        <input type="text" class="form-control" name="father_phone">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Line ID</label>
                                        <input type="text" class="form-control" name="father_line_id">
                                    </div>
                                </div>

                            </div>
                            <div class="row">

                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>คุณแม่ชื่อ</label>
                                        <input type="text" class="form-control" name="mather_name">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>โทรศัพท์</label>
                                        <input type="text" class="form-control" name="mather_phone">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Line ID</label>
                                        <input type="text" class="form-control" name="mather_line_id">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row highlight">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h1>ต้องการสมัครเรียนคอร์ส </h1>

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="radio">
                                        <label>
                                            <input type="radio"> GED
                                        </label>

                                        <p>- Writing</p>

                                        <p>- Social Studies</p>

                                        <p>- Science</p>

                                        <p>- Mathematics</p>
                                    </div>

                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="courses"> GICSE
                                        </label>
                                        <input type="text" class="form-control" name="course_detail_gicse">
                                    </div>

                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="courses"> SAT
                                        </label>
                                        <input type="text" class="form-control" name="course_detail_sat">
                                    </div>

                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="courses"> IELTS/TOEFL
                                        </label>
                                    </div>

                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="courses"> CU-TEP/TU-GET
                                        </label>
                                    </div>

                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="courses"> CU-ATS
                                        </label>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="courses"> MATH
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="courses"> CHEMISTRY
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="courses"> PHYSICS
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="courses"> BIOLOGY
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="courses"> ADV WRITING
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="courses"> ADV READING
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio"> OTHER
                                        </label>
                                        <input type="text" class="form-control" name="other_course">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row highlight ">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h1>ต้องการเรียนต่อมหาวิทยาลัย</h1>

                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group ">
                                    <label class="control-label">ต้องการศึกษาต่อ</label>
                                    <div class="form-group">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" value="0" name="study_in_country"> ในประเทศ
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" value="1" name="study_in_country"> ต่างประเทศ
                                        </label>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group ">
                                    <label>คณะที่อยากเข้าต่อ</label>
                                    <input type="text" class="form-control" name="favorite_faculty">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label>มหาวิทยาลัยในดวงใจ</label>
                                    <input type="text" class="form-control" name="favorite_university">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row highlight">
                        <div>&nbsp;</div>
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary">ส่งข้อมูล</button>
                        </div>

                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

<div class="topButtonBox">
    <a href="#" class="img-circle topButton"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
</div>

<script type="text/javascript">

    var validator;
    var form_input = $('#form_student_application');

    $(document).ready(function () {

        validateForm();

        $('#datetime_picker_register_date').datetimepicker({
            locale: 'th',
            format: "YYYY-MM-DD",
            defaultDate: new Date()
        });

        $('#datetime_picker_birth_date').datetimepicker({
            locale: 'th',
            format: "YYYY-MM-DD"
        });

        $(":file").filestyle({input: false});

        $("#picture_profile").change(function () {
            readURL(this);
        });

    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img_picture_profile').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function validateForm() {
        validator = form_input.validate({
            rules: {
                first_name: "required",
                last_name: "required",
                eng_name: "required",
                nick_name: "required"
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
        var targetUrl = BASE_URL + 'Student/create';
        showSpinner();
        $.ajax({
            type: 'POST',
            url: targetUrl,
            data: form_input.serializefiles(),
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                hideSpinner();
                if (response.success == true) {
                    alert("บันทึกข้อมูลเรียบร้อย");
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
        window.location = BASE_URL + 'Student/create';
    }

</script>