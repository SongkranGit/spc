<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/Admin_controller.php';

class Page extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("Page_model");
        $this->load->model("Gallery_model");
        $this->load->model("Article_model");
        $this->load->model("Template_model");
    }

    public function index()
    {
        $this->load->view("backend/pages/list_pages");
    }

    public function create()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $result = array('success' => false, 'messages' => array());

            $this->validateForm();

            if ($this->form_validation->run()) {
                $data = array(
                    "name" => trim($this->input->post("name")),
                    "parent_id" => trim($this->input->post("parent_id")),
                    "template_id" => trim($this->input->post("template_id")),
                    "order" => $this->Page_model->getLatestOrderNumber() + 1,
                    "gallery_id" => $this->input->post("gallery_id"),
                    "published" => intval($this->input->post("published")),
                    "created_date" => Calendar::currentDateTime(),
                    "updated_date" => Calendar::currentDateTime()
                );

                // Check language
                if(isEnglishLang()){
                    $data["title_en"] = $this->input->post("title");
                    $data["body_en"] = $this->input->post("body");
                }else{
                    $data["title_th"] = $this->input->post("title");
                    $data["body_th"] = $this->input->post("body");
                }

                if ($this->Page_model->save($data)) {
                    $result['success'] = true;
                }
            } else {
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            }

            echo json_encode($result);

        } else {
            $view_data = array(
                "data" => array(
                    "action" => ACTION_CREATE,
                    "heading_text" => $this->lang->line("pages_button_add"),
                    "galleries" => $this->Gallery_model->getAll(),
                    "templates" => $this->Template_model->getAll(),
                    "articles" => null,
                    "pages_no_parent" => $this->Page_model->getPagesWithoutParent(Null)
                )
            );

            $this->load->view("backend/pages/page_entry", $view_data);
        }
    }

    public function update($page_id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $result = array('success' => false, 'messages' => array());
            $data = array(
                "name" => trim($this->input->post("name")),
                "parent_id" => trim($this->input->post("parent_id")),
                "template_id" => trim($this->input->post("template_id")),
                "gallery_id" => $this->input->post("gallery_id"),
                "published" => intval($this->input->post("published")),
                "updated_date" => Calendar::currentDateTime()
            );

            // Check language
            if(isEnglishLang()){
                $data["title_en"] = $this->input->post("title");
                $data["body_en"] = $this->input->post("body");
            }else{
                $data["title_th"] = $this->input->post("title");
                $data["body_th"] = $this->input->post("body");
            }

            if ($this->Page_model->update($data, $page_id)) {
                $result['success'] = true;
            }

            echo json_encode($result);
        } else {
            $view_data = array(
                "data" => array(
                    "action" => ACTION_UPDATE,
                    "heading_text" => $this->lang->line("pages_button_edit"),
                    "galleries" => $this->Gallery_model->getAll(),
                    "templates" => $this->Template_model->getAll(),
                    "articles" => $this->Article_model->getArticleByPageId($page_id),
                    "pages_no_parent" => $this->Page_model->getPagesWithoutParent($page_id),
                    "row" => $this->Page_model->getById($page_id)
                )
            );

           // dump($this->Article_model->getArticleByPageId($page_id));

            $this->load->view("backend/pages/page_entry", $view_data);
        }
    }

    public function delete($id)
    {
        $result = array('success' => false);
        if ($id != "") {
            if ($this->Page_model->delete($id)) {
                $data = array("parent_id" => 0);
                $this->Page_model->updateChildWhenDeleteParent($data, $id);
                $result["success"] = true;
            }
        }
        echo json_encode($result);
    }

    public function loadPagesDataTable()
    {
        $data = $this->Page_model->loadPagesDataTable();
        echo json_encode($data);
    }

    public function validateForm()
    {
        $this->load->library('form_validation');
//        $this->form_validation->set_rules("parent_id", "ParentId", "trim|required");
        $this->form_validation->set_rules("name", "Name", "trim|required");
//        $this->form_validation->set_rules("template", "Template", "trim|required");
        // $this->form_validation->set_rules("body", "Body", "trim|required");
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
    }

    function recursive_parent_validation($parent_id)
    {
        if ($parent_id) {
            $this->form_validation->set_message("recursive_parent_validation", 'Parent is recursive , Please select other parent');
            if ($this->Page_model->isRecursiveParent($parent_id)) {
                dump($this->Page_model->isRecursiveParent($parent_id));
                return false;
            };
        }
        return false;
    }

    public function order()
    {
        $this->load->view("backend/pages/order_pages");
    }

    public function orderPageAjax()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $result = array('success' => false);
            $pages = $this->input->post("sortable");
            if ($pages != null && $pages != '') {
                $result['success'] = $this->Page_model->saveOrderPages($pages);
            }
            echo json_encode($result);
        } else {
            $data["pages"] = $this->Page_model->getNestedPages();
            // dump($data["pages"]);
            $this->load->view("backend/pages/order_pages_ajax", $data);
        }
    }

    public function saveOrderPages()
    {
        $result = array('success' => false);
        $pages = $this->input->post("sortable");
        // dump($pages);
        if ($pages != "") {
            $result['success'] = $this->Page_model->saveOrderPages($pages);
        }
        echo json_encode($result);
    }


}
