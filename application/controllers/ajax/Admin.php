<?php

/**
 *  A Controller class: handle ajax request related to administration.
 *
 *  @author ye.zhiqin@outlook.com
 */
class Admin extends MY_Controller
{

    /**
     *  Load model: user
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model', 'user');
    }

    /**
     * Process AJAX request: POST /index.php/ajaxGetUsers
     *
     * @return json
     */
    public function ajaxGetUsers()
    {
        $users = $this->user->getUsers();
        $length = count($users);
        $result = array(
            "draw"=>1,
            "recordsTotal"=>$length,
            "recordsFiltered"=>$length,
            "data"=>$users,
        );
        $json = json_encode($result);
        echo $json;
    }

    /**
     * Process AJAX request: POST /index.php/ajaxGetUserOpts
     *
     * @return json
     */
    public function ajaxGetUserOpts()
    {
        $users = $this->user->getUserOpts();
        $json = json_encode($users);
        echo $json;
    }

    /**
     * Process AJAX request: POST /index.php/ajaxGetServiceOpts
     *
     * @return json
     */
    public function ajaxGetServiceOpts()
    {
        $services = $this->user->getServiceOpts();
        $json = json_encode($services);
        echo $json;
    }

    /**
     * Process AJAX request: POST /index.php/ajaxGetRoleOpts
     *
     * @return json
     */
    public function ajaxGetRoleOpts()
    {
        $roles = $this->user->getRoleOpts();
        $json = json_encode($roles);
        echo $json;
    }

    /**
     * Process AJAX request: POST /index.php/ajaxAddUser
     *
     * @return json
     */
    public function ajaxAddUser()
    {
        $username = $this->input->post('username');
        $tel      = $this->input->post('tel');
        $email    = $this->input->post('email');
        $password = $this->input->post('password');

        $this->config->load('app_encryption');
        $conf =  $this->config->item('encryption');

        $options = [ 
            'cost' => 12, 
            'salt'=>$conf['salt'],
        ];  
        $ciphertext = password_hash($password, PASSWORD_BCRYPT, $options);

        $cnt = $this->user->addUser($username, $tel, $email, 'USING', '', $ciphertext);
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
     * Process AJAX request: POST /index.php/ajaxAddAuth
     *
     * @return json
     */
    public function ajaxAddAuth()
    {
        $userId = $this->input->post('userId');
        $roleId = $this->input->post('roleId');
        $srvIds = $this->input->post('srvIds');

        $data = array();
        $serviceIds = explode("-", $srvIds);
        foreach ($serviceIds as $serviceId) {
            if ($serviceId != "" && $serviceId != null) {
                $auth = array(
                    'user_id'=>$userId,
                    'service_id'=>$serviceId,
                    'role_id'=>$roleId,
                );
                array_push($data, $auth);
            }
        }

        $cnt = $this->user->addAuth($data);
        $result = array(
            "cnt"=>$cnt,
        );
        $json = json_encode($result);
        echo $json;
    }
}

