<?php

namespace App\Controllers;

use App\Models\ApiConnectModel;

class Home extends BaseController
{
    public function qr($local)
    {

        $apiConnectModel = new ApiConnectModel();
       // $data['usuarios'] = $apiConnectModel->getProdutoByLocal($local);
  print_r($local);
  exit();
        return view('welcome_message', $data);
    }
}
