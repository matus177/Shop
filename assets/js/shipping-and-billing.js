function shippingAndBillingOptions(shippingData) {
    for (var key in shippingData) {
        shippingData[key] = parseFloat(shippingData[key]);
    }
    $(document).ready(function () {
        $('#shipping_form').click(function () {
            if ($('#personal_collection').is(':checked')) {
                $('.payment_options input').attr('disabled', false);
                $('.delivery_price h4').replaceWith('<h4>Cena dopravy: ' + shippingData.personal_price + '&euro;</h4>');
                $('#courier').attr('disabled', true);
                $('#slovak_post').attr('disabled', true);
            } else if ($('#courier').is(':checked')) {
                $('.payment_options input').attr('disabled', false);
                $('#personal_collection').attr('disabled', true);
                $('.delivery_price h4').replaceWith('<h4>Cena dopravy: ' + shippingData.courier + '&euro;</h4>');
                $('#slovak_post').attr('disabled', true);
            } else if ($('#slovak_post').is(':checked')) {
                $('.payment_options input').attr('disabled', false);
                $('#personal_collection').attr('disabled', true);
                $('#courier').attr('disabled', true);
                $('.delivery_price h4').replaceWith('<h4>Cena dopravy: ' + shippingData.slovak_post + '&euro;</h4>');
            } else {
                $('.payment_options input').attr('disabled', true);
                $('#personal_collection').attr('disabled', false);
                $('#courier').attr('disabled', false);
                $('#slovak_post').attr('disabled', false);
                $('.delivery_price h4').replaceWith('<h4>Cena dopravy: Nezadane</h4>');
            }
        });
        $('.payment_options input').click(function () {
            var shippingPrice;
            if ($('#dobierka').is(':checked')) {
                if ($('#personal_collection').is(':checked')) {
                    $('.delivery_price h4').replaceWith('<h4>Cena dopravy: ' + (shippingPrice = shippingData.dobierka + shippingData.personal_price) + '&euro;</h4>');
                    $('.delivery_price input').attr("value", '');
                }
                else if ($('#courier').is(':checked')) {
                    $('.delivery_price h4').replaceWith('<h4>Cena dopravy: ' + (shippingPrice = shippingData.dobierka + shippingData.courier) + '&euro;</h4>');
                    $('.delivery_price input').attr("value", shippingPrice);
                }
                else if ($('#slovak_post').is(':checked')) {
                    $('.delivery_price h4').replaceWith('<h4>Cena dopravy: ' + (shippingPrice = shippingData.dobierka + shippingData.slovak_post) + '&euro;</h4>');
                    $('.delivery_price input').attr("value", shippingPrice);
                }
                $('#hotovost').attr('disabled', true);
                $('#card').attr('disabled', true);
            } else if ($('#hotovost').is(':checked')) {
                $('#dobierka').attr('disabled', true);
                if ($('#personal_collection').is(':checked')) {
                    $('.delivery_price h4').replaceWith('<h4>Cena dopravy: ' + (shippingPrice = shippingData.cash + shippingData.personal_price) + '&euro;</h4>');
                    $('.delivery_price input').attr("value", shippingPrice);
                }
                else if ($('#courier').is(':checked')) {
                    $('.delivery_price h4').replaceWith('<h4>Cena dopravy: ' + (shippingPrice = shippingData.cash + shippingData.courier) + '&euro;</h4>');
                    $('.delivery_price input').attr("value", shippingPrice);
                }
                else if ($('#slovak_post').is(':checked')) {
                    $('.delivery_price h4').replaceWith('<h4>Cena dopravy: ' + (shippingPrice = shippingData.cash + shippingData.slovak_post) + '&euro;</h4>');
                    $('.delivery_price input').attr("value", shippingPrice);
                }
                $('#card').attr('disabled', true);
            } else if ($('#card').is(':checked')) {
                $('#dobierka').attr('disabled', true);
                $('#hotovost').attr('disabled', true);
                if ($('#personal_collection').is(':checked')) {
                    $('.delivery_price h4').replaceWith('<h4>Cena dopravy: ' + (shippingPrice = shippingData.card + shippingData.personal_price) + '&euro;</h4>');
                    $('.delivery_price input').attr("value", shippingPrice);
                }
                else if ($('#courier').is(':checked')) {
                    $('.delivery_price h4').replaceWith('<h4>Cena dopravy: ' + (shippingPrice = shippingData.card + shippingData.courier) + '&euro;</h4>');
                    $('.delivery_price input').attr("value", shippingPrice);
                }
                else if ($('#slovak_post').is(':checked')) {
                    $('.delivery_price h4').replaceWith('<h4>Cena dopravy: ' + (shippingPrice = shippingData.card + shippingData.slovak_post) + '&euro;</h4>');
                    $('.delivery_price input').attr("value", shippingPrice);
                }
            } else {
                $('.payment_options input').attr('disabled', false);
            }
        });
    });
}

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

function shippingAndPaymentInfo(price, row) {
    document.getElementById(price).style.display = "inline";
    document.getElementById(price).style.color = "green";
    document.getElementById(price).style.marginLeft = "20px";

    $('#' + price).removeClass('hidden');
    $('.' + row).mouseleave(function () {
        $('#' + price).addClass('hidden');
    });
}