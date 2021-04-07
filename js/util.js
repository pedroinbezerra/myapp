function clearAddress(return_to) {
    document.getElementById(return_to + "_street").value = "";
    document.getElementById(return_to + "_neighborhood").value = "";
    document.getElementById(return_to + "_city_state").value = "";
}

function getAddress(zipcode, return_to) {
    var size = zipcode.length;
    if (size == 8) {
        var url = "https://viacep.com.br/ws/" + zipcode + "/json/";
        var address = '';

        $.ajax({
            url: url,
            dataType: "jsonp",
            success: function (response) {
                address = (response);
                if (("erro" in address)) {
                    alert('CEP não encontrado');
                    clearAddress(return_to);
                } else {
                    document.getElementById(return_to + "_street").value = (address.logradouro);
                    document.getElementById(return_to + "_neighborhood").value = (address.bairro);
                    document.getElementById(return_to + "_city_state").value = (address.localidade + " - " + address.uf);
                }
            }
        });
    } else {
        clearAddress(return_to);
    }
}

document.addEventListener('DOMContentLoaded', function () {
    setTimeout(function () {
        $(".alert").fadeOut();
    }, 5000);
}, false);

function negativeNumber(inputId) {
    let value = document.getElementById(inputId).value;
    if (value < 0) {
        document.getElementById(inputId).value = 0;
        alert("Permitida a entrada somente de números positivos");
    }
}

function formClear(form) {
    $(form).each(function () {
        this.reset();
    });
}

function validNumber(input) {
    let validNumber = true;

    if (input == 0 || input.trim() == "" || typeof (input) == "undefined") {
        validNumber = false;
    }

    return validNumber;
}

function goBack() {
    window.history.back();
}

function reload() {
    window.location.reload()
}

function convertRealToCents(ammout) {
    let result = '';
    try {
        result = ammout * 100;
    } catch (error) {
        result = 'Não foi possível multiplicar o valor ' + ammout + ' por 100';
    }

    return result;
}

$(document).ready(function () {
    $("thead").css("background-color", "#d3dceb");
    $("html:not(.legacy) table").stickyTableHeaders();
});