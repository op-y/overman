<?php

/**
 *  Controller class, process idc related route
 *
 *  @author ye.zhiqin@outlook.com
 */
class Idc extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Render /index.php/idc
     */
    public function index()
    {
        $this->display('header.tpl');
        $this->display('idc.tpl');
        $this->display('footer.tpl');
    }
}

