<?php

require_once('../../../assist/classes/mConnect.php');
require_once('../../../assist/classes/mAuth.php');
require_once('../../../assist/classes/mSale.php');

$CREATED_BY = 1;

$mAuth = new mAuth();
$mSale = new mSale();

$ITEM_ID = (int) $_POST['item_id'];

echo $mSale->removeItemSaleDetail($ITEM_ID);