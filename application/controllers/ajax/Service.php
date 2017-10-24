<?php

/**
 *  A Controller class: handle ajax request related to service.
 *
 *  @author ye.zhiqin@outlook.com
 */
class Service extends MY_Controller
{

    /**
     *  Load model: service
     *  Load model: user
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('service_model', 'service');
        $this->load->model('user_model', 'user');
    }

    /**
     * Process AJAX request: POST /index.php/ajaxTreeServices
     *
     * @return json
     */
    public function ajaxTreeServices()
    {
        $this->load->library('session');    
        $username = $this->session->userdata('username');
        $ids = $this->user->getAuthorizedServiceId($username);
        $services = $this->service->getTreeServices();

        $params = array('ids' => $ids, 'services' => $services);
        $this->load->library('serviceTree', $params);    
        $tree = $this->servicetree->getOwnedTree();
        $json = json_encode($tree);
        echo $json;
    }

    /**
     * Process AJAX request: POST /index.php/ajaxTreeNode
     *
     * @return json
     */
    public function ajaxTreeNode()
    {
        $id  = $this->input->post('id');
        $ids = array(
            (object)array('serviceId'=>$id)
        );

        $services = $this->service->getTreeServices();

        $params = array('ids' => $ids, 'services' => $services);
        $this->load->library('serviceTree', $params);    
        $tree = $this->servicetree->getSubTree();

        $json = json_encode($tree);
        echo $json;
    }

    /**
     * Process AJAX request: POST /index.php/ajaxSubServices
     *
     * @return json
     */
    public function ajaxSubServices()
    {
        $id  = $this->input->post('id');
        $children = $this->service->getSubServices($id);
        if ($children === null || count($children) == 0) {
            $children = null;
        }
        $result = array(
            "subservices"=>$children,
        );
        $json = json_encode($result);
        echo $json;
    }

    /**
     * Process AJAX request: POST /index.php/ajaxAddService
     *
     * @return json
     */
    public function ajaxAddService() {
        $pid  = $this->input->post('pid');
        $name = $this->input->post('name');
        $kind = $this->input->post('kind');
        $message = $this->service->addService($pid, $name, $kind);
        $result = array(
            "message"=>$message,
        );
        $json = json_encode($result);
        echo $json;
    }

    /**
     * Process AJAX request: POST /index.php/ajaxUpdateService
     *
     * @return json
     */
    public function ajaxUpdateService()
    {
        $id   = $this->input->post('id');
        $name = $this->input->post('name');
        $message = $this->service->updateService($id, $name);
        $result = array(
            "message"=>$message,
        );
        $json = json_encode($result);
        echo $json;
    }

    /**
     * Process AJAX request: POST /index.php/ajaxDeleteService
     *
     * @return json
     */
    public function ajaxDeleteService()
    {
        $id = $this->input->post('id');
        $message = $this->service->deleteService($id);
        $result = array(
            "message"=>$message,
        );
        $json = json_encode($result);
        echo $json;
    }

    /**
     * Process AJAX request: POST /index.php/ajaxGetDeployment
     *
     * @return json
     */
    public function ajaxGetDeployment()
    {
        $id  = $this->input->post('id');
        $deployment = $this->service->getDeploymentByService($id);
        $result = array(
            "deployment"=>$deployment,
        );
        $json = json_encode($result);
        echo $json;
    }

    /**
     * Process AJAX request: POST /index.php/ajaxConfigDeployment
     *
     * @return json
     */
    public function ajaxConfigDeployment() {
        $id                = $this->input->post('id');
        $serviceId         = $this->input->post('serviceid');
        $namespace         = $this->input->post('namespace');
        $idc               = $this->input->post('idc');
        $jenkinsJobName    = $this->input->post('jenkinsJobName');
        $jenkinsRepoURL    = $this->input->post('jenkinsRepoURL');
        $jenkinsRepoBranch = $this->input->post('jenkinsRepoBranch');
        $jenkinsMavenParam = $this->input->post('jenkinsMavenParam');
        $jenkinsJarPath    = $this->input->post('jenkinsJarPath');
        $jenkinsRunParam   = $this->input->post('jenkinsRunParam');
        $imageRepoURL      = $this->input->post('imageRepoURL');
        $k8sServiceName    = $this->input->post('k8sServiceName');
        $k8sServicePort    = $this->input->post('k8sServicePort');

        $message = $this->service->configDeployment(
            $id, 
            $serviceId, 
            $namespace, 
            $idc, 
            $jenkinsJobName, 
            $jenkinsRepoURL, 
            $jenkinsRepoBranch, 
            $jenkinsMavenParam, 
            $jenkinsJarPath, 
            $jenkinsRunParam, 
            $imageRepoURL, 
            $k8sServiceName, 
            $k8sServicePort, 
            "UPDATED");
        $result = array(
            "message"=>$message,
        );
        $json = json_encode($result);
        echo $json;
    }

