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
<script type="text/javascript">
    checkoutStep(<?php echo $orderStep ?>);
</script>