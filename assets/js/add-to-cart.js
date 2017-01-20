$(document).ready(function () {
    $('.product_footer a').click(function (e) {
        var idOfButton = e.target.id;
        $.ajax({
            url: window.location.origin + '/Shop/Cart/addToCart/' + idOfButton,
            type: 'GET'
        });
    });
});