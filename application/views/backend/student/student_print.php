<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Student Information</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?= base_url("assets/adminlte2/bootstrap/css/bootstrap.min.css") ?>">

    <style>

        .label_table {
            float: left;
        }

        input[type=checkbox] {
            -ms-transform: scale(1); /* IE */
            -moz-transform: scale(1); /* FF */
            -webkit-transform: scale(1); /* Safari and Chrome */
            -o-transform: scale(1); /* Opera */
            padding: 10px;
        }

        label {
            font-weight: 100;
        }

        span {
            font-weight: 700;
        }

        .header_coures {
            border-radius: 15px;
            border: 1px solid #adaba5;
            padding: 10px;
            background-color: #fff6a3;
            color:#0a0a0a;
            max-width: 300px;
            font-weight: 700;
            font-size: 16px;
            width: 100%;
        }

        /* สร้างช่องสี่เหลี่ยมสำหรับเช็คเลือก */
        .chk_box {
            display:block;
            width:10px;
            height:10px;
            overflow:hidden;
            border:1px solid #000;
        }
        /* css ส่วนสำหรับการแบ่งหน้าข้อมูลสำหรับการพิมพ์ */
        @media all
        {
            .page-break { display:none; }
            .page-break-no{ display:none; }
        }
        @media print
        {
            .page-break { display:block;height:1px; page-break-before:always; }
            .page-break-no{ display:block;height:1px; page-break-after:avoid; }
        }

        .frame-id-card{
            border-style: dotted;
            max-width: 400px;
            width: 400px;
            height: 200px;
            text-align: center;
            vertical-align: middle;
            display: table-cell;
            font-weight: 700;
        }
        .blank_dot{
            width: 100%;
            border-top: 1px dotted;
        }

        tr{
            line-height: 21px;
        }
        
    </style>

</head>
<!--<body  >-->
<body onload="window.print(); " >
<?php
$arr_courses = isset($data["courses"])?unserialize($data["courses"]): null;
?>

