<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Base Admin Class - used for all administration pages
 */

require_once APPPATH . 'core/MY_controller.php';

class Frontend_Controller extends MY_Controller
{

    protected $main_layout;

    function __construct()
    {
        parent::__construct();

        $this->load->model("Page_model");

        $this->initNavigationBar();

        $this->setConfig();

        $this->setDefaultLanguage();

    }

    private function initNavigationBar()
    {
        $this->data['menu'] = $this->Page_model->getNestedPages();
    }

    private function setConfig()
    {
        $this->data['site_name'] = config_item("site_name");
        $this->main_layout = "main_layout";
    }

    protected function setDefaultLanguage()
    {
        $language = $this->session->userdata('language');
        if ($language == null || $language == "") {
            $language = "thai";
            $this->session->set_userdata('language', $language);
        }
        $this->lang->load("frontend", $language);
    }


}
