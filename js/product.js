function openModalOnModal(idToClose, idToOpen) {
    $('#' + idToClose).modal('hide');
    $('#' + idToOpen).modal('show');
}

function productInfo(id_product) {
    $.ajax({
        type: "POST",
        url: "components/ajax/product/product_info.php",
        data: {
            id_product: id_product
        },
        success: function (html) {
            $("#bodyEditProvider").html(html);
        }
    });
}

function productEdit(id_product) {
    $.ajax({
        type: "POST",
        url: "components/ajax/product/product_edit.php",
        data: {
            id_product: id_product
        },
        success: function (html) {
            console.log(html);
            $("#bodyEditProduct").html(html);
        }
    });
}

function productInfo(id_product) {
    $.ajax({
        type: "POST",
        url: "components/ajax/product/product_info.php",
        data: {
            id_product: id_product
        },
        success: function (html) {
            $("#bodyInfoProduct").html(html);
        }
    });
}

function productDelete(id_product) {
    $.ajax({
        type: "POST",
        url: "components/ajax/product/product_delete.php",
        data: {
            id_product: id_product
        },
        success: function (html) {
            $("#bodyDeleteProduct").html(html);
        }
    });
}
