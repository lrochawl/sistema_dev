<?php

namespace App\Models;

use CodeIgniter\Model;

class produtosModel extends Model
{
    protected $table = 'estoque_produtos';
    protected $primaryKey = 'id_estoque_produtos';
}