<?php

namespace App\Controllers;

use App\Models\ApiConnectModel;

class Home extends BaseController
{
    public function index($ambiente, $local)
    {

        $apiConnectModel = new ApiConnectModel();
        $array = array('name' => $ambiente, 'title' => $local);
        $query = $db->where($array)->get(‘table_name’);
        return view('welcome_message', $data);
    }
}
