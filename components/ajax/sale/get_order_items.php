<?php

require_once('../../../assist/classes/mConnect.php');
require_once('../../../assist/classes/mAuth.php');
require_once('../../../assist/classes/mProduct.php');
require_once('../../../assist/classes/mSale.php');

$CREATED_BY = 1;

$mAuth = new mAuth();
$mSale = new mSale();

if ($_POST['order_id'] == '' || $_POST['order_id'] == null) {
    echo 'invalid_order_id';
} else {

    $orderDetails = $mSale->getOrderDetail($_POST['order_id']);

    $items = "";

    foreach ($orderDetails as $item) {

        $items = $items . "<tr><td>" . $item['FK_ID_PRODUCT'] . "</td><td>" . $item['QTD'] . "</td><td>" . $item['SALE_VALUE'] . "</td><td>" . $item['TOTAL_COST'] . "</td></tr>";
    }

    echo $items;
}
