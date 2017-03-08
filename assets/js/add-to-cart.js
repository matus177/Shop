function addProductToCart(id) {
    $(document).ready(function () {
        $.ajax({
            url: window.location.origin + '/Shop/Cart/addToCart',
            type: 'GET',
            data: {id: id},
            success: function () {
                window.location = window.location.origin + '/Shop/Cart';
            }
        });
    });
}