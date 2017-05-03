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

    public function ajaxAddHost() {
        $hostname = $this->input->post('hostname');
        $ip       = $this->input->post('ip');
        $idc      = $this->input->post('idc');
        $cpu      = $this->input->post('cpu');
        $memory   = $this->input->post('memory');
        $disk     = $this->input->post('disk');
        $ssd      = $this->input->post('ssd');
        $raid     = $this->input->post('raid');
        $nic      = $this->input->post('nic');

        $message = $this->host->addHost($hostname, $ip, $idc, $cpu, $memory, $disk, $ssd, $raid, $nic);
        $result = array(
            "message"=>$message,
        );
        $json = json_encode($result);
        echo $json;
    }

    public function ajaxUpdateHost() {
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

        $message = $this->host->updateHost($id, $hostname, $ip, $idc, $cpu, $memory, $disk, $ssd, $raid, $nic);
        $result = array(
            "message"=>$message,
        );
        $json = json_encode($result);
        echo $json;
    }

    public function ajaxDeleteHost() {
        $id = $this->input->post('id');
        $message = $this->host->deleteHost($id);
        $result = array(
            "message"=>$message,
        );
        $json = json_encode($result);
        echo $json;
    }
}
