<?php
require_once('./components/config.php');
require_once('assist/classes/mProvider.php');

$mProvider = new mProvider();

$LOGGED_USER = '2';

if (isset($_POST['createProvider'])) {
    if ($mProvider->createProvider($_POST['type'], $_POST['name'], $_POST['phone'], $_POST['mail'], $_POST['cpf_cnpj'], $_POST['zipcode'], $_POST['street'], $_POST['number'], $_POST['neighborhood'], $_POST['city_state'], $LOGGED_USER)) {
        header('location: provider.php?create=1');
    } else {
        header('location: provider.php?create=0');
    }
}

if (isset($_POST['editProvider'])) {
    if ($mProvider->editProvider($_POST['id'], $_POST['type'], $_POST['name'], $_POST['phone'], $_POST['mail'], $_POST['cpf_cnpj'], $_POST['zipcode'], $_POST['street'], $_POST['number'], $_POST['neighborhood'], $_POST['city_state'], $LOGGED_USER)) {
        header('location: provider.php?edit=1');
    } else {
        header('location: provider.php?edit=0');
    }
}

if (isset($_POST['updateStatusProvider'])) {
    if ($mProvider->updateStatusProvider($_POST['id_provider'], $_POST['status'], $LOGGED_USER)) {
        header('location: provider.php?updatedStatus=1');
    } else {
        header('location: provider.php?updatedStatus=0');
    }
}

