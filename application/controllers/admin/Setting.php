<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'core/Admin_controller.php';

class Setting extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("Setting_model");
    }

    public function index()
    {
        $data["row"] = $this->Setting_model->getSettings();
        $this->load->view("backend/settings/setting_general" , $data );
    }

    public function save()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $result = array('success' => false, 'messages' => array());
            $this->validateForm();

            if ($this->form_validation->run()) {

                $data = array(
                    "website_name" => $this->input->post("website_name"),
                    "website_short_name" => $this->input->post("website_short_name"),
                    "email" => $this->input->post("email"),
                    "phone" => $this->input->post("phone"),
                    "mobile" => $this->input->post("mobile"),
                    "address_th" => $this->input->post("address_th"),
                    "address_en" => $this->input->post("address_en"),
                    "facebook_link" => $this->input->post("facebook_link"),
                    "twitter_link" => $this->input->post("twitter_link"),
                    "instagram_link" => $this->input->post("instagram_link"),
                    "line_id" => $this->input->post("line_id"),
                    "vision_th" => $this->input->post("vision_th"),
                    "vision_en" => $this->input->post("vision_en"),
                    "default_language" => $this->input->post("default_language")
                );

                //check is existing
                $exist_data = $this->Setting_model->getSettings();
                if (!empty($exist_data)) {
                    $data["updated_date"] = Calendar::currentDateTime();
                    $isSuccess = $this->Setting_model->update($data, $exist_data["setting_id"]);
                } else {
                    $data["created_date"] = Calendar::currentDateTime();
                    $isSuccess = $this->Setting_model->save($data);
                }

                $result['success'] = $isSuccess;

            } else {
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            }
            // response to client
            echo json_encode($result);
        }
    }

    public function switchLanguage($lang){
        $this->session->set_userdata('language', $lang);
        $this->session->set_userdata('prev_url', $_SERVER['HTTP_REFERER']);
        redirect($this->session->userdata('prev_url'));
    }

    public function validateForm()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules("website_name", "Website name", "trim|required");
        $this->form_validation->set_rules("website_short_name", "Website Short name", "trim|required");
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
    }


}
