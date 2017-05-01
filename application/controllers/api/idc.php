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

    public function getIdcs() {
        echo "Here query Idcs";
    }

    public function addIdcs() {
        echo "Here insert Idcs to DB";
    }

    public function updateIdcs() {
        echo "Here update Idcs in DB";
    }

    public function deleteIdcs() {
        echo "Here delete Idcs from DB";
    }

}
