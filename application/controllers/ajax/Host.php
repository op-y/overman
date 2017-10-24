<?php

/**
 *  A Controller class: handle ajax request related to host.
 *
 *  @author ye.zhiqin@outlook.com
 */
class Host extends MY_Controller
{

    /**
     *  Load model: host
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('host_model', 'host');
    }

    /**
     * Process AJAX request: POST /index.php/ajaxGetHosts
     *
     * @return json
     */
    public function ajaxGetHosts()
    {
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

    /**
     * Process AJAX request: POST /index.php/ajaxAddHost
     *
     * @return json
     */
    public function ajaxAddHost()
    {
        $hostname = $this->input->post('hostname');
        $ip       = $this->input->post('ip');
        $idc      = $this->input->post('idc');
        $cpu      = $this->input->post('cpu');
        $memory   = $this->input->post('memory');
        $disk     = $this->input->post('disk');
        $ssd      = $this->input->post('ssd');
        $raid     = $this->input->post('raid');
        $nic      = $this->input->post('nic');
        $os       = $this->input->post('os');
        $kernel   = $this->input->post('kernel');
        $rack     = $this->input->post('rack');

        $message = $this->host->addHost($hostname, $ip, $idc, $cpu, $memory, $disk, $ssd, $raid, $nic, $os, $kernel, $rack);
        $result = array(
            "message"=>$message,
        );
        $json = json_encode($result);
        echo $json;
    }

    /**
     * Process AJAX request: POST /index.php/ajaxUpdateHost
     *
     * @return json
     */
    public function ajaxUpdateHost()
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

        $id       = $this->input->post('id');
        $hostname = $this->input->post('hostname');
        $ip       = $this->input->post('ip');
        $idc      = $this->input->post('idc');
        $cpu      = $this->input->post('cpu');
        $memory   = $this->input->post('memory');
        $disk     = $this->input->post('disk');
        $ssd      = $this->input->post('ssd');
        $raid     = $this->input->post('raid');
        $nic      = $this->input->post('nic');
        $os       = $this->input->post('os');
        $kernel   = $this->input->post('kernel');
        $rack     = $this->input->post('rack');

        $result = $this->host->updateHost($id, $hostname, $ip, $idc, $cpu, $memory, $disk, $ssd, $raid, $nic, $os, $kernel, $rack);
        $this->response(200, 'succ', 'OK', $result);
        return;
    }

    /**
     * Process AJAX request: POST /index.php/ajaxDeleteHost
     *
     * @return json
     */
    public function ajaxDeleteHost()
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
        $result = $this->host->deleteHost($id);
        $this->response(200, 'succ', 'OK', $result);
        return;
    }
}

