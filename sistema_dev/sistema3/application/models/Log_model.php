<?php defined('BASEPATH') or exit('Ação não permitida');


class Log_model extends CI_Model{

    public function __construct($debug){
        parent::__construct();

        echo '<pre>';
        print_r($debug);
        exit();
    }
}