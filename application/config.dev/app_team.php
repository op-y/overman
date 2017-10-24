<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['teams'] = array(
    'sre'=>array(
        'display'=>'SRE团队',
        'members'=>array(
            'zhangsan'=>array(
                'display'=>'张三',
                'tel'=>'10086',
                'email'=>'zhangsan@test.com',
                'duty'=>'Team Leader',
            ),
            'lisi'=>array(
                'display'=>'李四',
                'tel'=>'10086',
                'email'=>'lisi@test.com',
                'duty'=>'SRE',
            ),
            'wangwu'=>array(
                'display'=>'王五',
                'tel'=>'10086',
                'email'=>'wangwu@test.com',
                'duty'=>'IT',
            ),
        ),
        "rota"=>array(
            "method"=>"weekday&weekend",
            "weekday"=>array(
                1=>"zhangsan",
                2=>"lisi",
                3=>"wangwu",
                4=>"AI",
                5=>"AI",
            ),
            "weekend"=>array(
                "zhangsan","lisi","wangwu","AI","AI",
            ),
            "basetime"=>"2017-05-01",
            "pioneer"=>0,
        ),
    ),
);

