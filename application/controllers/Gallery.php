<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/Frontend_controller.php';

class Gallery extends Frontend_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("Gallery_model");
        $this->load->model("Gallery_images_model");
        $this->load->library('pagination');
    }

    public function listGalleries()
    {
        //call the model function to get data
        $this->data["gallery"]["list_galleries"] = $this->Gallery_model->getListOfGalleries();

        // load view
        $this->data["subview"] = "frontend/gallery/list_galleries";
        $this->load->view("main_layout", $this->data);
    }

    public function detail($gallery_id = NULL, $page = NULL)
    {

        //pagination settings
        $config['base_url'] = site_url('Gallery/detail/' . $gallery_id . "/");
        $config['total_rows'] = count($this->Gallery_images_model->getListImagesByGalleryId($gallery_id, null, null));
        $config['per_page'] = 9;
        $config["uri_segment"] = 4;
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
        $data['page'] = ($page != NULL) ? $page : 0;

        //call the model function to get data
        $this->data["gallery"]["image_list"] = $this->Gallery_images_model->getListImagesByGalleryId($gallery_id, $config["per_page"], $data['page']);
        $this->data["gallery"]['pagination'] = $this->pagination->create_links();

        // load view
        $this->data["subview"] = "templates/gallery";
        $this->load->view("main_layout", $this->data);
    }


}
