<?php

/**
 * Created by PhpStorm.
 * User: BERM-PC
 * Date: 23/4/2559
 * Time: 10:21
 */
class MY_Controller extends CI_Controller
{

    public $data = array();

    function __construct()
    {
        parent::__construct();

        $this->data["error"] = array();

        $this->loadSettings();
    }

    private function loadSettings()
    {
        $this->load->model("Setting_model");
        $this->data["settings"] = $this->Setting_model->getSettings();
    }


    protected function loadLanguage($file_lang){
        $language = $this->session->userdata('language');
        $this->lang->load( $file_lang , $language );
    }
}