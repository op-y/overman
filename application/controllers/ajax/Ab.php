<?php

/**
 *  A Controller class: handle ajax request related to AB test.
 *
 *  @author ye.zhiqin@outlook.com
 */
class Ab extends MY_Controller
{

    /**
     *  Load model: ab
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ab_model', 'ab');
    }

    /**
     * Process AJAX request: POST /index.php/ajaxGetABTest
     *
     * @return json
     */
    public function ajaxGetABTest()
    {
        $groupID = $this->input->post('id');
        $group = $this->ab->getGroup($groupID);
        if (0 == count($group)) {
            $info = array(
                'group'=>null,
                'abtest'=>null,
            );
            $json = json_encode($info);
            echo $json;
            return;
        }

        $this->config->load('app_ab');
        $conf =  $this->config->item('ab');

        $redis = new Redis();
        $redis->connect($conf['redis']['ip'], $conf['redis']['port']);

        $abTest  = array();
        foreach ($conf['items'] as $itemkey => $item) {
            $value = $redis->sMembers($item['key']);
            if (in_array($groupID, $value)) {
                $test = array(
                    'name'=>$item['name'],
                    'domain'=>$item['domain'],
                    'func'=>$item['func'],
                );
                array_push($abTest, $test);
            }
        }

        $info = array(
            'group'=>$group,
            'abtest'=>$abTest,
        );
        $json = json_encode($info);
        echo $json;
        return;
    }

    /**
     * Process AJAX request: POST /index.php/ajaxGetTestGroups
     *
     * @return json
     */
    public function ajaxGetTestGroups()
    {
        $key = $this->input->post('key');
        $draw = $this->input->post('draw');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $searchValue = $this->input->post('search[value]');

        // select one page
        $this->config->load('app_ab');
        $conf =  $this->config->item('ab');

        $redis = new Redis();
        $redis->connect($conf['redis']['ip'], $conf['redis']['port']);

        $recordsTotal = 0;
        $recordsFiltered = 0;
        $groups = array();
        $value = array();
        $ids = array();

        foreach ($conf['items'] as $itemkey => $item) {
            if ($key == $itemkey) {
                $value = $redis->sMembers($item['key']);

                if ($searchValue != null && $searchValue != '') {
                    foreach ($value as $id) {
                        $pos = strpos($id, $searchValue, 0);
                        if ($pos === 0) {
                            array_push($ids, $id);
                        }
                    }
                } else {
                    $ids = $value;
                }

                if (0 != count($ids)) {
                    sort($ids);
                    $idCnt = count($ids);
                    $currentIds = array_slice($ids, $start, $length);

                    $groups = $this->ab->getGroups($currentIds);
                    $recordsTotal = $idCnt;
                    $recordsFiltered = $idCnt;
                } else {
                    $groups = $ids;
                    $recordsTotal = 0;
                    $recordsFiltered = 0;
                }
            }
        }

        // response data
        $result = array(
            "draw"=>$draw,
            "recordsTotal"=>$recordsTotal,
            "recordsFiltered"=>$recordsTotal,
            "data"=>$groups,
        );  
        $json = json_encode($result);
        echo $json;
    }

    /**
     * Process AJAX request: POST /index.php/ajaxDoOp
     *
     * @return json
     */
    public function ajaxDoABOp()
    {
        $this->load->library('session');
        if ($this->session->has_userdata('username') 
            && $this->session->has_userdata('logged_in')
            && TRUE == $this->session->userdata('logged_in')) {
            
            if ("dangersheng" == $this->session->userdata('username') || "yezhiqin" == $this->session->userdata('username')) {
                $redisInstance  = $this->input->post('redis');
                $redisKey       = $this->input->post('key');
                $redisOpType    = $this->input->post('opType');
                $redisSeparator = $this->input->post('separator');
                $redisIds       = $this->input->post('ids');

                $separator = " ";
                switch($redisSeparator) {
                case "comma":
                    $separator = ",";
                    break;
                case "space":
                    $separator = " ";
                    break;
                case "lf":
                    $separator = "\n";
                    break;
                default:
                    break;
                }

                $endpoint = explode(":", $redisInstance);
                $redis = new Redis();
                $redis->connect($endpoint[0], $endpoint[1]);

                switch ($redisOpType) {
                case "add":
                    $value = 0;
                    $ids = explode($separator, $redisIds);
                    foreach ($ids as $id) {
                        if (trim($id) != "") {
                            $count = $redis->sAdd($redisKey, trim($id));
                            $value += $count;
                        }
                    }
                    break;
                case "remove":
                    $value = 0;
                    $ids = explode($separator, $redisIds);
                    foreach ($ids as $id) {
                        if (trim($id) != "") {
                            $count = $redis->sRem($redisKey, trim($id));
                            $value += $count;
                        }
                    }
                    break;
                case "comfirmOne":
                    $value = false;
                    if (trim($redisIds) != "") {
                        $value = $redis->sIsMember($redisKey, $redisIds);
                    }
                    break;
                case "queryCount":
                    $value = $redis->sCard($redisKey);
                    break;
                case "queryAll":
                    $value = $redis->sMembers($redisKey);
                    break;
                default:
                    break;
                }

                $result = array(
                    "code"=>200,
                    "message"=>$value,
                );
                $json = json_encode($result);
                echo $json;
            } else {
                $result = array(
                    "code"=>500,
                    "message"=>"对不起,请联系二哥!",
                );
                $json = json_encode($result);
                echo $json;
            }
        } else {
            $result = array(
                "code"=>500,
                "message"=>"请先登录!",
            );
            $json = json_encode($result);
            echo $json;
        }
    }
}

