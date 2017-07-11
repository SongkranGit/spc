<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'core/Frontend_controller.php';

class Clip extends Frontend_Controller
{
     function __construct()
    {
        parent::__construct();
        $this->load->model("Clip_model");
    }

    public function index( $page=NULL)
    {
        //pagination settings
        $config['base_url'] = site_url('Clip/index/');
        $config['total_rows'] = count($this->Clip_model->getAll());
        $config['per_page'] = 6;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $data['page'] = ($page != null) ? $page : 0;

        //call the model function to get data
        $this->data["clip"]["clips"] = $this->Clip_model->getListOfClip($config["per_page"], $data['page'] );
        $this->data["clip"]['pagination'] = $this->pagination->create_links();

        // load view
        $this->data["subview"] = "frontend/clip/list_clip";
        $this->load->view("main_layout" , $this->data);
    }

    public function detail($id){
        $data = $this->Clip_model->getById($id);
        $this->data["news_detail"] = $data;

        // load view
        $this->data["subview"] = "frontend/clip/news_detail";
        $this->load->view("main_layout" , $this->data);
    }

   

}
