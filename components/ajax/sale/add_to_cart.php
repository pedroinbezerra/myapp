<?php

require_once('../../../assist/classes/mConnect.php');
require_once('../../../assist/classes/mAuth.php');
require_once('../../../assist/classes/mProduct.php');
require_once('../../../assist/classes/mSale.php');

$CREATED_BY = 1;

$mAuth = new mAuth();
$mSale = new mSale();

if (
    $_POST['idClient'] == null || $_POST['idClient'] == '' || $_POST['idProduct'] == null || $_POST['idProduct'] == '' || $_POST['qtdProduct'] == null || $_POST['qtdProduct'] == '' || $_POST['price'] == null || $_POST['price'] == '' || $_POST['totalPrice'] == null || $_POST['totalPrice'] == ''
) {
    echo 'invalid_field';
} else {

    if ($mSale->getProduct($_POST['idProduct'])['QUANTITY'] > 0) {
        if ($_POST['id_order'] == '' || $_POST['id_order'] == null) {

            $orderId = $mSale->createOrder($_POST['idClient'], $CREATED_BY);
            $mSale->insertOrderDetail($orderId, $_POST['idProduct'], $_POST['qtdProduct'], $_POST['price'], $_POST['totalPrice'], $CREATED_BY);

            echo $orderId;
        } else {
            $mSale->insertOrderDetail($_POST['id_order'], $_POST['idProduct'], $_POST['qtdProduct'], $_POST['price'], $_POST['totalPrice'], $CREATED_BY);
            echo $_POST['id_order'];
        }
    } else {
        echo 'no_stock';
    }
}
