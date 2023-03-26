<?php

namespace App\Controllers;

use App\Models\ApiConnectModel;

class Home extends BaseController
{
    public function index()
    {

        $apiConnectModel = new ApiConnectModel();
        $data['usuarios'] = $apiConnectModel->getAPIData();
  print_r($data);
  exit();
        return view('welcome_message', $data);
    }
}
