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
        $marcasModel = new marcasModel();

        $data = $marcasModel->select('estoque_marcas.*')
            ->join('estoque_sistema_medidas', 'estoque_medidas.estoque_sistema_medida_id = estoque_sistema_medidas.id_estoque_sistema_medida')
            ->where('id_estoque_medida', $idMedidaDefault)
            ->get();

        $data = get_object_vars($data);


        if ($medidaConvert == 'D') { //Medida sistema para medida padrão
            $estoque['valorConvertido'] = $estoqueAtual / $data['multiplicador'];

            if ($data['status'] == 2) {
                $estoque['texto'] =  $estoque['valorConvertido'] . " " . ($estoque['valorConvertido'] > 1 ? $data['medida'] . 'S' : $data['medida']);
                $estoque['textoRS'] = $estoque['valorConvertido'] . " " . ($estoque['valorConvertido'] > 1 ? $data['medida'] . 'S' : $data['medida']);

                $estoque['valorConvertidoEstoqueMinimo'] = $estoqueMinimo / $data['multiplicador'];
                $estoque['textoEstoqueMinimo'] = $estoque['valorConvertidoEstoqueMinimo'] . " " . ($estoque['valorConvertido'] > 1 ? $data['medida'] . 'S' : $data['medida']);
                $estoque['textoEstoqueMinimoRS'] = $estoque['valorConvertidoEstoqueMinimo'] . " " . ($estoque['valorConvertido'] > 1 ? $data['medida'] . 'S' : $data['medida']);
            } else {
                $estoque['texto'] = $estoque['valorConvertido'] . " " . ($estoque['valorConvertido'] > 1 ? $data['medida'] . 'S' : $data['medida']) . " COM " . $data['multiplicador'] . " " . ($data['multiplicador'] > 1 ? $data['medidaSistema'] . 'S' : $data['medidaSistema']);
                $estoque['textoRS'] = $estoque['valorConvertido'] . " " . ($estoque['valorConvertido'] > 1 ? $data['medida'] . 'S' : $data['medida']);

                $estoque['valorConvertidoEstoqueMinimo'] = $estoqueMinimo / $data['multiplicador'];
                $estoque['textoEstoqueMinimo'] = $estoque['valorConvertidoEstoqueMinimo'] . " " . ($estoque['valorConvertido'] > 1 ? $data['medida'] . 'S' : $data['medida']) . " COM " . $data['multiplicador'] . " " . ($data['multiplicador'] > 1 ? $data['medidaSistema'] . 'S' : $data['medidaSistema']);
                $estoque['textoEstoqueMinimoRS'] = $estoque['valorConvertidoEstoqueMinimo'] . " " . ($estoque['valorConvertido'] > 1 ? $data['medida'] . 'S' : $data['medida']);
            }

            $estoque['sigla'] = $data['siglaMedida'];

            return $estoque;
        }

        if ($medidaConvert == 'S') { //Medida padrão para medida sistema
            $estoque['valorConvertido'] = $estoqueAtual * $data['multiplicador'];
            $estoque['texto'] = $estoque['valorConvertido'] . " " . ($estoque['valorConvertido'] > 1 ? $data['medidaSistema'] . 'S' : $data['medidaSistema']);

            $estoque['valorConvertidoEstoqueMinimo'] = $estoqueMinimo * $data['multiplicador'];
            $estoque['textoEstoqueMinimo'] = $estoque['valorConvertido'] . " " . ($estoque['valorConvertido'] > 1 ? $data['medidaSistema'] . 'S' : $data['medidaSistema']);

            $estoque['sigla'] = $data['siglaMedidaSistema'];

            return $estoque;
        }

        if ($medidaConvert == 'F') { //Medida sistema para medida fracionada
            $estoque['valorConvertido'] = $estoqueAtual * $data['fracionadorSistema'];
            $estoque['texto'] = $estoque['valorConvertido'] . " " . $data['fracionadorSistema'];

            $estoque['valorConvertidoEstoqueMinimo'] = $estoqueAtual * $data['fracionadorSistema'];
            $estoque['textoEstoqueMinimo'] = $estoque['valorConvertido'] . " " . $data['fracionadorSistema'];

            $estoque['sigla'] = $data['siglaFracaoSistema'];

            return $estoque;
        }

        if ($medidaConvert == 'FF') { //Medida fracionada para medida sistema
            $estoque['valorConvertido'] = $estoqueAtual / $data['fracionadorSistema'];
            $estoque['texto'] = $estoque['valorConvertido'] . " " . $data['fracionadorSistema'];

            $estoque['valorConvertidoEstoqueMinimo'] = $estoqueAtual * $data['fracionadorSistema'];
            $estoque['textoEstoqueMinimo'] = $estoque['valorConvertido'] . " " . $data['fracionadorSistema'];

            $estoque['sigla'] = $data['siglaFracaoSistema'];

            return $estoque;
        }
    }
}
