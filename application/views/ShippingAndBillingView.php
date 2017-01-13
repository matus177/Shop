<div class="col-md-9 col-sm-offset-3">
    <?php $this->load->view('FlashMessagesView'); ?>
    <div class="col-sm-6" style="padding-left: 0">
        <h4><b>Zvolte dopravu</b></h4>
        <div class="panel panel-info">
            <div class="panel-body form-horizontal">
                <?php echo form_open('ShippingAndBilling/checkShippingAndBilling', ['id' => 'shipping_form']); ?>
                <div onmouseover="shippingAndPaymentInfo('personal_price', 'personal_price_checkbox')"
                     class="personal_price_checkbox checkbox">
                    <label><input type="checkbox" name="osobny_odber" id="personal_collection" class="shipping_checkbox"
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
    <div class="col-sm-6" style="padding-right: 0">
        <h4><b>Zvolte sposob platby</b></h4>
        <div class="panel panel-info">
            <div class="panel-body form-horizontal">
                <?php echo form_open('ShippingAndBilling/checkShippingAndBilling'); ?>
                <div class="payment_options">
                    <div onmouseover="shippingAndPaymentInfo('dobierka_price', 'dobierka_price_checkbox')"
                         class="dobierka_price_checkbox checkbox">
                        <label><input id="dobierka" name="dobierka" class="payment_checkbox" type="checkbox" value="3.5"
                                      disabled>Dobierkou</label>
                        <div id="dobierka_price" class="hidden">Cena za
                            platbu <?php echo $shippingData->dobierka; ?>&euro;</div>
                    </div>
                    <div onmouseover="shippingAndPaymentInfo('hotovost_price', 'hotovost_price_checkbox')"
                         class="hotovost_price_checkbox checkbox">
                        <label><input id="hotovost" name="hotovost" class="payment_checkbox" type="checkbox" value="0"
                                      disabled>V hotovosti</label>
                        <div id="hotovost_price" class="hidden">Cena za
                            platbu <?php echo $shippingData->cash; ?>&euro;</div>
                    </div>
                    <div onmouseover="shippingAndPaymentInfo('card_price', 'card_price_checkbox')"
                         class="card_price_checkbox checkbox">
                        <label><input id="card" name="card" class="payment_checkbox" type="checkbox" value="0" disabled>Kartou</label>
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
    $(document).ready(function () {
        $('#shipping_form').click(function () {
            if ($('#personal_collection').is(':checked')) {
                $('.payment_options input').attr('disabled', false);
                $('.delivery_price h4').replaceWith('<h4>Cena dopravy: <?php echo $shippingData->personal_price; ?>&euro;</h4>');
                $('#courier').attr('disabled', true);
                $('#slovak_post').attr('disabled', true);
            } else if ($('#courier').is(':checked')) {
                $('.payment_options input').attr('disabled', false);
                $('#personal_collection').attr('disabled', true);
                $('.delivery_price h4').replaceWith('<h4>Cena dopravy: <?php echo $shippingData->courier; ?>&euro;</h4>');
                $('#slovak_post').attr('disabled', true);
            } else if ($('#slovak_post').is(':checked')) {
                $('.payment_options input').attr('disabled', false);
                $('#personal_collection').attr('disabled', true);
                $('#courier').attr('disabled', true);
                $('.delivery_price h4').replaceWith('<h4>Cena dopravy: <?php echo $shippingData->slovak_post; ?>&euro;</h4>');
            } else {
                $('.payment_options input').attr('disabled', true);
                $('#personal_collection').attr('disabled', false);
                $('#courier').attr('disabled', false);
                $('#slovak_post').attr('disabled', false);
                $('.delivery_price h4').replaceWith('<h4>Cena dopravy: Nezadane</h4>');
            }
        });
        $('.payment_options input').click(function () {
            if ($('#dobierka').is(':checked')) {
                if ($('#personal_collection').is(':checked')) {
                    $('.delivery_price h4').replaceWith('<h4>Cena dopravy: <?php echo $shippingPrice = $shippingData->dobierka + $shippingData->personal_price; ?>&euro;</h4>');
                    $('.delivery_price input').attr("value", <?php echo $shippingPrice ?>);
                }
                else if ($('#courier').is(':checked')) {
                    $('.delivery_price h4').replaceWith('<h4>Cena dopravy: <?php echo $shippingPrice = $shippingData->dobierka + $shippingData->courier; ?>&euro;</h4>');
                    $('.delivery_price input').attr("value", <?php echo $shippingPrice ?>);
                }
                else if ($('#slovak_post').is(':checked')) {
                    $('.delivery_price h4').replaceWith('<h4>Cena dopravy: <?php echo $shippingPrice = $shippingData->dobierka + $shippingData->slovak_post; ?>&euro;</h4>');
                    $('.delivery_price input').attr("value", <?php echo $shippingPrice ?>);
                }
                $('#hotovost').attr('disabled', true);
                $('#card').attr('disabled', true);
            } else if ($('#hotovost').is(':checked')) {
                $('#dobierka').attr('disabled', true);
                if ($('#personal_collection').is(':checked')) {
                    $('.delivery_price h4').replaceWith('<h4>Cena dopravy: <?php echo $shippingPrice = $shippingData->cash + $shippingData->personal_price; ?>&euro;</h4>');
                    $('.delivery_price input').attr("value", <?php echo $shippingPrice ?>);
                }
                else if ($('#courier').is(':checked')) {
                    $('.delivery_price h4').replaceWith('<h4>Cena dopravy: <?php echo $shippingPrice = $shippingData->cash + $shippingData->courier; ?>&euro;</h4>');
                    $('.delivery_price input').attr("value", <?php echo $shippingPrice ?>);
                }
                else if ($('#slovak_post').is(':checked')) {
                    $('.delivery_price h4').replaceWith('<h4>Cena dopravy: <?php echo $shippingPrice = $shippingData->cash + $shippingData->slovak_post; ?>&euro;</h4>');
                    $('.delivery_price input').attr("value", <?php echo $shippingPrice ?>);
                }
                $('#card').attr('disabled', true);
            } else if ($('#card').is(':checked')) {
                $('#dobierka').attr('disabled', true);
                $('#hotovost').attr('disabled', true);
                if ($('#personal_collection').is(':checked')) {
                    $('.delivery_price h4').replaceWith('<h4>Cena dopravy: <?php echo $shippingPrice = $shippingData->card + $shippingData->personal_price; ?>&euro;</h4>');
                    $('.delivery_price input').attr("value", <?php echo $shippingPrice ?>);
                }
                else if ($('#courier').is(':checked')) {
                    $('.delivery_price h4').replaceWith('<h4>Cena dopravy: <?php echo $shippingPrice = $shippingData->card + $shippingData->courier; ?>&euro;</h4>');
                    $('.delivery_price input').attr("value", <?php echo $shippingPrice ?>);
                }
                else if ($('#slovak_post').is(':checked')) {
                    $('.delivery_price h4').replaceWith('<h4>Cena dopravy: <?php echo $shippingPrice = $shippingData->card + $shippingData->slovak_post; ?>&euro;</h4>');
                    $('.delivery_price input').attr("value", <?php echo $shippingPrice ?>);
                }
            } else {
                $('.payment_options input').attr('disabled', false);
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#next_button_1').hover(function () {
            if (!($('.payment_checkbox').is(":checked") && $('.shipping_checkbox').is(":checked"))) {
                $('#next_button_1').attr("type", "button").attr("data-placement", "left").attr("data-content", "Zadajte sposob dopravy a platby.");
                $('#next_button_1').popover();
            } else {
                $('#next_button_1').attr('type', 'submit');
            }
        });
    });
</script>
<script>
    function shippingAndPaymentInfo(price, row) {
        document.getElementById(price).style.display = "inline";
        document.getElementById(price).style.color = "green";
        document.getElementById(price).style.marginLeft = "20px";

        $('#' + price).removeClass('hidden');
        $('.' + row).mouseleave(function () {
            $('#' + price).addClass('hidden');
        });
    }
</script>