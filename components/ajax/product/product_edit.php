<?php
require_once('../../../assist/classes/mConnect.php');
require_once('../../../assist/classes/mAuth.php');
require_once('../../../assist/classes/mProduct.php');
require_once('../../../assist/classes/mUtil.php');

$mAuth = new mAuth();

if (isset($_POST['id_product'])) {

    require_once('../../../assist/classes/mProvider.php');

    $mProduct = new mProduct();
    $mUtil = new mUtil();

    $unitys = $mProduct->getUnity();
    $providers = $mProduct->getProviders();

    $p = $mProduct->getProduct($_POST['id_product']);
    ?> 
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-8">
                <label for="description">Descrição</label>
                <input type="text" name="description" id="edit_description" value="<?= $p['DESCRIPTION'] ?>" class="form-control" required="">
            </div>
            <div class="col-md-4">
                <label for="quantity">Quantidade</label>
                <input type="number" name="quantity" id="edit_quantity" value="<?= $p['QUANTITY'] ?>" class="form-control" required="">
            </div>
        </div>

        <br>
        <div class="row">
            <div class="col-md-4">
                <label for="measure">Medida:</label>
                <input type="number" name="measure" value="<?= $p['MEASURE'] ?>" placeholder="Medida" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="unity">Unidade de medida</label>
                <select name="unity" id="edit_unity" class="form-control" required="" onchange="sval()">
                    <?php
                    foreach ($unitys as $u) {
                        if ($u['ID'] == $p['FK_ID_UNITY']) {
                            ?>
                            <option value="<?= $u['ID'] ?>" selected=""><?= $mUtil->autoCaption($u['NAME']) ?></option>
                        <?php } else { ?>
                            <option value="<?= $u['ID'] ?>"><?= $mUtil->autoCaption($u['NAME']) ?></option>
                            <?php
                        }
                    }
                    ?>                                           
                </select>
            </div>
            <div class="col-md-4">
                <label for="cost">Custo</label>
                <input type="text" name="cost" id="edit_cost" value="<?= $p['COST'] ?>" class="form-control money" required="">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <label for="low_stock">Estoque baixo</label>
                <input type="number" name="low_stock" id="new_low_stock" value="<?= $p['LOW_STOCK'] ?>" class="form-control" required="">
            </div>
            <div class="col-md-6">
                <label for="sale_value">Valor de venda</label>
                <input type="text" name="sale_value" id="edit_sale_value" value="<?= $p['SALE_VALUE'] ?>" class="form-control money" required="">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-10">
                <label for="provider">Fornecedor</label>
                <select name="provider" id="edit_provider" class="form-control" required="">
                    <?php if ($p['FK_ID_PROVIDER'] == 0) { ?>
                            <option value="" selected="">Sem fornecedor cadastrado</option>
                            <?php
                        } foreach ($providers as $provider) {
                        if ($provider['ID'] == $p['FK_ID_PROVIDER']) {
                            ?>
                            <option value="<?= $provider['ID'] ?>" selected=""><?= $provider['NAME'] . " - " . $provider['CPF_CNPJ'] ?></option>
                        <?php } else { ?>
                            <option value="<?= $provider['ID'] ?>"><?= $provider['NAME'] . " - " . $provider['CPF_CNPJ'] ?></option>
                            <?php
                        }
                    }
                    ?>                                      
                </select>
            </div>
            <div class="col-md-2">
                <br>
                <center>
                    <button id="edit_newProvider" type="button" class="btn btn-primary btn-row-top" data-toggle="modal" data-target="#createProvider" title="Cadastrar novo fornecedor" onclick="openModalOnModal('newProduct', 'createProvider')">
                        <i class="fas fa-plus-square"></i>
                    </button>
                </center>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <label for="observation">Observações</label>
                <textarea name="observation" id="edit_observation" class="form-control"><?= $p['OBSERVATION'] ?></textarea>
            </div>
        </div>
        <input type="hidden" name="id_product" value="<?= $p['ID'] ?>">
    </div> 
    <?php
} else {
    return 'error';
}
?>