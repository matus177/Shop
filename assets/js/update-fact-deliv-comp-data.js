function updateCompanyData(idOfInput, idOfUser) {
    $('#' + idOfInput).keyup(function () {
        var data = $('#' + idOfInput).val();
        $.ajax({
            url: window.location.origin + '/Shop/UserAccountSettings/updateCompanyData',
            type: 'GET',
            data: {input: idOfInput, data: data, id: idOfUser},
            success: function (response) {
                if (response == 'System error')
                    alert('Systemova chyba, kontaktujte spravcu webu.');
                else {
                    document.getElementById(idOfInput).style.borderColor = "green";
                }
            }
        })
    });
}
function updatePersonalData(idOfInput, idOfUser) {
    $('#' + idOfInput).on("autocompletechange change keyup", function () {
        var data = $('#' + idOfInput).val();
        $.ajax({
            url: window.location.origin + '/Shop/UserAccountSettings/updatePersonalData',
            type: 'GET',
            data: {input: idOfInput, data: data, id: idOfUser},
            success: function (response) {
                if (response == 'System error')
                    alert('Systemova chyba, kontaktujte spravcu webu.');
                else {
                    document.getElementById(idOfInput).style.borderColor = "green";
                }
            }
        })
    });
}
function updateDeliveryData(idOfInput, idOfUser) {
    $('#' + idOfInput).on("autocompletechange change keyup", function () {
        var data = $('#' + idOfInput).val();
        $.ajax({
            url: window.location.origin + '/Shop/UserAccountSettings/updateDeliveryData',
            type: 'GET',
            data: {input: idOfInput, data: data, id: idOfUser},
            success: function (response) {
                if (response == 'System error')
                    alert('Systemova chyba, kontaktujte spravcu webu.');
                else {
                    document.getElementById(idOfInput).style.borderColor = "green";
                }
            }
        })
    });
}