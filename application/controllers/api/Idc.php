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
        try {
            $message = $idcs = $this->idc->getIdcs();
            $cnt = count($idcs);
            $result = array(
                "status"=>"success",
                "message"=>$message,
                "count"=>$cnt,
                "data"=>$idcs,
            );
            $json = json_encode($result);
            echo $json;
        } catch (Exception $e) {
            $cnt = 0;
            $result = array(
                "status"=>"failure",
                "message"=>$e->getMessage(),
                "count"=>$cnt,
                "data"=>null,
            );
            $json = json_encode($result);
            echo $json;
        }
    }

    public function addIdcs() {
        $idcs = $this->input->post('idcs');
        if($idcs == "" || is_null($idcs)) {
            $cnt = 0;
            $result = array(
                "status"=>"failure",
                "message"=>"idcs parameter is empty",
                "count"=>$cnt,
                "data"=>null,
            );
            $json = json_encode($result);
            echo $json;
            return;
        }

        try {
            $idcArray = json_decode($idcs);
            if (is_null($idcArray)) {
                $cnt = 0;
                $result = array(
                    "status"=>"failure",
                    "message"=>"idcs json format error",
                    "count"=>$cnt,
                    "data"=>null,
                );
                $json = json_encode($result);
                echo $json;
            }
        } catch(Exception $e) {
            $cnt = 0;
            $result = array(
                "status"=>"failure",
                "message"=>$e->getMessage(),
                "count"=>$cnt,
                "data"=>null,
            );
            $json = json_encode($result);
            echo $json;
        }

        try {
            $cnt = count($idcArray);

            $message = $this->idc->addIdcs($idcArray);
            if($message instanceof Exception) {
                throw $message;
            }

            $result = array(
                "status"=>"success",
                "message"=>$message,
                "count"=>$cnt,
                "data"=>$idcArray,
            );
            $json = json_encode($result);
            echo $json;
        } catch(Exception $e) {
            $cnt = 0;
            $result = array(
                "status"=>"failure",
                "message"=>$e->getMessage(),
                "count"=>$cnt,
                "data"=>null,
            );
            $json = json_encode($result);
            echo $json;
        }
    }

    public function deleteIdc($id) {
        if($id == "" || is_null($id)) {
            $cnt = 0;
            $result = array(
                "status"=>"failure",
                "message"=>"id parameter is empty",
                "count"=>$cnt,
                "data"=>null,
            );
            $json = json_encode($result);
            echo $json;
            return;
        }

        try {
            $cnt = 1;
            $message = $this->idc->deleteIdc($id);
            if($message instanceof Exception) {
                throw $message;
            }

            $result = array(
                "status"=>"success",
                "message"=>$message,
                "count"=>$cnt,
                "data"=>$id,
            );
            $json = json_encode($result);
            echo $json;
        } catch(Exception $e) {
            $cnt = 0;
            $result = array(
                "status"=>"failure",
                "message"=>$e->getMessage(),
                "count"=>$cnt,
                "data"=>null,
            );
            $json = json_encode($result);
            echo $json;
        }
    }
}