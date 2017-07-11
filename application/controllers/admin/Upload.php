<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'core/Admin_controller.php';

class Upload extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        ini_set('memory_limit', "256M");
    }

    public function index()
    {

    }

    public function croppicUploadImage()
    {
        $response = array("status" => "error", "message" => "");
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (isset ($_FILES['img'])) {
                $new_name = "temp_" . $_FILES["img"]['name'];
                $config ['upload_path'] = "uploads/";
                $config ['allowed_types'] = 'gif|jpg|png';
                $config['file_name'] = $new_name;
                $upload_data = array();

                // load Upload library
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('img')) {
                    echo $this->upload->display_errors();
                } else {
                    $upload_data = $this->upload->data();
                }

                if (count($upload_data)) {
                    $response = $uploaded_file = array(
                        "status" => 'success',
                        "url" => base_url() . "uploads/" . $upload_data["file_name"],
                        "width" => $upload_data["image_width"],
                        "height" => $upload_data["image_height"]
                    );
                }
            } else {
                $response["status"] = "error";
                $response["message"] = "something went wrong, most likely file is to large for upload. check upload_max_filesize, post_max_size and memory_limit in you php.ini";
            }
        }

        echo json_encode($response);
    }
    
    public function croppicCropImage()
    {
        $imgUrl = $_POST['imgUrl'];

        $path_parts = pathinfo($imgUrl);

        $file_name = $path_parts['filename'];
        // original sizes
        $imgInitW = $_POST['imgInitW'];
        $imgInitH = $_POST['imgInitH'];
        // resized sizes
        $imgW = $_POST['imgW'];
        $imgH = $_POST['imgH'];
        // offsets
        $imgY1 = $_POST['imgY1'];
        $imgX1 = $_POST['imgX1'];
        // crop box
        $cropW = $_POST['cropW'];
        $cropH = $_POST['cropH'];
        // rotation angle
        $angle = $_POST['rotation'];

        $jpeg_quality = 100;

        //$output_filename = "temp/croppedImg_".rand();

        $arr_file_name = explode("_", $file_name);
        $output_filename = "uploads/" . $arr_file_name[1];

        // uncomment line below to save the cropped image in the same location as the original image.
        //$output_filename = dirname($imgUrl). "/croppedImg_".rand();

        $what = getimagesize($imgUrl);

        switch (strtolower($what['mime'])) {
            case 'image/png':
                $img_r = imagecreatefrompng($imgUrl);
                $source_image = imagecreatefrompng($imgUrl);
                $type = '.png';
                break;
            case 'image/jpeg':
                $img_r = imagecreatefromjpeg($imgUrl);
                $source_image = imagecreatefromjpeg($imgUrl);
                error_log("jpg");
                $type = '.jpeg';
                break;
            case 'image/gif':
                $img_r = imagecreatefromgif($imgUrl);
                $source_image = imagecreatefromgif($imgUrl);
                $type = '.gif';
                break;
            default:
                die('image type not supported');
        }

        //Check write Access to Directory
        if (!is_writable(dirname($output_filename))) {
            $response = Array(
                "status" => 'error',
                "message" => 'Can`t write cropped File'
            );
        } else {

            // resize the original image to size of editor
            $resizedImage = imagecreatetruecolor($imgW, $imgH);
            imagecopyresampled($resizedImage, $source_image, 0, 0, 0, 0, $imgW, $imgH, $imgInitW, $imgInitH);
            // rotate the rezized image
            $rotated_image = imagerotate($resizedImage, -$angle, 0);
            // find new width & height of rotated image
            $rotated_width = imagesx($rotated_image);
            $rotated_height = imagesy($rotated_image);
            // diff between rotated & original sizes
            $dx = $rotated_width - $imgW;
            $dy = $rotated_height - $imgH;
            // crop rotated image to fit into original rezized rectangle
            $cropped_rotated_image = imagecreatetruecolor($imgW, $imgH);
            imagecolortransparent($cropped_rotated_image, imagecolorallocate($cropped_rotated_image, 0, 0, 0));
            imagecopyresampled($cropped_rotated_image, $rotated_image, 0, 0, $dx / 2, $dy / 2, $imgW, $imgH, $imgW, $imgH);
            // crop image into selected area
            $final_image = imagecreatetruecolor($cropW, $cropH);
            imagecolortransparent($final_image, imagecolorallocate($final_image, 0, 0, 0));
            imagecopyresampled($final_image, $cropped_rotated_image, 0, 0, $imgX1, $imgY1, $cropW, $cropH, $cropW, $cropH);

            // Delete temp file
            $temp_file = realpath(APPPATH . '../uploads/' . basename($imgUrl));
            if (file_exists($temp_file)) {
                @unlink($temp_file);
            }

            // finally output png image
            //imagepng($final_image, $output_filename.$type, $png_quality);
            imagejpeg($final_image, $output_filename . $type, $jpeg_quality);
            $response = Array(
                "status" => 'success',
                "url" => base_url() . $output_filename . $type
            );
        }
        print json_encode($response);
    }
    
    public function upload_multiple_files()
    {
        $arr_data_uploaded = array();
        if ($this->input->post()) {

            $config ['upload_path'] = realpath(APPPATH . '../assets/uploads/');
            $config ['allowed_types'] = 'gif|jpg|png';
//            $config ['max_size'] = '1000';
//            $config ['max_width'] = '2000';
//            $config ['max_height'] = '1200';

            // load Upload library
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('user_files')) {
                echo $this->upload->display_errors();
            } else {
                $arr_data_uploaded = $this->upload->data();
            }
        }

        return $arr_data_uploaded;
    }

    
    
    
}
