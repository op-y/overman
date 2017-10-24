<?php

/**
 *  A Controller class: handle ajax request related to IDC.
 *
 *  @author ye.zhiqin@outlook.com
 */
class Idc extends MY_Controller
{

    /**
     *  Load model: idc
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('idc_model', 'idc');
    }

    /**
     * Process AJAX request: POST /index.php/ajaxGetIdcs
     *
     * @return json
     */
    public function ajaxGetIdcs()
    {
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

    /**
     * Process AJAX request: POST /index.php/ajaxGetIdcCode
     *
     * @return json
     */
    public function ajaxGetIdcCode()
    {
        $idcs = $this->idc->getIdcs();
        $result = array(
            "idcs"=>$idcs,
        );
        $json = json_encode($result);
        echo $json;
    }

    /**
     * Process AJAX request: POST /index.php/ajaxAddIdc
     *
     * @return json
     */
    public function ajaxAddIdc()
    {
        $name          = $this->input->post('name');
        $code          = $this->input->post('code');
        $address       = $this->input->post('address');
        $administrator = $this->input->post('administrator');
        $tel           = $this->input->post('tel');
        $message = $this->idc->addIdc($name, $code, $address, $administrator, $tel);
        $result = array(
            "message"=>$message,
        );
        $json = json_encode($result);
        echo $json;
    }

    /**
     * Process AJAX request: POST /index.php/ajaxUpdateIdc
     *
     * @return json
     */
    public function ajaxUpdateIdc()
    {
        if (! $this->isLogin()) {
            $this->response(401, 'fail', 'Not Login', null);
            return;
        }

        /*
         * bool hasAuthority($serviceId, $privilegeId)
         * serviceId 1: top level service 'SRE'
         * privilegeId 4: resource manage privilege 'RESO'
         */
        if (! $this->hasAuthority(1,4)) {
            $this->response(401, 'fail', 'Permission Denied', null);
            return;
        }

        $id            = $this->input->post('id');
        $name          = $this->input->post('name');
        $code          = $this->input->post('code');
        $address       = $this->input->post('address');
        $administrator = $this->input->post('administrator');
        $tel           = $this->input->post('tel');
        $result = $this->idc->updateIdc($id, $name, $code, $address, $administrator, $tel);
        $this->response(200, 'succ', 'OK', $result);
        return;
    }

    /**
     * Process AJAX request: POST /index.php/ajaxDeleteIdc
     *
     * @return json
     */
    public function ajaxDeleteIdc()
    {
        if (! $this->isLogin()) {
            $this->response(401, 'fail', 'Not Login', null);
            return;
        }

        /*
         * bool hasAuthority($serviceId, $privilegeId)
         * serviceId 1: top level service 'SRE'
         * privilegeId 4: resource manage privilege 'RESO'
         */
        if (! $this->hasAuthority(1,4)) {
            $this->response(401, 'fail', 'Permission Denied', null);
            return;
        }

        $id = $this->input->post('id');
        $result = $this->idc->deleteIdc($id);
        $this->response(200, 'succ', 'OK', $result);
        return;
    }
}

