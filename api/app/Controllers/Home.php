<?php

namespace App\Controllers;

use App\Models\ApiConnectModel;

class Home extends BaseController
{

    public function index($id)
    {
        echo "ID do cliente: ".$id ;
    }
}
