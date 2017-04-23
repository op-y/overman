<?php
/**
 *  @author ye.zhiqin@outlook.com
 */
class Billboard extends MY_Controller {

    /**
     *  The class constructor
     */
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->config->load('app_billboard');
        $data =  $this->config->item('billboard');
        $this->assign('billboard', $data);
        $this->display('header.tpl');
        $this->display('billboard.tpl');
        $this->display('footer.tpl');
    }
}
