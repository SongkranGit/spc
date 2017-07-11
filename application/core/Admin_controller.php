<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Base Admin Class - used for all administration pages
 */

require_once APPPATH.'core/MY_controller.php';

class Admin_Controller extends MY_Controller {


    function __construct()
    {
        parent::__construct();

        $this->authentication();

        $this->loadDefaultLanguage();

        $this->loadSettings();

    }

    protected function authentication()
    {
        $CI =& get_instance();
        $user_id = $CI->session->userdata('user_id');
        $role_id = $CI->session->userdata('role_id');
        if (IsNullOrEmptyString($user_id) || IsNullOrEmptyString($role_id)) {
            $CI->session->sess_destroy();
            redirect("admin/Login/index", "refresh");
        }
    }

    protected function resultSuccessJson($isSuccess){
        if ($isSuccess) {
            echo json_encode($this->result_success);
        } else {
            echo json_encode($this->result_failed);
        }
    }

    private function loadDefaultLanguage(){
        $language = $this->session->userdata('language');
        $this->lang->load(array('admin') , $language );
    }

    protected function loadLanguage($file_lang){
        $language = $this->session->userdata('language');
        $this->lang->load( $file_lang , $language );
    }

    private function loadSettings()
    {
        $this->load->model("Setting_model");
        $this->data["settings"] = $this->Setting_model->getSettings();
    }


}
