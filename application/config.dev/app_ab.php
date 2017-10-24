<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['ab'] = array(
    'redis'=>array(
        'ip'=>'127.0.0.1',
        'port'=>6379,
    ),
    'items'=>array(
        'module1'=>array(
            'name'=>'module1',
            'domain'=>'test.com',
            'key'=>'test.com',
            'type'=>'set',
            'func'=>array(
                'name1',
                'name2',
            ),
        ),
        'module2'=>array(
            'name'=>'module2',
            'domain'=>'test.com',
            'key'=>'test.com',
            'type'=>'set',
            'func'=>array(
                'name1',
                'name2',
            ),
        ),
    ),
);

