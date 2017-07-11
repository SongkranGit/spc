<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/Admin_controller.php';

class Student extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->loadLanguage("frontend");
        $this->loadLanguage("application");
        $this->load->model("Student_model");
        $this->load->library("Uuid");
        $this->load->library("ImageBase64");
    }

    public function index()
    {
        $this->load->view("backend/student/list_students");
    }

    public function create()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $response = array('success' => false, 'messages' => array());


            $this->validateForm();

            if ($this->form_validation->run()) {

                $courses_list = explode(',', $this->input->post("courses_list"));
                $courses_list = serialize($courses_list);

                $data = array(
                    "registered_date" => Calendar::con2MysqlDate($this->input->post("registered_date")),
                    "full_name" => $this->input->post("full_name"),
                    "nick_name" => $this->input->post("nick_name"),
                    "eng_name" => $this->input->post("eng_name"),
                    "birth_date" => Calendar::con2MysqlDate($this->input->post("birth_date")),
                    "religion" => $this->input->post("religion"),
                    "age" => intval($this->input->post("age")),
                    "personal_id" => intval($this->input->post("personal_id")),
                    "address" => $this->input->post("address"),
                    "post_code" => $this->input->post("post_code"),
                    "mobile" => $this->input->post("mobile"),
                    "phone" => $this->input->post("phone"),
                    "email" => $this->input->post("email"),
                    "line_id" => $this->input->post("line_id"),
                    "facebook_id" => $this->input->post("facebook_id"),
                    "study_grade" => $this->input->post("study_grade"),
                    "school_name" => $this->input->post("school_name"),
                    "country" => $this->input->post("country"),
                    "how_know_spc" => $this->input->post("how_know_spc"),
                    "father_name" => $this->input->post("father_name"),
                    "father_line_id" => $this->input->post("father_line_id"),
                    "father_phone" => $this->input->post("father_phone"),
                    "father_occupation" => $this->input->post("father_occupation"),
                    "mother_name" => $this->input->post("mother_name"),
                    "mother_line_id" => $this->input->post("mother_line_id"),
                    "mother_phone" => $this->input->post("mother_phone"),
                    "mother_occupation" => $this->input->post("mother_occupation"),
                    "courses" => $courses_list,
                    "other_course" => $this->input->post("other_course"),
                    "course_sat_detail" => $this->input->post("course_sat_detail"),
                    "course_gicse_detail" => $this->input->post("course_gicse_detail"),
                    "study_in_country" => $this->input->post("study_in_country"),
                    "favorite_faculty" => $this->input->post("favorite_faculty"),
                    "favorite_university" => $this->input->post("favorite_university"),
                    "created_date" => Calendar::currentDateTime(),
                    "updated_date" => Calendar::currentDateTime()
                );

                if($this->input->post("picture_profile_file_name") != '' ){
                    $data["picture_profile"] = $this->input->post("picture_profile_file_name");
                }

                if($this->input->post("idcard_file_name") != ''){
                    $data["id_card_file"] = $this->input->post("idcard_file_name");
                }

                $response['success'] = $this->Student_model->save($data);
                echo json_encode($response);
            } else {
                foreach ($_POST as $key => $value) {
                    $response['messages'][$key] = form_error($key);
                }
                echo json_encode($response);
            }
        } else {
            $this->data["subview"] = "frontend/student/student_application_entry";
            $this->load->view("main_layout", $this->data);
        }
    }

    public function update($id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $response = array('success' => false, 'messages' => array());

            $this->validateForm();

            if ($this->form_validation->run()) {

                $courses_list = explode(',', $this->input->post("courses_list"));
                $courses_list = serialize($courses_list);

                $data = array(
                    "registered_date" => Calendar::con2MysqlDate($this->input->post("registered_date")),
                    "full_name" => $this->input->post("full_name"),
                    "nick_name" => $this->input->post("nick_name"),
                    "eng_name" => $this->input->post("eng_name"),
                    "birth_date" => Calendar::con2MysqlDate($this->input->post("birth_date")),
                    "religion" => $this->input->post("religion"),
                    "age" => intval($this->input->post("age")),
                    "personal_id" => intval($this->input->post("personal_id")),
                    "address" => $this->input->post("address"),
                    "post_code" => $this->input->post("post_code"),
                    "mobile" => $this->input->post("mobile"),
                    "phone" => $this->input->post("phone"),
                    "email" => $this->input->post("email"),
                    "line_id" => $this->input->post("line_id"),
                    "facebook_id" => $this->input->post("facebook_id"),
                    "study_grade" => $this->input->post("study_grade"),
                    "school_name" => $this->input->post("school_name"),
                    "country" => $this->input->post("country"),
                    "how_know_spc" => $this->input->post("how_know_spc"),
                    "father_name" => $this->input->post("father_name"),
                    "father_line_id" => $this->input->post("father_line_id"),
                    "father_phone" => $this->input->post("father_phone"),
                    "father_occupation" => $this->input->post("father_occupation"),
                    "mother_name" => $this->input->post("mother_name"),
                    "mother_line_id" => $this->input->post("mother_line_id"),
                    "mother_phone" => $this->input->post("mother_phone"),
                    "mother_occupation" => $this->input->post("mother_occupation"),
                    "courses" => $courses_list,
                    "other_course" => $this->input->post("other_course"),
                    "course_sat_detail" => $this->input->post("course_sat_detail"),
                    "course_gicse_detail" => $this->input->post("course_gicse_detail"),
                    "study_in_country" => $this->input->post("study_in_country"),
                    "favorite_faculty" => $this->input->post("favorite_faculty"),
                    "favorite_university" => $this->input->post("favorite_university"),
                    "updated_date" => Calendar::currentDateTime()
                );

                if($this->input->post("picture_profile_file_name") != '' ){
                    $data["picture_profile"] = $this->input->post("picture_profile_file_name");
                }

                if($this->input->post("idcard_file_name") != ''){
                    $data["id_card_file"] = $this->input->post("idcard_file_name");
                }


                $response['success'] = $this->Student_model->update($data, $id);
            } else {
                foreach ($_POST as $key => $value) {
                    $response['messages'][$key] = form_error($key);
                }
            }
            echo json_encode($response);
        } else {
            $this->data["student"] = $this->Student_model->getById($id);
            $this->data["subview"] = "frontend/student/student_application_entry";
            $this->load->view("main_layout", $this->data);
        }
    }

    public function delete($id)
    {
        $result = array('success' => false);
        if ($id != "") {
            $result['success'] = $this->Student_model->delete($id);
            echo json_encode($result);
        }
    }

    public function validateForm()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules("registered_date", "Registered Date", "trim|required");
        $this->form_validation->set_rules("full_name", "Full name", "trim|required");
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
    }

    public function loadStudentDataTable()
    {
        $data = $this->Student_model->loadStudentDataTable();
        echo json_encode($data);
    }

    public function uploadPictureProfile()
    {
        $data_uploaded = array();
        $prefix_thumb_image = "picture_";
        $file_element_name = 'user_files';
        $uuid = $this->uuid->v5('user_files');
        // config upload
        $config['upload_path'] = PATH_UPLOADS;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = FALSE;
        $config['remove_spaces'] = true;
        $config['file_name'] = $uuid;

        // load Upload library
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($file_element_name)) {
            $data_uploaded["errorMessage"] = $this->upload->display_errors();
            return $data_uploaded;
        } else {
            // uploaded data
            $data_uploaded = $this->upload->data();

            //Exif image (Rotation image)
//            $image_data = read_exif_data($data_uploaded["full_path"], 'IFD0');
//            $this->load->library('image_lib');
//            $config=array();
//            $config['image_library'] = 'gd2';
//            $config['source_image'] = $data_uploaded["full_path"];
//
//            switch($image_data['Orientation']) {
//                case 3:
//                    $config['rotation_angle']='180';
//                    break;
//                case 6:
//                    $config['rotation_angle']='270';
//                    break;
//                case 8:
//                    $config['rotation_angle']='90';
//                    break;
//            }
//
//            $this->image_lib->initialize($config);
//            $this->image_lib->rotate();

            // Create thumb image with SimpleImage Library
            $arr_ext = explode(".", strtolower($data_uploaded['file_name']));
            $new_image = $prefix_thumb_image . $uuid . "." . end($arr_ext);
            $this->load->library("SimpleImage");
            $img = new SimpleImage();
            $img->load($data_uploaded["full_path"])->thumbnail(300, 300, 'center')->save("uploads/" . $new_image);

            // Delete original image
            $this->deleteFile(PATH_UPLOADS . "/" . $data_uploaded["file_name"]);

            //Set return data
            $data_uploaded["file_name"] = $prefix_thumb_image . $uuid . strtolower($data_uploaded["file_ext"]);
        }

        return $data_uploaded;
    }

    public function uploadIdCard()
    {
        $data_uploaded = array();
        $prefix_thumb_image = "idcard_";
        $file_element_name = 'file_id_card';
        $uuid = $this->uuid->v5('file_id_card');
        // config upload
        $config['upload_path'] = PATH_UPLOADS;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = FALSE;
        $config['remove_spaces'] = true;
        $config['file_name'] = $uuid;

        // load Upload library
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($file_element_name)) {
            $data_uploaded["errorMessage"] = $this->upload->display_errors();
            return $data_uploaded;
        } else {
            // uploaded data
            $data_uploaded = $this->upload->data();

            //Exif image (Rotation image)
//            $image_data = read_exif_data($data_uploaded["full_path"], 'IFD0');
//            $this->load->library('image_lib');
//            $config=array();
//            $config['image_library'] = 'gd2';
//            $config['source_image'] = $data_uploaded["full_path"];
//
//            switch($image_data['Orientation']) {
//                case 3:
//                    $config['rotation_angle']='180';
//                    break;
//                case 6:
//                    $config['rotation_angle']='270';
//                    break;
//                case 8:
//                    $config['rotation_angle']='90';
//                    break;
//            }
//
//            $this->image_lib->initialize($config);
//            $this->image_lib->rotate();

            // Create thumb image
            $arr_ext = explode(".", strtolower($data_uploaded['file_name']));
            $new_image = $prefix_thumb_image . $uuid . "." . end($arr_ext);

            // SimpleImage Lib
            $this->load->library("SimpleImage");
            $img = new SimpleImage();
            $img->load($data_uploaded["full_path"])->thumbnail(500, 300, 'center')->save("uploads/" . $new_image);

            // Delete original image
            $this->deleteFile(PATH_UPLOADS . "/" . $data_uploaded["file_name"]);

            $data_uploaded["file_name"] = $prefix_thumb_image . $uuid . strtolower($data_uploaded["file_ext"]);
        }

        return $data_uploaded;
    }

    private function deleteFile($path_file)
    {
        if ($path_file != '') {
            if (file_exists($path_file)) {
                @unlink($path_file);
            }
        }
    }

    public function printStudentInfo($student_id)
    {
        if ($student_id != NULL) {
            $data["data"] = $this->Student_model->getById($student_id);
        }
        $this->load->view("backend/student/student_print", $data);
    }

    public function uploadImageBase64(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $response = array('success' => false, 'file_name'=> '');

            $image = new ImageBase64();
            $file = $image->saveBase64StrImageToFile($this->input->post("imageBase64"));
            if(strcmp($this->input->post("imageType") , "profile") == 0){
                $image->createThumbnail($file , 360 , 450);
            }else{
                $image->createThumbnail($file , 500 , 300);
            }

            if(!empty($image->getFileName())){
                $response['success'] = true;
                $response['fileName'] = $image->getFileName().$image->getExtension();
            }
            echo json_encode($response);
        }
    }

}
