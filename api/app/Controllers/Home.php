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
        $data['produtos'] = $apiConnectModel->getProdutoByLocal($ambiente, $local)->getResult();
        $data['quantidade']    = $apiConnectModel->getProdutoByLocal($ambiente, $local)->getNumRows();
        $data['local']    = "Ambiente: ".strtoupper($ambiente)." Local: ".strtoupper($local);

        return view('qr_list', $data);
    }
}
