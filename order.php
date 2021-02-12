<?php
require_once('components/config.php');
require_once('assist/classes/mProduct.php');
require_once('assist/classes/mProvider.php');
require_once('assist/classes/mClient.php');
require_once('assist/classes/mOrder.php');

$mProduct = new mProduct();
$mProvider = new mProvider();
$mUtil = new mUtil();
$mClient = new mClient();
$mOrder = new mOrder();

$unitys = $mProduct->getUnity();
$providers = $mProduct->getProviders();
$products = $mProduct->getProducts();

$orders = $mOrder->getOrders();

$CREATED_BY = 1;


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_SESSION['app_title'] ?> - Pedidos</title>

    <?php require_once('components/script.php'); ?>
    <script type="text/javascript" src="vendor/jquery.quicksearch.js"></script>
    <script type="text/javascript" src="js/order.js"></script>
    <link rel="stylesheet" href="css/button.css" />

    <script type="text/javascript">
        $(document).ready(function() {
            $('.money').mask('#.##0.00', {
                reverse: true
            });
        });
    </script>
</head>

<body>

    <?php require_once('./components/navbar.php'); ?>
    <br>
    <center>
        <h1>Pedidos</h1>
    </center>
    <br>

    <?php if (isset($_GET['create']) && $_GET['create'] == 1) { ?>
        <center><br>
            <div class="col-md-8">
                <div class="alert alert-success" role="alert">Produto cadastrador com sucesso.</div>
            </div><br>
        </center>
    <?php } ?>

    <div class="form-group input-group col-md-12">
        <div class="col-md-8"></div>
        <div class="col-md-4">
            <input name="consulta" id="txt_consulta" placeholder="Buscar" type="text" class="form-control">
        </div>
    </div>
    <br>
    <!--Tabela de produtos-->
    <table id="tabela" class="table table-hover table-responsive-xl">
        <thead>
            <tr>
                <th scope="col">
                    <center>COD. PEDIDO</center>
                </th>
                <th scope="col">CLIENTE</th>
                <th scope="col">TOTAL</th>
                <th scope="col">DATA CRIAÇÃO</th>
                <th scope="col">
                    <center>COD. ATENDENTE</center>
                </th>
                <th scope="col">STATUS</th>
                <th scope="col"></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($orders as $o) { ?>
                <tr>
                    <td>
                        <center><?= $o['ID'] ?></center>
                    </td>
                    <td><?= $mProvider->getProvider($o['FK_ID_CLIENT'])['NAME'] ?> </td>
                    <td>R$ <?= $mOrder->getOrderTotalCost($o['ID']) ?></td>
                    <td><?= $o['CREATED_ON'] ?></td>
                    <td>
                        <center><?= $o['CREATED_BY'] ?></center>
                    </td>

                    <?php if ($o['STATUS'] == 0) { ?>
                        <td>
                            <h6><span class="badge badge-success">Aberto</span></h6>
                        </td>
                    <?php } else if ($o['STATUS'] == 1) { ?>
                        <td>
                            <h6><span class="badge badge-warning">Fechado</span></h6>
                        </td>
                    <?php } else if ($o['STATUS'] == 2) { ?>
                        <td>
                            <h6><span class="badge badge-primary">Finalizado</span></h6>
                        </td>
                    <?php } ?>

                    <td>
                        <div class="row">
                            <div>
                                <button type="button" class="btn btn-primary btn-row" data-toggle="modal" data-target="#infoOrder" title="Detalhes do pedido" onclick="orderInfo(<?= $o['ID'] ?>)">
                                    <i class="fas fa-align-center"></i>
                                </button>

                                <?php if ($o['STATUS'] == 0) { ?>
                                    <button type="button" class="btn btn-warning btn-row" data-toggle="modal" data-target="#editOrder" title="Editar pedido" onclick="ordertEdit(<?= $o['ID'] ?>)">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                <?php } ?>

                                <button type="button" class="btn btn-danger btn-row" data-toggle="modal" data-target="#deleteOrder" title="Excluir pedido" onclick="storeOrderId(<?= $o['ID'] ?>)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Modal de informações do pedido-->
    <div class="modal fade" id="infoOrder" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="action">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Informações do pedido</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="bodyInfoOrder">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal editar pedido-->
    <div class="modal fade" id="editOrder" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="order.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar pedido</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="bodyEditOrder">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <input type="submit" name="editOrder" class="btn btn-success" value="Salvar alterações">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal excluir pedido-->
    <div class="modal fade" id="deleteOrder" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <form action="" method="">
                    <div class="modal-header">
                        <h5 class="modal-title">Excluir pedido</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="bodyDeleteOrder">
                        Confirma a exclusão do pedido?
                        <br><br>
                        <strong>O registros desse pedido será removido.</strong>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <input type="button" name="deleteOrder" class="btn btn-success" value="Excluir" onclick="orderDelete()">
                    </div>
                </form>
            </div>
        </div>
    </div>

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