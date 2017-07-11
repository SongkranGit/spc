<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'core/Frontend_controller.php';

class Aboutus extends Frontend_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("Page_model");
        $this->load->model("Gallery_images_model");
    }

    public function index()
    {

    }

    public function page($page = NULL, $gallery_image_id = NULL)
    {
        switch (strtolower($page)) {
            case "founder":
                $data = $this->Page_model->getByName("founder");
                $this->loadTemplate($data, $gallery_image_id);
                break;
            case "teachers":
                $data = $this->Page_model->getByName("teachers");
                $this->loadTemplate($data, $gallery_image_id);
                break;
            case "spc":
                $data = $this->Page_model->getByName("spc");
                $this->loadTemplate($data, $gallery_image_id);
                break;
            case "success":
                $data = $this->Page_model->getByName("success");
                $this->loadTemplate($data, $gallery_image_id);
                break;
            case "impress":
                $data = $this->Page_model->getByName("impress");
                $this->loadTemplate($data, $gallery_image_id);
                break;
        }

        $this->load->view("main_layout", $this->data);
    }

    function loadTemplate($data, $gallery_image_id = NULL)
    {
        if ($data != null) {
            if ($gallery_image_id == NULL) {
                if (isset($data["gallery_id"]) && $data["gallery_id"] != '') {
                    $this->data["page_gallery"] = $this->Gallery_images_model->getListOfImagesByGalleryId($data["gallery_id"], $limit = null, $start = null);
                }
                $this->data["page"] = $data;
                $this->data["subview"] = "templates/".$data["template"];
            } else {
                // Detail
                $this->data["page"]["page_gallery_detail"] = $this->Gallery_images_model->getById($gallery_image_id);
                $this->data["subview"] = "templates/content_detail";
            }

        } else {
            $this->data["subview"] = "templates/".$data["template"];;
        }
    }


}
