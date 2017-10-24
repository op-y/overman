<?php

/**
 *  A Controller class: handle ajax request related to log file collector.
 *
 *  @author ye.zhiqin@outlook.com
 */
class Logfile extends MY_Controller
{

    /**
     *  Load model: logfile
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('logfile_model', 'logfile');
    }

    /**
     * Process AJAX request: POST /index.php/ajaxGetLogfile
     *
     * @return json
     */
    public function ajaxGetLogfile()
    {
        $draw = $this->input->get('draw');
        $start = $this->input->get('start');
        $length = $this->input->get('length');
        $searchValue = $this->input->get('search[value]');

        $logfiles = $this->logfile->getLogfiles($start, $length, $searchValue);
        $recordsTotal = $this->logfile->getLogfilesTotal($searchValue);
        $recordsFiltered = count($logfiles);

        $result = array(
            "draw"=>$draw,
            "recordsTotal"=>$recordsTotal,
            "recordsFiltered"=>$recordsTotal,
            "data"=>$logfiles,
        );
        $json = json_encode($result);
        echo $json;
    }
}

