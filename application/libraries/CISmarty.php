<?php 
if(!defined('BASEPATH')) exit('No direct script asscess allowed'); 
require_once( APPPATH . 'libraries/Smarty/Smarty.class.php' ); 

class CISmarty extends Smarty { 
    protected $ci; 
    public function  __construct(){
        parent::__construct();
        $this->ci = & get_instance(); 
        $this->ci->load->config('smarty');
        $this->template_dir   = $this->ci->config->item('template_dir'); 
        $this->compile_dir    = $this->ci->config->item('compile_dir'); 
        $this->cache_dir      = $this->ci->config->item('cache_dir');
        $this->config_dir     = $this->ci->config->item('config_dir'); 
        $this->caching        = $this->ci->config->item('caching'); 
        $this->cache_lifetime = $this->ci->config->item('lefttime'); 
    } 
}
