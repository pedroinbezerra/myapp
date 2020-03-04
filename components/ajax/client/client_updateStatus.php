<?php
require_once('../../../assist/classes/mConnect.php');
require_once('../../../assist/classes/mAuth.php');
require_once('../../../assist/classes/mUtil.php');

$mAuth = new mAuth();

if (isset($_POST['id_client'])) {

    require_once('../../../assist/classes/mClient.php');
    $mClient = new mClient();
    $client = $mClient->getClient($_POST['id_client']);
    ?>
    <div class="col-md-12">
        <strong>Confirma a <?= $client['ACTIVE'] == 1 ? "desativação" : "ativação" ?> do cliente abaixo?</strong>
        <br><br>
        <?= $client['NAME'] . ' - ' . $client['CPF_CNPJ'] ?>
        <input type="hidden" name="id_client" value="<?= $client['ID'] ?>">
        <input type="hidden" name="status" value="<?= $client['ACTIVE'] == 1 ? 0 : 1 ?>">
    </div>

    <script>
        if (<?= $client['ACTIVE'] ?> == 1) {
            document.getElementById("btnUpdateStatusClient").value = "Desativar";
        } else {
            document.getElementById("btnUpdateStatusClient").value = "Ativar";
        }
    </script>
<?php } ?>