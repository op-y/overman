<?php

/**
 * SSO login class
 * class SSO is a before controller hook.
 * login method is a request filter.
 *
 * @author  ye.zhiqin@outlook.com
 */
class SSO
{

    /**
     * Reference to the CI singleton
     *
     * @var ci
     */
    public function __construct()
    {
        $this->ci = & get_instance();
    }

    /**
     * Filter request.
     * Redirect to login page if user did not login.
     */
    public function login()
    {
        $this->ci->load->library('session');  
        $this->ci->load->helper('url');

        $uri =  uri_string();

        if ($uri === "") {
            return;
        }

        if (strpos($uri, "hualala123") === 0) {
            return;
        }

        if (strpos($uri, "login") === 0) {
            return;
        }

        if (strpos($uri, "logout") === 0) {
            return;
        }

        if (strpos($uri, "ab") === 0) {
            return;
        }

        if (strpos($uri, "ajax") === 0) {
            return;
        }

        if ($this->ci->session->has_userdata('username') 
            && $this->ci->session->has_userdata('logged_in')
            && TRUE == $this->ci->session->userdata('logged_in')) {
            return true;
        } else {
            $url = "/login?from=".$uri;
            redirect($url, 'auto', 302);
        } 
    }
}