<div class="wrapper">
    <!-- Main content -->
    <section class="content">
        <!--Header -->
        <table width="100%">
            <tr>
                <td width="20%" align="center">
                    <img height="90" src="<?= base_url("assets/spc/images/logo.png") ?>">
                </td>
                <td class="col-md-8" width="60%">
                    <p>คาดว่าจะเริ่มเรียนวันที่.......................................................</p>
                    <p>หนังสือที่ได้รับไปแล้ว........................................................</p>
                </td>
                <td align="center" width="20%">
                    <div class="profile">
                        <?php if (isset($data["picture_profile"])): ?>
                            <img  id="img_picture_profile" height="90"
                                 src="<?= base_url("uploads/user-profile/".$data["picture_profile"] ) ?>">
                        <?php else:; ?>
                            <img id="img_picture_profile" height="90"
                                 src="<?= base_url("assets/spc/images/blank_person.png") ?>">
                        <?php endif; ?>
                    </div>

                </td>
            </tr>
        </table>
        <br>
        <!--Data-->
        <table width="100%">
            <tr>
                <td>
                    <table width="100%">
                        <tr>
                            <td width="20%"><label class="label_table">วันที่</label></td>
                            <td width="80%"><span><?= Calendar::formatDateToDDMMYYYY($data["registered_date"]) ?></span></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <!--row1-->
            <tr>
                <td>
                    <table width="100%">
                        <tr>
                            <td width="70%" align="center"><label class="label_table">(ภาษาไทย) ขือ-สกุล</label>
                                <span><?= checkNullOrEmpty($data["full_name"]) ?></span></td>
                            <td width="30%" align="center"><label class="label_table">ชื่อเล่น </label>
                                <span><?= checkNullOrEmpty($data["nick_name"]) ?></span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!--row2-->
            <tr>
                <td>
                    <table width="100%">
                        <tr>
                            <td width="100%" align="center"><label class="label_table">(Name in English : Capital Letter)</label>
                                <span class=""><?= checkNullOrEmpty($data["eng_name"]) ?></span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!--Row 3-->
            <tr>
                <td>
                    <table width="100%">
                        <tr>
                            <td width="50%" align="center"><label class="label_table">เกิดเมือ (DOB:dd/mm/yyyy)</label>
                                <span><?= Calendar::formatDateToDDMMYYYY($data["birth_date"]) ?></span></td>
                            <td width="20%" align="center"><label class="label_table">อายุ </label>
                                <span><?= checkNullOrEmpty($data["age"]) ?></span></td>
                            <td width="30%" align="center"><label class="label_table">ศาสนา </label>
                                <span>
                                    <?php
                                    if (isset($data["religion"])) {
                                        switch ($data["religion"]) {
                                            case 1:
                                                echo "พุทธ";
                                                break;
                                            case 2:
                                                echo "คริสต์";
                                                break;
                                            case 3:
                                                echo "อิสลาม";
                                                break;
                                        }
                                    }
                                    ?>
                                </span></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <!--Row4-->
            <tr>
                <td>
                    <table width="100%">
                        <tr>
                            <td width="50%" align="center">
                                <label class="label_table">เลขที่บัตรประชาชน</label>
                                <span><?= checkNullOrEmpty($data["personal_id"]) ?></span>
                            </td>
                            <td width="50%" align="center">
                                <label class="label_table">หรือ เลขที่ Passport</label>
                                <span><?= checkNullOrEmpty($data["personal_id"]) ?></span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!--Row 5 (Address)-->
            <tr>
                <td>
                    <table width="100%">
                        <tr>
                            <td width="100%" align="center">
                                <label class="label_table">ที่อยู่ที่สามารถติดต่อได้</label>
                                <span><?= checkNullOrEmpty($data["address"]) ?></span></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <!--Row 6-->
            <tr>
                <td>
                    <table width="100%">
                        <tr>
                            <td width="50%" align="center"><label class="label_table">รหัสไปรษณีย์ (Area Code)</label>
                                <span><?= checkNullOrEmpty($data["post_code"]) ?></span></td>
                            <td width="50%" align="center"><label class="label_table">อีเมล์ (Email)</label>
                                <span><?= checkNullOrEmpty($data["email"]) ?></span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!--Row 7-->
            <tr>
                <td>
                    <table width="100%">
                        <tr>
                            <td width="33%" align="center"><label class="label_table">โทรศัพท์บ้าน (Home Phone) </label>
                                <span><?= checkNullOrEmpty($data["phone"]) ?></span></td>
                            <td width="33%" align="center"><label class="label_table">มือถือ (Mobile Phone) </label>
                                <span><?= checkNullOrEmpty($data["mobile"]) ?></span></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    <table width="100%">
                        <tr>
                            <td width="50%" align="center"><label class="label_table">ID Line </label>
                                <span><?= checkNullOrEmpty($data["line_id"]) ?></span></td>
                            <td width="50%" align="center"><label class="label_table">Facebook ID </label>
                                <span><?= checkNullOrEmpty($data["facebook_id"]) ?></span></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    <table width="100%">
                        <tr>
                            <td width="50%" align="center"><label class="label_table">กำลังเรียนอยู่เกรด </label>
                                <span><?= checkNullOrEmpty($data["study_grade"]) ?></span></td>
                            <td width="50%" align="center"><label class="label_table">โรงเรียน </label>
                                <span><?= checkNullOrEmpty($data["school_name"]) ?></span></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    <table width="100%">
                        <tr>
                            <td width="30%" align="center"><label class="label_table">ประเทศ </label>
                                <span><?= checkNullOrEmpty($data["study_in_country"]) ?></span></td>
                            <td width="70%" align="center"><label class="label_table">รู้จัก Study Plus Center
                                    จาก </label>
                                <span><?= checkNullOrEmpty($data["how_know_spc"]) ?></span></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td><h5 style="text-decoration: underline;font-weight: bold">กรณีฉุกเฉิน บุคคลที่สามารถติดต่อได้</h5></td>
            </tr>
            <!--บิดา-->
            <tr>
                <td>
                    <table width="100%">
                        <tr>
                            <td width="25%" align="center"><label class="label_table">ชื่อ-สกุล บิดา </label>
                                <span><?= checkNullOrEmpty($data["father_name"]) ?></span></td>
                            <td width="25%" align="center"><label class="label_table">อาชีพ</label>
                                <span><?= checkNullOrEmpty($data["father_occupation"]) ?></span></td>
                            <td width="25%" align="center"><label class="label_table">โทรศัพท์</label>
                                <span><?= checkNullOrEmpty($data["father_phone"]) ?></span></td>
                            <td width="25%" align="center"><label class="label_table">Line ID</label>
                                <span><?= checkNullOrEmpty($data["father_line_id"]) ?></span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!--มารดา-->
            <tr>
                <td>
                    <table width="100%">
                        <tr>
                            <td width="25%" align="center"><label class="label_table">ชื่อ-สกุล มารดา </label>
                                <span><?= checkNullOrEmpty($data["mother_name"]) ?></span></td>
                            <td width="25%" align="center"><label class="label_table">อาชีพ</label>
                                <span><?= checkNullOrEmpty($data["mother_occupation"]) ?></span></td>
                            <td width="25%" align="center"><label class="label_table">โทรศัพท์</label>
                                <span><?= checkNullOrEmpty($data["mother_phone"]) ?></span></td>
                            <td width="25%" align="center"><label class="label_table">Line ID</label>
                                <span><?= checkNullOrEmpty($data["mother_line_id"]) ?></span></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <!--Course-->
            <tr>
                <td>
                    <table width="100%">
                        <tr>
                            <td width="40%" align="center">
                                <p style="border: 1px dotted #0a0a0a; min-width: 300px; height: 200px">
                                    <?php if($data["id_card_file"] != null && !empty($data["id_card_file"]) ): ?>
                                        <img height="200" src="<?= base_url("uploads/user-profile/".$data["id_card_file"] ) ?>">
                                    <?php endif;?>
                                </p></td>
                            <td width="60%" valign="top">
                                <table width="100%" style="margin-left: 20px">
                                    <tr>
                                        <td colspan="2" align="center" ><p class="header_coures">ต้องการสมัครเรียนคอร์ส</p></td>
                                    </tr>
                                    <tr height="40">
                                        <td width="30%"><input type="checkbox" >&nbsp;&nbsp;<span>GED</span></td>
                                        <td width="70%"><div>Reading, Writing, Social Studies, Science, Mathematics</div> </td>
                                    </tr>
                                    <tr height="40">
                                        <td><input type="checkbox" >&nbsp;&nbsp;<span>IGCSE</span></td>
                                        <td ><span><?= checkNullOrEmpty($data["course_gicse_detail"]) ?></span> </td>
                                    </tr>
                                    <tr height="40">
                                        <td><input type="checkbox" >&nbsp;&nbsp;<span>SAT</span></td>
                                        <td ><span><?= checkNullOrEmpty($data["course_sat_detail"]) ?></span> </td>
                                    </tr>
                                    <tr height="40">
                                        <td colspan="2">
                                            <input type="checkbox" >&nbsp;&nbsp;<span>IELTS/TOEFL</span> &nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" >&nbsp;&nbsp;<span>CU-TEP/TU-GET</span> &nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" >&nbsp;&nbsp;<span>CU-ART</span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    <BR>
                    <table width="100%">
                        <tr >
                            <td colspan="2" ><input type="checkbox" <?=(isset($arr_courses[6])&& $arr_courses[6]== 7 )?"checked":""?> >&nbsp;&nbsp;<span>MATH</span> &nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" <?=(isset($arr_courses[7])&& $arr_courses[7]== 8 )?"checked":""?>>&nbsp;&nbsp;<span>CHEMISTRY</span> &nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" <?=(isset($arr_courses[8])&& $arr_courses[8]== 9 )?"checked":""?>>&nbsp;&nbsp;<span>PHYSICS</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" <?=(isset($arr_courses[9])&& $arr_courses[9]== 10 )?"checked":""?>>&nbsp;&nbsp;<span>BIOLOGY</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" <?=(isset($arr_courses[10])&& $arr_courses[10]== 11 )?"checked":""?>>&nbsp;&nbsp;<span>ADV WRITING</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" <?=(isset($arr_courses[11])&& $arr_courses[11]== 12 )?"checked":""?>>&nbsp;&nbsp;<span>ADV READING</span>
                            </td>
                        </tr>
                        <tr  >
                            <td colspan="2" ><input type="checkbox" <?=(isset($arr_courses[12])&& $arr_courses[12]== 13 )?"checked":""?> >&nbsp;&nbsp;<span>OTHER</span> &nbsp;&nbsp;&nbsp;&nbsp;<span><?= checkNullOrEmpty($data["other_course"]) ?></span>
                            </td>
                        </tr>
                        <tr  >
                            <td colspan="2" >
                                ต้องการเรียนต่อมหาวิทยาลัย&nbsp;&nbsp; <input type="radio" <?=(isset($student["study_in_country"]) && $student["study_in_country"]== 1 )?"checked":""?> >&nbsp;&nbsp;
                                <span>ในประเทศ</span> &nbsp;&nbsp;<input type="radio" <?=(isset($student["study_in_country"]) && $student["study_in_country"]== 2 )?"checked":""?>>&nbsp;&nbsp;
                                <span>ต่างประเทศ</span>&nbsp;&nbsp;
                                คณะที่อยากศึกษาต่อ&nbsp;&nbsp;<span><?= checkNullOrEmpty($data["favorite_faculty"]) ?></span>
                            </td>
                        </tr>
                        <tr  >
                            <td colspan="2" >
                              มหาวิทยาลัยในดวงใจ&nbsp;&nbsp;<span><?= checkNullOrEmpty($data["favorite_university"]) ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="right">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2" align="right"><div >ลงชื่อ.....................................................</div></td>
                        </tr>

                        <tr  >
                            <td colspan="2" >
                                <h5 style="text-decoration: underline;font-weight: bold">สำหรับเจ้าหน้าที่</h5>
                            </td>
                        </tr>
                        <tr >
                            <td colspan="2" >
                                <div class="blank_dot">&nbsp;</div>
                            </td>
                        </tr>
                        <tr >
                            <td colspan="2" >
                                <div class="blank_dot">&nbsp;</div>
                            </td>
                        </tr>
                        <tr >
                            <td colspan="2" >
                                <div class="blank_dot">&nbsp;</div>
                            </td>
                        </tr>
                        <tr >
                            <td colspan="2" >
                                <div class="blank_dot">&nbsp;</div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

        </table>


    </section>
</div>
<!-- ./wrapper -->
</body>
</html>
<?php //dump($data) ?>

<?php

function checkNullOrEmpty($data)
{
    $ret_data = '-';
    if ($data != null && $data != '') {
        $ret_data = $data;
    }
    return $ret_data;
}

?>
