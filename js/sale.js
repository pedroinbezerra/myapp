function manageAddToCartButton(inStock) {
    if (inStock <= 0) {
        let onDemand = sessionStorage.getItem("onDemand");

        if (onDemand == 0) {
            $(".addToCart").prop("disabled", true);
            $(".addToCart").removeAttr("title");

        }

        alert("Produto sem estoque");
        $(".addToCart").prop("title", "Produto sem estoque");
    } else {
        $(".addToCart").removeAttr("disabled");
        $(".addToCart").removeAttr("title");
        $(".addToCart").prop("title", "Adicionar ao carrinho");
    }
}

function manageVisibilityFooter(visibility) {
    $(".modal-footer").removeAttr("display");
    $(".modal-footer").css("display", visibility);
}

function getOrderItems(order_id) {
    $.ajax({
        type: "POST",
        url: "components/ajax/sale/get_order_items.php",
        data: {
            order_id: order_id
        },
        success: function (html) {
            $("#items").html("");
            $("#items").html(html);
        }
    });
}

function getOrderItems(order_id) {
    $.ajax({
        type: "POST",
        url: "components/ajax/sale/get_order_items.php",
        data: {
            order_id: order_id
        },
        success: function (html) {
            $("#items").html("");
            $("#items").html(html);
        }
    });
}

function validQuantity(toCart, inStock, reserved, returnType) {    
    let validValue = true;
    let disponible = inStock - reserved;

    if (toCart > disponible) {
        validValue = false;
    }

    if(returnType == 'qtdDisponible'){
        return disponible;
    } else {
        return validValue;
    }    
}

function addToCart() {
    let totalValueOrder = $("#product_price_total").val();
    let toCart = $("#qtd_product_unity").val();
    let inStock = $("#qtd_product_unity_stock").val();
    let reserved = $("#quantityReserved").val();

    let notValidQuantity = !validQuantity(toCart, inStock, reserved);

    if(notValidQuantity){
        let qtdDisponible = validQuantity(toCart, inStock, reserved, 'qtdDisponible');
        alert("A quantidade adicionada é maior que a disponível.\nDisponível: " + qtdDisponible);
        return;
    }

    if (totalValueOrder <= 0) {
        alert("Para adicionar o produto, o valor total deve ser maior que zero");
        return;
    }

    $.ajax({
        type: "POST",
        url: "components/ajax/sale/add_to_cart.php",
        data: {
            id_order: $("#id_order").val(),
            idClient: $("#client").val(),
            idProduct: $("#product").val(),
            qtdProduct: $("#qtd_product_unity").val(),
            price: $("#product_price").val(),
            totalPrice: $("#product_price_total").val()
        },
        success: function (html) {
            if (html == 'invalid_field') {
                alert('Verifique os campos e tente novamente');
            } else if (html == 'no_stock') {
                alert('Produto sem estoque');
            } else {
                $("#id_order").val(html);
                getOrderItems($("#id_order").val());
                manageVisibilityFooter("block");
                getTotalQtdReservedItems($("#product").val(), "#quantityReserved");
            }
        }
    });
}

function getTotalQtdReservedItems(id_product, element) {
    $.ajax({
        type: "POST",
        url: "components/ajax/sale/get_reserved_items.php",
        data: {
            id_product: id_product
        },
        success: function (html) {
            let qtdNotReserved = html
            $(element).html(qtdNotReserved);
        }
    });
}

function qtdItemDisponible(total, reserved){
    return total - reserved;
}

function saleProductInfo(id_product, array_key, id_return) {
    $.ajax({
        type: "POST",
        url: "components/ajax/sale/product_info.php",
        data: {
            id_product: id_product,
            array_key: array_key
        },
        success: function (html) {
            if (array_key == 'QUANTITY') {
                manageAddToCartButton(html);
            }
            $(id_return).html(html);
        }
    });
}

function getPrice(id_product, array_key) {
    $.ajax({
        type: "POST",
        url: "components/ajax/sale/product_info.php",
        data: {
            id_product: id_product,
            array_key: array_key
        },
        success: function (html) {
            $('#product_price').val(html);
        }
    });
}

function getCost(id_product, array_key) {
    $.ajax({
        type: "POST",
        url: "components/ajax/sale/product_info.php",
        data: {
            id_product: id_product,
            array_key: array_key
        },
        success: function (html) {
            $('#product_cost').val(html);
        }
    });
}

function onDemand(id_product) {
    $.ajax({
        type: "POST",
        url: "components/ajax/sale/product_info.php",
        data: {
            id_product: id_product,
            array_key: "ON_DEMAND"
        },
        success: function (html) {
            sessionStorage.setItem("onDemand", html);
        }
    });
}

function getProductData(id_product) {
    $("#qtd_product_unity").val('');
    $("#product_price_total").val('');
    saleProductInfo(id_product, 'ABREVIATION', '#product_unity_sale');
    saleProductInfo(id_product, 'ABREVIATION', '.product_unity_stock');
    getTotalQtdReservedItems(id_product, "#quantityReserved");
    saleProductInfo(id_product, 'QUANTITY', '#qtd_product_unity_stock');
    onDemand(id_product);
    getPrice(id_product, 'SALE_VALUE');
    getCost(id_product, 'COST');
    sessionStorage.setItem("idProduct", id_product);

}

function recalculatePrice(id_qtd, id_price, id_return) {
    if ($("#" + id_qtd).val() > 0) {
        $("#" + id_return).val(parseFloat($("#" + id_price).val() * $("#" + id_qtd).val()).toFixed(2));
    } else {
        $("#" + id_return).val(0.00);
    }
}

function changeProductUnity() {
    recalculatePrice("qtd_product_unity", "product_price", "product_price_total");
    negativeNumber("qtd_product_unity");
}

function changeFinalPrice() {
    recalculatePrice("qtd_product_unity", "product_price", "product_price_total");
    negativeNumber("qtd_product_unity");
}

function removeItem(item_id){
   
}

function deleteRow(element, item_id) {
    $(".removeItem").prop("disabled", true);
    $.ajax({
        type: "POST",
        url: "components/ajax/sale/remove_item_sale_detail.php",
        data: {
            item_id: item_id
        },
        success: function (html) {
            let idProduct = sessionStorage.getItem("idProduct");

            $(".removeItem").prop("disabled", false);
            $(element).closest("tr").remove();
            manageVisibilityFooter("block");

            getTotalQtdReservedItems(idProduct, "#quantityReserved");
        }
    });
    
}

function removeOrder() {
    var order_id = $("#id_order").val();

    $.ajax({
        type: "POST",
        url: "components/ajax/sale/remove_order.php",
        data: {
            order_id: order_id
        },
        success: function (html) {
            sessionStorage.setItem("discartedOrder", true);
            window.location.reload();
        }
    });
    
}