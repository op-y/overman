<?php

/**
 *  Controller class, process authentication route
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
     * Render /index.php/login
     */
    public function index()
    {
        $from = $this->input->get('from');
        $this->assign('from',$from);
        $this->display('login.tpl');
    }

    /**
     * Render /index.php/loginCommit
     */
    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $from     = $this->input->post('from');

        $this->config->load('app_encryption');
        $conf =  $this->config->item('encryption');

        $options = [ 
            'cost' => 12, 
            'salt'=>$conf['salt'],
        ];  
        $ciphertext = password_hash($password, PASSWORD_BCRYPT, $options);
        $this->load->model('user_model');
        $uc = $this->user_model->identify($username, $ciphertext);

        if (1 == $uc) {
            $newdata = array(
                'username'  => $username,
                'logged_in' => true,
            );  
            $this -> load -> library('session');
            $this->session->set_userdata($newdata);

            $this->load->helper('url');
            $url = "/".$from;
            redirect($url, 'auto', 302);
        } else {
            $this->load->helper('url');
            $url = "/login?from=".$from;
            redirect($url, 'auto', 302);
        }
    }

    /**
     * Render /index.php/mine
     */
    public function mine()
    {
        $this->display('header.tpl');
        $this->display('mine.tpl');
        $this->display('footer.tpl');
    }

    /**
     * Render /index.php/profile
     */
    public function profile()
    {
        $this->load->library('session');
        $username = $this->session->userdata('username');
        $this->load->model('user_model', 'user');
        $user = $this->user->getUserByName($username);

        $this->assign('user', $user);
        $this->display('header.tpl');
        $this->display('profile.tpl');
        $this->display('footer.tpl');
    }

    /**
     * Render /index.php/logout
     */
    public function logout()
    {
        $this->load->library('session');

        if ($this->session->has_userdata('username')) {
            $this->session->unset_userdata('username');
        }
        
        if ($this->session->has_userdata('logged_in')) {
            $this->session->unset_userdata('logged_in');
        }

        $url = "/";
        redirect($url, 'auto', 302);
    }
}

