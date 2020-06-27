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

if (isset($_POST['finalizeSale'])) {
    $on_demand = 0;
    
    if(isset($_POST['on_demand'])){
        $on_demand = 1;
    }

    if ($mProduct->editProduct($_POST['description'], $_POST['quantity'], $_POST['low_stock'], $_POST['unity'], $_POST['measure'], $_POST['cost'], $_POST['sale_value'], $on_demand, $_POST['provider'], $_POST['observation'], $CREATED_BY, $_POST['id_product'])) {
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
    <title><?= $_SESSION['app_title'] ?> - Novo pedido</title>

    <?php require_once('components/script.php'); ?>
    <script type="text/javascript" src="vendor/jquery.quicksearch.js"></script>
    <script type="text/javascript" src="js/sale.js"></script>
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
        <h1>Novo pedido</h1>
    </center>

    <?php if (isset($_GET['create']) && $_GET['create'] == 1) { ?>
        <center><br>
            <div class="col-md-8">
                <div class="alert alert-success" role="alert">Produto cadastrador com sucesso.</div>
            </div><br>
        </center>
    <?php }
    if (isset($_GET['create']) && $_GET['create'] == 0) { ?>
        <center><br>
            <div class="col-md-8">
                <div class="alert alert-danger" role="alert">Erro ao cadastrar produto.</div>
            </div><br>
        </center>
    <?php }
    if (isset($_GET['provider']) && $_GET['provider'] == 1) { ?>
        <center><br>
            <div class="col-md-8">
                <div class="alert alert-success" role="alert">Fornecedor cadastrador com sucesso.</div>
            </div><br>
        </center>
    <?php }
    if (isset($_GET['provider']) && $_GET['provider'] == 0) { ?>
        <center><br>
            <div class="col-md-8">
                <div class="alert alert-danger" role="alert">Erro ao cadastrar fornecedor.</div>
            </div><br>
        </center>
    <?php }
    if (isset($_GET['delete']) && $_GET['delete'] == 1) { ?>
        <center><br>
            <div class="col-md-8">
                <div class="alert alert-success" role="alert">Produto excluído com sucesso.</div>
            </div><br>
        </center>
    <?php }
    if (isset($_GET['delete']) && $_GET['delete'] == 0) { ?>
        <center><br>
            <div class="col-md-8">
                <div class="alert alert-danger" role="alert">Erro ao excluir produto.</div>
            </div><br>
        </center>
    <?php }
    if (isset($_GET['edit']) && $_GET['edit'] == 1) { ?>
        <center><br>
            <div class="col-md-8">
                <div class="alert alert-success" role="alert">Produto editado com sucesso.</div>
            </div><br>
        </center>
    <?php }
    if (isset($_GET['edit']) && $_GET['edit'] == 0) { ?>
        <center><br>
            <div class="col-md-8">
                <div class="alert alert-danger" role="alert">Erro ao editar produto.</div>
            </div><br>
        </center>
    <?php } ?>

    <form action="sale.php" method="post">
        <div class="modal-header">
            <h5 class="modal-title">Novo pedido</h5>
        </div>
        <div class="modal-body">
            <div class="col-md-12">

                <div class="row">
                    <div class="col-md-4">
                        <label for="id_order"><strong>Código do pedido</strong></label>
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
                    <div class="col-md-4">
                        <label for="product"><strong>Produto</strong></label>
                        <select id="product" class="form-control" onchange="getProductData(this.value)">
                            <option value="" disabled="" hidden="" selected="">Selecione</option>
                            <?php foreach ($products as $product) { ?>
                                <option value="<?= $product['ID'] ?>"><?= $product['DESCRIPTION'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="quantity"><strong>Quantidade</strong></label>
                        <div class="input-group">
                            <input type="number" id="qtd_product_unity" name="qtd_product_unity" class="form-control" placeholder="quantidade" required="" onkeyup="changeProductUnity()" onchange="changeProductUnity()">
                            <div class="input-group-prepend">
                                <div class="input-group-text" id="product_unity_sale"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="quantity"><strong>Em estoque</strong></label>
                        <div class="input-group">
                            <textarea type="number" id="qtd_product_unity_stock" class="form-control textarea_input" readonly="" rows="1"></textarea>
                            <div class="input-group-prepend">
                                <div class="input-group-text" id="product_unity_stock"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <br>
                <div class="row">
                    <div class="col-md-4">
                        <label for="product_cost"><strong>Preço de custo</strong></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">R$</div>
                            </div>
                            <input type="text" id="product_cost" value="" class="form-control money" disabled="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="price"><strong>Preço final</strong></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">R$</div>
                            </div>
                            <input type="text" id="product_price" value="" class="form-control money" required="" onkeyup="changeFinalPrice()" onchange="changeFinalPrice()">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="price"><strong>Total</strong></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">R$</div>
                            </div>
                            <input type="text" id="product_price_total" value="" class="form-control money" required="" disabled="">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-info addToCart" style="margin-top: 32px" title="Adicionar ao carrinho" onclick="addToCart()"><i class="fa fa-plus"></i></button>
                    </div>
                </div>

                <div class="col-md-12">
                    <br>
                    <hr><br>
                    <center>
                        <h4><label for="inCart"><strong>No carrinho</strong></label></h4>
                    </center>
                    <table id="inCart" class="table table-striped table-responsive-xl">
                        <thead>
                            <tr>
                                <th scope="col">Produto</th>
                                <th scope="col">Quantidade</th>
                                <th scope="col">Preço final</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody id="items">
                        </tbody>
                    </table>
                    <br>
                    <hr><br>
                </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            <input type="submit" name="finalizeSale" class="btn btn-success" value="Finalizar">
        </div>
    </form>
</body>

</html>