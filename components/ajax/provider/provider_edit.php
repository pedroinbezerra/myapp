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
        <input type="hidden" name="id" value="<?= $provider['ID'] ?>">
        <div class="row">
            <div class="col-md-5">
                <label for="edit_name">Empresa/Nome</label>
                <input type="text" name="name" id="edit_name" value="<?= $provider['NAME'] ?>" class="form-control" required="">
            </div>
            <div class="col-md-4">
                <label for="edit_phone">Telefone/Celular</label>
                <input type="number" name="phone" id="edit_phone" value="<?= $provider['PHONE'] ?>" class="form-control phone" required="">
            </div>
            <div class="col-md-3">
                <label for="type">Tipo</label>
                <select name="type" id="type" class="form-control" required="">
                    <?php if ($provider['TYPE'] == 'natural_person') { ?>
                        <option value="natural_person" selected="">Pessoa física</option>
                        <option value="legal_person">Pessoa jurídica</option>
                    <?php } else if ($provider['TYPE'] == 'legal_person') { ?>
                        <option value="natural_person">Pessoa física</option>
                        <option value="legal_person" selected="">Pessoa jurídica</option>
                    <?php } else { ?>
                        <option value="" selected="" hidden="" disabled="">Selecione</option>
                        <option value="natural_person">Pessoa física</option>
                        <option value="legal_person">Pessoa jurídica</option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4">
                <label for="edit_cpf_cnpj">CNPJ/CPF</label>
                <input type="number" name="cpf_cnpj" id="edit_cpf_cnpj" value="<?= $provider['CPF_CNPJ'] ?>" class="form-control cpf_cnpj" required="">
            </div>
            <div class="col-md-8">
                <label for="edit_mail">E-mail</label>
                <input type="email" name="mail" id="edit_mail" value="<?= $provider['MAIL'] ?>" class="form-control">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4">
                <label for="edit_zipcode">CEP</label>
                <input type="number" name="zipcode" id="edit_zipcode" value="<?= $provider['ZIPCODE'] ?>" class="form-control zipcode" required="" onkeyup="getAddress(this.value, 'edit')">
            </div>
            <div class="col-md-8">
                <label for="edit_number">Logradouro</label>
                <input type="text" name="street" id="edit_street" value="<?= $provider['STREET'] ?>" class="form-control" required="">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-3">
                <label for="edit_number">Número</label>
                <input type="number" name="number" id="edit_number" value="<?= $provider['NUMBER'] ?>" class="form-control" required="">
            </div>
            <div class="col-md-5">
                <label for="edit_neighborhood">Bairro</label>
                <input type="text" name="neighborhood" id="edit_neighborhood" value="<?= $provider['NEIGHBORHOOD'] ?>" class="form-control" required="">
            </div>
            <div class="col-md-4">
                <label for="edit_city_state">Cidade - Estado</label>
                <input type="text" name="city_state" id="edit_city_state" value="<?= $provider['CITY_STATE'] ?>" class="form-control" required="">
            </div>
        </div>
        <br>
    </div>
    <?php
} else {
    return 'error';
}
?>