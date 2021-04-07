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
        $items = $items . "<tr><td>" . $item['DESCRIPTION'] . "</td><td>" . $item['QTD'] . "</td><td> R$ " . number_format($item['SALE_VALUE'], 2) . "</td><td data-totalcost=" . $item['TOTAL_COST'] . "> R$ " . $item['TOTAL_COST'] . "</td><td><button type='button' class='btn btn-danger btn-sm removeItem' onClick='deleteRow(this, " . $item['ID'] . ")'><i class='fas fa-trash' title='Remover item'></i></button></td></tr>";
    }

    echo $items;
}
