function addToCart(id_product) {
    $.ajax({
        type: "POST",
        url: "components/ajax/sale/add_to_cart.php",
        data: {
            id_product: id_product
        },
        success: function (html) {
            $("#items").html(html);
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

function getProductData(id_product) {
    $("#qtd_product_unity").val('');
    $("#product_price_total").val('');
    saleProductInfo(id_product, 'ABREVIATION', 'product_unity');
    getPrice(id_product, 'SALE_VALUE');
}

function recalculatePrice(id_qtd, id_price, id_return) {
    $("#" + id_return).val(parseFloat($("#" + id_price).val() * $("#" + id_qtd).val()).toFixed(2));
}
