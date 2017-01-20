$(document).ready(function () {
    $.ajax({
        url: window.location.origin + '/Shop/Cart/isCartEmpty',
        type: 'GET',
        success: function (response) {
            if (response) {
                $('#next_button_0').attr("href", "#");
                $('#next_button_0').attr("data-placement", "left");
                $('#next_button_0').attr("data-content", "Vas nakupny kosik je prazdny.");
                $('#next_button_0').popover();
            } else {
                $('#next_button_0').attr('class', 'btn btn-success');
            }
        }
    });
});