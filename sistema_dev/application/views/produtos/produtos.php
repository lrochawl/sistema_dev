<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/datatable.css" />
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<script src="<?php echo base_url() ?>assets/js/sweetalert2.all.min.js"></script>

<div class="new122" style="margin-top: 0; min-height: 100vh">
    <div class="flexxn">
        <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'aProduto')) { ?>
            <a href="<?php echo base_url(); ?>produtos/adicionar" class="button btn btn-mini btn-success" style="max-width: 160px">
                <span class="button__icon"><i class='bx bx-plus-circle'></i></span><span class="button__text2">Add. Produtos</span></a>
            <a href="#modal-etiquetas" role="button" data-toggle="modal" class="button btn btn-mini btn-warning" style="max-width: 160px">
                <span class="button__icon"><i class='bx bx-barcode-reader'></i></span><span class="button__text2">Gerar Etiquetas</span></a>
            <a href="/produtos/settings" role="button" data-toggle="modal" class="button btn btn-mini btn-primary" style="max-width: 160px">
                <span class="button__icon"><i class='bx  bx-abacus'></i></span><span class="button__text2">Configurar</span></a>
    </div>

<?php } ?>

<div class="widget-box">
    <div class="widget-title">
        <span class="icon">
            <i class="fas fa-shopping-bag"></i>
        </span>
        <h5>Produtos</h5>
    </div>


    <div class="widget-content nopadding tab-content">
        <table id="tabela" class="table table-bordered ">

            <thead>
                <tr>
                    <th>Obs</th>
                    <th>Cod.</th>
                    <th>Grupo</th>
                    <th>Marca</th>
                    <th>Local</th>
                    <th>Descrição</th>
                    <th>Estoque</th>
                    <th>Ação</th>

                </tr>
            </thead>
            <!-- <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Extn.</th>
              
            </tr>
        </tfoot> -->


        </table>
    </div>
</div>
<?php //echo $this->pagination->create_links(); 
?>

<!-- Modal -->
<div id="modal-excluir" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form action="<?php echo base_url() ?>produtos/excluir" method="post">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h5 id="myModalLabel"><i class="fas fa-trash-alt"></i> Excluir Produto</h5>
        </div>
        <div class="modal-body">
            <input type="hidden" class="idProduto" name="id" value="" />
            <h5 style="text-align: center" id="tituloModalExcluir">Deseja realmente excluir este produto?</h5>
        </div>
        <div class="modal-footer" style="display:flex;justify-content: center">
            <button class="button btn btn-warning" data-dismiss="modal" aria-hidden="true">
                <span class="button__icon"><i class="bx bx-x"></i></span><span class="button__text2">Cancelar</span></button>
            <button class="button btn btn-danger" id="bt-salvar"><span class="button__icon"><i class='bx bx-trash'></i></span> <span class="button__text2">Excluir</span></button>
        </div>
    </form>
</div>

<!-- Modal Estoque -->
<div id="atualizar-estoque" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form action="<?php echo base_url() ?>produtos/atualizar_estoque" method="post" id="formEstoque">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h5 id="myModalLabel"><i class="fas fa-plus-square"></i> Atualizar Estoque</h5>
        </div>
        <div class="modal-body">
            <div class="control-group">
                <label for="estoqueAtualTxt" class="control-label">Estoque Atual</label>
                <div class="controls">
                    <input id="estoqueAtualTxt" type="text" value="" readonly />
                    <input type="hidden" id="estoqueAtual" name="estoqueAtual" value="" />
                    <input type="hidden" class="idProduto" name="id" value="" />
                    <input id="medida" type="hidden" name="medida" value="" />

                </div>
            </div>

            <div class="control-group">
                <label for="estoque" class="control-label">Atualizar Produtos<span class="required">*</span></label>
                <div class="controls">
                    <select name="operacao" class="select30" required>
                        <option desabled>Selecione</option>
                        <option value="+">Adicionar</option>
                        <option value="-">Remover</option>
                    </select>

                    <input id="estoque" type="number" name="estoque" value="0" class="input3" required />

                    <select name="selectMedida" class="select30" id="selectMedida" required>
                        <option desabled>Selecione</option>

                    </select>
                </div>
            </div>


        </div>
        <div class="modal-footer" style="display:flex;justify-content: center">
            <button class="button btn btn-primary"><span class="button__icon"><i class="bx bx-sync"></i></span><span class="button__text2">Atualizar</span></button>
            <button class="button btn btn-warning" data-dismiss="modal" aria-hidden="true"><span class="button__icon"><i class="bx bx-x"></i></span><span class="button__text2">Cancelar</span></button>
        </div>
    </form>
