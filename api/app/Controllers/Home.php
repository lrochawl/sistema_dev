<?php

namespace App\Controllers;

use App\Models\ApiConnectModel;

class Home extends BaseController
{
    public function mostrar($idCliente)
    {
        echo "ID do cliente: " . $idCliente;
    }
}
