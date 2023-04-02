<!doctype html>
<html lang="en">
  <head>
  	<title>Table 06</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="<?= base_url('recursos/css/style.css') ?>">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-4">
					<?php if(is_array($produtos) and !empty($produtos)):?>
					<h2 class="heading-section">Tabela de Produtos Localizados (<?= $local ?>)</h2>
					<?php else: ?>
						<h2 class="heading-section">Não há produtos neste local (<?= $local ?>)</h2>
					<?php endif ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h3 class="h5 mb-4 text-center">QR Search</h3>
					<div class="table-wrap">
						<table class="table">
						  <thead class="thead-primary">
						    <tr>
						    	<th>&nbsp;</th>
						    	<th>&nbsp;</th>
						    	<th>Local</th>
						      <th>Produto</th>
						      <th>Quantidade</th>
						      <th>Grupo</th>
						      <th>Quantidade</th>
						      <th>&nbsp;</th>
						      <th>&nbsp;</th>
						    </tr>
						  </thead>
						  <tbody>
                            <?php foreach($produtos as $produto):?>
						    <tr class="alert" role="alert">
						    	<td>
						    		<label class="checkbox-wrap checkbox-primary">
										  <input type="checkbox" checked>
										  <span class="checkmark"></span>
										</label>
						    	</td>
						    	<td>
						    		<div class="img" style="background-image: url(<?= $produto->imagemProduto ?>);"></div>
						    	</td>
						      <td>
						      	<div class="email">
						      		<span><?= $produto->location ?> </span>
						      		<span><?= $produto->ambiente ?> </span>
						      	</div>
						      </td>
						      <td><?= $produto->produtoDescricao ?></td>
						      <td class="quantity">
					        	<div class="input-group">
				             	<input type="text" name="quantity" class="quantity form-control input-number" value="<?= $produto->estoque ?>" min="1" max="100">
				          	</div>
				          </td>
				          <td><?= $produto->tipo_produto ?></td>
				          <td><?= $produto->marca ?></td>
				          <td><a href="https://sistema.wltopos.com.br/index.php/produtos/editar/<?= $produto->id_estoque_produto ?>">Editar</a></td>
						      <td>
						      	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				            	<span aria-hidden="true"><i class="fa fa-close"></i></span>
				          	</button>
				        	</td>
						    </tr>
                            <?php endforeach ?>
						  </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="<?= base_url('recursos/js/jquery.min.js')?>"></script>
  <script src="<?= base_url('recursos/js/popper.js')?>"></script>
  <script src="<?= base_url('recursos/js/bootstrap.min.js')?>"></script>
  <script src="<?= base_url('recursos/js/main.js')?>"></script>

	</body>
</html>

