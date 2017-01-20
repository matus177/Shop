function checkoutStep(step) {
    $(document).ready(function () {
        switch (step) {
            case 0:
                $('#cart_order').removeClass().addClass('active');
                $('#shipping_billing').removeClass().addClass('next');
                $('#shipping_options').removeClass().addClass('next');
                $('#review_payment').removeClass().addClass('next');
                $('#complete_order').removeClass().addClass('next');
                break;
            case 1:
                $('#cart_order').removeClass().addClass('previous visited');
                $('#shipping_billing').removeClass().addClass('active');
                $('#shipping_options').removeClass().addClass('next');
                $('#review_payment').removeClass().addClass('next');
                $('#complete_order').removeClass().addClass('next');
                break;
            case 2:
                $('#cart_order').removeClass().addClass('previous visited');
                $('#shipping_billing').removeClass().addClass('previous visited');
                $('#shipping_options').removeClass().addClass('active');
                $('#review_payment').removeClass().addClass('next');
                $('#complete_order').removeClass().addClass('next');
                break;
            case 3:
                $('#cart_order').removeClass().addClass('previous visited');
                $('#shipping_billing').removeClass().addClass('previous visited');
                $('#shipping_options').removeClass().addClass('previous visited');
                $('#review_payment').removeClass().addClass('active');
                $('#complete_order').removeClass().addClass('next');
                break;
            case 4:
                $('#cart_order').removeClass().addClass('previous visited');
                $('#shipping_billing').removeClass().addClass('previous visited');
                $('#shipping_options').removeClass().addClass('previous visited');
                $('#review_payment').removeClass().addClass('previous visited');
                $('#complete_order').removeClass().addClass('active');
        }
    });
}.