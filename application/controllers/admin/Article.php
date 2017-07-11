<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/Admin_controller.php';

class Article extends Admin_Controller
{

    private $upload_path;

    function __construct()
    {
        parent::__construct();
        $this->load->model("Article_model");
        $this->load->model("Article_images_model");
        $this->load->model("Page_model");
        $this->load->library("Uuid");
        $this->upload_path = realpath(APPPATH . '../uploads/article');
    }

    public function index()
    {
        $data["pages"] = $this->Page_model->getAll();
        $this->load->view("backend/article/list_articles", $data);
    }

    public function create()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $result = array('success' => false, 'messages' => array());

            $this->validateForm();

            if ($this->form_validation->run()) {
                $data = array(
                    "page_id" => $this->input->post("page_id"),
                    "published" => intval($this->input->post("published")),
                    "published_date" => Calendar::con2MysqlDate($this->input->post("published_date")),
                    "created_date" => Calendar::currentDateTime()
                );

                // Check language
                if(isEnglishLang()){
                    $data["title_en"] = $this->input->post("title");
                    $data["name_en"] = $this->input->post("name");
                    $data["body_en"] = $this->input->post("body");
                }else{
                    $data["title_th"] = $this->input->post("title");
                    $data["name_th"] = $this->input->post("name");
                    $data["body_th"] = $this->input->post("body");
                }

                $isSuccess = $this->Article_model->save($data);
                if ($isSuccess) {
                    $article_id = $this->db->insert_id();
                    $list_image_uuid = $this->input->post("list_image_uuid");
                    $this->updateArticleImages($list_image_uuid , $article_id);
                    $result['success'] = true;
                }
            } else {
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            }

            // response to client
            echo json_encode($result);

        } else {
            $view_data = array(
                "data" => array(
                    "action" => ACTION_CREATE,
                    "pages" => $this->Page_model->getAll(),
                    "heading_text" => $this->lang->line("article_title_add")
                )
            );
            $this->load->view("backend/article/article_entry", $view_data);
        }
    }

    public function update($article_id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $result = array('success' => false, 'messages' => array());

            $this->validateForm();

            if ($this->form_validation->run()) {
                $data = array(
                    "page_id" => $this->input->post("page_id"),
                    "published_date" => $this->input->post("published_date"),
                    "published" => intval($this->input->post("published")),
                    "updated_date" => Calendar::currentDateTime()
                );

                // Check language
                if(isEnglishLang()){
                    $data["title_en"] = $this->input->post("title");
                    $data["name_en"] = $this->input->post("name");
                    $data["body_en"] = $this->input->post("body");
                }else{
                    $data["title_th"] = $this->input->post("title");
                    $data["name_th"] = $this->input->post("name");
                    $data["body_th"] = $this->input->post("body");
                }

                $isSuccess = $this->Article_model->update($data, $article_id);
                if ($isSuccess) {
                    $list_image_uuid = $this->input->post("list_image_uuid");
                    $this->updateArticleImages($list_image_uuid , $article_id);
                    $result['success'] = true;
                }
            } else {
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            }
            
            // response to client
            echo json_encode($result);
        } else {
            $arr_result = $this->Article_model->getById($article_id);
            $view_data = array(
                "data" => array(
                    "action" => ACTION_UPDATE,
                    "heading_text" => $this->lang->line("article_title_edit"),
                    "pages" => $this->Page_model->getAll(),
                    "article_id" => $article_id,
                    "row" => $arr_result
                )
            );
            $this->load->view("backend/article/article_entry", $view_data);
        }
    }

    public function delete($id)
    {
        $result = array('success' => false);
        if ($id != "") {
            $result['success'] = $this->Article_model->delete($id);
            echo json_encode($result);
        }
    }

    public function loadArticlesDataTable()
    {
        $data = $this->Article_model->loadArticlesDataTable();
        echo json_encode($data);
    }

    public function updateOrderSeq()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $response = array('success' => false, 'messages' => array());
            $data = array(
                "order_seq" => $this->input->post("order_seq")
            );
            $response["success"] = $this->Article_model->update($data, $this->input->post("rowId"));
            echo json_encode($response);
        }
    }

    public function validateForm()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules("published_date", "Publish Date", "trim|required");
        $this->form_validation->set_rules("name", "Name", "trim|required");
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
    }

    public function deleteImage()
    {
        $file = $this->input->post("file");
        if ($file && file_exists($this->upload_path . "/" . $file)) {
            @unlink($this->upload_path . "/" . $file);
            @unlink($this->upload_path . "/" . "thumb_" . $file);
        }

        //delete from database
        $this->Article_images_model->deleteByImageName($file);
    }

    public function uploadImages()
    {
        if (!empty($_FILES)) {
            //image info
            $prefix_thumb_image = "thumb_";
            $uuid = $this->uuid->v4();
            $image_old_name = $_FILES["file"]["name"];

            // config upload
            $config ['upload_path'] = $this->upload_path;
            $config ['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['overwrite'] = FALSE;
            $config['remove_spaces'] = true;
            $config['file_name'] = $uuid;

            // load Upload library
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload("file")) {
                echo $this->upload->display_errors();
            } else {
                // uploaded data
                $data_uploaded = $this->upload->data();

                // Create thumb image
                $new_thumb_image = $prefix_thumb_image . strtolower($data_uploaded["file_name"]);
                $this->load->library("SimpleImage");
                $img = new SimpleImage();
                $img->load($data_uploaded["full_path"])->thumbnail(500, 380, 'center')->save("uploads/article/" . $new_thumb_image);

                // Save to article_images
                $data = array(
                    "article_id" => null,
                    "image_uuid"=> $uuid ,
                    "image_old_name" => strtolower($image_old_name),
                    "image_name" => strtolower($data_uploaded["file_name"]),
                    "size" => $data_uploaded["file_size"],
                    "order_seq" => null,
                    "created_date" => Calendar::currentDateTime()
                );
                $this->Article_images_model->save($data);

                //
                $success_message = array(
                    'success' => 200,
                    'image_uuid'=> $uuid,
                    'serverFileName' => strtolower($data_uploaded["file_name"]),
                    'size'=> $data_uploaded["file_size"]
                );

                echo json_encode($success_message);
            }
        } else {
            echo "file not found";
        }
    }

    public function getImagesByArticleId($article_id)
    {
        if ($article_id != '') {
            $data = $this->Article_images_model->getImagesByArticleId($article_id);
            echo json_encode($data);
        }
    }

    private function updateArticleImages($list_image_uuid , $article_id){
        if (!IsNullOrEmptyString($list_image_uuid)) {
            $arr_list_image_uuid = explode(',', $list_image_uuid);
            for ($i = 0; $i < count($arr_list_image_uuid); $i++) {
                $order = $i;
                $data_image = array(
                    "article_id" => $article_id,
                    "order_seq" => $order + 1
                );
                //  echo $arr_list_image_uuid[$i]."::";
                $this->Article_images_model->updateByImageUUID($data_image , trim($arr_list_image_uuid[$i]));
            }
        }
    }
}
