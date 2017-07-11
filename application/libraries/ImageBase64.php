<?php

/**
 * Created by PhpStorm.
 * User: BERM-PC
 * Date: 11/9/2559
 * Time: 18:23
 */

// Autoload the required files
require_once(APPPATH . 'libraries/SimpleImage.php');
require_once(APPPATH . 'libraries/Uuid.php');

class ImageBase64
{

    private $uuid;
    private $extension;
    private $file_name;
    private $prefix_thumbnail = "thumb_";
    private $folder_profile;

    function __construct()
    {
        $objUuid = new Uuid();
        $this->uuid = $objUuid->v4();
       // $this->createFolderIfNotExist();
        $this->folder_profile = PATH_UPLOADS . "/user-profile/";
    }


    public function saveBase64StrImageToFile($base64img)
    {
        $extension = substr($base64img, 5, strpos($base64img, ';') - 5);
        $extension = substr($extension, 6);
        // $base64img = str_replace('data:image/png;base64,', '', $base64img);
        $base64img = str_replace('data:image/' . $extension . ';base64,', '', $base64img);
        $data = base64_decode($base64img);
        $file = $this->folder_profile . $this->uuid . "." . $extension;
        $this->extension = $extension;
        $this->file_name = $this->uuid;
        //Save file
        file_put_contents($file, $data);
        return $file;
    }

    public function createThumbnail($file_path, $width = 200, $height = 200)
    {
        $simpleImage = new SimpleImage();
        $simpleImage->load($file_path)->thumbnail($width, $height, 'center')->save($file_path);
    }

    public function getFileName()
    {
        return $this->file_name;
    }

    public function getExtension()
    {
        return "." . strtolower($this->extension);
    }

    private function createFolderIfNotExist()
    {
        $filename = PATH_UPLOADS . "/profile/";
        if (!file_exists($filename)) {
            mkdir($filename, 0777);
            exit;
        }
    }

}