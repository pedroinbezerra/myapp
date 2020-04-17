<?php
require_once('../../../assist/classes/mConnect.php');
require_once('../../../assist/classes/mAuth.php');

$mAuth = new mAuth();

if (isset($_POST['id_order'])) {

    require_once('../../../assist/classes/mProvider.php');
    require_once('../../../assist/classes/mProduct.php');
    require_once('../../../assist/classes/mUtil.php');
    require_once('../../../assist/classes/mClient.php');
    require_once('../../../assist/classes/mOrder.php');

    $mProduct = new mProduct();
    $mUtil = new mUtil();
    $mProvider = new mProvider();
    $mClient = new mClient();
    $mOrder = new mOrder();

    $unitys = $mProduct->getUnity();
    $providers = $mProduct->getProviders();

    $order = $mOrder->getOrder($_POST['id_order']);
    $client = $mProvider->getProvider($order['FK_ID_CLIENT']);
    $items = $mOrder->getSaleDetails($order['ID']);

?>

    <div class="col-md-12" style="overflow-y: auto; max-height: 550px">
        <div class="row" id="order">
            <div class="col-md-4">
                <label for="description">Cod. Pedido</label>
                <input type="text" name="description" id="info_description" value="<?= $order['ID'] ?>" class="form-control" readonly="">
            </div>
            <div class="col-md-4">
                <label for="description">Data de criação</label>
                <input type="text" name="description" id="info_description" value="<?= $order['CREATED_ON'] ?>" class="form-control" readonly="">
            </div>
            <div class="col-md-4">
                <label for="description">Total</label>
                <input type="text" name="description" id="info_description" value="R$ <?= substr($mOrder->getOrderTotalCost($order['ID']), 0,  5) ?>" class="form-control" readonly="">
            </div>
        </div>
        <hr>

        <br>
        <center><label for="client"><strong>Cliente</strong></label></center>
        <hr>
        <div id="client">
            <div class="row">
                <div class="col-md-4">
                    <label for="description">CPF / CNPJ</label>
                    <input type="text" name="description" id="info_description" value="<?= $client['CPF_CNPJ'] ?>" class="form-control" readonly="">
                </div>
                <div class="col-md-8">
                    <label for="description">Nome</label>
                    <input type="text" name="description" id="info_description" value="<?= $client['NAME'] ?>" class="form-control" readonly="">
                </div>
            </div>

            <br>
            <div class="row">
                <div class="col-md-6">
                    <label for="description">Telefone</label>
                    <input type="text" name="description" id="info_description" value="<?= $client['PHONE'] ?>" class="form-control" readonly="">
                </div>
                <div class="col-md-6">
                    <label for="description">E-mail</label>
                    <input type="text" name="description" id="info_description" value="<?= $client['MAIL'] ?>" class="form-control" readonly="">
                </div>
            </div>

            <br>
            <div class="row">
                <div class="col-md-12">
                    <label for="description">Logradouro</label>
                    <input type="text" name="description" id="info_description" value="<?= $client['STREET'] . ", " . $client['NUMBER'] . " - " . $client['NEIGHBORHOOD'] . " - " . $client['CITY_STATE'] . ", " . $client['ZIPCODE'] ?>" class="form-control" readonly="">
                </div>
            </div>
        </div>

        <br><br>
        <center><label for="client"><strong>Itens</strong></label></center>
        <div id="client">
            <table class="table table-striped table-responsive-xl">
                <thead>
                    <tr>
                        <th scope="col">Descrição</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Preço final</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody id="items">
                    <?php foreach ($items as $item) { ?>
                        <tr>
                            <td><?= $mProduct->getProduct($item['FK_ID_PRODUCT'])['DESCRIPTION'] ?></td>
                            <td><?= $item['QTD'] ?></td>
                            <td><?= $item['SALE_VALUE'] ?></td>
                            <td><?= $item['TOTAL_COST'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <hr>
    </div>

<?php } else {
    return 'error';
} ?>