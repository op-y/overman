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

    public function ajaxAddIdc() {
        $name          = $this->input->post('name');
        $address       = $this->input->post('address');
        $administrator = $this->input->post('administrator');
        $tel           = $this->input->post('tel');
        $message = $this->idc->addIdc($name, $address, $administrator, $tel);
        $result = array(
            "message"=>$message,
        );
        $json = json_encode($result);
        echo $json;
    }

    public function ajaxUpdateIdc() {
        $id            = $this->input->post('id');
        $name          = $this->input->post('name');
        $address       = $this->input->post('address');
        $administrator = $this->input->post('administrator');
        $tel           = $this->input->post('tel');
        $message = $this->idc->updateIdc($id, $name, $address, $administrator, $tel);
        $result = array(
            "message"=>$message,
        );
        $json = json_encode($result);
        echo $json;
    }

    public function ajaxDeleteIdc() {
        $id = $this->input->post('id');
        $message = $this->idc->deleteIdc($id);
        $result = array(
            "message"=>$message,
        );
        $json = json_encode($result);
        echo $json;
    }

}
