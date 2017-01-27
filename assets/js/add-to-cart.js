$(document).ready(function () {
    $('.product_footer a').click(function (e) {
        var idOfButton = e.target.id;
        $.ajax({
            url: window.location.origin + '/Shop/Cart/addToCart/' + idOfButton,
            type: 'GET',

            success: function (response) {
                if (response == 'error')
                    alert('Vyskytla sa chyba.');
                else
                    window.location = window.location.origin + '/Shop/Cart';
            }
        });
    });
});