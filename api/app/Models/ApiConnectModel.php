<?php

namespace App\Models;

use CodeIgniter\Model;

class ApiConnectModel extends Model
{
    protected $table = 'estoque_produtos';
    protected $primaryKey = 'id_estoque_produto';
    protected $allowedFields = ['codDeBarra','produtoDescricao','estoque','estoqueMinimo','precoCompra','margemLucro','precoVenda','observacao','estoque_location_id','estoque_medida_id','estoque_marca_id','financeiro_nota_id','imagemProduto','pathImagem','saida','entrada','dataCadastro','dateUpdate','status','msg_status'];
    protected $returnType = 'object';
   
    public function getProdutoByLocal($ambiente, $local)
    {
    $produtosModel = new produtosModel();
    $locaisModel = new locaisModel();

    $query = $produtosModel->select('estoque_produtos.*, estoque_locations.*, estoque_tipo_produtos.*, estoque_marcas.*')
        ->join('estoque_locations', 'estoque_locations.id_estoque_location = estoque_produtos.estoque_location_id')
        ->join('estoque_tipo_produtos', 'estoque_tipo_produtos.id_estoque_tipo_produto = estoque_produtos.estoque_tipo_produto_id')
        ->join('estoque_marcas', 'estoque_marcas.id_estoque_marca = estoque_produtos.estoque_marca_id')
        ->where('estoque_locations.location', $local)
        ->where('estoque_locations.ambiente', $ambiente)
        ->get();

    return $query->getResult();
    }
    
}