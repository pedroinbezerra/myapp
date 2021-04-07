<?php

require_once('../../../assist/classes/mConnect.php');
require_once('../../../assist/classes/mAuth.php');
require_once('../../../assist/classes/mProduct.php');
require_once('../../../assist/classes/mTransaction.php');

$CREATED_BY = 1;

$mAuth = new mAuth();
$mTransaction = new mTransaction();

try {
    $ORDER_ID = (int) $_POST['order_id'];
    $createTransaction = $mTransaction->createTransaction($ORDER_ID, $_POST['token_transaction'], $_POST['payment_method'], $CREATED_BY);
    return $createTransaction;
} catch (Exception $e) {
    return false;
}