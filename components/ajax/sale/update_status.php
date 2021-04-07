<?php

require_once('../../../assist/classes/mConnect.php');
require_once('../../../assist/classes/mAuth.php');
require_once('../../../assist/classes/mSale.php');

$MODIFIED_BY = 1;

$mAuth = new mAuth();
$mSale = new mSale();

$ORDER_ID = (int) $_POST['order_id'];

echo $mSale->updateOrderStatus($ORDER_ID, $_POST['status_id'], $MODIFIED_BY);