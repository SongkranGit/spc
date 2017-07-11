<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/Admin_controller.php';

class GalleryImage extends Admin_Controller
{

    private $upload_path;

    function __construct()
    {
        parent::__construct();
        $this->load->model("Gallery_model");
        $this->load->model("Gallery_images_model");
        $this->load->helper('text');
        $this->load->library("Uuid");
        $this->upload_path = realpath(APPPATH . '../uploads/gallery');
    }


    public function index()
    {
        $data["galleries"] = $this->Gallery_model->getAll();
        $this->load->view("backend/gallery/list_upload_images", $data);
    }

    public function upload()
    {
        $response = array('success' => false, 'messages' => array());
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            //upload image only
            if (!empty($this->input->post("list_image_uuid"))) {
                $list_image_uuid = $this->input->post("list_image_uuid");
                $gallery_id = $this->input->post("gallery_id");
                $published = $this->input->post("published");
                $this->updateGalleryIdToGalleryImages($list_image_uuid, $gallery_id, $published);
                $response['success'] = true;
            } // upload image with description
            else {
                $gallery_id = $this->input->post("gallery_id");
                $data = array(
                    "gallery_id" => $gallery_id,
                    "published" => intval($this->input->post("published")),
                    "order_seq" => 1,
                    "created_date" => Calendar::currentDateTime()
                );

                // Check language
                if (isEnglishLang()) {
                    $data["caption_en"] = $this->input->post("caption");
                    $data["description_en"] = $this->input->post("description");
                } else {
                    $data["caption_th"] = $this->input->post("caption");
                    $data["description_th"] = $this->input->post("description");
                }

                $arr_upload = $this->doUploadImage($gallery_id);
                if (!empty($arr_upload)) {
                    if($arr_upload["file_name"] != null && !empty($arr_upload["file_name"])){
                        $data["file_name"] = $arr_upload["file_name"];
                        $response['success'] = $this->Gallery_images_model->save($data);
                    }
                }
            }

            echo json_encode($response);
        } else {
            $view_data = array(
                "data" => array(
                    "action" => ACTION_CREATE,
                    "heading_text" => $this->lang->line("gallery_title_upload"),
                    "galleries" => $this->Gallery_model->getAll()
                )
            );
            $this->load->view("backend/gallery/upload_images", $view_data);
        }
    }

    public function editImage($gallery_id = NULL, $id = NULL)
    {
        $response = array('success' => false, 'messages' => array());
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = array(
                "gallery_id" => $this->input->post("gallery_id"),
                "published" => intval($this->input->post("published")),
                "updated_date" => Calendar::currentDateTime()
            );

            // Check language
            if (isEnglishLang()) {
                $data["caption_en"] = $this->input->post("caption");
                $data["description_en"] = $this->input->post("description");
            } else {
                $data["caption_th"] = $this->input->post("caption");
                $data["description_th"] = $this->input->post("description");
            }

            if (!empty($_FILES)) {
                $arr_upload = $this->doUploadImage($gallery_id);
                if (!empty($arr_upload)) {
                    $data["file_name"] = $arr_upload["file_name"];
                }
            }

            $response['success'] = $this->Gallery_images_model->update($data, $id);
            echo json_encode($response);
        } else {
            $view_data = array(
                "data" => array(
                    "action" => ACTION_UPDATE,
                    "heading_text" => $this->lang->line("gallery_title_upload"),
                    "galleries" => $this->Gallery_model->getAll(),
                    'gallery_id' => $gallery_id,
                    "row" => $this->Gallery_images_model->getById($id)
                )
            );
            $this->load->view("backend/gallery/upload_images", $view_data);
        }
    }

    public function updateOrderSeq()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $response = array('success' => false, 'messages' => array());
            $data = array(
                "order_seq" => $this->input->post("order_seq")
            );
            $response["success"] = $this->Gallery_images_model->update($data, $this->input->post("rowId"));
            echo json_encode($response);
        }
    }

    public function loadUploadImageDataTable()
    {
        $data = $this->Gallery_images_model->loadUploadImageDataTable();
        echo json_encode($data);
    }

    public function detail($id = NULL)
    {
        $view_data = array();
        if ($id != "") {
            $view_data["gallery_images"] = $this->Gallery_images_model->getImagesByGalleryId($id);
            $this->load->view("backend/gallery/gallery_detail", $view_data);
        } else {
            show_404(current_url());
        }
    }

    public function deleteImageById($id = NULL)
    {
        if ($id != null) {
            $result = array('success' => false);
            // Delete file
            $data = $this->Gallery_images_model->getById($id);
            $path_file = PATH_UPLOADS . "/" . $data["file_name"];
            if (file_exists($path_file)) {
                @unlink($path_file);
            }
            // Delete from database
            $result['success'] = $this->Gallery_images_model->delete($id);
            echo json_encode($result);
        }
    }

    private function doUploadImage($gallery_id)
    {
        $data_uploaded = array();
        $prefix_thumb_image = "thumb_";
        $file_element_name = 'user_files';

        $directory_path = $this->createDirectoryByGalleryId($gallery_id);

        if ($this->input->post()) {
            $uuid = $this->uuid->v4();
            // config upload
            $config ['upload_path'] = $directory_path;
            $config ['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['overwrite'] = FALSE;
            $config['remove_spaces'] = true;
            $config['file_name'] = $uuid;

            // load Upload library
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload($file_element_name)) {
                echo $this->upload->display_errors();
            } else {
                // uploaded data
                $data_uploaded = $this->upload->data();

                // Create thumb image
                $arr_ext = explode(".", strtolower($data_uploaded['file_name']));
                $new_image = $prefix_thumb_image . $uuid . "." . end($arr_ext);

                // SimpleImage Lib
                $this->load->library("SimpleImage");
                $img = new SimpleImage();
                $img->load($data_uploaded["full_path"])->thumbnail(500, 380, 'center')->save($directory_path . "/" . $new_image);

            }
        }
        return $data_uploaded;
    }

    public function uploadImageWithDropzone()
    {
        if (!empty($_FILES)) {
            //image info
            $prefix_thumb_image = "thumb_";
            $uuid = $this->uuid->v4();
            $image_old_name = $_FILES["file"]["name"];

            //create directory
            $gallery_id = $this->input->post('gallery_id');
            $directory_path = $this->createDirectoryByGalleryId($gallery_id);

            // config upload
            $config ['upload_path'] = $directory_path;
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
                $img->load($data_uploaded["full_path"])->thumbnail(500, 380, 'center')->save($directory_path . "/" . $new_thumb_image);

                // Save to article_images
                $data = array(
                    "image_uuid" => $uuid,
                    "image_old_name" => strtolower($image_old_name),
                    "file_name" => strtolower($data_uploaded["file_name"]),
                    "size" => $data_uploaded["file_size"],
                    "created_date" => Calendar::currentDateTime()
                );
                $this->Gallery_images_model->save($data);

                //
                $success_message = array(
                    'success' => 200,
                    'image_uuid' => $uuid,
                    'serverFileName' => strtolower($data_uploaded["file_name"]),
                    'size' => $data_uploaded["file_size"]
                );

                echo json_encode($success_message);
            }
        } else {
            echo "file not found";
        }
    }

    public function deleteImage($gallery_id = null)
    {
        $directory_path = $this->upload_path . "/" . $gallery_id . "/";
        $file = $this->input->post("file");
        if ($file && $gallery_id != null && file_exists($directory_path . $file)) {
            @unlink($directory_path . $file);
            @unlink($directory_path . "thumb_" . $file);
        }

        //delete from database
        $this->Gallery_images_model->deleteByFileName($file);
    }

    private function createDirectoryByGalleryId($gallery_id)
    {
        if (!file_exists($this->upload_path)) {
            mkdir($this->upload_path, 0777, true);
        }

        if ($gallery_id != null && $gallery_id != '') {
            if (!file_exists($this->upload_path . "/" . $gallery_id)) {
                mkdir($this->upload_path . "/" . $gallery_id, 0777, true);
            }
            return $this->upload_path . "/" . $gallery_id;
        } else {
            return $this->upload_path;
        }
    }

    private function updateGalleryIdToGalleryImages($list_image_uuid, $gallery_id, $published)
    {
        if (!IsNullOrEmptyString($list_image_uuid)) {
            $arr_list_image_uuid = explode(',', $list_image_uuid);
            for ($i = 0; $i < count($arr_list_image_uuid); $i++) {
                $order = $i;
                $data_image = array(
                    "gallery_id" => $gallery_id,
                    "published" => $published,
                    "order_seq" => $order + 1
                );
                $this->Gallery_images_model->updateByImageUUID($data_image, trim($arr_list_image_uuid[$i]));
            }
        }
    }

}
