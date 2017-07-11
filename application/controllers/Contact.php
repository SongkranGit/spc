<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'core/Frontend_controller.php';

class Contact extends Frontend_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("Contact_model");
    }

    public function create()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $response = array('success' => false, 'notes' => array());

            $this->validateForm();

            if ($this->form_validation->run()) {
                $data = array(
                    "full_name" => trim($this->input->post("full_name")),
                    "phone" => trim($this->input->post("phone")),
                    "email" => trim($this->input->post("email")),
                    "age" => intval($this->input->post("age")),
                    "education" => intval($this->input->post("education")),
                    "note" => $this->input->post("note"),
                    "created_date" => Calendar::currentDateTime()
                );

                if ($this->Contact_model->save($data)) {
                    $response['success'] = true;
                }

                echo json_encode($response);

                if($response["success"] == true){
                    $this->sendEmail($data);
                }

            } else {
                foreach ($_POST as $key => $value) {
                    $result['notes'][$key] = form_error($key);
                }
            }
        }
    }

    public function validateForm()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules("email", "Email", "trim|required");
        $this->form_validation->set_rules("full_name", "Name", "trim|required");
        $this->form_validation->set_rules("note", "Note", "trim|required");
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
    }

    public function sendEmail($data)
    {
        $this->load->library('email');

        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'mail.modernsofttech.com';
        $config['smtp_port']    = '25';
        $config['smtp_timeout'] = '15';
        $config['smtp_user']    = 'ss@modernsofttech.com';
        $config['smtp_pass']    = 'liver167';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'text'; // or html
       // $config['validation'] = TRUE; // bool whether to validate email or not

        $this->email->initialize($config);

        $this->email->set_newline("\r\n");

        $this->email->from($data["email"]);
        $this->email->to($this->data["settings"]["email"]);
        $this->email->subject('ติดต่อจากคุณ ' . $data["full_name"]."  ผ่านระบบส่งเมล์ Study Plus Center");
        $this->email->message($data["note"]);
        if (!$this->email->send()) {
            show_error($this->email->print_debugger());
        }
    }

//    private function getMailMessage($data){
//        $message = "ข้าพเจ้า ".$data["full_name"];
//        $message.= "";
//    }

}
