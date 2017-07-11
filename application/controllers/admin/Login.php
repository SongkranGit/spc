<?php

/**
 * Created by PhpStorm.
 * User: BERM-PC
 * Date: 15/1/2559
 * Time: 21:31
 */
class Login extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("User_model");
        $this->load->library('facebook');
    }

    public function index()
    {
        if (isset($_COOKIE["username"]) && isset($_COOKIE["password"])) {
            $data = $this->User_model->checkUserLogin($_COOKIE["username"], $_COOKIE["password"]);
            $this->setSession($data);
            redirect("Login/index", "refresh");
        } else {
            $this->load->view("backend/login");
        }
    }

    public function performLogin()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $response = array('success' => false, 'message' => "");

            if ($this->input->post('username') != "" && $this->input->post('password') != "") {
                //Check is System Admin
                if($this->input->post('username')==SYSTEM_ADMIN_USERNAME && $this->input->post('password')==SYSTEM_ADMIN_PASSWORD){
                    $data = array();
                    $data["role_name"] = "System Admin";
                    $data["role_id"] = 0;
                    $data["user_id"] = 0;
                    $data["firstname"] = "System";
                    $data["lastname"] = "Admin";
                    $response['success'] = true;
                    $response['role'] = $data["role_name"];
                    $this->setSession($data);
                }else{
                    $arr_result = $this->User_model->checkUserLogin($this->input->post('username'), $this->input->post('password'));
                    if (count($arr_result) > 0) {
                        // update Logged in dateTime
                        $data = array("logged_in_date" => Calendar::currentDateTime());
                        $this->User_model->update($data, $arr_result["user_id"]);

                        //session
                        $this->setSession($arr_result);

                        //cookie
                        if ($this->input->post('remember') != NULL) {
                            $this->setCookies($this->input->post('username'), $this->input->post('password'));
                        }

                        $response['success'] = true;
                        $response['role'] = $arr_result["role_name"];
                    } else {
                        $response['message'] = "Username or Password is not correct";
                    }
                }
            }
            
           echo json_encode($response);
        } else {
            $this->load->view("backend/login");
        }
    }

    public function performLoginWithFacebook()
    {
        $response = array('success' => false, 'message' => "" , 'facebook_login_url'=>'');

        if ($this->facebook->logged_in()) {
            $arr_facebook = $this->facebook->user_id();
            if (!empty($arr_facebook)) {
                $facebook_id = $arr_facebook["data"]["user_id"];
                $result = $this->User_model->getUserByFacebookId($facebook_id);
                if (!empty($result)) {
                    $response["success"] = true;
                } else {
                    $response["message"] = "Cannot login with facebook";
                }
            }else{
                $response["message"] = "Cannot login with facebook";
            }
        }


        echo json_encode($response);
    }

    public function redirectAfterLoginFacebook(){
       // dump($this->session->userdata('controller_before_facebook_login'));
        if ($this->facebook->logged_in()) {
            if($this->session->userdata('controller_before_facebook_login')=="User"){
                $arr_facebook = $this->facebook->user_id();
                // update User with facebook id
                $data = array("facebook_id" => $arr_facebook["data"]["user_id"]);
                $this->User_model->update($data , $this->session->userdata('user_id'));
                redirect($this->session->userdata('prev_url_facebook_login') , 'refresh');
            }else{
                //check facebook id is exist in database
                $arr_facebook = $this->facebook->user_id();
                if (!empty($arr_facebook)) {
                    $facebook_id = $arr_facebook["data"]["user_id"];
                    $result = $this->User_model->getUserByFacebookId($facebook_id);
                    if (!empty($result)) {

                        dump("OK");

                        redirect("admin/dashboard");
                    } else {
                        $view_data = array("facebook_login_failed_message" => "Cannot login with facebook");
                        redirect("Login/index");
                    }
                }
            }
        }
    }


    public function performLogout()
    {
        //Clear session
        $this->session->sess_destroy();

        //Clear cookies
        setcookie("username", "", 0, "/");
        setcookie("password", "", 0, "/");

        return redirect("admin/Login");
    }

    public function facebookLogout(){
       // $this->facebook->destroy_session();
    }

    private function setSession($data)
    {
        $this->session->set_userdata('user_role', $data["role_name"]);
        $this->session->set_userdata('user_id', $data["user_id"]);
        $this->session->set_userdata('role_id', $data["role_id"]);
        $this->session->set_userdata('user_fullname', $data["firstname"] . " " . $data["lastname"]);
        $this->session->set_userdata('language', "thai");
    }

    private function setCookies($username, $password)
    {
        setcookie('username', $username, time() + (8640 * 30), "/");
        setcookie('password', $password, time() + (8640 * 30), "/");
    }



}
