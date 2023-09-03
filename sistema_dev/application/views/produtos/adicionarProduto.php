<link rel="stylesheet" href="<?php echo base_url('assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css'); ?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/css/controllers/adcionarProduto.css'); ?>" />
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js') ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert2.all.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/auth/login.js') ?>"></script>
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
                        <input onkeydown='handleEnter(event)' type="hidden" id="produto_id" name="codDeBarra" class="codDeBarra" value="" />
                        <input onkeydown='handleEnter(event)' type="hidden" id="imagemProduto" name="imagemProduto" value="" />
                        <input onkeydown='handleEnter(event)' type="hidden" id="lastID" name="lastID" value="<?php echo $resultProdutos; ?>" />
                        <div class="control-group">
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
                            <div class="control-group">
                                <label for="codDeBarra" class="control-label">Código interno/GTIN<span class="required">*</span></label>
                                <div class="controls input-group">
                                    <input required onkeydown='handleEnter(event)' class="form-control-btn codDeBarra" autocomplete="off" name="codigo" id="codDeBarra" type="text" value="<?php echo set_value('codDeBarra'); ?>" />
                                    <button class="btn btn-primary botaoGerarCodigo" type="button"><a href="#"><i class="bx bx-refresh"></i></a></button>

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
                                <select required onkeydown='handleEnter(event)' onchange="btAddCampo()" title="Adicionar campo" name="addCampo" id="addCampo" value="<?php echo set_value('addCampo'); ?>">
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
                                <button title="adicionar campo" class="btn btn-light" type="button" id="add-campo" ><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        <!--  <div class="control-group">
                        <label class="control-label">Tipo de Movimento</label>
                        <div class="controls">
                            <label for="entrada" class="btn btn-default" style="margin-top: 5px;">Entrada
                                <input required  onkeydown='handleEnter(event)' type="checkbox" id="entrada" name="entrada" class="badgebox" value="1" checked>
                                <span class="badge">&check;</span>
                            </label>
                            <label for="saida" class="btn btn-default" style="margin-top: 5px;">Saída
                                <input required  onkeydown='handleEnter(event)' type="checkbox" id="saida" name="saida" class="badgebox" value="1" checked>
                                <span class="badge">&check;</span>
                            </label>
                        </div>
                    </div> -->

                        <div class="control-group">
                            <label for="dataVencimento" class="control-label">Data de Vencimento</label>
                            <div class="controls">
                                <input onkeydown='handleEnter(event)' id="dataVencimento" type="date" name="dataVencimento" value="<?php echo set_value('dataVencimento'); ?>" readonly />
                                <input onkeydown='handleEnter(event)' id="ativaVencimento" type="checkbox">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="form-actions">
                    <div class="span12">
                        <div class="span6 offset3" style="display: flex;justify-content: center">
                            <button type="submit" class="button btn btn-mini btn-success" style="max-width: 160px"><span class="button__icon"><i class='bx bx-plus-circle'></i></span><span class="button__text2" id="adcionarProduto">Adicionar</span></button>
                            <button type="submit" id="editarProduto" class="button btn btn-mini btn-info" style="max-width: 160px; display: none;" disabled><span class="button__icon"><i class='bx bx-plus-circle'></i></span><span class="button__text2">Editar</span></button>
                            <a href="<?php echo base_url('index.php/produtos') ?>" id="voltar" class="button btn btn-mini btn-warning"><span class="button__icon"><i class="bx bx-undo"></i></span><span class="button__text2">Voltar</span></a>
                            <a href="#" class="button btn btn-mini btn-info botaoGerarCodigo">
                                <span class="button__icon"><i class="bx bx-barcode-reader"></i></span><span class="button__text2">Gerar codigo</span></a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<script src="<?php echo base_url('assets/js/controllers/imagemDragAndDrop.js') ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.validate.js') ?>"></script>
