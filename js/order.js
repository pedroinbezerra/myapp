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
