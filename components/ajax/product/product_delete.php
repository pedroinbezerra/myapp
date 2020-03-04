<?php
require_once('../../../assist/classes/mConnect.php');
require_once('../../../assist/classes/mAuth.php');

$mAuth = new mAuth();

if (isset($_POST['id_product'])) {
    ?>
    <div class="col-md-12">
        Deseja prosseguir com a exclusão do produto?
        <input type="hidden" name="id_product" value="<?= $_POST['id_product'] ?>">
    </div>
    <?php
} else {
    return 'error';
}
?>