$(document).ready(function () {
    $('.buy_button').click(function (e) {
        var idOfButton = e.target.id;
        $.ajax({
            url: window.location.origin + '/Shop/Cart/addToCart/' + idOfButton,
            type: 'GET',

            success: function () {
                window.location = window.location.origin + '/Shop/Cart';
            }
        });
    });
});