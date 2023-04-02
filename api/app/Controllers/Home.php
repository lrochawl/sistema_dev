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
        $data['apiConnectModel'] = $apiConnectModel;
        $data['medidas'] = [
            [
                'tabela' => 'estoque_sistema_medidas',
                'id1' => 'estoque_medidas.estoque_sistema_medida_id',
                'id2' => 'estoque_sistema_medidas.id_estoque_sistema_medida',
            ]
        ];

        return view('qr_list', $data);
    }
}
