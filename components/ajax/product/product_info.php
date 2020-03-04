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
                <input type="text" name="description" id="info_description" value="<?= $p['DESCRIPTION'] ?>" class="form-control" readonly="">
            </div>
            <div class="col-md-4">
                <label for="quantity">Quantidade</label>
                <input type="number" name="quantity" id="info_quantity" value="<?= $p['QUANTITY'] ?>" class="form-control" readonly="">
            </div>
        </div>

        <br>
        <div class="row">
            <div class="col-md-4">
                <label for="measure">Medida:</label>
                <input type="number" name="measure" value="<?= $p['MEASURE'] ?>" placeholder="Medida" class="form-control" readonly="">
            </div>
            <div class="col-md-4">
                <label for="unity">Unidade de medida</label>
                <?php
                foreach ($unitys as $u) {
                    if ($u['ID'] == $p['FK_ID_UNITY']) {
                        ?>
                        <input value="<?= $mUtil->autoCaption($u['NAME']) ?>" class="form-control" readonly="">
                        <?php
                    }
                }
                ?>   
            </div>
            <div class="col-md-4">
                <label for="cost">Custo</label>
                <input type="text" name="cost" id="info_cost" value="<?= $p['COST'] ?>" class="form-control money" readonly="">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <label for="low_stock">Estoque baixo</label>
                <input type="number" name="low_stock" id="new_low_stock" value="<?= $p['LOW_STOCK'] ?>" class="form-control" readonly="">
            </div>
            <div class="col-md-6">
                <label for="sale_value">Valor de venda</label>
                <input type="text" name="sale_value" id="edit_sale_value" value="<?= $p['SALE_VALUE'] ?>" class="form-control money" readonly="">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <label for="provider">Fornecedor</label>
                <?php if ($p['FK_ID_PROVIDER'] == 0) { ?>
                    <input type="text" class="form-control" value="Sem fornecedor cadastrado" readonly="">
                    <?php
                } foreach ($providers as $provider) {
                    if ($provider['ID'] == $p['FK_ID_PROVIDER']) {
                        ?>
                        <input type="text" class="form-control" value="<?= $provider['NAME'] . " - " . $provider['CPF_CNPJ'] ?>" readonly="">
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <label for="observation">Observações</label>
                <textarea name="observation" id="info_observation" class="form-control" readonly=""><?= $p['OBSERVATION'] ?></textarea>
            </div>
        </div>
    </div> 
    <?php
} else {
    return 'error';
}
?>