<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Frontend_controller.php';

class Article extends Frontend_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("News_model");
        $this->load->model("Page_model");
        $this->load->model("Gallery_images_model");
        $this->load->model("Article_model");
        $this->load->model("Article_images_model");
    }

    public function visit()
    {
        $view_data["record"] = $this->Page_model->getByName("VisitUniversity");
        $gallery_id = $view_data["record"]["gallery_id"];
        $view_data["images"] = $this->Gallery_images_model->getListImagesByGalleryId($gallery_id = intval($gallery_id), $limit = null, $start = null);
        $view_data["subview"] = "frontend/article/visit_university";
        $this->load->view("main_layout", $view_data);
    }

    public function knowledge($page = NULL)
    {
        $page_result = $this->Page_model->getByName("knowledge");
        $page_id = $page_result["id"];

        //pagination settings
        $config['base_url'] = site_url('Article/knowledge/');
        $config['total_rows'] = count($this->Article_model->getArticleByPageId($page_id, null));
        $config['per_page'] = 10;
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
        $data['page'] = ($page != NULL) ? $page : 0;

        //call the model function to get data
        $data["article_list"] = $this->Article_model->getListOfArticle($config["per_page"], $data['page'], $page_id);
        $data['pagination'] = $this->pagination->create_links();

        // load view
        $data["subview"] = "frontend/article/list_article";
        $this->load->view("main_layout", $data);

    }

    public function knowledge_detail($article_id)
    {
        $result = $this->Article_model->getById($article_id);
        $images = $this->Article_images_model->getImagesByArticleId($article_id);
        $data["images"] = $images;
        $data["article"] =$result;
        $data["subview"] = "frontend/article/article_detail";
        $this->load->view("main_layout", $data);
    }

    function detail($article_id){
        $this->data["page"] = $this->Article_model->getById($article_id);
        // load view
        $this->data["subview"] = "templates/content";
        $this->load->view("main_layout" , $this->data);
    }

}