</div>

<!-- Modal Etiquetas -->
<div id="modal-etiquetas" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form action="<?php echo base_url() ?>relatorios/produtosEtiquetas" method="get">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h5 id="myModalLabel">Gerar etiquetas com Código de Barras</h5>
        </div>
        <div class="modal-body">
        <div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title" style="margin: -20px 0 0">
                <span class="icon">
                    <i class="fas fa-shopping-bag"></i>
                </span>
                <h5>Cadastro de Produto</h5>
                <?php echo $custom_error; ?>
            </div>
            <div id="imageLogo"> </div>
            <form action="<?php echo current_url(); ?>" id="formProduto" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="drop-zone">
                    <span class="drop-zone__prompt" id="zone__prompt">Arraste o arquivo ou clique para upload</span>
                    <input type="file" name="userfile" class="drop-zone__input">
                    <div id="drop-zone" class="drop-zone__thumb"></div>
                </div>
                <div class="widget-content nopadding tab-content" style="margin-bottom: 2%;">
                    <div class="span6">
                        <input onkeydown='handleEnter(event)' type="hidden" id="adNotaFiscal_id" name="adNotaFiscal_id" value="" />
                        <input onkeydown='handleEnter(event)' type="hidden" id="produto_id" name="codDeBarra" value="" />
                        <input onkeydown='handleEnter(event)' type="hidden" id="imagemProduto" name="imagemProduto" value="" />
                        <div class="control-group">
                            <div class="control-group">
                                <label for="codDeBarra" class="control-label">Código/Referência/GTIN<span class="required">*</span></label>
                                <div class="controls">
                                    <input required onkeydown='handleEnter(event)' autocomplete="off" name="codigo" id="codDeBarra" type="text" value="<?php echo set_value('codDeBarra'); ?>" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="adNotaFiscal" class="control-label">Nota Fiscal<span class="required">*</span></label>
                                <div class="controls">
                                    <input required onkeydown='handleEnter(event)' type="text" autocomplete="off" id="adNotaFiscal" name="adNotaFiscal" value="<?php echo set_value('adNotaFiscal'); ?>" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="selectMarca" class="control-label">Marca<span class="required">*</span></label>
                                <div class="controls">
                                    <select required onkeydown='handleEnter(event)' id="selectMarca" name="marca" value="<?php echo set_value('marca'); ?>">
                                        <?php if (!$resultMarca) {
                                            echo '<option disabled selected>Sem marcas cadastradas</option>';
                                        } else {
                                            echo '<option value="" disabled selected>Selecione uma marca</option>';
                                            foreach ($resultMarca as $rmc) {
                                                echo "<option value=$rmc->id_estoque_marca >$rmc->marca</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="tipoMarca" class="control-label">Grupo<span class="required">*</span></label>
                                <div class="controls">
                                    <select required onkeydown='handleEnter(event)' name="complemento" id="tipoMarca" value="<?php echo set_value('complemento'); ?>">
                                        <?php if (!$resultTipo) {
                                            echo '<option disabled selected>Sem itens cadastrados</option>';
                                        } else {
                                            echo '<option value="" disabled selected>Selecione um item</option>';
                                            foreach ($resultTipo as $rt) {
                                                echo "<option value=$rt->id_estoque_tipo_produto >$rt->tipo_produto</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="descricao" class="control-label">Descrição<span class="required">*</span></label>
                            <div class="controls">
                                <input required onkeydown='handleEnter(event)' id="descricao" type="text" name="descricao" value="<?php echo set_value('descricao'); ?>" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="precoCompra" class="control-label">Preço de Compra(R$)<span class="required">*</span></label>
                            <div class="controls">
                                <input required onkeydown='handleEnter(event)' id="precoCompra" class="money input-numberProduto" data-affixes-stay="true" data-thousands="" data-decimal="." type="text" name="precoCompra" value="<?php echo set_value('precoCompra'); ?>" />
                                Margem (%) <input required onkeydown='handleEnter(event)' style="width: 3em;" id="margemLucro" name="margemLucro" value="<?php echo set_value('margemLucro'); ?>" type="text" placeholder="%" maxlength="3" size="2" />
                                <strong><span style="color: red" id="errorAlert"></span></strong>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="precoVenda" class="control-label">Preço de Venda(R$)<span class="required">*</span></label>
                            <div class="controls">
                                <input required onkeydown='handleEnter(event)' id="precoVenda" class="money" data-affixes-stay="true" data-thousands="" data-decimal="." type="text" name="precoVenda" value="<?php echo set_value('precoVenda'); ?>" readonly />
                                <a class="btn btn-primary btn-calcular" onclick="calcPrecoVenda()" id="calcular" role="button">Calcular</a>
                            </div>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="control-group">
                            <label for="estoque" class="control-label">Estoque<span class="required">*</span></label>
                            <div class="controls">
                                <input required onkeydown='handleEnter(event)' class="input-numberProduto" min="0" id="estoque" type="number" name="estoque" value="<?php echo set_value('estoque'); ?>" />
                                <select required onkeydown='handleEnter(event)' class="wh3" id="unidade" title="unidade" name="unidade" value="<?php echo set_value('unidade'); ?>">
                                    <?php if (!$resultMedida) {
                                        echo '<option disabled selected>Sem madidas cadastradas</option>';
                                    } else {
                                        echo '<option value="" disabled selected>Medida</option>';
                                        foreach ($resultMedida as $r) {
                                            if ($r->status == 1) {
                                                echo "<option value=$r->id_estoque_medida >$r->medida $r->multiplicador $r->siglaMedidaSistema </option>";
                                            } else if ($r->status == 2) {
                                                echo "<option value=$r->id_estoque_medida >$r->medida </option>";
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="estoqueMinimo" class="control-label">Estoque Mínimo</label>
                            <div class="controls">
                                <input required onkeydown='handleEnter(event)' class="input-numberProduto" min="0" id="estoqueMinimo" type="number" name="estoqueMinimo" value="<?php echo set_value('estoqueMinimo'); ?>" />
                                <select required onkeydown='handleEnter(event)' class="wh3" title="locations" name="location" id="locations" value="<?php echo set_value('location'); ?>">

                                    <?php if (!$resultLocations) {
                                        echo '<option disabled selected>Sem Localizações</option>';
                                    } else {
                                        echo '<option value="" disabled selected>Localização</option>';
                                        foreach ($resultLocations as $r) {
                                            echo "<option value=$r->id_estoque_location >$r->location</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="control-group" id="divAddCampo">
                            <label for="addCampo" class="control-label">Adicionar campo<span class="required">*</span></label>
                            <div class="controls">
                                <select required onkeydown='handleEnter(event)' onchange="btAddCampo()"  title="Adicionar campo" name="addCampo" id="addCampo" value="<?php echo set_value('addCampo'); ?>">
                                    <?php if ($resultAddCampo) {
                                        echo  '<option value="0" disabled selected>Tipo de observação</option>';
                                        foreach ($resultAddCampo as $r) {
                                            if (isset($r->addCampo)) {
                                                echo "<option value='$r->id_estoque_addCampo,$r->tipoAddCampo' > $r->addCampo</option>";
                                            }
                                        }
                                    } else {
                                        echo '<option disabled selected>Sem tipos cadastrados</option>';
                                    }
                                    ?>
                                </select>
                                <button title="adicionar campo" class="btn btn-light" type="button" id="add-campo" style="margin-left: 5px;"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
        <div class="modal-footer" style="display:flex;justify-content: center">
            <button class="button btn btn-warning" data-dismiss="modal" aria-hidden="true">
                <span class="button__icon"><i class="bx bx-x"></i></span>
                <span class="button__text2">Cancelar</span></button>
            <button class="button btn btn-success">
                <span class="button__icon">
                    <i class='bx bx-barcode'></i></span>
                    <span class="button__text2">Gerar</span></button>
        </div>
    </form>
</div>


<script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
<!-- Modal Etiquetas e Estoque-->
<script type="text/javascript">
    $(document).ready(function() {

        const DATATABLE_PTBR = {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": " ",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            },
            "select": {
                "rows": {
                    "_": "Selecionado %d linhas",
                    "0": "Nenhuma linha selecionada",
                    "1": "Selecionado 1 linha"
                }
            }
        }

        $('#tabela').DataTable({
            ajax: '<?= site_url('/produtos/getProdutos') ?>',
            "oLanguage": DATATABLE_PTBR,
            "processing": true,
            "lengthChange": true,
            "autoWidth": true,
            "deferRender": true,
            "autoFill": true,
            columnDefs: [

                {
                    target: 0,
                    visible: false,
                },
                {
                    target: 7,
                    width: '114px',
                },
            ],
            "language": {
                // processing: '<i class="fa fa-spinner fa-spin fa-3x fa-aw"></i>',
            },
            "responsive": true,
            "pagingType": $(window).width() < 768 ? 'simple' : 'numbers',
        });

        $("#seleciona_categoria").select2({
            dropdownParent: $("#modal-config")
        });


        //⬇️FUNÇÃO PARA INCLUIR VALORES DOS ATRIBUTOS DO LINK PARA VALUES DO MODAL
        $(document).on('click', 'a', function(event) {

            let produto = $(this).attr('produto');
            let codigo = $(this).attr('codigo');
            let estoqueTxt = $(this).attr('estoqueTxt');
            let estoque = $(this).attr('estoque');
            let dataResult = $(this).attr('data_result');
            let medida = $(this).attr('medida');

            if ($(this).attr('href') == "#modal-excluir") {
                $('.idProduto').val(produto);
                $('#tituloModalExcluir').text(`Deseja realmente excluir o produto de codigo: ${codigo}`);
            }

            if ($(this).attr('href') == "#atualizar-estoque") {
                let dataR = dataResult.split('|');

                $('.idProduto').val(produto);
                $('#estoqueAtualTxt').val(estoqueTxt);
                $('#estoqueAtual').val(estoque);
                $('#medida').val(medida);

                $('#selectMedida').empty();
                $('#selectMedida').append(`<option value="D">${dataR[0]}</option>`);

                if (dataR[0] != dataR[1]) {
                    $('#selectMedida').append(`<option value="S">${dataR[1]}</option>`);
                }
                if (dataR[1] != dataR[2]) {
                    $('#selectMedida').append(`<option value="F">${dataR[2]}</option>`);
                }
            }



        });

        $('#formEstoque').validate({
            rules: {
                estoque: {
                    required: true,
                    number: true
                }
            },
            messages: {
                estoque: {
                    required: 'Campo Requerido.',
                    number: 'Informe um número válido.'
                }
            },
            errorClass: "help-inline",
            errorElement: "span",
            highlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
        });


        //auto complete 
        $('button#bt-salvar1').attr("disabled", true);
        $('button#bt-salvar2').attr("disabled", true);
        $('button#bt-salvar3').attr("disabled", true);
        $("#pesquisa_marca").autocomplete({
            source: "<?php echo base_url(); ?>AutoComplete/autoCompleteMarca",
            minLength: 1,
            close: function(ui) {
                if (ui.label == 'Adicionar marca...')
                    ui.target.value = '';
            },
            select: function(event, ui) {
                $('button#bt-salvar1').attr("disabled", true);
                if (ui.item.id == null) {
                    $("#idCategoriaProduto").val(ui.item.idCategoriaProduto);
                    $("#pesquisa_marca_id").val(ui.item.marca);
                    $("#nome_marca").val('');
                    $("#sigla_marca").val('');
                    $("#seleciona_status_marca").val(1).change();
                    $('#acao_1').val('salvar');
                    $('#atualiza-marca').hide();
                    $('#bt_save-icon1').attr('class', 'bx bx-save');
                    $('#bt_save-text1').text('Salvar');
                    $('button#bt-salvar1').attr("disabled", false);
                } else {
                    $("#idCategoriaProduto").val(ui.item.idCategoriaProduto);
                    $("#pesquisa_marca_id").val(ui.item.id);
                    $("#nome_marca").val(ui.item.marca);
                    $("#sigla_marca").val(ui.item.siglaMarca);
                    $("#seleciona_status_marca").val(ui.item.status).change();
                    $('#acao_1').val('update');
                    $('#atualiza-marca').show();
                    $('#bt_save-icon1').attr('class', 'bx bx-sync');
                    $('#bt_save-text1').text('Atualizar');
                    $('button#bt-salvar1').attr("disabled", false);
                }
            }
        });
        $("#pesquisa_categoria").autocomplete({
            source: "<?php echo base_url(); ?>AutoComplete/autoCompleteCategoria",
            minLength: 1,
            close: function(ui) {
                if (ui.label == 'Adicionar categoria...')
                    ui.target.value = '';
            },
            select: function(event, ui) {
                $('button#bt-salvar2').attr("disabled", true);

                if (ui.item.id == null) {
                    $("#pesquisa_categoria_id").val(ui.item.categoria);
                    $("#pesquisa_categoria").val('');
                    $("#nome_categoria").val('');
                    $("#sigla_categoria").val('');
                    $("#seleciona_status_categoria").val(1).change();
                    $('#acao_2').val('salvar');
                    $('#atualiza-produto').hide();
                    $('#bt_save-icon2').attr('class', 'bx bx-save');
                    $('#bt_save-text2').text('Salvar');
                    $('button#bt-salvar2').attr("disabled", false);
                } else {
                    $("#pesquisa_categoria_id").val(ui.item.id);
                    $("#pesquisa_categoria").val(ui.item.descricaoCategoria);
                    $("#nome_categoria").val(ui.item.descricaoCategoria);
                    $("#sigla_categoria").val(ui.item.siglaCategoria);;
                    $("#seleciona_status_categoria").val(ui.item.statusCategoria).change();
                    $('#acao_2').val('update');
                    $('#atualiza-produto').show();
                    $('#bt_save-icon2').attr('class', 'bx bx-sync');
                    $('#bt_save-text2').text('Atualizar');
                    $('button#bt-salvar2').attr("disabled", false);
                }
            }
        });
        $("#pesquisa_tipo_produto").autocomplete({
            source: "<?php echo base_url(); ?>AutoComplete/autoCompleteTipoProduto",
            minLength: 1,
            close: function(ui) {
                if (ui.label == 'Adicionar marca...')
                    ui.target.value = '';
            },
            select: function(event, ui) {
                $('button#bt-salvar3').attr("disabled", true);
                if (ui.item.id == null) {
                    $("#pesquisa_tipo_produto_id").val(ui.item.produto);
                    $("#pesquisa_tipo_produto").val('');
                    $("#altera_tipo_produto").val('');
                    $("#seleciona_categoria").val(0).change();
                    $("#seleciona_status_produto").val(1).change();
                    $('#acao_3').val('salvar');
                    $('#atualiza-produto').hide();
                    $('#bt_save-icon3').attr('class', 'bx bx-save');
                    $('#bt_save-text3').text('Salvar');
                    $('button#bt-salvar3').attr("disabled", false);
                } else {
                    $("#pesquisa_tipo_produto_id").val(ui.item.id);
                    $("#pesquisa_tipo_produto").val(ui.item.tipoProduto);
                    $("#altera_tipo_produto").val(ui.item.tipoProduto);
                    $("#seleciona_categoria").val(ui.item.idCategoriaProduto).change();
                    $("#seleciona_status_produto").val(ui.item.statusProduto).change();
                    $('#acao_3').val('update');
                    $('#atualiza-produto').show();
                    $('#bt_save-icon3').attr('class', 'bx bx-sync');
                    $('#bt_save-text3').text('Atualizar');
                    $('button#bt-salvar3').attr("disabled", false);
                }
            }
        });

        $("#pesquisa_medida").autocomplete({
            source: "<?php echo base_url(); ?>AutoComplete/autoCompleteMedida",
            minLength: 1,
            close: function(ui) {
                if (ui.label == 'Adicionar marca...')
                    ui.target.value = '';
            },
            select: function(event, ui) {
                $('button#bt-salvar4').attr("disabled", true);
                if (ui.item.id == null) {
                    $("#pesquisa_medida_id").val(ui.item.medida);
                    $("#descricao_medida").val('');
                    $("#descricao_medida").prop("readonly", false);
                    $("#casas_decimais").val('');
                    $("#casas_decimais").prop("readonly", false);
                    $("#multiplicador").val('');
                    $("#multiplicador").prop("readonly", false);
                    $("#sigla_medida").val('');
                    $("#sigla_medida").prop("readonly", false);
                    $("#seleciona_status_medida").val(1).change();
                    $("#seleciona_status_medida").attr("readonly", false);
                    $('button#bt-salvar4').attr("disabled", false);
                    $('#atualiza_medida').hide();
                    $('#bt_save-icon4').attr('class', 'bx bx-save');
                    $('#bt_save-text4').text('Salvar');
                    $('#acao_4').val('salvar');
                    $('#padrao').attr("readonly", false);
                } else {
                    if (ui.item.bloqueio == 0) {
                        $("#pesquisa_medida_id").val(ui.item.id);
                        $("#descricao_medida").val(ui.item.descricaoMedida);
                        $("#descricao_medida").prop("readonly", false);
                        $("#casas_decimais").val(ui.item.casasDecimais);
                        $("#casas_decimais").prop("readonly", false);
                        $("#multiplicador").val(ui.item.multiplicador);
                        $("#multiplicador").prop("readonly", false);
                        $("#sigla_medida").val(ui.item.siglaMedida);
                        $("#sigla_medida").prop("readonly", false);
                        $("#seleciona_status_medida").val(ui.item.statusMedida).change();
                        $("#seleciona_status_medida").attr("readonly", false);
                        $('button#bt-salvar4').attr("disabled", false);
                        $('#atualiza_medida').show();
                        $('#bt_save-icon4').attr('class', 'bx bx-sync');
                        $('#bt_save-text4').text('Atualizar');
                        $('#acao_4').val('update');
                        $('#padrao').val(ui.item.idMedidaSistema).change();
                    } else {
                        $("#pesquisa_medida_id").val(ui.item.id);
                        $("#descricao_medida").val(ui.item.descricaoMedida);
                        $("#descricao_medida").prop("readonly", true);
                        $("#casas_decimais").val(ui.item.casasDecimais);
                        $("#casas_decimais").prop("readonly", true);
                        $("#multiplicador").val(ui.item.multiplicador);
                        $("#multiplicador").prop("readonly", true);
                        $("#sigla_medida").val(ui.item.siglaMedida);
                        $("#sigla_medida").prop("readonly", true);
                        $("#seleciona_status_medida").val(ui.item.statusMedida).change();
                        $("#seleciona_status_medida").attr('readonly', 'readonly');
                        $('button#bt-salvar4').attr("disabled", true);
                        $('#atualiza_medida').show();
                        $('#bt_save-icon4').attr('class', 'bx bx-sync');
                        $('#bt_save-text4').text('Atualizar');
                        $('#msg-medida').text('Medida padrão do sistema não pode ser alterada');
                        $('#msg-medida').css('color', 'red');
                        $('#acao_4').val('update');
                        $('#padrao').val(ui.item.idMedidaSistema).change();
                        $('#padrao').attr("disabled", true);
                    }

                }
            }
        });



    });
</script>