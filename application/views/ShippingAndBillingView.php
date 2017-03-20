<div class="col-md-9">
    <?php $this->load->view('FlashMessagesView'); ?>
    <div class="shippingAndBilling_main">
        <h3>2. Doprava a platba</h3>
        <hr>
        <div class="col-sm-6">
            <h4>Zvolte sposob dopravy</h4>
            <div class="panel panel-info">
                <div class="panel-body form-horizontal">
                    <?php echo form_open('ShippingAndBilling/checkShippingAndBilling', ['id' => 'shipping_form']); ?>
                    <div onmouseover="shippingAndPaymentInfo('personal_price', 'personal_price_checkbox')"
                         class="personal_price_checkbox checkbox">
                        <label><input type="checkbox" name="osobny_odber" id="personal_collection"
                                      class="shipping_checkbox"
                                      value="1">Osobny odber
                        </label>
                        <div id="personal_price" class="hidden">Cena za
                            dopravu <?php echo $shippingData->personal_price; ?>&euro;</div>
                    </div>
                    <div onmouseover="shippingAndPaymentInfo('courier_price', 'courier_price_checkbox')"
                         class="courier_price_checkbox checkbox">
                        <label><input type="checkbox" name="courier" id="courier" class="shipping_checkbox" value="6">Kurier</label>
                        <div id="courier_price" class="hidden">Cena za
                            dopravu <?php echo $shippingData->courier; ?>&euro;</div>
                    </div>
                    <div onmouseover="shippingAndPaymentInfo('post_price', 'post_price_checkbox')"
                         class="post_price_checkbox checkbox">
                        <label><input type="checkbox" name="slovak_post" id="slovak_post" class="shipping_checkbox"
                                      value="3.5">Slovenska
                            posta</label>
                        <div id="post_price" class="hidden">Cena za
                            dopravu <?php echo $shippingData->slovak_post; ?>&euro;</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <h4>Zvolte sposob platby</h4>
            <div class="panel panel-info">
                <div class="panel-body form-horizontal">
                    <?php echo form_open('ShippingAndBilling/checkShippingAndBilling'); ?>
                    <div class="payment_options">
                        <div onmouseover="shippingAndPaymentInfo('dobierka_price', 'dobierka_price_checkbox')"
                             class="dobierka_price_checkbox checkbox">
                            <label><input id="dobierka" name="dobierka" class="payment_checkbox" type="checkbox"
                                          value="3.5"
                                          disabled>Dobierkou</label>
                            <div id="dobierka_price" class="hidden">Cena za
                                platbu <?php echo $shippingData->dobierka; ?>&euro;</div>
                        </div>
                        <div onmouseover="shippingAndPaymentInfo('hotovost_price', 'hotovost_price_checkbox')"
                             class="hotovost_price_checkbox checkbox">
                            <label><input id="hotovost" name="hotovost" class="payment_checkbox" type="checkbox"
                                          value="0"
                                          disabled>V hotovosti</label>
                            <div id="hotovost_price" class="hidden">Cena za
                                platbu <?php echo $shippingData->cash; ?>&euro;</div>
                        </div>
                        <div onmouseover="shippingAndPaymentInfo('card_price', 'card_price_checkbox')"
                             class="card_price_checkbox checkbox">
                            <label><input id="card" name="card" class="payment_checkbox" type="checkbox" value="0"
                                          disabled>Kartou</label>
                            <div id="card_price" class="hidden">Cena za
                                platbu <?php echo $shippingData->card; ?>&euro;</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="delivery_price">
            <h4>Cena dopravy: Nezadane </h4>
            <input type="text" name="delivery_price" value="<?php echo $shippingPrice ?>" hidden>
        </div>
    </div>
    <a href="<?php echo base_url('Cart'); ?>" class="btn btn-default">
        <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Spat
    </a>
    <button style="float: right" type="submit" id="next_button_1"
            class="btn btn-success">Dalej
        <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
    </button>
    <?php echo form_close(); ?>
    <?php echo form_close(); ?>
</div>
<script>
    shippingAndBillingOptions(<?php echo json_encode($shippingData); ?>);
</script>