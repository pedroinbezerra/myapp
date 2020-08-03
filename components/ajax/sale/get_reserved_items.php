<?php

require_once('../../../assist/classes/mConnect.php');
require_once('../../../assist/classes/mAuth.php');
require_once('../../../assist/classes/mSale.php');

$CREATED_BY = 1;

$mAuth = new mAuth();
$mSale = new mSale();

$PRODUCT_ID = $_POST['id_product'];

echo $mSale->getReservedProducts($PRODUCT_ID)['TOTAL'];