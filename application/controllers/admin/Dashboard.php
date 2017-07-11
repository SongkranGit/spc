<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'core/Admin_controller.php';

class Dashboard extends Admin_Controller
{
    function __construct(){
        parent::__construct();
    }

    public function index()
    {
       // print_r($this->session->all_userdata());
        $this->load->view("backend/dashboard");
    }




}
