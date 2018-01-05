<?php

/**
 *  Controller class, process A/B Test related route
 *
 *  @author ye.zhiqin@outlook.com
 */
class Ab extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Render /index.php/ab
     */
    public function index()
    {
        $this->config->load('app_ab');
        $conf =  $this->config->item('ab');

        $redis = new Redis();
        $redis->connect($conf['redis']['ip'], $conf['redis']['port']);

        $abTest  = array();
        foreach ($conf['items'] as $itemkey => $item) {
            $value = $redis->sMembers($item['key']);
            $count = count($value);
            $func = $item['func'];
            $tips = join(' | ', $func);
            $test = array(
                'itemkey'=>$itemkey,
                'name'=>$item['name'],
                'domain'=>$item['domain'],
                'count'=>$count,
                'tips'=>$tips,
            );
            array_push($abTest, $test);
        }

        $this->assign('abTest', $abTest);
        $this->display('header.tpl');
        $this->display('ab.tpl');
        $this->display('footer.tpl');
    }

    /**
     * Render /index.php/abOp
     */
    public function ops()
    {
        $this->config->load('app_ab');
        $conf =  $this->config->item('ab');

        $redisConf = $conf['redis'];
        $redisList = array(
            "redis"=>$redisConf['ip'].":".$redisConf['port'],
        );

        $redisKeys = array();
        foreach ($conf['items'] as $itemkey => $item) {
            $key = $item['name'];
            $value = $item['key'];
            $redisKeys[$key]=$value;
        }

        $this->assign('redisList', $redisList);
        $this->assign('redisKeys', $redisKeys);
        $this->display('header.tpl');
        $this->display('abOp.tpl');
        $this->display('footer.tpl');
    }

    /**
     * Render /index.php/abGroups/(:any)
     */
    public function groups($key)
    {
        $this->assign('key', $key);
        $this->display('header.tpl');
        $this->display('abdetail.tpl');
        $this->display('footer.tpl');
    }
}

