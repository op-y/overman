<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['deployment'] = array(
    'imageList'=>array(
        'method'=>'GET',
        'protocol'=>'http',
        'host'=>'test.com',
        'port'=>80,
        'uri'=>'/test/image',
        'params' => array(
            'circumstance'=>'',
            'image'=>'',
            'limit'=>5,
        ),
    ),
    'k8sStatus'=>array(
        'method'=>'GET',
        'protocol'=>'http',
        'host'=>'test.com',
        'port'=>80,
        'uri'=>'/test/deployment',
        'params' => array(
            'service_name'=>'',
            'circumstance'=>'',
        ),
    ),
    'k8sUpdate'=>array(
        'method'=>'PUT',
        'protocol'=>'http',
        'host'=>'test.com',
        'port'=>80,
        'uri'=>'/test/deployment',
        'params' => array(
            'service_name'=>'',
            'circumstance'=>'',
            'container'=>'',
            'image_id'=>'',
        ),
    ),
    'k8sRollback'=>array(
        'method'=>'PUT',
        'protocol'=>'http',
        'host'=>'test.com',
        'port'=>80,
        'uri'=>'/test/deployment',
        'params' => array(
            'service_name'=>'',
            'circumstance'=>'',
            'rollback'=>'true',
        ),
    ),
    'k8sPause'=>array(
        'method'=>'PUT',
        'protocol'=>'http',
        'host'=>'test.com',
        'port'=>80,
        'uri'=>'/test/deployment',
        'params' => array(
            'service_name'=>'',
            'circumstance'=>'',
            'pause'=>'true',
        ),
    ),
    'k8sResume'=>array(
        'method'=>'PUT',
        'protocol'=>'http',
        'host'=>'test.com',
        'port'=>80,
        'uri'=>'/test/deployment',
        'params' => array(
            'service_name'=>'',
            'circumstance'=>'',
            'pause'=>'false',
        ),
    ),
    'k8sReboot'=>array(
        'method'=>'PUT',
        'protocol'=>'http',
        'host'=>'test.com',
        'port'=>80,
        'uri'=>'/pod/restart',
        'params' => array(
            'service_name'=>'',
            'circumstance'=>'',
            'idc'=>'',
        ),
    ),
);

