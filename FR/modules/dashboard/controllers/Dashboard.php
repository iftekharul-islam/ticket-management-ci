<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends FR_Controller{
    
        function __construct(){
            parent::__construct();
            if (!$this->ion_auth->logged_in() || $this->ion_auth->in_group('customer')){
                redirect('login', 'refresh');
            }
        }
        function index(){
            $data['page_title'] = 'Dashboard';
            $this->mfrk->_render_backend('index', $data);
        }
        
        
}
