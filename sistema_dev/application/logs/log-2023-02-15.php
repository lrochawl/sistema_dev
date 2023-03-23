<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-02-15 10:05:06 --> Query error: Cannot add or update a child row: a foreign key constraint fails (`u782442173_db_estoque`.`estoque_produtos`, CONSTRAINT `notaFiscal_produto` FOREIGN KEY (`financeiro_nota_id`) REFERENCES `financeiro_notas` (`id_financeiro_nota`) ON DELETE NO ACTION ON UPDAT) - Invalid query: INSERT INTO `estoque_produtos` (`codDeBarra`, `produtoDescricao`, `estoque_location_id`, `estoque_medida_id`, `estoque_marca_id`, `estoque_tipo_produto_id`, `financeiro_nota_id`, `precoCompra`, `margemLucro`, `precoVenda`, `estoque`, `observacao`, `estoqueMinimo`, `dataCadastro`, `dataVencimento`, `saida`, `entrada`) VALUES ('', '32LY340C', '2', '3', '5', '1', '', '78.00', '100', '156.00', 3, '1::32LB5600 32LB5800 32LY340||', 3, '2023-02-15 10:05:06', '', '1', '1')
ERROR - 2023-02-15 21:43:02 --> 404 Page Not Found: /index
ERROR - 2023-02-15 21:54:35 --> 404 Page Not Found: /index
