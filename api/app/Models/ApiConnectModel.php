<?php

namespace App\Models;

use CodeIgniter\Model;

class ApiConnectModel extends Model
{
    protected $table = 'estoque_produtos';
    protected $primaryKey = 'id_estoque_produto';
    protected $allowedFields = ['codDeBarra','produtoDescricao','estoque','estoqueMinimo','precoCompra','margemLucro','precoVenda','observacao','estoque_location_id','estoque_medida_id','estoque_marca_id','financeiro_nota_id','imagemProduto','pathImagem','saida','entrada','dataCadastro','dateUpdate','status','msg_status'];
    protected $returnType = 'object';
   
    public function getProdutoByLocal($local)
    {
    $produtosModel = new produtosModel();
    $locaisModel = new locaisModel();

    $query = $produtosModel->select('estoque_produtos.*')
        ->join('estoque_locations', 'estoque_locations.id_estoque_location = estoque_produtos.estoque_location_id')
        ->like('estoque_locations.location', $local)
        ->get();

    return $query->getResult();
    }
    
}