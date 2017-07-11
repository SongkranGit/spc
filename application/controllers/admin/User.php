<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'core/Admin_controller.php';

class User extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("User_model");
        $this->load->model("Role_model");
        $this->load->library('facebook');
    }

    public function index()
    {
        $this->load->view("backend/user/list_users");
    }

    public function create()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $result = array('success' => false, 'messages' => array());

            $this->validateForm();

            if ($this->form_validation->run()) {
                $data = array(
                    "firstname" => $this->input->post("firstname"),
                    "lastname" => $this->input->post("lastname"),
                    "username" => $this->input->post("username"),
                    "password" => md5($this->input->post("password")),
                    "email" => $this->input->post("email"),
                    "phone" => $this->input->post("phone"),
                    "role_id" => $this->input->post("role_id"),
                    "created_date" => Calendar::currentDateTime(),
                    "updated_date" => Calendar::currentDateTime()
                );

                $isSuccess = $this->User_model->save($data);
                if( $isSuccess){
                    $result['success'] = true;
                }
            }
            else {
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            }

           echo json_encode($result);

        } else {
            $view_data = array(
                "data" => array(
                    "action" => ACTION_CREATE,
                    "heading_text" => $this->lang->line("user_title_add_user"),
                    "roles" => $this->getListOfRoles()
                )
            );
            $this->load->view("backend/user/user_entry", $view_data);
        }
    }

    public function update($user_id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $result = array('success' => false, 'messages' => array());

            $this->load->library('form_validation');
            $this->form_validation->set_rules("firstname", "First Name", "trim|required");
            $this->form_validation->set_rules("lastname", "Last Name", "trim|required");
            $this->form_validation->set_rules("username", "Username", "trim|required");
            $this->form_validation->set_rules("email", "Email", "trim|required|valid_email");
            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

            if ($this->form_validation->run()) {
                $data = array(
                    "firstname" => $this->input->post("firstname"),
                    "lastname" => $this->input->post("lastname"),
                    "username" => $this->input->post("username"),
                    "email" => $this->input->post("email"),
                    "phone" => $this->input->post("phone"),
                    "role_id" => $this->input->post("role_id"),
                    "updated_date" => Calendar::currentDateTime()
                );

                // check is allow to edit password
                if($this->input->post("isEditPassword")){
                    $data["password"] = md5($this->input->post("password"));
                }

                $isSuccess = $this->User_model->update($data , $user_id);
                if( $isSuccess){
                    $result['success'] = true;
                }
            }else{
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            }

            echo json_encode($result);
        } else {
            $arr_result = $this->User_model->getUserById($user_id);
            $view_data = array(
                "data" => array(
                    "action" => ACTION_UPDATE,
                    "heading_text" => $this->lang->line("user_title_edit_user"),
                    "roles" => $this->getListOfRoles(),
                    "result"=> $arr_result
                )
            );
            $this->load->view("backend/user/user_entry", $view_data);
        }
    }

    public function delete($user_id){
        $result = array('success' => false);
        if($user_id != ""){
            $isSuccess = $this->User_model->delete($user_id);
            if($isSuccess){
                $result['success'] = true;
            }
            echo json_encode($result);
        }
    }

    public function getListOfRoles()
    {
        $data = $this->Role_model->getListOfRoles();
        return $data;
    }

    public function userProfile($id=NULL)
    {
        if($id != null){
            $result["data"] = $this->User_model->getUserById($id);
            $this->load->view('backend/user/user_profile' , $result);
        }
    }

    public function loadUsersDataTable(){
        $data = $this->User_model->loadUsersDataTable();
        echo json_encode($data);
    }

    public function connectToFacebook($user_id){
        // check is exist facebook id in database
        $arr_result = $this->User_model->getUserById($user_id);
       // dump($arr_result);
        if($arr_result['facebook_id']== NULL && $arr_result['facebook_id'] =='' ){
            $this->session->set_userdata('prev_url_facebook_login', $_SERVER['HTTP_REFERER']);
            $this->session->set_userdata('controller_before_facebook_login', $this->uri->segment(3));
            if ($this->facebook->logged_in()) {
                $arr_facebook = $this->facebook->user_id();
                // update User with facebook id
                $data = array("facebook_id" => $arr_facebook["data"]["user_id"]);
                $this->User_model->update($data , $user_id);
                redirect($_SERVER['HTTP_REFERER'] , 'refresh');
            }else{
                header( "location: ".$this->facebook->login_url());
                die();
            }
        }
    }

    public function validateForm(){
       $this->load->library('form_validation');
       $this->form_validation->set_rules("firstname", "First Name", "trim|required");
       $this->form_validation->set_rules("lastname", "Last Name", "trim|required");
       $this->form_validation->set_rules("username", "Username", "trim|required");
       $this->form_validation->set_rules("email", "Email", "trim|required|valid_email");
       $this->form_validation->set_rules("password", "Password", "trim|required");
       $this->form_validation->set_rules("password_confirm", "Password Confirm", "trim|required|matches[password]");
       $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
   }


}
