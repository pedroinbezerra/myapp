<?php

session_start();

define('ENCRYPTION_KEY_SANDBOX', 'ek_test_WQoFhEs6RwTiOG6RQO49pnuCF9CglU');

$_SESSION['ENCRYPTION_KEY_SANDBOX'] = constant('ENCRYPTION_KEY_SANDBOX');

$_SESSION['app_title'] = ucfirst(strtolower("myapp"));

require_once('assist/classes/mConnect.php');
require_once('assist/classes/mAuth.php');
require_once('assist/classes/mUtil.php');

$mAuth = new mAuth();

//valida se o usuário logado é autêntico
/*
if (isset($_SESSION['userdata'])) {
    if ($mAuth->isValid($_SESSION['userdata']['USERNAME'] == 0)) {
        header('location: index.php');
    }
} else {
    header('location: index.php');
}
*/