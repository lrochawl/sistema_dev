<?php defined('BASEPATH') or exit('Ação não permitida');

class Home extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
    
    }

    public function index(){
        $this->load->view('restrita/layout/header');
        $this->load->view('restrita/home/index');
        $this->load->view('restrita/layout/settings');
        $this->load->view('restrita/layout/footer');
    }
}