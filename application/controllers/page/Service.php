<?php

/**
 *  Controller class, process service related route
 *
 *  @author ye.zhiqin@outlook.com
 */
class Service extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    // a test method
    public function test()
    {
        if ($this->hasAuthority(47,1)) {
            echo "Yes, I have!";
        } else {
            echo "No, I have not!";
        }
        return;
    }

    /**
     * Render /index.php/service
     */
    public function index()
    {
        $this->display('header.tpl');
        $this->display('sidebar.tpl');
        $this->display('service.tpl');
        $this->display('footer.tpl');
    }

    /**
     * Render /index.php/service
     */
    public function service()
    {
        $this->display('header.tpl');
        $this->display('sidebar.tpl');
        $this->display('service.tpl');
        $this->display('footer.tpl');
    }

    /**
     * Render /index.php/deployment
     */
    public function deployment() {
        $this->display('header.tpl');
        $this->display('sidebar.tpl');
        $this->display('deployment.tpl');
        $this->display('footer.tpl');
    }

    /**
     * Render /index.php/status
     */
    public function status()
    {
        $this->display('header.tpl');
        $this->display('sidebar.tpl');
        $this->display('status.tpl');
        $this->display('footer.tpl');
    }
}