    /**
     * Process AJAX request: POST /index.php/ajaxGetDeploymentHistory
     *
     * @return json
     */
    public function ajaxGetDeploymentHistory()
    {
        $serviceId = $this->input->post('serviceId');

        $history = $this->service->getHistoryByService($serviceId);
        $result = array(
            "history"=>$history,
        );
        $json = json_encode($result);
        echo $json;
    }

    /**
     * Process AJAX request: POST /index.php/ajaxUpdate
     *
     * @return json
     */
    public function ajaxUpdate()
    {
        $serviceId    = $this->input->post('serviceId');
        $circumstance = $this->input->post('env');
        $idc          = $this->input->post('idc');
        $serviceName  = $this->input->post('module');
        $imageTag     = $this->input->post('imageTag');

        $this->load->library('session');    
        $username = $this->session->userdata('username');
        $user = $this->user->getUserId($username);
        $userId = $user->userId;

        $timestamp = date("Y-m-d H:i:s",time());

        $this->config->load('app_deployment');
        $k8s = $this->config->item('deployment');
        $method   = $k8s['k8sUpdate']['method'];
        $protocol = $k8s['k8sUpdate']['protocol'];
        $host     = $k8s['k8sUpdate']['host'];
        $port     = $k8s['k8sUpdate']['port'];
        $uri      = $k8s['k8sUpdate']['uri'];

        $url = $protocol."://".$host.":".$port.$uri."?circumstance=".$circumstance."&idc=".$idc."&service_name=".$serviceName."&image_id=".$imageTag;
        $this->load->helper('curl');
        $result = curl_call($url, $method, null, null);
        $resultObj = json_decode($result);

        if ("201" == $resultObj->code) {
            $this->service->addDeployLog($timestamp, $userId, $serviceId, $imageTag, 60, "SUCC");
        } elseif ("1015" == $resultObj->code) {
            $this->service->addDeployLog($timestamp, $userId, $serviceId, $imageTag, 60, "KEEP");
        } else {
            $this->service->addDeployLog($timestamp, $userId, $serviceId, $imageTag, 60, "FAIL");
        }

        $data = array(
            'message'=>$resultObj->message,
            'code'=>$resultObj->code,
        );
        $json = json_encode($data);
        echo $json;
    }

    /**
     * Process AJAX request: POST /index.php/ajaxRollback
     *
     * @return json
     */
    public function ajaxRollback()
    {
        $circumstance = $this->input->post('env');
        $idc          = $this->input->post('idc');
        $serviceName  = $this->input->post('module');

        $this->config->load('app_deployment');
        $k8s = $this->config->item('deployment');
        $method   = $k8s['k8sRollback']['method'];
        $protocol = $k8s['k8sRollback']['protocol'];
        $host     = $k8s['k8sRollback']['host'];
        $port     = $k8s['k8sRollback']['port'];
        $uri      = $k8s['k8sRollback']['uri'];
        $rollback = $k8s['k8sRollback']['params']['rollback'];

        $url = $protocol."://".$host.":".$port.$uri."?circumstance=".$circumstance."&idc=".$idc."&service_name=".$serviceName."&rollback=".$rollback;
        $this->load->helper('curl');
        $result = curl_call($url, $method, null, null);
        $resultObj = json_decode($result);

        $data = array(
            'message'=>$resultObj->message,
            'code'=>$resultObj->code,
        );
        $json = json_encode($data);
        echo $json;
    }

    /**
     * Process AJAX request: POST /index.php/ajaxPause
     *
     * @return json
     */
    public function ajaxPause()
    {
        $circumstance = $this->input->post('env');
        $idc          = $this->input->post('idc');
        $serviceName  = $this->input->post('module');

        $this->config->load('app_deployment');
        $k8s = $this->config->item('deployment');
        $method   = $k8s['k8sPause']['method'];
        $protocol = $k8s['k8sPause']['protocol'];
        $host     = $k8s['k8sPause']['host'];
        $port     = $k8s['k8sPause']['port'];
        $uri      = $k8s['k8sPause']['uri'];
        $pause    = $k8s['k8sPause']['params']['pause'];

        $url = $protocol."://".$host.":".$port.$uri."?circumstance=".$circumstance."&idc=".$idc."&service_name=".$serviceName."&pause=".$pause;
        $this->load->helper('curl');
        $result = curl_call($url, $method, null, null);
        $resultObj = json_decode($result);
        $data = array(
            'message'=>$resultObj->message,
            'code'=>$resultObj->code,
        );
        $json = json_encode($data);
        echo $json;
    }

