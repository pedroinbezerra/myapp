<?php
require_once('../../../assist/classes/mConnect.php');
require_once('../../../assist/classes/mAuth.php');
require_once('../../../assist/classes/mUtil.php');

$mAuth = new mAuth();

if (isset($_POST['id_provider'])) {

    require_once('../../../assist/classes/mProvider.php');
    $mProvider = new mProvider();
    $provider = $mProvider->getProvider($_POST['id_provider']);
    ?>
    <div class="col-md-12">
        <strong>Confirma a <?= $provider['ACTIVE'] == 1 ? "desativação" : "ativação" ?> do fornecedor abaixo?</strong>
        <br><br>
        <?= $provider['NAME'] . ' - ' . $provider['CPF_CNPJ'] ?>
        <input type="hidden" name="id_provider" value="<?= $provider['ID'] ?>">
        <input type="hidden" name="status" value="<?= $provider['ACTIVE'] == 1 ? 0 : 1 ?>">
    </div>

    <script>
        if (<?= $provider['ACTIVE'] ?> == 1) {
            document.getElementById("btnUpdateStatusProvider").value = "Desativar";
        } else {
            document.getElementById("btnUpdateStatusProvider").value = "Ativar";
        }
    </script>
<?php } ?>