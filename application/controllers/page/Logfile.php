<?php

/**
 *  Controller class, process log related route
 *
 *  @author ye.zhiqin@outlook.com
 */
class Logfile extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Render /index.php/logfile
     */
    public function index()
    {
        $this->display('header.tpl');
        $this->display('logfile.tpl');
        $this->display('footer.tpl');
    }
}