    /**
     * Process AJAX request: POST /index.php/ajaxResume
     *
     * @return json
     */
    public function ajaxResume()
    {
        $circumstance = $this->input->post('env');
        $idc          = $this->input->post('idc');
        $serviceName  = $this->input->post('module');

        $this->config->load('app_deployment');
        $k8s = $this->config->item('deployment');
        $method   = $k8s['k8sResume']['method'];
        $protocol = $k8s['k8sResume']['protocol'];
        $host     = $k8s['k8sResume']['host'];
        $port     = $k8s['k8sResume']['port'];
        $uri      = $k8s['k8sResume']['uri'];
        $pause    = $k8s['k8sResume']['params']['pause'];

        $url = $protocol."://".$host.":".$port.$uri."?circumstance=".$circumstance."&idc=".$idc."&service_name=".$serviceName."&pause=".$pause;
        $this->load->helper('curl');
        $result = curl_call($url, $method, null, null);
        $resultObj = json_decode($result);
        $data = array(
            'message'=>$resultObj->message,
            'code'=>$resultObj->code,
        );
        $json = json_encode($data);
        echo $json;
    }

    /**
     * Process AJAX request: POST /index.php/ajaxGetDeploymentStatus
     *
     * @return json
     */
    public function ajaxGetDeploymentStatus()
    {
        $circumstance = $this->input->post('circumstance');
        $idc          = $this->input->post('idc');
        $serviceName  = $this->input->post('serviceName');

        $this->config->load('app_deployment');
        $k8s = $this->config->item('deployment');
        $method   = $k8s['k8sStatus']['method'];
        $protocol = $k8s['k8sStatus']['protocol'];
        $host     = $k8s['k8sStatus']['host'];
        $port     = $k8s['k8sStatus']['port'];
        $uri      = $k8s['k8sStatus']['uri'];

        $url = $protocol."://".$host.":".$port.$uri."?circumstance=".$circumstance."&idc=".$idc."&service_name=".$serviceName;
        $this->load->helper('curl');
        $result = curl_call($url, $method, null, null);
        echo $result;
    }

    /**
     * Process AJAX request: POST /index.php/ajaxGetImages
     *
     * @return json
     */
    public function ajaxGetImages()
    {
        $id = $this->input->post('id');

        $deployment = $this->service->getDeploymentByService($id);
        $circumstance = $deployment->namespace;
        $image        = $deployment->k8sServiceName;

        $this->config->load('app_deployment');
        $k8s = $this->config->item('deployment');
        $method   = $k8s['imageList']['method'];
        $protocol = $k8s['imageList']['protocol'];
        $host     = $k8s['imageList']['host'];
        $port     = $k8s['imageList']['port'];
        $uri      = $k8s['imageList']['uri'];
        $limit    = $k8s['imageList']['params']['limit'];

        $url = $protocol."://".$host.":".$port.$uri."?circumstance=".$circumstance."&image=".$image."&limit=".$limit;
        $this->load->helper('curl');
        $result = curl_call($url, $method, null, null);
        echo $result;
    }

    /**
     * Process AJAX request: POST /index.php/ajaxGetJDKStatus
     *
     * @return json
     */
    public function ajaxGetJDKStatus()
    {
        $deployName  = $this->input->post('deployName');
        $env         = $this->input->post('env');
        $idc         = $this->input->post('idc');
        $jdkCommand  = $this->input->post('command');

        $this->config->load('app_status');
        $status = $this->config->item('status');
        $method   = $status['jdklog']['method'];
        $protocol = $status['jdklog']['protocol'];
        $host     = $status['jdklog']['host'];
        $port     = $status['jdklog']['port'];
        $uri      = $status['jdklog']['uri'];
        $download = $status['jdklog']['params']['download'];

        $url = $protocol."://".$host.":".$port.$uri."?circumstance=".$env."&service_name=".$deployName."&idc=".$idc."&command=".$jdkCommand."&download=".$download;
        $this->load->helper('curl');
        $result = curl_call($url, $method, null, null);
        echo $result;
    }

    /**
     * Process AJAX request: POST /index.php/ajaxGetPodLog
     *
     * @return json
     */
    public function ajaxGetPodLog()
    {
        $deployName = $this->input->post('deployName');
        $env        = $this->input->post('env');
        $idc        = $this->input->post('idc');

        $this->config->load('app_status');
        $status = $this->config->item('status');
        $method   = $status['podlog']['method'];
        $protocol = $status['podlog']['protocol'];
        $host     = $status['podlog']['host'];
        $port     = $status['podlog']['port'];
        $uri      = $status['podlog']['uri'];
        $download = $status['podlog']['params']['download'];

        $url = $protocol."://".$host.":".$port.$uri."?circumstance=".$env."&service_name=".$deployName."&idc=".$idc."&download=".$download;
        $this->load->helper('curl');
        $result = curl_call($url, $method, null, null);
        echo $result;
    }
}