if (isset($_POST['deleteProvider'])) {
    if ($mProvider->deleteProvider($_POST['id_provider'])) {
        header('location: provider.php?delete=1');
    } else {
        header('location: provider.php?delete=0');
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $_SESSION['app_title'] ?> - Fornecedor</title>

        <?php require_once('components/script.php'); ?>
        <script type="text/javascript" src="vendor/jquery.quicksearch.js"></script>
        <script type="text/javascript" src="js/provider.js"></script>
        <link rel="stylesheet" href="css/button.css"/>

        <script type="text/javascript">
            $(document).ready(function () {
                $(".zipcode").mask("99999999");
                $(".phone").mask("99999999999");
                $(".cpf_cnpj").mask("99999999999999");
            });
        </script>

    </head>

    <body>

        <?php require_once('./components/navbar.php'); ?>
        <br>
    <center><h1>Fornecedores</h1></center>

    <?php if (isset($_GET['create']) && $_GET['create'] == 1) { ?>
        <center><br><div class="col-md-8"><div class="alert alert-success" role="alert">Fornecedor cadastrador com sucesso.</div></div><br></center>
    <?php } if (isset($_GET['create']) && $_GET['create'] == 0) { ?>
        <center><br><div class="col-md-8"><div class="alert alert-danger" role="alert">Erro ao cadastrar fornecedor.</div></div><br></center>
    <?php } if (isset($_GET['edit']) && $_GET['edit'] == 1) { ?>
        <center><br><div class="col-md-8"><div class="alert alert-success" role="alert">Fornecedor editado com sucesso.</div></div><br></center>
    <?php } if (isset($_GET['edit']) && $_GET['edit'] == 0) { ?>
        <center><br><div class="col-md-8"><div class="alert alert-danger" role="alert">Erro ao editar fornecedor.</div></div><br></center>
    <?php } if (isset($_GET['updatedStatus']) && $_GET['updatedStatus'] == 1) { ?>
        <center><br><div class="col-md-8"><div class="alert alert-success" role="alert">Status do fornecedor atualizado com sucesso.</div></div><br></center>
    <?php } if (isset($_GET['updatedStatus']) && $_GET['updatedStatus'] == 0) { ?>
        <center><br><div class="col-md-8"><div class="alert alert-danger" role="alert">Erro ao atualizar status do fornecedor.</div></div><br></center>
    <?php } if (isset($_GET['delete']) && $_GET['delete'] == 1) { ?>
        <center><br><div class="col-md-8"><div class="alert alert-success" role="alert">Fornecedor excluído com sucesso.</div></div><br></center>
    <?php } if (isset($_GET['delete']) && $_GET['delete'] == 0) { ?>
        <center><br><div class="col-md-8"><div class="alert alert-danger" role="alert">Erro ao excluir fornecedor.</div></div><br></center>
    <?php } ?>

    <div class="form-group input-group col-md-12">
        <div class="col-md-2">
            <!-- Button trigger modal novo fornecedor -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createProvider">
                Novo fornecedor
            </button>
        </div>
        <div class="col-md-2">
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <input name="consulta" id="txt_consulta" placeholder="Buscar" type="text" class="form-control">
        </div>
    </div>
    <br>

    <table id="tabela" class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Empresa / Nome</th>
                <th scope="col">Endereço</th>
                <th scope="col">CPF / CNPJ</th>
                <th scope="col">Telefone</th>
                <th scope="col">E-mail</th>
                <th scope="col">Status</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>

            <?php
            $providers = $mProvider->getProviders();

            foreach ($providers as $p) {
                ?>
                <tr>
                    <td><?= $p['ID'] ?></td>
                    <td><?= $p['NAME'] ?></td>
                    <td><?= $p['STREET'] . ", " . $p['NUMBER'] . ", " . $p['NEIGHBORHOOD'] . " - " . $p['CITY_STATE'] ?></td>
                    <td><?= $p['CPF_CNPJ'] ?></td>
                    <td><?= $p['PHONE'] ?></td>
                    <td><?= $p['MAIL'] ?></td>
                    <?php if ($p['ACTIVE'] == 1) { ?>
                        <td><h6><span class="badge badge-success">Ativo</span></h6></td>
                    <?php } else { ?>
                        <td><h6><span class="badge badge-danger">Inativo</span></h6></td>
                    <?php } ?>
                    <td>
                        <div class="row">
                            <button type="button" class="btn btn-primary btn-row" title="Editar" data-toggle="modal" data-target="#editProvider" onclick="editProvider(<?= $p['ID'] ?>)">
                                <i class="fas fa-pen"></i>
                            </button>
                            <?php if ($p['ACTIVE'] == 1) { ?>
                                <button type="button" class="btn btn-danger btn-row" title="Desativar" data-toggle="modal" data-target="#updateStatusProvider" onclick="updateStatusProvider(<?= $p['ID'] ?>)">
                                    <i class="fas fa-ban"></i>
                                </button>
                            <?php } else { ?>
                                <button type="button" class="btn btn-success btn-row" title="Ativar" data-toggle="modal" data-target="#updateStatusProvider" onclick="updateStatusProvider(<?= $p['ID'] ?>)">
                                    <i class="fas fa-check"></i>
                                </button>
                            <?php } ?>
                            <button type="button" class="btn btn-danger btn-row" title="Excluir" data-toggle="modal" data-target="#deleteProvider" onclick="deleteProvider(<?= $p['ID'] ?>)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            <?php } ?>            
        </tbody>
    </table>        

    <!-- Modal novo fornecedor-->
    <div class="modal fade" id="createProvider" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="provider.php" method="post">
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
                                    <input type="number" name="phone" id="new_phone" placeholder="Telefone/Celular" class="form-control phone" required="">
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
                                    <input type="number" name="cpf_cnpj" id="new_cpf_cnpj" placeholder="CNPJ/CPF" class="form-control cpf_cnpj" required="">
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

    <!-- Modal editar fornecedor-->
    <div class="modal fade" id="editProvider" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="provider.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar fornecedor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="bodyEditProvider">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <input type="submit" name="editProvider" class="btn btn-success" value="Salvar alterações">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal desativar fornecedor-->
    <div class="modal fade" id="updateStatusProvider" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <form action="provider.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">Alterar status do fornecedor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="bodyupdateStatusProvider">
                    </div> 
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <input type="submit" id="btnUpdateStatusProvider" name="updateStatusProvider" class="btn btn-success" value="">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal excluir fornecedor-->
    <div class="modal fade" id="deleteProvider" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="provider.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">Excluir fornecedor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="bodyDeleteProvider">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <input type="submit" name="deleteProvider" class="btn btn-success" value="Excluir" title="Essa ação não pode ser desfeita">
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