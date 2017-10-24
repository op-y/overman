<?php if (!defined('BASEPATH')) exit('No direct access allowed.');
/**
 * We add assign and display method for Smarty template engine.
 * isLogin method used for check user login status.
 * hasAuthority method used for check user authority.
 * response method used for output JSON response.
 *
 * @author  ye.zhiqin@outlook.com
 */

/**
 * Custom controller class
 *
 * This class object is the super class that every application
 * controller class must inherit
 *
 * @author ye.zhiqin@outlook.com
 */
class MY_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Assign value to template
     *
     * @param key
     * @param val
     */
    public function assign($key, $val)
    {
        $this->cismarty->assign($key, $val);
    }

    /**
     * Render a certain template
     *
     * @param html
     */
    public function display($html)
    {
        $this->cismarty->display($html);
    }

    /**
     * Generate JSON formate HTTP response body
     *
     * @param code
     * @param status
     * @param message
     * @param data
     * @return json
     */
    public function response($code, $status, $message, $data)
    {
        $content = array(
            'code'=>$code,
            'status'=>$status,
            'message'=>$message,
            'data'=>$data,
        );
        $json = json_encode($content);
        echo $json;
    }

    /**
     * Check user login status
     *
     * @return true/false
     */
    public function isLogin()
    {
        $this->load->library('session');    
        if ($this->session->has_userdata('username')
            && $this->session->has_userdata('logged_in')
            && true == $this->session->userdata('logged_in')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check user's authority for a certain service
     *
     * @param serviceId
     * @param privilegeId
     * @return true/false
     */
    public function hasAuthority($serviceId, $privilegeId)
    {
        $this->load->library('session');    
        $username = $this->session->userdata('username');

        $params = array(
            'username'=>$username,
            'serviceId'=>$serviceId,
            'privilegeId'=>$privilegeId,
        );
        $this->load->library('authority', $params);    

        return $this->authority->hasAuthority();
    }
}

