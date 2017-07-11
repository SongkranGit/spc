<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'core/Admin_controller.php';

class News extends Admin_Controller
{

    private $upload_path;

    function __construct()
    {
        parent::__construct();
        $this->load->model("News_model");
        $this->load->library("Uuid");
        $this->upload_path = realpath(APPPATH . '../uploads/news');
    }

    public function index()
    {
        $this->load->view("backend/news/list_news");
    }

    public function create()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $result = array('success' => false, 'messages' => array());

            $this->validateForm();

            if ($this->form_validation->run()) {
                $data = array(
                    "is_show_on_home_page" => $this->input->post("is_show_on_home_page" )!= null && $this->input->post("is_show_on_home_page")== "on" ? 1 : 0 ,
                    "published" => intval($this->input->post("published")),
                    "published_date" => Calendar::con2MysqlDate($this->input->post("published_date")) ,
                    "created_date" => Calendar::currentDateTime(),
                    "updated_date" => Calendar::currentDateTime()
                );

                // Check language
                if (isEnglishLang()) {
                    $data["name_en"] = $this->input->post("name");
                    $data["title_en"] = $this->input->post("title");
                    $data["body_en"] = $this->input->post("body");
                } else {
                    $data["name_th"] = $this->input->post("name");
                    $data["title_th"] = $this->input->post("title");
                    $data["body_th"] = $this->input->post("body");
                }

                $arr_upload = $this->uploadImage();
                if (!empty($arr_upload)) {
                    $data["file_name"] = strtolower($arr_upload["file_name"]);
                }
                $result['success'] = $this->News_model->save($data);
            } else {
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            }

            echo json_encode($result);

        } else {
            $view_data = array(
                "data" => array(
                    "action" => ACTION_CREATE,
                    "heading_text" => $this->lang->line("news_title_add")
                )
            );
            $this->load->view("backend/news/news_entry", $view_data);
        }
    }

    public function update($id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $result = array('success' => false, 'messages' => array());

            $this->validateForm();

            if ($this->form_validation->run()) {
                $data = array(
                    "is_show_on_home_page" => $this->input->post("is_show_on_home_page" )!= null && $this->input->post("is_show_on_home_page")== "on" ? 1 : 0 ,
                    "published" => intval($this->input->post("published")),
                    "published_date" => Calendar::con2MysqlDate($this->input->post("published_date")) ,
                    "updated_date" => Calendar::currentDateTime()
                );

                // Check language
                if (isEnglishLang()) {
                    $data["name_en"] = $this->input->post("name");
                    $data["title_en"] = $this->input->post("title");
                    $data["body_en"] = $this->input->post("body");
                } else {
                    $data["name_th"] = $this->input->post("name");
                    $data["title_th"] = $this->input->post("title");
                    $data["body_th"] = $this->input->post("body");
                }

                if (!empty($_FILES["user_files"]["name"])) {
                    $arr_upload = $this->uploadImage();
                    if (!empty($arr_upload)) {
                        $data["file_name"] = $arr_upload["file_name"];
                    }
                }

                $result['success'] = $this->News_model->update($data, $id);
            } else {
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            }
            echo json_encode($result);
        } else {
            $arr_result = $this->News_model->getById($id);
            $view_data = array(
                "data" => array(
                    "action" => ACTION_UPDATE,
                    "heading_text" => $this->lang->line("news_title_edit"),
                    "row" => $arr_result
                )
            );
            $this->load->view("backend/news/news_entry", $view_data);
        }
    }

    public function delete($id)
    {
        $result = array('success' => false);
        if ($id != "") {
            $result['success'] = $this->News_model->delete($id);
            echo json_encode($result);
        }
    }

    public function updateOrderSeq()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $response = array('success' => false, 'messages' => array());
            $data = array(
                "order_seq" => $this->input->post("order_seq")
            );
            $response["success"] = $this->News_model->update($data, $this->input->post("rowId"));
            echo json_encode($response);
        }
    }

    public function loadNewsDataTable()
    {
        $data = $this->News_model->loadNewsDataTable();
        echo json_encode($data);
    }

    public function validateForm()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules("published_date", "Publish Date", "trim|required");
        $this->form_validation->set_rules("name", "Name", "trim|required");
        $this->form_validation->set_rules("title", "Title", "trim|required");
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
    }

    public function uploadImage()
    {
        $file_element_name = "user_files";
        $data_uploaded = array();

        if ($this->input->post()) {
            $uuid = $this->uuid->v4();

            // config upload
            $config ['upload_path'] = $this->upload_path;
            $config ['allowed_types'] = 'gif|jpg|png';
            $config['overwrite'] = FALSE;
            $config['remove_spaces'] = true;
            $config['file_name'] = $uuid;
            //$config ['max_size'] = '2000';
            //$config ['max_width'] = '2000';
            //$config ['max_height'] = '2000';


            // load Upload library
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload($file_element_name)) {
                echo $this->upload->display_errors();
            } else {
                // uploaded data
                $data_uploaded = $this->upload->data();

                // Create thumb image
                $arr_ext = explode(".", strtolower($data_uploaded['file_name']));
                $new_image = "thumb_" .  $uuid . "." . end($arr_ext);
                $config["source_image"] = $data_uploaded["file_name"];
                $config["new_image"] = $new_image;
                $config["width"] = 200;
                $config["height"] = 200;
                $config['maintain_ratio'] = FALSE;
                $this->load->library('image_lib');
                $this->image_lib->thumb($config, FCPATH . 'uploads/news/');

                // Create circle image
                $arr_ext = explode(".", strtolower($data_uploaded['file_name']));
                $new_image =  $uuid . "." . end($arr_ext);
                $config["source_image"] = $data_uploaded["file_name"];
                $config["new_image"] = $new_image;
                $config["width"] = 300;
                $config["height"] = 300;
                $config['maintain_ratio'] = FALSE;
                $this->load->library('image_lib');
                $this->image_lib->thumb($config, FCPATH . 'uploads/news/');

                // Delete original image
               // $this->deleteFile($this->upload_path . "/" . $data_uploaded["file_name"]);
            }
        }
        return $data_uploaded;
    }


    private function deleteFile($path_file){
        if($path_file != ''){
            if (file_exists($path_file)) {
                @unlink($path_file);
            }
        }
    }



}
