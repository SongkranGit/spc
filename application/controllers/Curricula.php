<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Frontend_controller.php';

class Curricula extends Frontend_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("Article_model");
    }

    function index(){
        $arr_result = $this->Article_model->getArticleByPageName($page_name ="Curricula" , $limit = 1);
        $this->data["article"] = $arr_result[0];
        // load view
        $this->data["subview"] = "templates/curricula";
        $this->load->view("main_layout" , $this->data);
    }


    function show($curricula_name){
        $this->data["article"] = $this->Article_model->getByName(trim($curricula_name));
        // load view
        $this->data["subview"] = "templates/curricula";
        $this->load->view("main_layout" , $this->data);
    }

}
