<?php
require_once('components/config.php');
require_once('assist/classes/mProduct.php');
require_once('assist/classes/mProvider.php');

$mProduct = new mProduct();
$mProvider = new mProvider();
$mUtil = new mUtil();

$unitys = $mProduct->getUnity();
$providers = $mProduct->getProviders();
$products = $mProduct->getProducts();

$CREATED_BY = 1;

if (isset($_POST['createProduct'])) {
    if ($mProduct->createProduct($_POST['description'], $_POST['quantity'], $_POST['low_stock'], $_POST['unity'], $_POST['measure'], $_POST['cost'], $_POST['sale_value'], $_POST['provider'], $_POST['observation'], $CREATED_BY)) {
        header('location: product.php?create=1');
    } else {
        header('location: product.php?create=0');
    }
}

if (isset($_POST['editProduct'])) {
    if ($mProduct->editProduct($_POST['description'], $_POST['quantity'], $_POST['low_stock'], $_POST['unity'], $_POST['measure'], $_POST['cost'], $_POST['sale_value'], $_POST['provider'], $_POST['observation'], $CREATED_BY, $_POST['id_product'])) {
        header('location: product.php?edit=1');
    } else {
        header('location: product.php?edit=0');
    }
}

if (isset($_POST['createProvider'])) {
    if ($mProvider->createProvider($_POST['type'], $_POST['name'], $_POST['phone'], $_POST['mail'], $_POST['cpf_cnpj'], $_POST['zipcode'], $_POST['street'], $_POST['number'], $_POST['neighborhood'], $_POST['city_state'], $CREATED_BY)) {
        header('location: product.php?provider=1');
    } else {
        header('location: product.php?provider=0');
    }
}

