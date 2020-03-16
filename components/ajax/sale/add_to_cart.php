<?php

require_once('../../../assist/classes/mConnect.php');
require_once('../../../assist/classes/mAuth.php');
require_once('../../../assist/classes/mProduct.php');
require_once('../../../assist/classes/mSale.php');

$mAuth = new mAuth();
$mSale = new mSale();



if (isset($_POST['id_product']) and isset($_POST['array_key'])) {

    $mProduct = new mProduct();

    $product_unity = $mProduct->getProduct($_POST['id_product']);

    echo $product_unity[$_POST['array_key']];
}
?>