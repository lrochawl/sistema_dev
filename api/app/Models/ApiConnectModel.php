<?php

namespace App\Models;

use CodeIgniter\Model;

class ApiConnectModel extends Model
{
    protected $table = 'estoque_produtos';
    protected $primaryKey = 'id_estoque_produto';
    protected $allowedFields = ['codDeBarra', 'produtoDescricao', 'estoque', 'estoqueMinimo', 'precoCompra', 'margemLucro', 'precoVenda', 'observacao', 'estoque_location_id', 'estoque_medida_id', 'estoque_marca_id', 'financeiro_nota_id', 'imagemProduto', 'pathImagem', 'saida', 'entrada', 'dataCadastro', 'dateUpdate', 'status', 'msg_status'];
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

        return $query;
    }

    public function converteMedida($estoqueAtual, $idMedidaDefault, $medidaConvert, $estoqueMinimo = 1)
    {
        //MEDIDA PADRÃO <<<< MEDIDA SISTEMA >>>>> MEDIDA FRACIONADA
        $produtosModel = new produtosModel();
        $medidasModel = new medidasModel();

        $data = $medidasModel->select('estoque_sistema_medidas.*, estoque_medidas.*')
            ->join('estoque_sistema_medidas', 'estoque_medidas.estoque_sistema_medida_id = estoque_sistema_medidas.id_estoque_sistema_medida')
            ->where('id_estoque_medida', $idMedidaDefault)
            ->get();

       $data = get_object_vars($data);
   
        if ($medidaConvert == 'D') { //Medida sistema para medida padrão
            $estoque['valorConvertido'] = $estoqueAtual / $data[0]->multiplicador;

            if ($data['status'] == 2) {
                $estoque['texto']   =  $estoque['valorConvertido'] . " " . ($estoque['valorConvertido'] > 1 ? $data[0]->medida . 'S' : $data[0]->medida);
                $estoque['textoRS'] = $estoque['valorConvertido'] . " " . ($estoque['valorConvertido'] > 1 ? $data[0]->medida . 'S' : $data[0]->medida);

                $estoque['valorConvertidoEstoqueMinimo'] = $estoqueMinimo / $data[0]->multiplicador;
                $estoque['textoEstoqueMinimo'] = $estoque['valorConvertidoEstoqueMinimo'] . " " . ($estoque['valorConvertido'] > 1 ? $data[0]->medida . 'S' : $data[0]->medida);
                $estoque['textoEstoqueMinimoRS'] = $estoque['valorConvertidoEstoqueMinimo'] . " " . ($estoque['valorConvertido'] > 1 ? $data[0]->medida . 'S' : $data[0]->medida);
            } else {
                $estoque['texto'] = $estoque['valorConvertido'] . " " . ($estoque['valorConvertido'] > 1 ? $data[0]->medida . 'S' : $data[0]->medida) . " COM " . $data[0]->multiplicador . " " . ($data[0]->multiplicador > 1 ? $data[0]->medidaSistema . 'S' : $data[0]->medidaSistema);
                $estoque['textoRS'] = $estoque['valorConvertido'] . " " . ($estoque['valorConvertido'] > 1 ? $data[0]->medida . 'S' : $data[0]->medida);

                $estoque['valorConvertidoEstoqueMinimo'] = $estoqueMinimo / $data[0]->multiplicador;
                $estoque['textoEstoqueMinimo'] = $estoque['valorConvertidoEstoqueMinimo'] . " " . ($estoque['valorConvertido'] > 1 ? $data[0]->medida . 'S' : $data[0]->medida) . " COM " . $data[0]->multiplicador . " " . ($data[0]->multiplicador > 1 ? $data[0]->medidaSistema . 'S' : $data[0]->medidaSistema);
                $estoque['textoEstoqueMinimoRS'] = $estoque['valorConvertidoEstoqueMinimo'] . " " . ($estoque['valorConvertido'] > 1 ? $data[0]->medida . 'S' : $data[0]->medida);
            }

            $estoque['sigla'] = $data[0]->siglaMedida;

            return $estoque;
        }

        if ($medidaConvert == 'S') { //Medida padrão para medida sistema
            $estoque['valorConvertido'] = $estoqueAtual * $data[0]->multiplicador;
            $estoque['texto'] = $estoque['valorConvertido'] . " " . ($estoque['valorConvertido'] > 1 ? $data[0]->medidaSistema . 'S' : $data[0]->medidaSistema);

            $estoque['valorConvertidoEstoqueMinimo'] = $estoqueMinimo * $data[0]->multiplicador;
            $estoque['textoEstoqueMinimo'] = $estoque['valorConvertido'] . " " . ($estoque['valorConvertido'] > 1 ? $data[0]->medidaSistema . 'S' : $data[0]->medidaSistema);

            $estoque['sigla'] = $data[0]->siglaMedidaSistema;

            return $estoque;
        }

        if ($medidaConvert == 'F') { //Medida sistema para medida fracionada
            $estoque['valorConvertido'] = $estoqueAtual * $data[0]->fracionadorSistema;
            $estoque['texto'] = $estoque['valorConvertido'] . " " . $data[0]->fracionadorSistema;

            $estoque['valorConvertidoEstoqueMinimo'] = $estoqueAtual * $data[0]->fracionadorSistema;
            $estoque['textoEstoqueMinimo'] = $estoque['valorConvertido'] . " " . $data[0]->fracionadorSistema;

            $estoque['sigla'] = $data[0]->siglaFracaoSistema;

            return $estoque;
        }

        if ($medidaConvert == 'FF') { //Medida fracionada para medida sistema
            $estoque['valorConvertido'] = $estoqueAtual / $data[0]->fracionadorSistema;
            $estoque['texto'] = $estoque['valorConvertido'] . " " . $data[0]->fracionadorSistema;

            $estoque['valorConvertidoEstoqueMinimo'] = $estoqueAtual * $data[0]->fracionadorSistema;
            $estoque['textoEstoqueMinimo'] = $estoque['valorConvertido'] . " " . $data[0]->fracionadorSistema;

            $estoque['sigla'] = $data[0]->siglaFracaoSistema;

            return $estoque;
        }
    }
}
