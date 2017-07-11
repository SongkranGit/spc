<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/Admin_controller.php';

class Gallery extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("Gallery_model");
        $this->load->helper('text');
    }

    public function index()
    {
        $this->load->view("backend/gallery/list_galleries");
    }

    public function create()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $result = array('success' => false, 'messages' => array());

            $this->validateForm();

            if ($this->form_validation->run()) {
                $data = array(
                    "name" => $this->input->post("name"),
                    "description" => $this->input->post("description"),
                    "published" => intval($this->input->post("published")),
                    "created_date" => Calendar::currentDateTime(),
                    "updated_date" => Calendar::currentDateTime()
                );

                $isSuccess = $this->Gallery_model->save($data);
                if ($isSuccess) {
                    $gallery_id = $this->db->insert_id();
                    $list_image_uuid = $this->input->post("list_image_uuid");
                    if ($list_image_uuid != null && $list_image_uuid != '') {
                        $this->updateGalleryImages($list_image_uuid, $gallery_id);
                        $result['success'] = true;
                    }
                }

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
                    "heading_text" => $this->lang->line("gallery_title_add")
                )
            );
            $this->load->view("backend/gallery/gallery_entry", $view_data);
        }
    }

    public function update($id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $result = array('success' => false, 'messages' => array());

            $this->validateForm();

            if ($this->form_validation->run()) {
                $data = array(
                    "name" => $this->input->post("name"),
                    "description" => $this->input->post("description"),
                    "published" => intval($this->input->post("published")),
                    "updated_date" => Calendar::currentDateTime()
                );


                $result['success'] = $this->Gallery_model->update($data, $id);

            } else {
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            }

            echo json_encode($result);
        } else {
            $arr_result = $this->Gallery_model->getById($id);
            $view_data = array(
                "data" => array(
                    "action" => ACTION_UPDATE,
                    "heading_text" => $this->lang->line("gallery_title_edit"),
                    "row" => $arr_result
                )
            );
            $this->load->view("backend/gallery/gallery_entry", $view_data);
        }
    }

    public function delete($id)
    {
        $result = array('success' => false);
        if ($id != "") {
            $result['success'] = $this->Gallery_model->delete($id);
            echo json_encode($result);
        }
    }

    public function updateGalleryOrderSeq()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $response = array('success' => false, 'messages' => array());
            $data = array(
                "order_seq" => $this->input->post("order_seq")
            );
            $response["success"] = $this->Gallery_model->update($data, $this->input->post("rowId"));
            echo json_encode($response);
        }
    }

    public function loadGalleriesDataTable()
    {
        $data = $this->Gallery_model->loadGalleriesDataTable();
        echo json_encode($data);
    }

    public function validateForm()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules("name", "Name", "trim|required");
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
    }

}
