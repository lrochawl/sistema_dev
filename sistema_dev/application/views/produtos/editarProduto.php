<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/controllers/adcionarProduto.css" />
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<script src="<?php echo base_url() ?>assets/js/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/auth/login.js"></script>

<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title" style="margin: -20px 0 0">
                <span class="icon">
                    <i class="fas fa-shopping-bag"></i>
                </span>
                <h5>Cadastro de Produto</h5>
            </div>

            <form action="<?php echo current_url(); ?>" id="formProduto" method="post" enctype="multipart/form-data" class="form-horizontal">
                <?php if ($result->imagemProduto != NULL and $result->imagemProduto != '') : ?>
                    <div class="drop-zone">
                        <input type="file" name="userfile" class="drop-zone__input">
                        <div class="drop-zone__thumb" data-label="<?= "Imagem do Produto" ?>">
                            <img class="logoImagem" src="<?= $result->imagemProduto ?>">
                        </div>
                    </div>

                <?php elseif ($result->urlLogoMarca != NULL and $result->urlLogoMarca != '') : ?>

                    <div class="drop-zone">
                        <input type="file" name="userfile" class="drop-zone__input">
                        <div class="drop-zone__thumb" data-label="<?= "Imagem da logomarca " ?>">
                            <img class="logoImagem" src="<?= $result->urlLogoMarca ?>">
                        </div>
                    </div>

                <? else : ?>
                    <div class="drop-zone">
                        <input type="file" name="userfile" class="drop-zone__input">
                        <div class="drop-zone__thumb" data-label="<?= "Sem imagem " ?>">
                            <img class="logoImagem" src='<?= base_url('assets/img/sem_logo.png') ?>'>
                        </div>
                    </div>

                <? endif ?>
                <div class="widget-content nopadding tab-content" style="margin-bottom: 2%;">
                    <div class="span6">
                        <?php echo $custom_error; ?>
                        <input onkeydown='handleEnter(event)' type="hidden" id="adNotaFiscal_id" name="adNotaFiscal_id" value="<?php echo $result->id_financeiro_nota; ?>" />
                        <input onkeydown='handleEnter(event)' type="hidden" id="produto_id" name="codDeBarra" class="codDeBarra" value="<?php echo $result->codDeBarra; ?>" />
                        <input onkeydown='handleEnter(event)' type="hidden" name="id_estoque_produto" value="<?php echo $result->id_estoque_produto; ?>" />
                        <input onkeydown='handleEnter(event)' type="hidden" id="imagemProduto" name="imagemProduto" value="<?php echo $result->imagemProduto; ?>" />
                        <input onkeydown='handleEnter(event)' type="hidden" id="lastID" name="lastID" value="<?php echo $result->id_estoque_produto; ?>" />

                        <div class="control-group">

                            <div class="control-group">
                                <label for="codDeBarra" class="control-label">Código interno/GTIN<span class="required">*</span></label>
                                <div class="controls">
                                    <input onkeydown='handleEnter(event)' autocomplete="off" id="codDeBarra" type="text" class="form-control-btn codDeBarra" name="codigo" required value="<?php echo $result->codDeBarra; ?>" />
                                    <button class="btn btn-primary botaoGerarCodigo" type="button"><a href="#"><i class="bx bx-refresh"></i></a></button>
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="adNotaFiscal" class="control-label">Nota Fiscal<span class="required">*</span></label>
                                <div class="controls">
                                    <input onkeydown='handleEnter(event)' type="text" required id="adNotaFiscal" name="adNotaFiscal" autocomplete="false" value="<?php echo $result->notaFiscal; ?>" readonly />
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="selectMarca" class="control-label">Marca<span class="required">*</span></label>
                                <div class="controls">
                                    <select required onkeydown='handleEnter(event)' id="selectMarca" name="marca" required>

                                        <?php if (!$resultMarca) {
                                            echo '<option disabled selected>Sem marcas cadastradas</option>';
                                        }

                                        foreach ($resultMarca as $r) {
                                            if ($result->estoque_marca_id == $r->id_estoque_marca) {
                                                echo  "<option value='$r->id_estoque_marca' selected>$r->marca</option>";
                                            } elseif ($result->estoque_marca_id != $r->id_estoque_marca && $r->status != 0) {
                                                echo "<option value='$r->id_estoque_marca' >$r->marca</option>";
                                            }
                                        }
                                        ?>
                                    </select>


                                </div>
                            </div>
                            <div class="control-group">
                                <label for="tipoMarca" class="control-label">Grupo<span class="required">*</span></label>
                                <div class="controls">
                                    <select required onkeydown='handleEnter(event)' name="complemento" id="tipoMarca">

                                        <?php if (!$resultTipo) {
                                            echo '<option disabled selected>Sem produtos cadastrados</option>';
                                        } else {
                                            echo '<option disabled selected>Selecione um item</option>';

                                            foreach ($resultTipo as $r) {
                                                if ($result->estoque_tipo_produto_id == $r->id_estoque_tipo_produto) {
                                                    echo  "<option value='$r->id_estoque_tipo_produto' selected>$r->tipo_produto</option>";
                                                } elseif ($result->estoque_tipo_produto_id != $r->id_estoque_tipo_produto && $r->statusTipo_produto != 0) {
                                                    echo "<option value='$r->id_estoque_tipo_produto' >$r->tipo_produto</option>";
                                                }
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

                                <input onkeydown='handleEnter(event)' id="descricao" type="text" required name="descricao" value="<?php echo $result->produtoDescricao; ?>" />
                            </div>
                        </div>

                        <div class="control-group">
                            <label for="precoCompra" class="control-label">Preço de Compra(R$)<span class="required">*</span></label>
                            <div class="controls">
                                <input onkeydown='handleEnter(event)' id="precoCompra" class="money input-numberProduto" data-affixes-stay="true" data-thousands="" data-decimal="." type="text" required name="precoCompra" value="<?php echo $result->precoCompra; ?>" required />
                                Margem (%) <input onkeydown='handleEnter(event)' style="width: 3em;" id="margemLucro" name="margemLucro" value="<?php echo $result->margemLucro; ?>" type="text" required placeholder="%" maxlength="3" size="2" />
                                <strong><span style="color: red" id="errorAlert"></span></strong>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="precoVenda" class="control-label">Preço de Venda<span class="required">*</span></label>
                            <div class="controls">
                                <input onkeydown='handleEnter(event)' id="precoVenda" class="money" data-affixes-stay="true" data-thousands="" data-decimal="." type="text" required name="precoVenda" value="<?php echo $result->precoVenda; ?>" readonly />
                                <a class="btn btn-primary  btn-calcular" onclick="calcPrecoVenda()" id="calcular" role="button">Calcular</a>
                            </div>
                        </div>

                    </div>

                    <div class="span6">

                        <div class="control-group">
                            <label for="estoque" class="control-label">Estoque<span class="required">*</span></label>
                            <div class="controls">
                                <input onkeydown='handleEnter(event)' class="input-numberProduto" id="estoque" type="number" min="0" name="estoque" value="<?php echo $estoque['valorConvertido']; ?>" />
                                <select required onkeydown='handleEnter(event)' class="wh3" id="unidade" name="unidade">

                                    <?php if (!$resultMedida) {
                                        echo '<option disabled selected>Sem madidas cadastradas</option>';
                                    } else {
                                        echo '<option disabled selected>Medida</option>';

                                        foreach ($resultMedida as $r) {
                                            if ($result->estoque_medida_id == $r->id_estoque_medida and $r->status == 1) {
                                                echo "<option value=$r->id_estoque_medida selected>$r->medida $r->multiplicador $r->siglaMedidaSistema</option>";
                                            } else if (($result->estoque_medida_id == $r->id_estoque_medida and $r->status == 2)) {
                                                echo "<option value=$r->id_estoque_medida selected>$r->medida </option>";
                                            } else if (($result->estoque_medida_id != $r->id_estoque_medida and $r->status == 1)) {
                                                echo "<option value=$r->id_estoque_medida >$r->medida $r->multiplicador $r->siglaMedidaSistema </option>";
                                            } else if (($result->estoque_medida_id != $r->id_estoque_medida and $r->status == 2)) {
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
                                <input onkeydown='handleEnter(event)' id="estoqueMinimo" class="input-numberProduto" min="0" type="number" name="estoqueMinimo" value="<?php echo $estoque['valorConvertidoEstoqueMinimo']; ?>" />
                                <select required onkeydown='handleEnter(event)' title="locations" class="wh3" name="location" id="locations" value="<?php echo set_value('location'); ?>">

                                    <?php if (!$resultLocations) {
                                        echo '<option disabled selected>Sem Localizações</option>';
                                    } else {
                                        echo '<option disabled selected>Locationização</option>';

                                        foreach ($resultLocations as $r) { {
                                                if ($result->estoque_location_id == $r->id_estoque_location) {
                                                    echo "<option value='$r->id_estoque_location' selected >$r->location</option>";
                                                } else {
                                                    echo "<option value='$r->id_estoque_location' >$r->location</option>";
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="control-group" id="divAddCampo">
                            <label for="addCampo" class="control-label">Adicionar campo<span class="required">*</span></label>
                            <div class="controls">

                                <select required onkeydown='handleEnter(event)' onchange='btAddCampo()' title="Adicionar campo" id="addCampo" value="<?php echo set_value('addCampo'); ?>">

                                    <?php if (!$resultAddCampo) {
                                        echo '<option disabled selected>Sem tipos cadastrados</option>';
                                    } else {
                                        echo '<option value="0" disabled selected>Tipo de observação</option>';
                                        foreach ($resultAddCampo as $r) {
                                            echo "<option value='$r->id_estoque_addCampo,$r->tipoAddCampo' >$r->addCampo</option>";
                                        }
                                    }

                                    ?>
                                </select>
                                <button title="adcionar campo" class="btn btn-light" type="button" id="add-campo" style="margin-left: 5px;"><i class="fa fa-plus"></i></button>
                            </div>

                            <?php

                            $resultCampos = explode("||", $result->observacao);
                            $i = 0;
                            foreach ($resultCampos as $rCampo) {
                                $i++;
                                $var3 = explode('::', $rCampo);
                                $idCampo = trim($var3[0]);
                                foreach ($resultAddCampo as $r) {

                                    if ($idCampo != '' && $r->id_estoque_addCampo == $idCampo) {
                                        if ($r->tipoAddCampo != "textarea") {     ?>
                                           
                                            <script>
                                                $('#divAddCampo').append(`<div id='<?= "rm_" . $r->siglaAddCampo . "_" . $i ?>' class='control-group addCampo'>
                                                <label for='<?= $r->siglaAddCampo . "_" . $i ?>' class='control-label campoAdd'>
                                                <?= $r->addCampo ?><span class='required'>*</span></label>
                                                <div class='controls'>
                                                <input onkeydown='handleEnter(event)' type='<?= $r->tipoAddCampo ?>'  id='<?= $r->siglaAddCampo . "_" . $i ?>' name='addCampoInput[<?= $r->id_estoque_addCampo . "_" . $i ?>]' value='<?= "$var3[1]" ?>' <?= ($r->tipoAddCampo == 'color' ? 'style=" height: 33px; width: 16em;"' : ''); ?> />   
                                                <button title="remove campo" class="btn btn-danger" type="button"  onclick="removeCampo('#<?= "rm_" . $r->siglaAddCampo . "_" . $i ?>')" style="margin-left: 5px;">
                                                <i class="fa fa-minus"></i></button> </div> </div>`);
                                            </script>
                                        <?php  } else { ?>
                                            <script>
                                                $('#divAddCampo').append(`<div id='<?= "rm_" . $r->siglaAddCampo . "_" . $i ?>' class='control-group addCampo'>
                                                <label for='<?= $r->siglaAddCampo . "_" . $i ?>' class='control-label'>
                                                <?= $r->addCampo ?><span class='required'>*</span></label>
                                                <div class='controls'>
                                                <<?= $r->tipoAddCampo ?> onkeydown='handleEnter(event)'  id='<?= $r->siglaAddCampo . "_" . $i ?>' name='addCampoInput[<?= $r->id_estoque_addCampo . "_" . $i ?>]' > <?= "$var3[1]" ?> </<?= $r->tipoAddCampo ?>>  
                                                <button title="remove campo" class="btn btn-danger" type="button"  onclick="removeCampo('#<?= "rm_" . $r->siglaAddCampo . "_" . $i ?>')" style="margin-left: 5px;">
                                                <i class="fa fa-minus"></i></button> </div> </div>`);
                                            </script>
                            <?php

                                        }
                                    }
                                }
                            }

                            ?>
                        </div>
                        <!--  <div class="control-group">
                        <label class="control-label">Tipo de Movimento</label>
                        <div class="controls">
                            <label for="entrada" class="btn btn-default" style="margin-top: 5px;">Entrada
                                <input onkeydown='handleEnter(event)' type="checkbox" id="entrada" name="entrada" class="badgebox" value="1" checked>
                                <span class="badge">&check;</span>
                            </label>
                            <label for="saida" class="btn btn-default" style="margin-top: 5px;">Saída
                                <input onkeydown='handleEnter(event)' type="checkbox" id="saida" name="saida" class="badgebox" value="1" checked>
                                <span class="badge">&check;</span>
                            </label>
                        </div>
                    </div> -->

                        <!-- <div class="control-group">
                            <label for="dataVencimento" class="control-label">Data de Vencimento</label>
                            <div class="controls">
                                <?php
                                if ($result->dataVencimento != null and $result->dataVencimento != '0000-00-00') {
                                    echo " <input onkeydown='handleEnter(event)' id='dataVencimento' type='date' name='dataVencimento' value='$result->dataVencimento'  /> ";
                                    echo '<input onkeydown="handleEnter(event)" class="form-check-input" id="ativaVencimento" type="checkbox" checked="checked" >';
                                } else {
                                    echo " <input onkeydown='handleEnter(event)' id='dataVencimento' type='date' name='dataVencimento' value='$result->dataVencimento' readonly /> ";
                                    echo '<input onkeydown="handleEnter(event)" class="form-check-input" id="ativaVencimento" type="checkbox" >';
                                }

                                ?>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="form-actions">
                    <div class="span12">
                        <div class="span6 offset3" style="display: flex;justify-content: center">
                            <button type="submit" class="button btn btn-primary" style="max-width: 160px">
                                <span class="button__icon"><i class="bx bx-sync"></i></span><span class="button__text2">Atualizar</span></button>
                            <a href="<?php echo base_url() ?>index.php/produtos" id="" class="button btn btn-mini btn-warning">
                                <span class="button__icon"><i class="bx bx-undo"></i></span><span class="button__text2">Voltar</span></a>
                            <!-- <a href="#" id="botaoGerarCodigo" class="button btn btn-mini btn-info">
                                <span class="button__icon"><i class="bx bx-barcode-reader"></i></span><span class="button__text2">Gerar codigo</span></a>
                        -->
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<script src="<?php echo base_url() ?>assets/js/controllers/imagemDragAndDrop.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>assets/js/maskmoney.js"></script>
<script src="<?php echo base_url(); ?>assets/js/controllers/margemLucro.js"></script>
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
        $('#tipoMarca').select2();
        $('#selectMarca').select2();
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

        const barCode = document.getElementById("codDeBarra");
        const myInput = document.querySelector("#descricao");
        const imgLogo = document.querySelector("#imageLogo");
        const image_x = document.getElementById('imgLogo');
        const marcas = document.getElementById('marcasAgrotec');
        const camposDB = <?= json_encode($resultAddCampo) ?>;

        $("#codDeBarra").autocomplete({
            source: "<?php echo base_url('AutoComplete/autoCompleteProduto'); ?>",
            minLength: 1,
            response: function(event, ui) {
                $("#editarProduto").hide();
                $('#adcionarProduto').text('Adicionar');
                $('#codDeBarra').css("background-color", "#d5d19d");
                $('#codDeBarra').css("font-weight", 700);

                // ui.content is the array that's about to be sent to the response callback.
                if (ui.content.length === 0) {
                    buscaProdutos();
                }
            },
            select: function(event, ui) {
                $('#codDeBarra').css("background-color", "#9dc2d5");
                $('#codDeBarra').css("font-weight", 700);
                $('#imgLogo').remove();
                $('.addCampo').remove();

                if (ui.item.id != null) {

                    $("#editarProduto").show();
                    $('#adcionarProduto').text('Duplicar');
                    $("#adNotaFiscal").val(ui.item.notaFiscal);
                    $("#adNotaFiscal_id").val(ui.item.id_financeiro_nota);
                    $("#produto_id").val(ui.item.codDeBarra);
                    $("#selectMarca").val(ui.item.marca_id).change();
                    $("#tipoMarca").val(ui.item.idTipo).change();
                    $("#descricao").val(ui.item.descricao);
                    $("#estoque").val(parseInt(ui.item.estoque / ui.item.multiplicador));
                    $("#estoqueMinimo").val(parseInt(ui.item.estoqueMinimo / ui.item.multiplicador));
                    $("#unidade").val(ui.item.idMedida).change();
                    $("#locations").val(ui.item.location).change();
                    $("#precoCompra").val(ui.item.precoCompra);
                    $("#precoVenda").val(ui.item.precoVenda);
                    $("#margemLucro").val(ui.item.margem);

                    if (ui.item.dataVencimento != null) {
                        $("#ativaVencimento").prop("checked", true);
                        $("#dataVencimento").val(ui.item.dataVencimento);
                    }

                    if ($('#dataVencimento').val() != '') {
                        $("#dataVencimento").attr("readonly", false);
                        $('#ativaVencimento')[0].checked = true;
                    } else {
                        $("#dataVencimento").attr("readonly", true);
                        $('#ativaVencimento')[0].checked = false;
                    }
                    $.ajax({
                        url: "<?= site_url('produtos/returnAddCampos'); ?>",
                        dataType: 'json',
                        success: function(data) {
                            $('.campoAdd').remove();
                            let camposDB = data;
                            let dadosCampos = ui.item.observacao.split('||');
                            let i = 0;
                            dadosCampos.forEach((dadosCampo) => {
                                i++;
                                dadosCampo = dadosCampo.split('::');
                                camposDB.forEach((campo) => {
                                    if (campo.id_estoque_addCampo == dadosCampo[0] && campo.tipoAddCampo != "textarea") {
                                        $('#divAddCampo').append(`<div id='rm_${campo.siglaAddCampo}_${i}' class='control-group campoAdd'>
                                        <label for='${campo.siglaAddCampo}_${i}' class='control-label'>${campo.addCampo}<span class='required'>*</span></label>
                                                            <div class='controls'><input required  onkeydown='handleEnter(event)' type='${campo.tipoAddCampo}'  id='${campo.siglaAddCampo}_${i}' name='addCampoInput[${campo.id_estoque_addCampo}_${i}]' value='${dadosCampo[1]} ' ${campo.tipoAddCampo =='color'?'style=" height: 33px;  width: 16em;"':''} />
                                                            <button title="remove campo" class="btn btn-danger" type="button"  onclick="removeCampo('#rm_${campo.siglaAddCampo}_${i}')" style="margin-left: 5px;"><i class="fa fa-minus"></i></button> </div> </div>`);
                                    }
                                    if (campo.id_estoque_addCampo == dadosCampo[0] && campo.tipoAddCampo == "textarea") {
                                        $('#divAddCampo').append(`<div id='rm_${campo.siglaAddCampo}_${i}' class='control-group campoAdd'>
                                                            <label for='${campo.siglaAddCampo}_${i}' class='control-label'><?= isset($r->addCampo) ? $r->addCampo : ''; ?><span class='required'>*</span></label><div class='controls'>
                                                            <${campo.tipoAddCampo} required  onkeydown='handleEnter(event)'  id='${campo.siglaAddCampo}_${i}' name='addCampoInput[${campo.id_estoque_addCampo}_${i}]' rows='5' cols='33' >  ${dadosCampo[1]} </${campo.tipoAddCampo}>
                                                            <button title="remove campo" class="btn btn-danger" type="button"  onclick="removeCampo('#rm_${campo.siglaAddCampo}_${i}')" style="margin-left: 5px;"><i class="fa fa-minus"></i></button> </div> </div>`);
                                    }
                                });
                            });
                            $('.codDeBarra').val(ui.item.codDeBarra);
                        }
                    });

                } else if (ui.item.idTipo != null) {
                    $("#produto_id").val(ui.item.modelo);
                    $("#selectSetor").val(ui.item.idSetor);
                    $("#selectCategoria").val(ui.item.idCategoria);
                    $("#selectMarca").val(ui.item.marca);
                    $("#tipoMarca").val(ui.item.idTipo);
                    $("#editarProduto").hide();
                }
            }
        });

        function buscaProdutos() {
            let v;
            v = barCode.value;
            $('#imgLogo').remove();

            $.ajax({
                url: '<?= site_url('/produtos/consultaProduto/') ?>' + v,
                success: function(data) {
                    if (data != null && data != 0) {
                        $('#produto_id').val(v);
                        $('.addCampo').remove();

                        let dados = JSON.parse(data);
                        let json = dados;
                        let logo = '';

                        $("#imagemProduto").val(logo);
                        //   updateThumbnail(logo);


                        if (json.description) {
                            $('#descricao').val(dados.description);
                        }

                        try {
                            if (!json.thumbnail) {
                                throw 'erro 1: tumbnail não encontrada'
                            }

                            //image.src = json.thumbnail;
                            //imgLogo.appendChild(image).setAttribute("id", "imgLogo");
                            $('#imagemProduto').val(json.thumbnail);
                            updateThumb(json.thumbnail);

                        } catch (e) {

                            try {

                                var logoLink = json.brand.picture.split('/');

                                if (!logoLink[0]) {
                                    throw 'erro 2: picture não encontrada'
                                }

                                //image.src = (logoLink[0] == 'https:') ? json.brand.picture : 'https://api.cosmos.bluesoft.com.br/' + json.brand.picture;
                                // imgLogo.appendChild(image).setAttribute("id", "imgLogo");
                                $('#imagemProduto').val((logoLink[0] == 'https:') ? json.brand.picture : 'https://api.cosmos.bluesoft.com.br/' + json.brand.picture);
                                updateThumb((logoLink[0] == 'https:') ? json.brand.picture : 'https://api.cosmos.bluesoft.com.br/' + json.brand.picture);


                            } catch (err) {
                                //image.src = '/assets/img/sem_logo.png';
                                // imgLogo.appendChild(image).setAttribute("id", "imgLogo");
                                $('#imagemProduto').val('<?= base_url('assets/img/sem_logo.png') ?>');
                                updateThumb('<?= base_url('assets/img/sem_logo.png') ?>');
                            }
                        }

                        $('#codDeBarra').css("background-color", "#b8fdda");
                        $('#codDeBarra').css("font-weight", 700);

                        /* $('#description').val(json.description);
                         $('#marca').append(json.brand.name);
                         $('#avg_price').append(json.avg_price);
                         $('#updated_at').append(json.updated_at);
                         $('#barcode_image').attr('src', json.barcode_image);
                         $('#img').attr('src', logo);*/

                    } else {
                        $('#codDeBarra').css("background-color", "#f1a3a3");
                        $('#codDeBarra').css("font-weight", 700);
                        $('#produto_id').val(barCode.value);
                    }

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#codDeBarra').css("background-color", "#f1a3a3");
                    $('#codDeBarra').css("font-weight", 700);
                    $('#produto_id').val(barCode.value);
                }
            });

        }
    })

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
            //    $('.drop-zone').append(`<div class="drop-zone__thumb" data-label="${file}" style="background-position: center; background-image: url(${file}); background-color: white;"></div>`);
        } else {

            $("#drop-zone > img").remove();
            $("#zone__prompt").addClass("drop-zone__prompt");
            $("#zone__prompt").text("Arraste o arquivo ou clique para upload");


            // $('.drop-zone').append('<span class="drop-zone__prompt">Arraste o arquivo ou clique para upload</span>');
            // console.log("Remove imagem");
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
</script>