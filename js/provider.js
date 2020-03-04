function editProvider(id_provider) {
    $.ajax({
        type: "POST",
        url: "components/ajax/provider/provider_edit.php",
        data: {
            id_provider: id_provider
        },
        success: function (html) {
            $("#bodyEditProvider").html(html);
        }
    });
}

function deleteProvider(id_provider) {
    $.ajax({
        type: "POST",
        url: "components/ajax/provider/provider_delete.php",
        data: {
            id_provider: id_provider
        },
        success: function (html) {
            $("#bodyDeleteProvider").html(html);
        }
    });
}


function updateStatusProvider(id_provider) {
    $.ajax({
        type: "POST",
        url: "components/ajax/provider/provider_updateStatus.php",
        data: {
            id_provider: id_provider
        },
        success: function (html) {
            $("#bodyupdateStatusProvider").html(html);
        }
    });
}