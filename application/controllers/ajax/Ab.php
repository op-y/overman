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

        $this->config->load('app_ab');
        $conf =  $this->config->item('ab');

        $redis = new Redis();
        $redis->connect($conf['redis']['ip'], $conf['redis']['port']);

        foreach ($conf['items'] as $itemkey => $item) {
            if ($key == $itemkey) {
                $value = $redis->sMembers($item['key']);

                if (0 != count($value)) {
                    $groups = $this->ab->getGroups($value);
                } else {
                    $groups = null;
                }

                $info = array(
                    'ids'=>$value,
                    'name'=>$item['name'],
                    'groups'=>$groups,
                );
                $json = json_encode($info);
                echo $json;
                return;
            }
        }

        $info = array(
            'ids'=>null,
            'name'=>null,
            'groups'=>null,
        );
        $json = json_encode($info);
        echo $json;
        return;
    }
}

