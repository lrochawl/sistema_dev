<?php

namespace App\Models;

use CodeIgniter\Model;

class ApiConnectModel extends Model
{
    protected $table      = 'usuarios';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nome', 'email'];

    public function getAPIData(){
        return $this->findAll();
    }
}