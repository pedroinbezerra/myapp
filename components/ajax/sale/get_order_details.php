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

    $details = [];
    $objItems = [];
    $total_cost = 0;
    
    foreach ($orderDetails as $item) {
        $objItem = array(
            'id' => $item['ID'],
            'title' => $item['DESCRIPTION'],
            'unit_price' => $item['SALE_VALUE'],
            'quantity' => $item['QTD'],
            'tangible' => 'false'
        );

        array_push($objItems, $objItem);

        $total_cost += $item['TOTAL_COST'];
    }

    $details['items'] = json_encode($objItems);
    $details['ammount'] = json_encode($total_cost);

    $details = json_encode($details);

    echo $details;
}