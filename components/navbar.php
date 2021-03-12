<?php ?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"><?= $_SESSION['app_title'] ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="provider.php">Fornecedores</a>
            </li>
            <li class="nav-item">
                <div class="dropdown mr-1">
                    <a class="nav-link dropdown-toggle" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="10,20">Produtos</a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                        <a class="dropdown-item" href="product.php">Listar produtos</a>
                        <a class="dropdown-item" href="product_new.php">Novo produto</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="client.php">Clientes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contas a pagar</a>
            </li>
            <li class="nav-item">
                <div class="dropdown mr-1">
                    <a class="nav-link dropdown-toggle" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="10,20">Vendas</a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                        <a class="dropdown-item" href="sale.php">Novo pedido</a>
                        <a class="dropdown-item" href="order.php">Pedidos</a>
                    </div>
                </div>
            </li>
            <li class="nav-item" style="position: absolute; right: 24px">
                <a class="nav-link" href="#">Sair</a>
            </li>
            <!--li class="nav-item active">
                <a class="nav-link" href="#">Início <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form-->
    </div>
</nav>