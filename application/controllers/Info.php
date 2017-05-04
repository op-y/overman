<?php
/**
 *  @author ye.zhiqin@outlook.com
 */
class Info extends MY_Controller {

    /**
     *  The class constructor
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('event_model', 'event');
    }

    public function team() {
        $this->config->load('app_team');
        $data =  $this->config->item('teams');
        $this->assign('teams', $data);
        $this->display('header.tpl');
        $this->display('team.tpl');
        $this->display('footer.tpl');
    }

    public function ajaxGetRota() {
        $today = date("Y-m-d");
        $today_start_sts = (string)(strtotime($today+"T00:00:00") * 1000);
        $today_end_sts = (string)(strtotime($today+"T23:59:59") * 1000);
        $weekday = date("D");

        $rota = array(
            array(
                "id"=>"1",
                "title"=>"值班人:张三",
                "url"=>"http://www.baidu.com/",
                "class"=>"event-info",
                "start"=>"1493568000000",
                "end"=>"1493654399000",
            ),
        );
        $data = array(
            "success"=>1,
            "result"=>$rota,
        );
        $json = json_encode($data);
        echo $json;
    }
    
    public function event() {
        $this->display('header.tpl');
        $this->display('event.tpl');
        $this->display('footer.tpl');
    }

    public function ajaxGetEvents() {
        $events = $this->event->getEvents();
        $data = array(
            "success"=>1,
            "result"=>$events,
        );
        $json = json_encode($data);
        echo $json;
    }
    
    public function ajaxAddEvent() {
        $title = $this->input->post('title');
        $url   = $this->input->post('url');
        $kind  = $this->input->post('kind');
        $start = $this->input->post('start');
        $end   = $this->input->post('end');

        $start_sts = (string)(strtotime($start) * 1000);
        $end_sts = (string)(strtotime($end) * 1000);

        $message = $this->event->addEvent($title, $url, $kind, $start_sts, $end_sts);
        $result = array(
            "message"=>$message,
        );
        $json = json_encode($result);
        echo $json;
    }
}
