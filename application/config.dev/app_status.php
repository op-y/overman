<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['status'] = array(
    'jdklog'=>array(
        'method'=>'POST',
        'protocol'=>'http',
        'host'=>'test.com',
        'port'=>80,
        'uri'=>'/test/exec',
        'params' => array(
            'circumstance'=>'',
            'idc'=>'',
            'service_name'=>'',
            'command'=>'',
            'download'=>'true',
        ),
    ),
    'podlog'=>array(
        'method'=>'GET',
        'protocol'=>'http',
        'host'=>'test.com',
        'port'=>80,
        'uri'=>'/test/termitallog',
        'params' => array(
            'service_name'=>'',
            'circumstance'=>'',
            'idc'=>'',
            'download'=>'true',
        ),
    ),
);

