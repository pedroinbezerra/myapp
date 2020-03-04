function editClient(id_client) {
    $.ajax({
        type: "POST",
        url: "components/ajax/client/client_edit.php",
        data: {
            id_client: id_client
        },
        success: function (html) {
            $("#bodyEditClient").html(html);
        }
    });
}

function deleteClient(id_client) {
    $.ajax({
        type: "POST",
        url: "components/ajax/client/client_delete.php",
        data: {
            id_client: id_client
        },
        success: function (html) {
            $("#bodyDeleteClient").html(html);
        }
    });
}


function updateStatusClient(id_client) {
    $.ajax({
        type: "POST",
        url: "components/ajax/client/client_updateStatus.php",
        data: {
            id_client: id_client
        },
        success: function (html) {
            $("#bodyupdateStatusClient").html(html);
        }
    });
}