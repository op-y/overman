<?php

/**
 *  A Controller class: handle ajax request related to team infomation.
 *
 *  @author ye.zhiqin@outlook.com
 */
class Info extends MY_Controller
{

    /**
     *  Load model: event
     *  Load model: duty
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('event_model', 'event');
        $this->load->model('duty_model', 'duty');
    }

    /**
     * Process AJAX request: POST /index.php/ajaxGetRota
     *
     * @return json
     */
    public function ajaxGetRota()
    {
        $this->config->load('app_team');
        $data =  $this->config->item('teams');

        $rota = array();
        
        // Get the day in a week. If sunday, the day is 7.
        $weekday = date("w");
        if (0 == $weekday) {
            $weekday = 7;
        }

        // Get custom duty records from database.
        $monday_diff = sprintf("%+d day", 1 - $weekday);
        $monday      = date("Y-m-d",strtotime($monday_diff,time()));
        $sunday_diff = sprintf("%+d day", 7 - $weekday);
        $sunday      = date("Y-m-d",strtotime($sunday_diff,time()));
        $tmp_duty    = $this->duty->getWeekDuty($monday, $sunday);

        // Calculate rota.
        for ($i=1;$i<=7;$i++) {
            $diff = sprintf("%+d day", $i - $weekday);
            $that_date = date("Y-m-d",strtotime($diff,time()));
            $start_sts = (string)(mktime(0,0,0,date("n",strtotime($diff,time())),date("j",strtotime($diff,time())),date("Y",strtotime($diff,time())),-1) * 1000);
            $end_sts = (string)(mktime(23,59,59,date("n",strtotime($diff,time())),date("j",strtotime($diff,time())),date("Y",strtotime($diff,time())),-1) * 1000);

            $op = $i;
            if ($i < 6) {
                $name = $data['sre']['rota']['weekday'][$i];
                $op = $data['sre']['members'][$name]['display'];
            } else {
                $basetime = $data['sre']['rota']['basetime'];
                $pioneer = $data['sre']['rota']['pioneer'];
                $len = count($data['sre']['rota']['weekend']);

                $date_base = new DateTime($basetime);
                $date_now = new DateTime(date("Y-m-d",strtotime($diff,time())));
                $date_interval = $date_now->diff($date_base);
                $interval = $date_interval->days + 1;
                $ordinal = floor($interval/7) * 2 + (6==($interval%7)?1:0) + $pioneer;
                $idx = (0==($ordinal%$len)?($len-1):($ordinal%$len - 1));

                $name = $data['sre']['rota']['weekend'][$idx];
                $op = $data['sre']['members'][$name]['display'];
            }

            foreach ($tmp_duty as $one_duty) {
                if ($one_duty['duty_date'] == $that_date) {
                    $name = $one_duty['op'];
                    $op = $data['sre']['members'][$name]['display'];
                    break;
                }
            }

            $event = array(
                "id"=>$i,
                "title"=>"值班人:".$op,
                "url"=>"https://www.baidu.com/",
                "class"=>"event-info",
                "start"=>$start_sts,
                "end"=>$end_sts,
            );
            array_push($rota, $event);
        }

        $data = array(
            "success"=>1,
            "result"=>$rota,
        );
        $json = json_encode($data);
        echo $json;
    }

    /**
     * Process AJAX request: POST /index.php/ajaxChangeDuty
     *
     * @return json
     */
    public function ajaxChangeDuty()
    {
        $duty_date = $this->input->post('dutyDate');
        $op        = $this->input->post('op');
        $message   = $this->duty->changeDuty('sre', $duty_date, $op);
        $result = array(
            "message"=>$message,
        );
        $json = json_encode($result);
        echo $json;
    }
    
    /**
     * Process AJAX request: POST /index.php/ajaxGetEvents
     *
     * @return json
     */
    public function ajaxGetEvents()
    {
        $events = $this->event->getEvents();
        $data = array(
            "success"=>1,
            "result"=>$events,
        );
        $json = json_encode($data);
        echo $json;
    }
    
    /**
     * Process AJAX request: POST /index.php/ajaxAddEvent
     *
     * @return json
     */
    public function ajaxAddEvent()
    {
        $title = $this->input->post('title');
        $url   = $this->input->post('url');
        $kind  = $this->input->post('kind');
        $start = $this->input->post('start');
        $end   = $this->input->post('end');

        $start_sts = (string)(strtotime($start) * 1000);
        $end_sts   = (string)(strtotime($end) * 1000);

        $message = $this->event->addEvent($title, $url, $kind, $start_sts, $end_sts);
        $result = array(
            "message"=>$message,
        );
        $json = json_encode($result);
        echo $json;
    }
}

