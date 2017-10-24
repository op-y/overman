<?php
/**
 *  A class handle index page request.
 *  @author ye.zhiqin@outlook.com
 */
class App123 extends MY_Controller
{

    /**
     *  The class constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display billboard page.
     */
    public function index()
    {
        $this->config->load('app_billboard');
        $data =  $this->config->item('app123');
        $this->assign('app123', $data);
        $this->display('header.tpl');
        $this->display('app123.tpl');
        $this->display('footer.tpl');
    }
}