if (isset($_POST['deleteProduct'])) {
    if ($mProduct->deleteProduct($_POST['id_product'])) {
        $$products = $mProduct->getProducts();
        header('location: product.php?delete=1');
    } else {
        header('location: product.php?delete=0');
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $_SESSION['app_title'] ?> - Novo produto</title>

        <?php require_once('components/script.php'); ?>
        <script type="text/javascript" src="vendor/jquery.quicksearch.js"></script>
        <script type="text/javascript" src="js/product.js"></script>
        <link rel="stylesheet" href="css/button.css"/>

        <script type="text/javascript">
            $(document).ready(function () {
                $('.money').mask('#.##0.00', {reverse: true});
            });
        </script>
    </head>

    <body>

        <?php require_once('./components/navbar.php'); ?>
        <br>
    <center><h1>Novo produto</h1></center>

    <?php if (isset($_GET['create']) && $_GET['create'] == 1) { ?>
        <center><br><div class="col-md-8"><div class="alert alert-success" role="alert">Produto cadastrador com sucesso.</div></div><br></center>
    <?php } if (isset($_GET['create']) && $_GET['create'] == 0) { ?>
        <center><br><div class="col-md-8"><div class="alert alert-danger" role="alert">Erro ao cadastrar produto.</div></div><br></center>
    <?php } if (isset($_GET['provider']) && $_GET['provider'] == 1) { ?>
        <center><br><div class="col-md-8"><div class="alert alert-success" role="alert">Fornecedor cadastrador com sucesso.</div></div><br></center>
    <?php } if (isset($_GET['provider']) && $_GET['provider'] == 0) { ?>
        <center><br><div class="col-md-8"><div class="alert alert-danger" role="alert">Erro ao cadastrar fornecedor.</div></div><br></center>
    <?php } ?>

    <br>
    <!-- Modal novo produto-->

    <form action="product.php" method="post">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <label for="description">Descrição</label>
                        <input type="text" name="description" id="new_description" placeholder="Descrição do produto" class="form-control" required="">
                    </div>
                    <div class="col-md-4">
                        <label for="quantity">Quantidade</label>
                        <input type="number" name="quantity" id="new_quantity" placeholder="Quantidade" class="form-control" required="">
                    </div>
                </div>

                <br>
                <div class="row">
                    <div class="col-md-4">
                        <label for="measure">Medida:</label>
                        <input type="number" name="measure" id="new_measure" placeholder="Medida" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="unity">Unidade de medida</label>
                        <select name="unity" id="new_unity" class="form-control" required="" onchange="sval()">
                            <option value="" selected="" hidden="" disabled="">Selecione</option>
                            <?php foreach ($unitys as $u) { ?>
                                <option value="<?= $u['ID'] ?>"><?= $mUtil->autoCaption($u['NAME']) ?></option>
                            <?php } ?>                                           
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="cost">Custo</label>
                        <input type="text" name="cost" id="new_cost" placeholder="Valor de custo" class="form-control money" required="">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="sale_value">Valor de venda</label>
                        <input type="text" name="sale_value" id="new_sale_value" placeholder="Valor de venda" class="form-control money" required="">
                    </div>
                    <div class="col-md-6">
                        <label for="low_stock">Estoque baixo</label>
                        <input type="number" name="low_stock" id="new_low_stock" placeholder="Quantidade para alerta de estoque baixo" class="form-control" required="">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-10">
                        <label for="provider">Fornecedor</label>
                        <select name="provider" id="new_provider" class="form-control" required="">
                            <option value="" selected="" hidden="" disabled="">Selecione</option>
                            <option value="0">Sem fornecedor cadastrado</option>
                            <?php foreach ($providers as $p) { ?>
                                <option value="<?= $p['ID'] ?>"><?= $p['NAME'] . " - " . $p['CPF_CNPJ'] ?></option>
                            <?php } ?>                                      
                        </select>
                    </div>
                    <div class="col-md-2">
                        <br>
                        <center>
                            <button id="new_newProvider" type="button" class="btn btn-primary btn-row-top" data-toggle="modal" data-target="#createProvider" title="Cadastrar novo fornecedor" onclick="openModalOnModal('newProduct', 'createProvider')">
                                <i class="fas fa-plus-square"></i>
                            </button>
                        </center>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <label for="observation">Observações</label>
                        <textarea name="observation" id="new_observation" class="form-control"></textarea>
                    </div>
                </div>
            </div>   
            <div>
                <br>
                <center>
                    <input type="submit" name="createProduct" class="btn btn-success" value="Salvar">
                </center>
            </div>
        </div>
    </form>


    <!-- Modal novo fornecedor-->
    <div class="modal fade" id="createProvider" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="product.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">Novo fornecedor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="new_name">Empresa/Nome</label>
                                    <input type="text" name="name" id="new_name" placeholder="Empresa/Nome" class="form-control" required="">
                                </div>
                                <div class="col-md-4">
                                    <label for="new_phone">Telefone/Celular</label>
                                    <input type="text" name="phone" id="new_phone" placeholder="Telefone/Celular" class="form-control phone" required="">
                                </div>
                                <div class="col-md-3">
                                    <label for="type">Tipo</label>
                                    <select name="type" id="type" class="form-control" required="">
                                        <option value="" selected="" hidden="" disabled="">Selecione</option>
                                        <option value="natural_person">Pessoa física</option>
                                        <option value="legal_person">Pessoa jurídica</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="new_cpf_cnpj">CNPJ/CPF</label>
                                    <input type="text" name="cpf_cnpj" id="new_cpf_cnpj" placeholder="CNPJ/CPF" class="form-control cpf_cnpj" required="">
                                </div>
                                <div class="col-md-8">
                                    <label for="new_mail">E-mail</label>
                                    <input type="email" name="mail" id="new_mail" placeholder="E-mail" class="form-control">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="new_zipcode">CEP</label>
                                    <input type="number" name="zipcode" id="new_zipcode" placeholder="CEP" class="form-control zipcode" required="" onkeyup="getAddress(this.value, 'new')">
                                </div>
                                <div class="col-md-8">
                                    <label for="new_number">Logradouro</label>
                                    <input type="text" name="street" id="new_street" placeholder="Logradouro" class="form-control" required="">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="new_number">Número</label>
                                    <input type="number" name="number" id="new_number" placeholder="Número" class="form-control" required="">
                                </div>
                                <div class="col-md-5">
                                    <label for="new_neighborhood">Bairro</label>
                                    <input type="text" name="neighborhood" id="new_neighborhood" placeholder="Bairro" class="form-control" required="">
                                </div>
                                <div class="col-md-4">
                                    <label for="new_city_state">Cidade - Estado</label>
                                    <input type="text" name="city_state" id="new_city_state" placeholder="Cidade - Estado" class="form-control" required="">
                                </div>
                            </div>
                            <br>
                        </div>                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <input type="submit" name="createProvider" class="btn btn-success" value="Salvar">
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

<script>
    $('input#txt_consulta').quicksearch('table#tabela tbody tr');
</script>

</html>