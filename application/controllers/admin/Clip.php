<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'core/Admin_controller.php';

class Clip extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("Clip_model");
        $this->load->model("Clip_category_model");
    }

    public function index()
    {
        $view_data = array(
            "data" => array(
                "clip_categories"=> $this->Clip_category_model->getAll()
            )
        );
        $this->load->view("backend/clip/list_clips" , $view_data);
    }

    public function create()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $result = array('success' => false, 'messages' => array());

            $this->validateForm();

            if ($this->form_validation->run()) {
                $data = array(
                    "category_id" => $this->input->post("category_id"),
                    "youtube_link" => $this->input->post("youtube_link"),
                    "description_th" => $this->input->post("description_th"),
                    "description_en" => $this->input->post("description_en"),
                    "is_show_on_home_page" => $this->input->post("is_show_on_home_page" )!= null && $this->input->post("is_show_on_home_page")== "on" ? 1 : 0 ,
                    "published" => intval($this->input->post("published")),
                    "created_date" => Calendar::currentDateTime()
                );

                $result['success'] = $this->Clip_model->save($data);

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
                    "heading_text" => $this->lang->line("clip_title_add"),
                    "clip_categories"=> $this->Clip_category_model->getAll()
                )
            );
            $this->load->view("backend/clip/clip_entry", $view_data);
        }
    }

    public function update($id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $result = array('success' => false, 'messages' => array());

            $this->validateForm();

            if ($this->form_validation->run()) {
                $data = array(
                    "category_id" => $this->input->post("category_id"),
                    "youtube_link" => $this->input->post("youtube_link"),
                    "description_th" => $this->input->post("description_th"),
                    "description_en" => $this->input->post("description_en"),
                    "is_show_on_home_page" => $this->input->post("is_show_on_home_page" )!= null && $this->input->post("is_show_on_home_page")== "on" ? 1 : 0 ,
                    "published" => intval($this->input->post("published")),
                    "updated_date" => Calendar::currentDateTime()
                );


                $result['success'] = $this->Clip_model->update($data, $id);

            } else {
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            }

            echo json_encode($result);
        } else {
            $arr_result = $this->Clip_model->getById($id);
            $view_data = array(
                "data" => array(
                    "action" => ACTION_UPDATE,
                    "heading_text" => $this->lang->line("clip_title_edit"),
                    "clip_categories"=> $this->Clip_category_model->getAll(),
                    "row" => $arr_result
                )
            );
            $this->load->view("backend/clip/clip_entry", $view_data);
        }
    }

    public function delete($id)
    {
        $result = array('success' => false);
        if ($id != "") {
            $result['success'] = $this->Clip_model->delete($id);
            echo json_encode($result);
        }
    }

    public function updateOrderSeq(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $response = array('success' => false, 'messages' => array());
            $data = array(
                "order_seq"=> $this->input->post("order_seq")
            );
            $response["success"] = $this->Clip_model->update($data , $this->input->post("rowId") );
            echo json_encode($response);
        }
    }

    public function loadClipsDataTable()
    {
        $data = $this->Clip_model->loadClipsDataTable();
        echo json_encode($data);
    }

    public function validateForm()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules("youtube_link", "Youtube", "trim|required");
        $this->form_validation->set_rules("description_th", "Description Thai", "trim|required");
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
    }


}
