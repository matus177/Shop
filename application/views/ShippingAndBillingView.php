<div class="col-md-9 col-sm-offset-3">
    <?php $this->load->view('FlashMessagesView'); ?>
    <div class="col-sm-6" style="padding-left: 0">
        <h4><b>Zvolte dopravu</b></h4>
        <div class="panel panel-info">
            <div class="panel-body">
                <form id="shipping_form">
                    <div onmouseover="shippingAndPaymentInfo('personal_price', 'personal_price_checkbox')"
                         class="personal_price_checkbox checkbox">
                        <label><input type="checkbox" id="personal_collection" class="shipping_checkbox" value="">Osobny
                            odber</label>
                        <div id="personal_price" class="hidden">Cena za dopravu 1&euro;</div>
                    </div>
                    <div onmouseover="shippingAndPaymentInfo('courier_price', 'courier_price_checkbox')"
                         class="courier_price_checkbox checkbox">
                        <label><input type="checkbox" id="courier" class="shipping_checkbox" value="">Kurier</label>
                        <div id="courier_price" class="hidden">Cena za dopravu 6&euro;</div>
                    </div>
                    <div onmouseover="shippingAndPaymentInfo('post_price', 'post_price_checkbox')"
                         class="post_price_checkbox checkbox">
                        <label><input type="checkbox" id="slovak_post" class="shipping_checkbox" value="">Slovenska
                            posta</label>
                        <div id="post_price" class="hidden">Cena za dopravu 3,50&euro;</div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-6" style="padding-right: 0">
        <h4><b>Zvolte sposob platby</b></h4>
        <div class="panel panel-info">
            <div class="panel-body">
                <form>
                    <div class="payment_options">
                        <div onmouseover="shippingAndPaymentInfo('dobierka_price', 'dobierka_price_checkbox')"
                             class="dobierka_price_checkbox checkbox">
                            <label><input id="dobierka" class="payment_checkbox" type="checkbox" value="" disabled>Dobierkou</label>
                            <div id="dobierka_price" class="hidden">Cena za platbu 3,50&euro;</div>
                        </div>
                        <div onmouseover="shippingAndPaymentInfo('hotovost_price', 'hotovost_price_checkbox')"
                             class="hotovost_price_checkbox checkbox">
                            <label><input id="hotovost" class="payment_checkbox" type="checkbox" value="" disabled>V
                                hotovosti</label>
                            <div id="hotovost_price" class="hidden">Cena za platbu 0&euro;</div>
                        </div>
                        <div onmouseover="shippingAndPaymentInfo('card_price', 'card_price_checkbox')"
                             class="card_price_checkbox checkbox">
                            <label><input id="card" class="payment_checkbox" type="checkbox" value=""
                                          disabled>Kartou</label>
                            <div id="card_price" class="hidden">Cena za platbu 0&euro;</div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="delivery_price">
        <h4>Cena dopravy: Nezadane</h4>
    </div>
    <a href="<?php echo base_url('Cart'); ?>" class="btn btn-default">
        <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Spat
    </a>
    <a style="float: right" href="<?php echo base_url('ShippingOptions?id=2'); ?>" id="next_button_1"
       class="btn btn-success">Dalej
        <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
    </a>
</div>
<script>
    $(document).ready(function () {
        $('#shipping_form').click(function () {
            if ($('#personal_collection').is(':checked')) {
                $('.payment_options input').attr('disabled', false);
                $('.delivery_price h4').replaceWith('<h4>' + 'Cena dopravy: 1' + '&euro;' + '</h4>');
                $('#courier').attr('disabled', true);
                $('#slovak_post').attr('disabled', true);
            } else if ($('#courier').is(':checked')) {
                $('.payment_options input').attr('disabled', false);
                $('#personal_collection').attr('disabled', true);
                $('.delivery_price h4').replaceWith('<h4>' + 'Cena dopravy: 6' + '&euro;' + '</h4>');
                $('#slovak_post').attr('disabled', true);
            } else if ($('#slovak_post').is(':checked')) {
                $('.payment_options input').attr('disabled', false);
                $('#personal_collection').attr('disabled', true);
                $('#courier').attr('disabled', true);
                $('.delivery_price h4').replaceWith('<h4>' + 'Cena dopravy: 3,50' + '&euro;' + '</h4>');
            } else {
                $('.payment_options input').attr('disabled', true);
                $('#personal_collection').attr('disabled', false);
                $('#courier').attr('disabled', false);
                $('#slovak_post').attr('disabled', false);
                $('.delivery_price h4').replaceWith('<h4>' + 'Cena dopravy: Nezadane' + '</h4>');
            }
        });
        $('.payment_options input').click(function () {
            if ($('#dobierka').is(':checked')) {
                $('#personal_collection').is(':checked') ? $('.delivery_price h4').replaceWith('<h4>' + 'Cena dopravy: 4,50' + '&euro;' + '</h4>') :
                    $('#courier').is(':checked') ? $('.delivery_price h4').replaceWith('<h4>' + 'Cena dopravy: 9,50' + '&euro;' + '</h4>') :
                        $('#slovak_post').is(':checked') ? $('.delivery_price h4').replaceWith('<h4>' + 'Cena dopravy: 7' + '&euro;' + '</h4>') : '';
                $('#hotovost').attr('disabled', true);
                $('#card').attr('disabled', true);
            } else if ($('#hotovost').is(':checked')) {
                $('#dobierka').attr('disabled', true);
                $('#personal_collection').is(':checked') ? $('.delivery_price h4').replaceWith('<h4>' + 'Cena dopravy: 1' + '&euro;' + '</h4>') :
                    $('#courier').is(':checked') ? $('.delivery_price h4').replaceWith('<h4>' + 'Cena dopravy: 6' + '&euro;' + '</h4>') :
                        $('#slovak_post').is(':checked') ? $('.delivery_price h4').replaceWith('<h4>' + 'Cena dopravy: 3,50' + '&euro;' + '</h4>') : '';
                $('#card').attr('disabled', true);
            } else if ($('#card').is(':checked')) {
                $('#dobierka').attr('disabled', true);
                $('#hotovost').attr('disabled', true);
                $('#personal_collection').is(':checked') ? $('.delivery_price h4').replaceWith('<h4>' + 'Cena dopravy: 1' + '&euro;' + '</h4>') :
                    $('#courier').is(':checked') ? $('.delivery_price h4').replaceWith('<h4>' + 'Cena dopravy: 6' + '&euro;' + '</h4>') :
                        $('#slovak_post').is(':checked') ? $('.delivery_price h4').replaceWith('<h4>' + 'Cena dopravy: 3,50' + '&euro;' + '</h4>') : '';
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
                $('#next_button_1').attr("href", "#").attr("data-placement", "left").attr("data-content", "Zadajte sposob dopravy a platby.");
                $('#next_button_1').popover();
            } else {
                $('#next_button_1').attr("href", '<?php echo base_url('ShippingOptions?id=2'); ?>');
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