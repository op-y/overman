<?php

/**
 *  A Controller class, process host API related route.
 *
 *  @author ye.zhiqin@outlook.com
 */
class Host extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('host_model', 'host');
    }

    /**
     * API: GET /index.php/api/host
     *
     * @return json
     */
    public function getHosts()
    {
        try {
            $hosts = $this->host->getHosts();
            $cnt = count($hosts);
            $result = array(
                "status"=>"success",
                "message"=>"get host info done",
                "count"=>$cnt,
                "data"=>$hosts,
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

    /**
     * API: POST /index.php/api/host
     *
     * @return json
     */
    public function addHosts()
    {
        $hosts = $this->input->post('hosts');
        if ($hosts == "" || is_null($hosts)) {
            $cnt = 0;
            $result = array(
                "status"=>"failure",
                "message"=>"hosts parameter is empty",
                "count"=>$cnt,
                "data"=>null,
            );
            $json = json_encode($result);
            echo $json;
            return;
        }

        try {
            $hostArray = json_decode($hosts);
            if (is_null($hostArray)) {
                $cnt = 0;
                $result = array(
                    "status"=>"failure",
                    "message"=>"hosts json format error",
                    "count"=>$cnt,
                    "data"=>null,
                );
                $json = json_encode($result);
                echo $json;
            }
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

        try {
            $cnt = count($hostArray);
            $message = $this->host->addHosts($hostArray);
            if ($message instanceof Exception) {
                throw $message;
            }

            $result = array(
                "status"=>"success",
                "message"=>$message,
                "count"=>$cnt,
                "data"=>$hostArray,
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

    /**
     * API: DELETE /index.php/api/host
     *
     * @return json
     */
    public function deleteHost($id)
    {
        if ($id == "" || is_null($id)) {
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
            $message = $this->host->deleteHost($id);
            if ($message instanceof Exception) {
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
}

