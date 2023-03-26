<?php

namespace App\Controllers;

use App\Models\ApiConnectModel;

class Home extends BaseController
{
   
   
   public function index(){
    return view('welcome_message');
   }
    public function qr($local)
    {

        $apiConnectModel = new ApiConnectModel();
        $data['produtos'] = $apiConnectModel->getProdutoByLocal($local);

        return view('welcome_message', $data);
    }
}
