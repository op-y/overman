<?php

/**
 *  Controller class, process administration route
 *
 *  @author ye.zhiqin@outlook.com
 */
class Admin extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Render /index.php/admin
     */
    public function index()
    {
        $this->display('header.tpl');
        $this->display('admin.tpl');
        $this->display('footer.tpl');
    }
}

