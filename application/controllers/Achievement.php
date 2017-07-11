<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Frontend_controller.php';

class Achievement extends Frontend_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("Article_model");
        $this->load->model("Clip_model");
    }

    function index(){

    }

    public function content($page = NULL, $gallery_image_id = NULL)
    {
        switch (strtolower($page)) {
            case "alumni":
                $data = $this->Page_model->getByName("alumni");
                $this->loadTemplate($data , $gallery_image_id);
                break;
            case "studentoutstanding":
                $data = $this->Page_model->getByName("studentOutstanding");
                $this->loadTemplate($data , $gallery_image_id);
                break;
        }
        $this->load->view("main_layout", $this->data);
    }


    function loadTemplate($data , $gallery_image_id = NULL){
        if($data != null){
            if(isset($data["is_show_gallery"]) &&  $data["is_show_gallery"] == 1  ){
                if($gallery_image_id == NULL){
                    if (isset($data["gallery_id"]) && $data["gallery_id"] != '') {
                        $this->data["page_gallery"] = $this->Gallery_images_model->getListOfImagesByGalleryId($data["gallery_id"], $limit = null, $start = null);
                    }
                    $this->data["page"] = $data;
                    $this->data["subview"] = "templates/content";
                }else{
                    // Detail
                    $this->data["page"]["page_gallery_detail"] = $this->Gallery_images_model->getById($gallery_image_id);
                    $this->data["subview"] = "templates/content_detail";
                }
            }else{
                $this->data["page"] = $data;
                $this->data["subview"] = "templates/content";
            }
        }else{
            $this->data["subview"] = "templates/content";
        }
    }

    public function parent($page= null){

        $category_id = 2;

        //pagination settings
        $config['base_url'] = site_url('Achievement/parent/');
        $config['total_rows'] = count($this->Clip_model->getAllClipsByCategory($category_id));
        $config['per_page'] = 3;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

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
        $this->data["clip"]["clips"] = $this->Clip_model->getListOfClip($config["per_page"], $data['page'] , $category_id);
        $this->data["clip"]['pagination'] = $this->pagination->create_links();

        // load view
        $this->data["subview"] = "frontend/clip/list_clip";
        $this->load->view("main_layout" , $this->data);
    }

}
