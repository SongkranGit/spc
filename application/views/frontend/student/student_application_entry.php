<link rel="stylesheet"
      href="<?= base_url("assets/libraries/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css") ?>">
<script src="<?= base_url("assets/js/moment-with-locales.js") ?>"></script>
<script src="<?= base_url("assets/libraries/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js") ?>"></script>
<script src="<?= base_url("assets/js/bootstrap-filestyle.min.js") ?>"></script>
<script src="<?= base_url("assets/js/load-image.all.min.js") ?>"></script>
<script src="<?= base_url("assets/js/exif.js") ?>"></script>
<?php echo js_asset('functions.js') ?>

<div class="loading-spinner">
    <img src="<?= base_url("assets/images/spinner.gif") ?>">
</div>
<style>

    .input-group {
        position: relative;
        display: table;
        border-collapse: separate;
        text-align: center;
        margin: 0 auto;
        /* padding-top: 10px;*/
    }

    #img_picture_profile {
        height: 170px;
    }

    #img_id_card {
        height: 170px;
    }

</style>

<?php
//dump($this->data["student"]);
$student = isset($this->data["student"]) ? $this->data["student"] : "";
$arr_courses = isset($student["courses"]) ? unserialize($student["courses"]) : null;

?>

<div class="formContainer loginPage">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <form id="form_student_application">
                    <div class="row highlight">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="row">
                                <h1>กรอกข้อมูลแบบฟอร์ม <a href="<?= base_url("Home") ?>" class="pull-right"><i
                                            class="fa fa-close fa-2x "></i></a></h1>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">วันที่บันทึก</label>
                                        <div class='input-group date'
                                             id='datetime_picker_register_date'>
                                            <input type='text' class="form-control" name="registered_date"
                                                   value="<?php echo isset($student["registered_date"]) ? $student["registered_date"] : "" ?>"/>
                                                <span class="input-group-addon"><span
                                                        class="glyphicon glyphicon-calendar"></span>
                                        </div>
                                    </div>
                                    <div class="form-group required ">
                                        <label class="control-label">ชื่อ-สกุล</label>
                                        <input type="text" class="form-control" id="full_name" name="full_name"
                                               value="<?php echo isset($student["full_name"]) ? $student["full_name"] : "" ?>">
                                    </div>

                                    <div class="form-group required">
                                        <label class="control-label">Name in English : Capital Letter</label>
                                        <input type="text" class="form-control" id="eng_name" name="eng_name"
                                               value="<?php echo isset($student["eng_name"]) ? $student["eng_name"] : "" ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!--PROFILE-->
                                    <div class="col-sm-6 col-md-6">
                                        <div class="profile text-center">
                                            <div style="font-weight: 700" class="text-center">รูปโปรไฟล์</div>
                                            <div id="show_profile"></div>
                                            <?php if (isset($student["picture_profile"])): ?>
                                                <img id="img_picture_profile" height="120" width="120"
                                                     src="<?= base_url("uploads/user-profile/" . $student["picture_profile"]) ?>"
                                                     class="img-thumbnail crop">
                                            <?php else:; ?>
                                                <img id="img_picture_profile"
                                                     src="<?= base_url("assets/spc/images/blank_person.png") ?>"
                                                     class="img-thumbnail crop">
                                            <?php endif; ?>
                                            <div class="form-group " style="margin-top: 5px;">
                                                <input type="file" id="picture_profile" name="user_files">
                                                <input type="hidden" id="picture_profile_file_name"
                                                       name="picture_profile_file_name">
                                            </div>
                                        </div>
                                    </div>
                                    <!--ID CARD-->
                                    <div class="col-sm-6 col-md-6">
                                        <div class="profile text-center">
                                            <div style="font-weight: 700">บัตรประชาชน</div>
                                            <div id="show_id_card"></div>
                                            <?php if (isset($student["id_card_file"]) && !empty($student["id_card_file"])): ?>
                                                <img id="img_id_card"
                                                     src="<?= base_url("uploads/user-profile/" . $student["id_card_file"]) ?>"
                                                     class="img-thumbnail crop">
                                            <?php else:; ?>
                                                <img id="img_id_card" s
                                                     src="<?= base_url("assets/spc/images/image-not-found.png") ?>"
                                                     class="img-thumbnail crop">
                                            <?php endif; ?>
                                            <div class="form-group " style="margin-top: 5px">
                                                <input type="file" id="file_id_card" name="file_id_card">
                                                <input type="hidden" id="idcard_file_name" name="idcard_file_name">
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group required">
                                        <label class="control-label">ชื่อเล่น</label>
                                        <input type="text" class="form-control" name="nick_name"
                                               value="<?php echo isset($student["nick_name"]) ? $student["nick_name"] : "" ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label class="control-label">เกิดเมื่อ</label>
                                                <div class='input-group date' id='datetime_picker_birth_date'>
                                                    <input type='text' class="form-control" name="birth_date"
                                                           value="<?php echo isset($student["birth_date"]) ? $student["birth_date"] : "" ?>"/>
                                                    <span class="input-group-addon"><span
                                                            class="glyphicon glyphicon-calendar"></span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">อายุ</label>
                                                <input type="number" class="form-control" name="age"
                                                       value="<?php echo isset($student["age"]) ? $student["age"] : "" ?>">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">เลขที่บัตรประชาชน หรือ Passport</label>
                                        <input type="text" class="form-control" name="personal_id"
                                               value="<?php echo isset($student["personal_id"]) ? $student["personal_id"] : "" ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group checkboxContainer">
                                        <label class="control-label">ศาสนา</label>

                                        <div class="checkbox">
                                            <label>
                                                <input type="radio" value="1"
                                                       name="religion" <?= (isset($student["religion"]) && $student["religion"] == 1) ? "checked" : "" ?> >
                                                พุทธ
                                            </label>

                                            <label>
                                                <input type="radio" value="2"
                                                       name="religion" <?= (isset($student["religion"]) && $student["religion"] == 2) ? "checked" : "" ?>>
                                                คริสต์
                                            </label>

                                            <label>
                                                <input type="radio" value="3"
                                                       name="religion" <?= (isset($student["religion"]) && $student["religion"] == 3) ? "checked" : "" ?>>
                                                อิสลาม
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>ที่อยู่ (Address)</label>
                                        <textarea class="form-control" rows="2"
                                                  name="address"><?php echo isset($student["address"]) ? $student["address"] : "" ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>รหัสไปรษณีย์ (Area code)</label>
                                <input type="text" class="form-control" name="post_code"
                                       value="<?php echo isset($student["post_code"]) ? $student["post_code"] : "" ?>">
                            </div>
                            <div class="form-group">
                                <label>โทรศัพท์ที่บ้าน (Home Phone)</label>
                                <input type="text" class="form-control" name="phone"
                                       value="<?php echo isset($student["phone"]) ? $student["phone"] : "" ?>">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>มือถือ (Mobile Phone)</label>
                                <input type="text" class="form-control" name="mobile"
                                       value="<?php echo isset($student["mobile"]) ? $student["mobile"] : "" ?>">
                            </div>

                            <div class="form-group">
                                <label>อีเมล์</label>
                                <input type="text" class="form-control" name="email"
                                       value="<?php echo isset($student["email"]) ? $student["email"] : "" ?>">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>ID Line</label>
                                <input type="text" class="form-control" name="line_id"
                                       value="<?php echo isset($student["line_id"]) ? $student["line_id"] : "" ?>">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Facebook ID</label>
                                <input type="text" class="form-control" name="facebook_id"
                                       value="<?php echo isset($student["facebook_id"]) ? $student["facebook_id"] : "" ?>">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>กำลังเรียนอยู่เกรด</label>
                                <input type="text" class="form-control" name="study_grade"
                                       value="<?php echo isset($student["study_grade"]) ? $student["study_grade"] : "" ?>">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>โรงเรียน</label>
                                <input type="text" class="form-control" name="school_name"
                                       value="<?php echo isset($student["school_name"]) ? $student["school_name"] : "" ?>">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>ประเทศ</label>
                                <input type="text" class="form-control" name="country"
                                       value="<?php echo isset($student["country"]) ? $student["country"] : "" ?>">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>รู้จัก Study Plus จาก</label>
                                <input type="text" class="form-control" name="how_know_spc"
                                       value="<?php echo isset($student["how_know_spc"]) ? $student["how_know_spc"] : "" ?>">
                            </div>
                        </div>

                    </div><!--End-->

                    <div class="row highlight">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h1>กรณีฉุกเฉิน บุคคลที่สามารถติดต่อได้ </h1>

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-5">
                                    <div class="form-group">
                                        <label>ชื่อ-สกุล บิดา</label>
                                        <input type="text" class="form-control" name="father_name"
                                               value="<?php echo isset($student["father_name"]) ? $student["father_name"] : "" ?>">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <label>อาชีพ</label>
                                        <select name="father_occupation" class="form-control">
                                            <option
                                                value="1" <?= (isset($student["father_occupation"]) && $student["father_occupation"] == 1) ? "selected" : "" ?> >
                                                ธุรกิจส่วนตัว
                                            </option>
                                            <option
                                                value="2" <?= (isset($student["father_occupation"]) && $student["father_occupation"] == 2) ? "selected" : "" ?>>
                                                พนักงานบริษัท
                                            </option>
                                            <option
                                                value="3" <?= (isset($student["father_occupation"]) && $student["father_occupation"] == 3) ? "selected" : "" ?>>
                                                ข้าราชการ
                                            </option>
                                            <option
                                                value="4" <?= (isset($student["father_occupation"]) && $student["father_occupation"] == 4) ? "selected" : "" ?>>
                                                แม่บ้าน
                                            </option>
                                            <option
                                                value="5" <?= (isset($student["father_occupation"]) && $student["father_occupation"] == 5) ? "selected" : "" ?>>
                                                อื่นๆ
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2">
                                    <div class="form-group">
                                        <label>โทรศัพท์</label>
                                        <input type="text" class="form-control" name="father_line_id"
                                               value="<?php echo isset($student["father_line_id"]) ? $student["father_line_id"] : "" ?>">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2">
                                    <div class="form-group">
                                        <label>Line ID</label>
                                        <input type="text" class="form-control" name="father_line_id"
                                               value="<?php echo isset($student["father_line_id"]) ? $student["father_line_id"] : "" ?>">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-5">
                                    <div class="form-group">
                                        <label>ชื่อ-สกุล มารดา</label>
                                        <input type="text" class="form-control" name="mother_name"
                                               value="<?php echo isset($student["mother_name"]) ? $student["mother_name"] : "" ?>">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <label>อาชีพ</label>
                                        <select name="mother_occupation" class="form-control">
                                            <option
                                                value="1" <?= (isset($student["mother_occupation"]) && $student["mother_occupation"] == 1) ? "selected" : "" ?> >
                                                ธุรกิจส่วนตัว
                                            </option>
                                            <option
                                                value="2" <?= (isset($student["mother_occupation"]) && $student["mother_occupation"] == 2) ? "selected" : "" ?> >
                                                พนักงานบริษัท
                                            </option>
                                            <option
                                                value="3" <?= (isset($student["mother_occupation"]) && $student["mother_occupation"] == 3) ? "selected" : "" ?> >
                                                ข้าราชการ
                                            </option>
                                            <option
                                                value="4" <?= (isset($student["mother_occupation"]) && $student["mother_occupation"] == 4) ? "selected" : "" ?> >
                                                แม่บ้าน
                                            </option>
                                            <option
                                                value="5" <?= (isset($student["mother_occupation"]) && $student["mother_occupation"] == 5) ? "selected" : "" ?> >
                                                อื่นๆ
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2">
                                    <div class="form-group">
                                        <label>โทรศัพท์</label>
                                        <input type="text" class="form-control" name="mother_line_id"
                                               value="<?php echo isset($student["mother_line_id"]) ? $student["mother_line_id"] : "" ?>">
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2">
                                    <div class="form-group">
                                        <label>Line ID</label>
                                        <input type="text" class="form-control" name="father_line_id"
                                               value="<?php echo isset($student["father_line_id"]) ? $student["father_line_id"] : "" ?>">
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

                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>
                                                <input type="checkbox" name="courses[]"
                                                       value="1" <?= (isset($arr_courses[0]) && $arr_courses[0] == 1) ? "checked" : "" ?> >
                                                GED
                                            </label>
                                        </div>
                                        <div class="col-md-9">
                                            <ul>
                                                <li>Reading</li>
                                                <li>Writing</li>
                                                <li>Social Studies</li>
                                                <li>Science</li>
                                                <li>Mathematics</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>
                                                <input type="checkbox" name="courses[]"
                                                       value="2" <?= (isset($arr_courses[1]) && $arr_courses[1] == 2) ? "checked" : "" ?> >
                                                IGCSE
                                            </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="course_gicse_detail"
                                                   value="<?php echo isset($student["course_gicse_detail"]) ? $student["course_gicse_detail"] : "" ?>">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">

                                        </div>
                                        <div class="col-md-9">

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>
                                                <input type="checkbox" name="courses[]"
                                                       value="3" <?= (isset($arr_courses[2]) && $arr_courses[2] == 3) ? "checked" : "" ?> >
                                                SAT
                                            </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="course_sat_detail"
                                                   value="<?php echo isset($student["course_sat_detail"]) ? $student["course_sat_detail"] : "" ?>">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>
                                                <input type="checkbox" name="courses[]"
                                                       value="4" <?= (isset($arr_courses[3]) && $arr_courses[3] == 4) ? "checked" : "" ?> >
                                                IELTS/TOEFL
                                            </label>
                                        </div>
                                        <div class="col-md-9">

                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>
                                                <input type="checkbox" name="courses[]"
                                                       value="5" <?= (isset($arr_courses[4]) && $arr_courses[4] == 5) ? "checked" : "" ?> >
                                                CU-TEP/TU-GET
                                            </label>
                                        </div>
                                        <div class="col-md-9">

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>
                                                <input type="checkbox" name="courses[]"
                                                       value="6" <?= (isset($arr_courses[5]) && $arr_courses[5] == 6) ? "checked" : "" ?> >
                                                CU-ATS
                                            </label>
                                        </div>
                                        <div class="col-md-9">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>
                                                <input type="checkbox" name="courses[]"
                                                       value="7"<?= (isset($arr_courses[6]) && $arr_courses[6] == 7) ? "checked" : "" ?> >
                                                MATH
                                            </label>
                                        </div>
                                        <div class="col-md-9">

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>
                                                <input type="checkbox" name="courses[]"
                                                       value="8" <?= (isset($arr_courses[7]) && $arr_courses[7] == 8) ? "checked" : "" ?> >
                                                CHEMISTRY
                                            </label>
                                        </div>
                                        <div class="col-md-9">

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>
                                                <input type="checkbox" name="courses[]"
                                                       value="9" <?= (isset($arr_courses[8]) && $arr_courses[8] == 9) ? "checked" : "" ?> >
                                                PHYSICS
                                            </label>
                                        </div>
                                        <div class="col-md-9">

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>
                                                <input type="checkbox" name="courses[]"
                                                       value="10" <?= (isset($arr_courses[9]) && $arr_courses[9] == 10) ? "checked" : "" ?> >
                                                BIOLOGY
                                            </label>
                                        </div>
                                        <div class="col-md-9">

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>
                                                <input type="checkbox" name="courses[]"
                                                       value="11" <?= (isset($arr_courses[10]) && $arr_courses[10] == 11) ? "checked" : "" ?> >
                                                ADV WRITING
                                            </label>
                                        </div>
                                        <div class="col-md-9">

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>
                                                <input type="checkbox" name="courses[]"
                                                       value="12" <?= (isset($arr_courses[11]) && $arr_courses[11] == 12) ? "checked" : "" ?> >
                                                ADV READING
                                            </label>
                                        </div>
                                        <div class="col-md-9">

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>
                                                <input type="checkbox" name="courses[]"
                                                       value="13" <?= (isset($arr_courses[12]) && $arr_courses[12] == 13) ? "checked" : "" ?> >
                                                OTHER
                                            </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="other_course"
                                                   value="<?php echo isset($student["other_course"]) ? $student["other_course"] : "" ?>">
                                        </div>
                                    </div>

                                    <input type="hidden" id="hd_courses_list" name="courses_list">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row highlight ">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h1>ต้องการเรียนต่อมหาวิทยาลัย</h1>

                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                <div class="form-group ">
                                    <label class="control-label">ต้องการศึกษาต่อ</label>

                                    <div class="form-group">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" value="1"
                                                       name="study_in_country" <?= (isset($student["study_in_country"]) && $student["study_in_country"] == 1) ? "checked" : "" ?> >
                                                ในประเทศ
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" value="2"
                                                       name="study_in_country" <?= (isset($student["study_in_country"]) && $student["study_in_country"] == 2) ? "checked" : "" ?>>
                                                ต่างประเทศ
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                <div class="form-group ">
                                    <label>คณะที่อยากเข้าต่อ</label>
                                    <input type="text" class="form-control" name="favorite_faculty"
                                           value="<?php echo isset($student["favorite_faculty"]) ? $student["favorite_faculty"] : "" ?>">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                <div class="form-group">
                                    <label>มหาวิทยาลัยในดวงใจ</label>
                                    <input type="text" class="form-control" name="favorite_university"
                                           value="<?php echo isset($student["favorite_university"]) ? $student["favorite_university"] : "" ?>">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">ส่งข้อมูล</button>
                                    </div>
                                </div>
                            </div>
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
    var imageType = {
        PROFILE: 'profile',
        IDCARD: 'idcard'
    };

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

        $('#picture_profile').on('change', function (e) {
            e.preventDefault();
            e = e.originalEvent;
            var target = e.dataTransfer || e.target,
                file = target && target.files && target.files[0],
                options = {
                    canvas: true,
                    maxHeight: 170,
                    maxWidth: 250
                };

            if (!file) {
                return;
            }
            // Use the "JavaScript Load Image" functionality to parse the file data
            loadImage.parseMetaData(file, function (data) {
                // Get the correct orientation setting from the EXIF Data
                if (data.exif) {
                    options.orientation = data.exif.get('Orientation');
                }

                // Load the image from disk and inject it into the DOM with the correct orientation
                loadImage(
                    file,
                    function (canvas) {
                        var imgDataURL = canvas.toDataURL();
                        var img = $('<img>').attr('src', imgDataURL);
                        $('#img_picture_profile').hide();
                        $("#show_profile").empty();
                        $("#show_profile").append(img);
                        //upload image
                        uploadImageBase64(imgDataURL, $('#picture_profile_file_name'), imageType.PROFILE);
                    },
                    options
                );
            });
        });

        $('#file_id_card').on('change', function (e) {
            e.preventDefault();
            e = e.originalEvent;
            var target = e.dataTransfer || e.target,
                file = target && target.files && target.files[0],
                options = {
                    canvas: true,
                    maxHeight: 170,
                    maxWidth: 250
                };

            if (!file) {
                return;
            }
            // Use the "JavaScript Load Image" functionality to parse the file data
            loadImage.parseMetaData(file, function (data) {
                // Get the correct orientation setting from the EXIF Data
                if (data.exif) {
                    options.orientation = data.exif.get('Orientation');
                }
                // Load the image from disk and inject it into the DOM with the correct orientation
                loadImage(
                    file,
                    function (canvas) {
                        var imgDataURL = canvas.toDataURL();
                        var img = $('<img>').attr('src', imgDataURL);
                        $('#img_id_card').hide();
                        $("#show_id_card").empty();
                        $("#show_id_card").append(img);
                        //upload image
                        uploadImageBase64(imgDataURL, $('#idcard_file_name') , imageType.IDCARD);
                    },
                    options
                );
            });
        });

    });

    function readURL(input, elementShowImge) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                elementShowImge.attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function validateForm() {
        validator = form_input.validate({
            rules: {
                full_name: "required",
                eng_name: "required",
                nick_name: "required",
                email: {email: true}
            },
            messages: {
                full_name: '<?php echo $this->lang->line("message_this_field_is_require");?>',
                email: {
                    required: '<?php echo $this->lang->line("message_this_field_is_require");?>',
                    email: '<?php echo $this->lang->line("message_email_not_valid");?>'
                },
                note: '<?php echo $this->lang->line("message_this_field_is_require");?>',
                "courses[]": '<?php echo $this->lang->line("message_this_field_is_require");?>'
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

        var targetUrl;
        var id = '<?=$this->uri->segment(4)?>';
        if (id === "") {
            targetUrl = BASE_URL + 'admin/Student/create';
        } else {
            targetUrl = BASE_URL + 'admin/Student/update/' + id;
        }

        setValueCheckbox();

        showSpinner();
        $.ajax({
            type: 'POST',
            url: targetUrl,
            data: form_input.serializefiles(),
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                hideSpinner();
                if (response.success == true) {
                    alert("บันทึกข้อมูลเรียบร้อย");
                    var id = '<?=$this->uri->segment("4");?>';
                    if (id != null && id != '') {
                        window.location = BASE_URL + 'admin/Student';
                    } else {
                        clearForm();
                    }
                } else if (response.success == false && response.errorMessage != null && response.errorMessage != '') {
                    alert(response.errorMessage);
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
//                clearForm();
//                alert(request.responseText);
            }
        });
    }

    function uploadImageBase64(imageBase64, saveToElement , imageType) {
        var targetUrl = BASE_URL + 'admin/Student/uploadImageBase64';
        $.ajax({
            type: 'POST',
            url: targetUrl,
            data: { imageType: imageType , imageBase64: imageBase64},
            dataType: 'json',
            success: function (response) {
                if (response.success == true) {
                    saveToElement.val(response.fileName);
                }
            },
            error: function (request, status, error) {
            }
        });
    }

    function clearForm() {
        window.location = BASE_URL + 'admin/Student/create';
    }

    function setValueCheckbox() {
        var values = new Array();
        $.each($("input[name='courses[]'] "), function () {
            if ($(this).is(':checked')) {
                values.push($(this).val());
            } else {
                values.push(0);
            }
        });
        console.log(values);
        $('#hd_courses_list').val(values);
    }

</script>