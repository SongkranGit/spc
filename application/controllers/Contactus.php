<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'core/Frontend_controller.php';

class Contactus extends Frontend_Controller
{
    private $qr_code_id = "";

    function __construct()
    {
        parent::__construct();
        $this->load->model("Page_model");
        $this->load->model("Contact_model");
        $this->load->library("Uuid");
        $this->load->library('email');
        $this->load->library('ciqrcode');
    }

    public function index()
    {
        $this->data["educations"] = $this->Contact_model->getListOfEducations();
        $this->data["page"] = $this->Page_model->getByName("contact_us");
        // load view
        $this->data["subview"] = "templates/contact_us";
        $this->load->view($this->main_layout, $this->data);
    }

    public function create()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $response = array('success' => false, 'notes' => array());

            $this->validateForm();

            $courses_list = explode(',', $this->input->post("courses_list"));
            $courses_list = serialize($courses_list);
            $this->generateQRCode();

            if ($this->form_validation->run()) {
                $data = array(
                    "full_name" => trim($this->input->post("full_name")),
                    "phone" => trim($this->input->post("phone")),
                    "email" => trim($this->input->post("email")),
                    "age" => intval($this->input->post("age")),
                    "education" => intval($this->input->post("education")),
                    "line_id" => $this->input->post("line_id"),
                    "note" => $this->input->post("note"),
                    "courses" => $courses_list,
                    "qr_code_id"=>$this->qr_code_id,
                    "created_date" => Calendar::currentDateTime()
                );

                if ($this->Contact_model->save($data)) {
                    $response['success'] = true;
                }

                echo json_encode($response);

                if ($response["success"] == true) {
                    $this->sendEmail($data);
                    $this->sendEmailToInterestedPerson($data);
                }

            } else {
                foreach ($_POST as $key => $value) {
                    $result['notes'][$key] = form_error($key);
                }
            }
        }
    }

    public function validateForm()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules("email", "Email", "trim|required");
        $this->form_validation->set_rules("full_name", "Name", "trim|required");
        $this->form_validation->set_rules("note", "Note", "trim|required");
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
    }

    private function sendEmailWithPhpmailer($data){
        require_once(APPPATH.'libraries/Phpmailer.php');
        $mailer = new PHPMailer();

        $mailer->CharSet = "utf-8";
        $mailer->IsSMTP();
        $mailer->IsHTML(true);
        $mailer->SMTPDebug = 0;
        $mailer->SMTPAuth = true;
        $mailer->Host = "mail.modernsofttech.com"; // SMTP server
        $mailer->Port = 25; // พอร์ท
        $mailer->Username = "ss@modernsofttech.com"; // account SMTP
        $mailer->Password = "liver167"; // รหัสผ่าน SMTP

        $mailer->SetFrom(strip_tags($data["email"]), $data["full_name"]);
        $mailer->AddAddress(strip_tags($this->data["settings"]["email"]), "recipient1"); // ผู้รับคนที่หนึ่ง

       // $mail->AddReplyTo("email@yourdomain.com", "yourname");
        $mailer->Subject = "ทดสอบ PHPMailer with images";

        $mailer->AddEmbeddedImage(FCPATH."/uploads/". $this->qr_code_id.".png", "image_1");
        $mailer->Body = 'Embedded Image: <img alt="PHPMailer" src="cid:image_1"> Here is an image!';

       // $mailer->Body    = "";
        //$mailer->MsgHTML();


      //  $mail->AddAddress("recipient2@somedomain.com", "recipient2"); // ผู้รับคนที่สอง

        if(!$mailer->Send()) {
            echo "Mailer Error: " . $mailer->ErrorInfo;
        } else {
           // echo "Message sent!  ".dirname(__FILE__)."/uploads/". $this->qr_code_name.".png";
        }

    }

    public function sendEmail($data)
    {
        require_once(APPPATH.'libraries/Phpmailer.php');
        $mailer = new PHPMailer();

        $mailer->CharSet = "utf-8";
        $mailer->IsSMTP();
        $mailer->IsHTML(true);
        $mailer->SMTPDebug = 0;
        $mailer->SMTPAuth = true;
        $mailer->Host = "mail.modernsofttech.com"; // SMTP server
        $mailer->Port = 25; // พอร์ท
        $mailer->Username = "ss@modernsofttech.com"; // account SMTP
        $mailer->Password = "liver167"; // รหัสผ่าน SMTP

        $mailer->SetFrom(strip_tags($data["email"]), $data["full_name"]);
        $mailer->AddAddress(strip_tags($this->data["settings"]["email"]), "recipient1"); // ผู้รับคนที่หนึ่ง

        $mailer->Subject = "ระบบส่งเมล์อัตโนมัต Study Plus Center ";
        $mailer->Body = $this->getResponseEmailMessage($data);

        if(!$mailer->Send()) {
            echo "Mailer Error: " . $mailer->ErrorInfo;
        } else {
            // echo "Message sent!  ".dirname(__FILE__)."/uploads/". $this->qr_code_name.".png";
        }

    }

    public function sendEmailToInterestedPerson($data)
    {
        require_once(APPPATH.'libraries/Phpmailer.php');
        $mailer = new PHPMailer();
        $mailer->CharSet = "utf-8";
        $mailer->IsSMTP();
        $mailer->IsHTML(true);
        $mailer->SMTPDebug = 0;
        $mailer->SMTPAuth = true;
        $mailer->Host = "mail.modernsofttech.com"; // SMTP server
        $mailer->Port = 25; // พอร์ท
        $mailer->Username = "ss@modernsofttech.com"; // account SMTP
        $mailer->Password = "liver167"; // รหัสผ่าน SMTP

        $mailer->SetFrom(strip_tags($data["email"]), $data["full_name"]);
        $mailer->AddAddress(strip_tags($data["email"]), "recipient1"); // ผู้รับคนที่หนึ่ง

        $mailer->Subject = "Study Plus Center ขอขอบคุณที่ท่านให้ความสนใจ";

        $mailer->AddEmbeddedImage(FCPATH."/uploads/". $this->qr_code_id.".png", "image_1");
        $mailer->Body = $this->getResponseEmailMessageForInterestedPerson($data);

        if(!$mailer->Send()) {
            echo "Mailer Error: " . $mailer->ErrorInfo;
        } else {
            // echo "Message sent!  ".dirname(__FILE__)."/uploads/". $this->qr_code_name.".png";
        }

    }

    private function generateQRCode()
    {
        header("Content-Type: image/png");
        $config['cacheable'] = true; //boolean, the default is true
        $config['cachedir'] = ''; //string, the default is application/cache/
        $config['errorlog'] = ''; //string, the default is application/logs/
        $config['quality'] = true; //boolean, the default is true
        $config['size'] = ''; //interger, the default is 1024
        $config['black'] = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white'] = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $uuid = $this->uuid->v4();

        $params['data'] = base_url("admin/Contact/approveGetCoupon")."/".$uuid;
        $params['level'] = 'H';
        $params['size'] = 10;
        $params['savename'] = FCPATH . "/uploads/" . $uuid . '.png';
        $this->ciqrcode->generate($params);

        //return qr code
        $this->qr_code_id = $uuid ;
    }

    private function getResponseEmailMessageForInterestedPerson($data)
    {
        $message = "<!DOCTYPE html><html><body>";
        $message .= "<p>Study Plus center ได้รับข้อมูลจากคุณแล้ว</p>";
        $message .= "<p>กรุณานำ code จาก Email นี้ไปรับคูปองได้</p>";
        $message .= '<div><img src="http://www.studypluscenter.com/uploads/"'.$this->qr_code_id.'png'.'></div>';
        $message .= "</body></html>";
        return $message;
    }

    private function getResponseEmailMessage($data)
    {
        $message = "<!DOCTYPE html><html><body>";
        $message .= '<p>กรุณาดูรายละเอียดที่ <a href=\'http://www.studypluscenter.com/admin/Contact\'>Link</a></p>';
        $message .= "</body></html>";
        return $message;
    }

}
