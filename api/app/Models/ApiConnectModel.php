<?php

namespace App\Models;

use CodeIgniter\Model;

class ApiConnectModel extends Model
{
    protected $table = 'estoque_produtos';
    protected $primaryKey = 'id_estoque_produto';
    protected $allowedFields = ['codDeBarra','produtoDescricao','estoque','estoqueMinimo','precoCompra','margemLucro','precoVenda','observacao','estoque_location_id','estoque_medida_id','estoque_marca_id','financeiro_nota_id','imagemProduto','pathImagem','saida','entrada','dataCadastro','dateUpdate','status','msg_status'];
    protected $returnType = 'object';
    public function getAPIData(){
        return $this->findAll();
    }
}