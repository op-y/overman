<?php

/**
 *  Controller class, process team related route
 *
 *  @author ye.zhiqin@outlook.com
 */
class Info extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Render /index.php/team
     */
    public function team()
    {
        $this->config->load('app_team');
        $data =  $this->config->item('teams');
        $this->assign('teams', $data);
        $this->display('header.tpl');
        $this->display('team.tpl');
        $this->display('footer.tpl');
    }

    /**
     * Render /index.php/event
     */
    public function event()
    {
        $this->display('header.tpl');
        $this->display('event.tpl');
        $this->display('footer.tpl');
    }
}

