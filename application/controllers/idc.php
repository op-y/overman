<?php
/**
 *  @author ye.zhiqin@outlook.com
 */
class Idc extends MY_Controller {

    /**
     *  The class constructor
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('idc_model', 'idc');
    }

    public function index() {
        $this->display('header.tpl');
        $this->display('idc.tpl');
        $this->display('footer.tpl');
    }

    public function ajaxGetIdcs() {
        $idcs = $this->idc->getIdcs();
        $length = count($idcs);
        $result = array(
            "draw"=>1,
            "recordsTotal"=>$length,
            "recordsFiltered"=>$length,
            "data"=>$idcs,
        );
        $json = json_encode($result);
        echo $json;
    }

}
