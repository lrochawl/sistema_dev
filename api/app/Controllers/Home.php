<?php

namespace App\Controllers;

use App\Models\ApiConnectModel;

class Home extends BaseController
{
   
   
   public function index(){
    return view('welcome_message');
   }
    public function qr($ambiente, $local)
    {

        $apiConnectModel = new ApiConnectModel();
        $data['produtos'] = $apiConnectModel->getProdutoByLocal($ambiente, $local);

        return view('qr_list', $data);
    }
}
