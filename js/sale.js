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

function addToCart() {
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
            } else {
                $("#id_order").val(html);
                getOrderItems($("#id_order").val());
            }
        }
    });
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
            $("#" + id_return).html(html);
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

function getProductData(id_product) {
    $("#qtd_product_unity").val('');
    $("#product_price_total").val('');
    saleProductInfo(id_product, 'ABREVIATION', 'product_unity');
    getPrice(id_product, 'SALE_VALUE');
    getCost(id_product, 'COST');
}

function recalculatePrice(id_qtd, id_price, id_return) {
    $("#" + id_return).val(parseFloat($("#" + id_price).val() * $("#" + id_qtd).val()).toFixed(2));
}