<script src="<?php echo base_url('assets/js/maskmoney.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/controllers/margemLucro.js'); ?>"></script>
<script type="text/javascript">
    function handleEnter(event) {
        if (event.key === "Enter") {
            const form = document.getElementById('formProduto');
            const index = [...form.elements].indexOf(event.target);
            form.elements[index + 1].focus();
        }
    }

    $(document).ready(function() {
        // Verificador de preenchimento do preço e margem de lucro
        $('#ativaVencimento').click(function() {
            if ($('#ativaVencimento').is(":checked")) {
                $("#dataVencimento").prop("readonly", false);
            } else {
                $("#dataVencimento").prop("readonly", true);
                $("#dataVencimento").val('');
            }
        });

        // Select com buscador
        $('#categorias').select2();
        $('#marcasAgrotec').select2();
        $('.wh3').select2({
            width: '9rem'
        });

        // Validação de campos
        $(".money").maskMoney();

        // Autocomplete produto
        $("#adNotaFiscal").autocomplete({
            source: "<?php echo base_url(); ?>index.php/AutoComplete/autoCompleteNotaFiscal",
            async: true,
            minLength: 1,
            select: function(event, ui) {
                if (ui.item.label == 'Adicionar nota fiscal...') {
                    $('.addclient').show();
                } else {
                    $("#adNotaFiscal_id").val(ui.item.id);
                    $('.addclient').hide();
                }
            }
        });

        // Resto do seu código...

        // Função para remover caracteres especiais
        function removerCaracteresEspeciais(texto) {
            return texto.replace(/[^\w\s]/gi, '');
        }

        // Função para gerar código automático
        function gerarCodigo(event) {
            event.preventDefault();

            const categoriaSelecionada = categoriaSelect.find(":selected").text();
            const subcategoriaSelecionada = subcategoriaSelect.val();
            const marcaSelecionada = marcaSelect.find(":selected").text();
            const descricao = descricaoInput.val();
            const lastID = parseInt(lastId.val()) + 1;

            if (categoriaSelecionada != null && subcategoriaSelecionada != null && marcaSelecionada != null && descricao != null) {
                let codigo = categoriaSelecionada.slice(0, 3).toUpperCase() +
                    subcategoriaSelecionada +
                    marcaSelecionada.slice(0, 3).toUpperCase() +
                    descricao.slice(0, 3).toUpperCase() +
                    lastID;

                codigo = removerCaracteresEspeciais(codigo);

                codigoInput.val(codigo);
            } else {
                codigoInput.val(0);
            }
        }

        // Atribuir evento de clique ao botão
        $('.botaoGerarCodigo').click(function(event) {
            gerarCodigo(event);
        });
    });

    function updateThumb(file) {
        if ($(".drop-zone__thumb") && typeof file == "string") {
            $("#zone__prompt").removeClass("drop-zone__prompt");
            $("#drop-zone > img").remove();
            $("#zone__prompt").text("");
            $('<img />', {
                class: 'logoImagem',
                src: file,
                alt: 'MyAlt'
            }).appendTo($('.drop-zone__thumb'));
            $('.drop-zone__thumb').attr('data-label', "Imagem do produto");
        } else {
            $("#drop-zone > img").remove();
            $("#zone__prompt").addClass("drop-zone__prompt");
            $("#zone__prompt").text("Arraste o arquivo ou clique para upload");
        }
    }

    // ===========================================================
    // SCRIPT BOTÃO ADICIONAR CAMPO
    // ===========================================================
    let i = 0;
    $('#add-campo').click(function() {
        i++;
        let campo = $('#addCampo option:selected').text();
        let idCampo = $('#addCampo option:selected').val();
        idCampo = idCampo.split(',');
        if (idCampo[0] != "0" && i < 5 && idCampo[1] != 'textarea') {

            $('#divAddCampo').append(`<div id='rm_${idCampo[0]}_${i}' class='control-group campoAdd'>
                                      <label for='${idCampo[0]}' class='control-label'>${campo}<span class='required'>*</span></label>
                                      <div class='controls'>
                                      <input onkeydown='handleEnter(event)' type='${idCampo[1]}'  id='${idCampo[0]}' name='addCampoInput[${idCampo[0]}_${i}]' value='' ${(idCampo[1]=='color')?'style=" height: 33px;  width: 16em;"':''} />
                                      <button title='remove campo' class='btn btn-danger' type='button'  onclick='removeCampo("#rm_${idCampo[0]}_${i}")' style='margin-left: 5px;'>
                                      <i class='fa fa-minus'></i></button></div></div>`);


        }
        if (idCampo[0] != "0" && i < 2 && idCampo[1] == 'textarea') {

            let textarea = `<${idCampo[1]}  onkeydown='handleEnter(event)' id='${idCampo[0]}' name='addCampoInput[${idCampo[0]}_${i}]'  rows='5' cols='33' ></${idCampo[1]}>`;

            $('#divAddCampo').append(`<div id='rm_${idCampo[0]}_${i}' class='control-group campoAdd'>
                                        <label for='${idCampo[0]}' class='control-label'>${campo}<span class='required'>*</span></label>
                                        <div class='controls'>${textarea}
                                        <button title='remove campo' class='btn btn-danger' type='button' onclick='removeCampo("#rm_${idCampo[0]}_${i}")' style='margin-left: 5px; height: 33px;'>
                                        <i class='fa fa-minus'></i></button></div></div>`);
        }
    });

    function btAddCampo() {
        let opt = $('#addCampo option:selected').val();

        if (opt != "0") {
            $('#add-campo').attr('class', 'btn btn-primary');
        }
    }

    function removeCampo(campo) {
        $(campo).remove();
    }

    function removeTodosCampos() {
        $('.campoAdd').remove();
    }
</script>

<script>
    // GERAR CÓDIGO AUTOMÁTICO
    $(document).ready(function() {
        const categoriaSelect = $('#tipoMarca');
        const subcategoriaSelect = $('#tipoMarca');
        const marcaSelect = $('#selectMarca');
        const codigoInput = $('.codDeBarra');
        const lastId = $('#lastID');
        const descricaoInput = $('#descricao'); // Adicione a seleção para o campo de descrição

        function removerCaracteresEspeciais(texto) {
            return texto.replace(/[^\w\s]/gi, '');
        }

        // Função para gerar o código automático
        function gerarCodigo(event) {
            event.preventDefault(); // Impede o comportamento padrão do botão

            const categoriaSelecionada = categoriaSelect.find(":selected").text();
            const subcategoriaSelecionada = subcategoriaSelect.val();
            const marcaSelecionada = marcaSelect.find(":selected").text();
            const descricao = descricaoInput.val(); // Obtenha o valor do campo de descrição
            const lastID = parseInt(lastId.val()) + 1; // Converta o valor de lastId para número

            // Gerando o código
            if (categoriaSelecionada != null && subcategoriaSelecionada != null && marcaSelecionada != null && descricao != null) {
                let codigo = categoriaSelecionada.slice(0, 3).toUpperCase() +
                    subcategoriaSelecionada +
                    marcaSelecionada.slice(0, 3).toUpperCase() +
                    descricao.slice(0, 3).toUpperCase() +
                    lastID;

                // Removendo caracteres especiais do código
                codigo = removerCaracteresEspeciais(codigo);

                // Definindo o código gerado no campo de entrada
                codigoInput.val(codigo);
            } else {
                codigoInput.val(0);
            }
        }

        // Atribuir evento de clique ao botão
        $('.botaoGerarCodigo').click(function(event) {
            gerarCodigo(event);
        });
    });
</script>
