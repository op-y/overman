<?php

/**
 *  A Controller class: handle ajax request related to authorization.
 *
 *  @author ye.zhiqin@outlook.com
 */
class Auth extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Process AJAX request: POST /index.php/ajaxUpdateProfile
     *
     * @return json
     */
    public function ajaxUpdateProfile()
    {
        $this->load->library('session');    
        $username = $this->session->userdata('username');

        $tel   = $this->input->post('tel');
        $email = $this->input->post('email');

        $this->load->model('user_model', 'user');
        $cnt = $this->user->updateProfile($username, $tel, $email);

        if ($cnt == 1) {
            $status = 200;
            $message = "Succeed";
        } else {
            $status = 500;
            $message = "Fail";
        }

        $result = array(
            "status"=>$status,
            "message"=>$message,
        );
        $json = json_encode($result);
        echo $json;
    }

    /**
     * Process AJAX request: POST /index.php/ajaxUpdatePassword
     *
     * @return json
     */
    public function ajaxUpdatePassword()
    {
        $this->load->library('session');    
        $username = $this->session->userdata('username');

        $oldPassword = $this->input->post('oldPassword');
        $newPassword = $this->input->post('newPassword');

        $this->config->load('app_encryption');
        $conf =  $this->config->item('encryption');

        $options = [ 
            'cost' => 12, 
            'salt'=>$conf['salt'],
        ];  
        $oldCiphertext = password_hash($oldPassword, PASSWORD_BCRYPT, $options);
        $newCiphertext = password_hash($newPassword, PASSWORD_BCRYPT, $options);

        $this->load->model('user_model', 'user');
        $cnt = $this->user->updatePassword($username, $oldCiphertext, $newCiphertext);
        if ($cnt == 1) {
            $status = 200;
            $message = "Succeed";
        } else {
            $status = 500;
            $message = "Fail";
        }

        $result = array(
            "status"=>$status,
            "message"=>$message,
        );
        $json = json_encode($result);
        echo $json;
    }

    /**
     * Process AJAX request: POST /index.php/ajaxGetMineAuth
     *
     * @return json
     */
    public function ajaxGetMineAuth()
    {
        $this->load->library('session');    
        $username = $this->session->userdata('username');

        $this->load->model('user_model', 'user');
        $auth = $this->user->getMineAuth($username);
        $length = count($auth);
        $result = array(
            "draw"=>1,
            "recordsTotal"=>$length,
            "recordsFiltered"=>$length,
            "data"=>$auth,
        );
        $json = json_encode($result);
        echo $json;
    }
}

