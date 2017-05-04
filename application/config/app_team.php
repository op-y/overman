<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['teams'] = array(
    'sre'=>array(
        'title'=>'SRE团队',
        'members'=>array(
            array(
                'name'=>'张三',
                'tel'=>'110',
                'email'=>'zhangsan@gmail.com',
                'duty'=>'Team Leader',
            ),
            array(
                'name'=>'李四',
                'tel'=>'119',
                'email'=>'lisi@gmail.com',
                'duty'=>'API Gateway/Big Data Platform/Basic Ops',
            ),
            array(
                'name'=>'王五',
                'tel'=>'120',
                'email'=>'wangwu@gmail.com',
                'duty'=>'IT',
            ),
        ),
        "rota"=>array(
            "method"=>"weekday&weekend",
            "weekday"=>array(
                "Mon"=>"zhangsan",
                "Tue"=>"lisi",
                "wed"=>"wangwu",
                "Thu"=>"zhangsan",
                "Fri"=>"lisi",
            ),
            "weekend"=>array(
                "zhangsan","lisi","wangwu",
            ),
            "basetime"=>"2017-05-06",
            "pioneer"=>"zhangsan",
        ),
    ),
);

/* End of file app_team.php */
/* Location: ./application/config/app_team.php */
