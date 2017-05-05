<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['teams'] = array(
    'sre'=>array(
        'display'=>'SRE团队',
        'members'=>array(
            'zhangsan'=>array(
                'display'=>'张三',
                'tel'=>'110',
                'email'=>'zhangsan@gmail.com',
                'duty'=>'Team Leader',
            ),
            'lisi'=>array(
                'display'=>'李四',
                'tel'=>'119',
                'email'=>'lisi@gmail.com',
                'duty'=>'API Gateway/Big Data Platform/Basic Ops',
            ),
            'wangwu'=>array(
                'display'=>'王五',
                'tel'=>'120',
                'email'=>'wangwu@gmail.com',
                'duty'=>'IT',
            ),
        ),
        "rota"=>array(
            "method"=>"weekday&weekend",
            "weekday"=>array(
                1=>"zhangsan",
                2=>"lisi",
                3=>"wangwu",
                4=>"zhangsan",
                5=>"lisi",
            ),
            "weekend"=>array(
                "zhangsan","lisi","wangwu",
            ),
            "basetime"=>"2017-05-01",
            "pioneer"=>0,
        ),
    ),
);

/* End of file app_team.php */
/* Location: ./application/config/app_team.php */
