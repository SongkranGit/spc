<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'core/Admin_controller.php';

class Contact extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("Contact_model");
    }


    public function index()
    {
        $this->load->view("backend/contact/list_contact");
    }

    public function detail($id){
        $result["data"] = $this->Contact_model->getById($id);
        $this->load->view("backend/contact/contact_detail" , $result);
    }

    public function delete($id)
    {
        $result = array('success' => false);
        if ($id != "") {
            $result['success'] = $this->Contact_model->delete($id);
            echo json_encode($result);
        }
    }

    public function loadContactsDataTable()
    {
        $data = $this->Contact_model->loadContactsDataTable();
        echo json_encode($data);
    }


    public function approveGetCoupon($qr_code_id= null , $is_approve = null ){
        if($qr_code_id != null && $is_approve == null){
            $result["data"] = $this->Contact_model->findByQrCode($qr_code_id);
            $this->load->view("backend/contact/contact_detail" , $result);
        }else if($qr_code_id != null && $is_approve != null){
            $data = array(
                "is_approve"=> 1,
                "updated_date"=>Calendar::currentDateTime()
            );
            $this->Contact_model->approveCoupon($qr_code_id , $data);
            $this->load->view("backend/contact/list_contact");
        }

    }




}
