<div class="col-md-9">
    <div class="checkout-wrap">
        <ul class="checkout-bar">
            <li id="cart_order">Kosik</li>
            <li id="shipping_billing">Doprava a platba</li>
            <li id="shipping_options" class="next">Dodacie udaje</li>
            <li id="review_payment" class="next">Suhrn</li>
            <li id="complete_order" class="next">Dokoncenie</li>
        </ul>
    </div>
</div>

<script>
    $(document).ready(function () {
        switch (<?php echo $orderStep ?>) {
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
</script>