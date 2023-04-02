<!doctype html>
<html lang="en">

<head>
	<title>Table 06</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="<?= base_url('recursos/css/style.css') ?>">
	<style>
		h2#linkScan {
			margin-top: 8%;
		}
	</style>

</head>
<?php if (is_array($produtos) and !empty($produtos)) : ?>

	<body onload="mostraTabela()">
	<?php else : ?>

		<body onload="escondeTabela()">
		<?php endif ?>

		<section class="ftco-section">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-6 text-center mb-4">
						<h2 class="heading-section" onload="mostraTabela()">
							<?= (is_array($produtos) and !empty($produtos)) ? "😊 A pesquisa localizou $quantidade registros" : "😒 Não há produtos a serem exibidos neste local "  ?>
						</h2>
						<h3 id="titulo" class="heading-section"><?= $local ?></h3>
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
									<?php foreach ($produtos as $produto) : ?>
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
											<td><?= $produto->id_estoque_produto." - ". $produto->produtoDescricao ?></td>
											<td class="quantity">
												<div class="input-group">
													<span><?=  $this->produtos_model->converteMedida($produto->estoque, $produto->estoque_medida_id, 'D');?></span>
												</div>
											</td>
											<td><?= $produto->tipo_produto ?></td>
											<td><?= $produto->marca ?></td>
											<td><a href="https://dev.wltopos.com/index.php/produtos/visualizar/<?= $produto->id_estoque_produto ?>">Detalhes</a></td>
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

		<script src="<?= base_url('recursos/js/jquery.min.js') ?>"></script>
		<script src="<?= base_url('recursos/js/popper.js') ?>"></script>
		<script src="<?= base_url('recursos/js/bootstrap.min.js') ?>"></script>
		<script src="<?= base_url('recursos/js/main.js') ?>"></script>
		<script>
			function escondeTabela() {
				$(".col-md-12").hide();
				$("#titulo").append('<h2 id="linkScan" class="heading-section"><a href="https://dev.wltopos.com/QrCode">Scanear novamente</a></h2>');
			}

			function mostraTabela() {
				$(".col-md-12").show();
				$("#titulo").append('<h2 id="linkScan" class="heading-section"><a href="https://dev.wltopos.com/QrCode">Scanear novamente</a></h2>');
			}
		</script>

		</body>

</html>