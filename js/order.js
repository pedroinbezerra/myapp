function orderInfo(id_order) {
    $.ajax({
        type: "POST",
        url: "components/ajax/order/order_info.php",
        data: {
            id_order: id_order
        },
        success: function (html) {
            $("#bodyInfoOrder").html(html);
        }
    });
}

function ordertEdit(id_order) {
    $.ajax({
        type: "POST",
        url: "components/ajax/order/order_edit.php",
        data: {
            id_order: id_order
        },
        success: function (html) {
            console.log(html);
            $("#bodyEditOrder").html(html);
        }
    });
}

function storeOrderId(id_order) {
    sessionStorage.setItem("id_order_to_delete", id_order);
}

function orderDelete() {
    id_order = sessionStorage.getItem("id_order_to_delete");
    
    sessionStorage.removeItem("id_order_to_delete");

    $.ajax({
        type: "POST",
        url: "components/ajax/order/remove_order.php",
        data: {
            id_order: id_order
        },
        success: function () {
            window.location.reload();
        }
    });

}
