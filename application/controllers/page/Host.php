<?php

/**
 *  Controller class, process host related route
 *
 *  @author ye.zhiqin@outlook.com
 */
class Host extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Render /index.php/host
     */
    public function index()
    {
        $this->display('header.tpl');
        $this->display('host.tpl');
        $this->display('footer.tpl');
    }
}

