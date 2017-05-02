<?php
/**
 *  @author ye.zhiqin@outlook.com
 */
class Host extends MY_Controller {

    /**
     *  The class constructor
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('host_model', 'host');
    }

    public function index() {
        $this->display('header.tpl');
        $this->display('host.tpl');
        $this->display('footer.tpl');
    }

    public function ajaxGetHosts() {
        $hosts = $this->host->getHosts();
        $length = count($hosts);
        $result = array(
            "draw"=>1,
            "recordsTotal"=>$length,
            "recordsFiltered"=>$length,
            "data"=>$hosts,
        );
        $json = json_encode($result);
        echo $json;
    }
}
