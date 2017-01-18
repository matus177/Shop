<div class="col-md-9 col-sm-offset-3">
    <?php $this->load->view('FlashMessagesView'); ?>
    <?php echo form_open('Cart/updateCart'); ?>
    <table class="table table-bordered">
        <tr>
            <th>Pocet</th>
            <th>Popis</th>
            <th style="text-align:right">Cena</th>
            <th style="text-align:right">Cena za kusy</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach ($this->cart->contents() as $items): ?>
            <?php echo form_hidden($i . '[rowid]', $items['rowid']); ?>
            <tr>
                <td><?php echo form_input(array(
                        'name' => $i . '[qty]',
                        'value' => $items['qty'],
                        'maxlength' => '3',
                        'size' => '5',
                        'class' => "form-control"
                    )); ?></td>
                <td>
                    <?php echo $items['name']; ?>
                    <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>
                        <p>
                            <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
                                <strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br/>
                            <?php endforeach; ?>
                        </p>
                    <?php endif; ?>
                </td>
                <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
                <td style="text-align:right">$<?php echo $this->cart->format_number($items['subtotal']); ?></td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
        <tr>
            <td colspan="2"></td>
            <td class="right"><strong>Spolu</strong></td>
            <td class="right">$<?php echo $this->cart->format_number($this->cart->total()); ?></td>
        </tr>
    </table>
    <p>
        <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-info" type="submit">Pokracovat v nakupe</a>
        <?php echo form_submit(array('class' => 'btn btn-warning'), 'Aktualizovat kosik'); ?>
        <a style="float: right" href="<?php echo base_url('ShippingAndBilling?id=1'); ?>" id="next_button_0"
           class="btn btn-success">Dalej <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
        </a>
    </p>
</div>
<script>
    $(document).ready(function () {
        $.ajax({
            url: 'Cart/isCartEmpty',
            type: 'GET',
            success: function (response) {
                if (response) {
                    $('#next_button_0').attr("href", "#");
                    $('#next_button_0').attr("data-placement", "left");
                    $('#next_button_0').attr("data-content", "Vas nakupny kosik je prazdny.");
                    $('#next_button_0').popover();
                } else {
                    $('#next_button_0').attr('class', 'btn btn-success');
                }
            }
        });
    });
</script>
