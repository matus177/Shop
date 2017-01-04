<div class="col-md-9 col-sm-offset-3">
    <?php $this->load->view('FlashMessagesView'); ?>
    <div class="col-sm-6" style="padding-left: 0">
        <h4><b>Zvolte dopravu</b></h4>
        <div class="panel panel-info">
            <div class="panel-body">
                <form id="shipping_form" class="aa">
                    <div class="checkbox">
                        <label><input type="checkbox" id="personal_collection" value="">Osobny odber
                            <span id="a" class="a glyphicon glyphicon-question-sign hidden"></span>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" id="courier" value="1">Kurier</label>
                        <span id="a" class="a glyphicon glyphicon-question-sign hidden"></span>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" id="slovak_post" value="">Slovenska posta</label>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-6" style="padding-right: 0">
        <h4><b>Zvolte sposob platby</b></h4>
        <div class="panel panel-info">
            <div class="panel-body">
                <form id="payment_form">
                    <div class="payment_options">
                        <div class="checkbox">
                            <label><input id="dobierka" type="checkbox" value="" disabled>Dobierkou</label>
                        </div>
                        <div class="checkbox">
                            <label><input id="hotovost" type="checkbox" value="" disabled>V hotovosti</label>
                        </div>
                        <div class="checkbox">
                            <label><input id="card" type="checkbox" value="" disabled>Kartou</label>
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
    <a style="float: right" href="<?php echo base_url('ShippingOptions?id=2'); ?>" class="btn btn-success">Dalej
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
        $('#payment_form').click(function () {
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
                $('#dobierka').attr('disabled', false);
                $('#hotovost').attr('disabled', false);
                $('#card').attr('disabled', false);
            }
        });
    });
</script>
<script>
    $('.aa').hover(function () {
        $('.a').removeClass('hidden');
        alert($('.aa input').val());
    }, function () {
        $('.a').addClass('hidden');
    });
</script>