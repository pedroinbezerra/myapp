<?php
require_once('components/config.php');
require_once('assist/classes/mProduct.php');
require_once('assist/classes/mProvider.php');
require_once('assist/classes/mClient.php');

$mProduct = new mProduct();
$mProvider = new mProvider();
$mClient = new mClient();
$mUtil = new mUtil();

$unitys = $mProduct->getUnity();
$providers = $mProduct->getProviders();
$products = $mProduct->getProducts();
$clients = $mClient->getClients();

$CREATED_BY = 1;

if (isset($_POST['editProduct'])) {
    if ($mProduct->editProduct($_POST['description'], $_POST['quantity'], $_POST['low_stock'], $_POST['unity'], $_POST['measure'], $_POST['cost'], $_POST['sale_value'], $_POST['provider'], $_POST['observation'], $CREATED_BY, $_POST['id_product'])) {
        header('location: product.php?edit=1');
    } else {
        header('location: product.php?edit=0');
    }
}

if (isset($_POST['deleteProduct'])) {
    if ($mProduct->deleteProduct($_POST['id_product'])) {
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
        <title><?= $_SESSION['app_title'] ?> - Venda</title>

        <?php require_once('components/script.php'); ?>
        <script type="text/javascript" src="vendor/jquery.quicksearch.js"></script>
        <script type="text/javascript" src="js/sale.js"></script>
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
    <center><h1>Venda de produtos</h1></center>

    <?php if (isset($_GET['create']) && $_GET['create'] == 1) { ?>
        <center><br><div class="col-md-8"><div class="alert alert-success" role="alert">Produto cadastrador com sucesso.</div></div><br></center>
    <?php } if (isset($_GET['create']) && $_GET['create'] == 0) { ?>
        <center><br><div class="col-md-8"><div class="alert alert-danger" role="alert">Erro ao cadastrar produto.</div></div><br></center>
    <?php } if (isset($_GET['provider']) && $_GET['provider'] == 1) { ?>
        <center><br><div class="col-md-8"><div class="alert alert-success" role="alert">Fornecedor cadastrador com sucesso.</div></div><br></center>
    <?php } if (isset($_GET['provider']) && $_GET['provider'] == 0) { ?>
        <center><br><div class="col-md-8"><div class="alert alert-danger" role="alert">Erro ao cadastrar fornecedor.</div></div><br></center>
    <?php } if (isset($_GET['delete']) && $_GET['delete'] == 1) { ?>
        <center><br><div class="col-md-8"><div class="alert alert-success" role="alert">Produto excluído com sucesso.</div></div><br></center>
    <?php } if (isset($_GET['delete']) && $_GET['delete'] == 0) { ?>
        <center><br><div class="col-md-8"><div class="alert alert-danger" role="alert">Erro ao excluir produto.</div></div><br></center>
    <?php } if (isset($_GET['edit']) && $_GET['edit'] == 1) { ?>
        <center><br><div class="col-md-8"><div class="alert alert-success" role="alert">Produto editado com sucesso.</div></div><br></center>
    <?php } if (isset($_GET['edit']) && $_GET['edit'] == 0) { ?>
        <center><br><div class="col-md-8"><div class="alert alert-danger" role="alert">Erro ao editar produto.</div></div><br></center>
    <?php } ?>

    <div class="form-group input-group col-md-12">
        <div class="col-md-2">
            <!--Button trigger modal novo pedido-->
            <button type="button" class="btn btn-primary btn-row" data-toggle="modal" data-target="#newSale">
                Novo pedido
            </button>
        </div>
        <div class="col-md-6"></div>
        <div class="col-md-4" style="">
            <input id="txt_consulta" placeholder="Buscar" type="text" class="form-control">
        </div>
    </div>
    <br>
    <!--Tabela de produtos-->
    <table id="tabela" class="table table-hover table-responsive-xl">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Descrição</th>
                <th scope="col">Em estoque</th>
                <th scope="col">Valor de venda</th>
                <th scope="col">Fornecedor</th>
                <th scope="col">Status</th>
                <th scope="col"></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach (/* $products */ $a as $p) { ?>
                <tr>
                    <td><?= $p['ID'] ?></td>
                    <td><?= $p['DESCRIPTION'] ?></td>
                    <td><?= $p['QUANTITY'] . ' ' . $mProduct->getAbrevMeasure($p['FK_ID_UNITY']) ?> </td>
                    <td>R$ <?= $p['SALE_VALUE'] ?></td>
                    <td><?= $mProduct->getProviderName($p['FK_ID_PROVIDER']) ?></td>

                    <?php if ($p['QUANTITY'] > $p['LOW_STOCK']) { ?>
                        <td><h6><span class="badge badge-success">Em estoque</span></h6></td>
                    <?php } else if ($p['QUANTITY'] <= $p['LOW_STOCK'] && $p['QUANTITY'] != 0) { ?>
                        <td><h6><span class="badge badge-warning">Estoque baixo</span></h6></td>
                    <?php } else if ($p['QUANTITY'] <= 0) { ?>
                        <td><h6><span class="badge badge-danger">Indisponível</span></h6></td>
                    <?php } ?>

                    <td>
                        <div class="row">
                            <div>
                                <button type="button" class="btn btn-primary btn-row" data-toggle="modal" data-target="#infoProduct" title="Detalhes do produto" onclick="productInfo(<?= $p['ID'] ?>)" >
                                    <i class="fas fa-align-center"></i>
                                </button>

                                <button type="button" class="btn btn-primary btn-row" data-toggle="modal" data-target="#editProduct" title="Editar produto" onclick="productEdit(<?= $p['ID'] ?>)" >
                                    <i class="fas fa-pen"></i>
                                </button>

                                <button type="button" class="btn btn-danger btn-row" data-toggle="modal" data-target="#deleteProduct" title="Excluir produto" onclick="productDelete(<?= $p['ID'] ?>)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>

    </table>        

    <!-- Modal nova venda-->
    <div class="modal fade" id="newSale" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <form action="product.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">Novo pedido</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">

                            <div class="row">
                                <div class="col-md-4">
                                    <label for="id_order"><strong>ID do pedido</strong></label>
                                    <input type="text" id="id_order" name="id_order" class="form-control" readonly="">
                                </div>
                                <div class="col-md-8">
                                    <label for="client"><strong>Cliente</strong></label>
                                    <select id="client" class="form-control">
                                        <option value="" disabled="" hidden="" selected="">Selecione</option>
                                        <?php foreach ($clients as $client) { ?>
                                            <option value="<?= $client['ID'] ?>"><?= $client['NAME'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <br>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                    <label for="product"><strong>Produto</strong></label>
                                    <select id="product" class="form-control" onchange="getProductData(this.value)">
                                        <option value="" disabled="" hidden="" selected="">Selecione</option>
                                        <?php foreach ($products as $product) { ?>
                                            <option value="<?= $product['ID'] ?>"><?= $product['DESCRIPTION'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="quantity"><strong>Quantidade</strong></label>
                                    <div class="input-group">
                                        <input type="number" id="qtd_product_unity" name="qtd_product_unity" class="form-control" placeholder="quantidade" required="" onkeyup="recalculatePrice('qtd_product_unity', 'product_price', 'product_price_total')">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text" id="product_unity"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="price"><strong>Preço</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">R$</div>
                                        </div>
                                        <input type="text" id="product_price" value="" class="form-control money" required="">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="price"><strong>Total</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">R$</div>
                                        </div>
                                        <input type="text" id="product_price_total" value="" class="form-control money" required="" disabled="">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-info" style="margin-top: 32px" title="Adicionar ao carrinho" onclick="addToCart()"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <br><hr><br>

                                <label for="inCart"><strong>No carrinho</strong></label>
                                <ul id="items">

                                </ul>
                                <br><hr><br>
                            </div>

                        </div>                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <input type="submit" name="createProduct" class="btn btn-success" value="Salvar">
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