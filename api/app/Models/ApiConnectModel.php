<?php

namespace App\Models;

use CodeIgniter\Model;

class ApiConnectModel extends Model
{
    

    public function getAPIData(){
        return $this->findAll();
    }
}