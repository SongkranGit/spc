<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'core/Admin_controller.php';

class Member extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("Member_model");
    }

    public function index()
    {
        $this->load->view("backend/member/list_members");
    }

    public function detail($id){
        $result["data"] = $this->Member_model->getById($id);
        $this->load->view("backend/member/member_detail" , $result);
    }

    public function delete($id)
    {
        $result = array('success' => false);
        if ($id != "") {
            $result['success'] = $this->Member_model->delete($id);
            echo json_encode($result);
        }
    }

    public function loadGridDataTable()
    {
        $data = $this->Member_model->loadGridDataTable();
        echo json_encode($data);
    }




}
