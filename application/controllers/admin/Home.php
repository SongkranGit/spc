<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'core/Frontend_controller.php';

class Home extends Frontend_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("Slideshow_model");
        $this->load->model("Clip_model");
        $this->load->model("Gallery_images_model");
        $this->load->model("Contact_model");
        $this->load->model("News_model");
        $this->load->model("Article_model");
        $this->load->model("Page_model");
    }

    public function switchLanguage($lang)
    {
        $this->session->set_userdata('language', $lang);
        $this->session->set_userdata('prev_url', $_SERVER['HTTP_REFERER']);
        redirect($this->session->userdata('prev_url'));
    }

    public function index()
    {
        /**
         * Logic :: Frontend จะ custom route url ถ้าหากมี error 404 จะทำการ route มาที่ Home index เสมอ
         *       :: เมื่อสร้าง controller ที่ตรงกับ url ก็จะ route ไปที่ controller นั้นเลยเช่น สร้าง webboard ขึ้นมาก็จะ route ไปที webboard เล
        */

        $this->checkingDefaultHomePage();

        $this->data["page"] = $this->Page_model->getByName($this->uri->segment(1) == NULL ? "Home" : $this->uri->segment(1));

        //dump($this->db->last_query());
        count($this->data["page"]) || show_404(current_url());

        $method = "template_".strtolower ($this->data['page']['template']);
        //dump($method);

        if(method_exists($this , $method)){
            $this->$method();
        }else{
            show_error("Template is not found" , $method);
        }

        // load view
        $this->data["subview"] = "templates/".$this->data["page"]["template"];
        $this->load->view($this->main_layout, $this->data);
    }

    public function template_home(){
        // Slide show (list)
        $this->data["slide_show"] = $this->Slideshow_model->getAll();

        // Clip (1 record)
        $this->data["clip"] = $this->Clip_model->getByTopOfSeq();

        // Gallery
       // $this->data["gallery_images"] = $this->Gallery_images_model->getListImagesByGalleryId($gallery_id = 1 , $limit = 8 , $start = 1);


        // News (1 record)
        $this->data["news"] = $this->News_model->getListOfNews($limit = 1 , $start= 0 , $category = 1);

        // Promotion (1 record)
        $this->data["promotion"] = $this->News_model->getListOfNews($limit = 1  , $start = 0 , $category = 2);

        // Article (list)
        $this->data["article"] = $this->Article_model->getListOfArticleForHomePage();

        $this->data["gallery_images"] = $this->Gallery_images_model->getListImagesOfTopOfOrderSeqInGallery( $limit = 8 , $start = 0);
    }

    public function template_content(){
       // dump($this->uri->segment(1));
       // dump($this->data);
        $page_name = $this->uri->segment(1);
        switch($page_name){
            case "course_igcse" :
                break;
            case "course_ged" :
                break;
        }
    }

    public function template_contact_us(){
        $this->data["educations"] = $this->Contact_model->getListOfEducations();
    }

    public function template_curricula(){

    }

    public function vision(){
        $this->data["page"] = $this->Page_model->getByName("vision");

        // load view
        $this->data["subview"] = "templates/content";
        $this->load->view($this->main_layout, $this->data);
    }

    private function checkingDefaultHomePage(){
         $cont = $this->uri->segment(1);
       // dump("\n\n\n\n\n\n\n\n\n\n\n\n\n teswt :".$cont);
        if($cont == null || $cont == ""){
            redirect("Home" , "refresh");
        }
    }







}
