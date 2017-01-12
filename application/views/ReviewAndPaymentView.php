<div class="col-md-9 col-sm-offset-3">
    <?php $this->load->view('FlashMessagesView'); ?>
    <div class="review_order">
        <hr>
        <h4>Súhrn objednávky</h4><br>
        <div class="col-sm-4">
            <p><b>Fakturačné údaje</b></p>
            <p><?php echo $this->encryption->decrypt($userData['fact_name']) . ' ' . $this->encryption->decrypt($userData['fact_surname']) ?></p>
            <p><?php echo $userData['fact_street'] ?></p>
            <p><?php echo $userData['fact_zip'] . ' ' . $userData['fact_city'] ?></p>
        </div>
        <div class="col-sm-4">
            <p><b>Dodacie údaje</b></p>
            <p><?php if (strlen($this->encryption->decrypt($userData['deliv_name']) . ' ' . $this->encryption->decrypt($userData['deliv_surname'])) > 1)
                    echo $this->encryption->decrypt($userData['deliv_name']) . ' ' . $this->encryption->decrypt($userData['deliv_surname']);
                else echo $this->encryption->decrypt($userData['fact_name']) . ' ' . $this->encryption->decrypt($userData['fact_surname']); ?></p>
            <p><?php if (strlen($userData['deliv_street']) > 0) echo $userData['deliv_street']; else echo $userData['fact_street']; ?></p>
            <p><?php if (strlen($userData['deliv_zip'] . ' ' . $userData['deliv_city']) > 1)
                    echo $userData['deliv_zip'] . ' ' . $userData['deliv_city'];
                else echo $userData['fact_zip'] . ' ' . $userData['fact_city']; ?></p>
        </div>
        <div class="col-sm-4">
            <p><b>Email:</b></p>
            <p><?php echo $userData['email'] ?></p>
            <p><b>Telefón:</b></p>
            <p><?php echo $userData['fact_phone'] ?></p>
        </div>
    </div>
    <div class="review_order_product">
        <hr class="col-lg-12">
        <div class="col-sm-4">
            <p><b>Tovar</b></p>
        </div>
        <div class="col-sm-3">
            <p><b>Kusy</b></p>
        </div>
        <div class="col-sm-3">
            <p><b>Cena/ks &euro;</b></p>
        </div>
        <div class="col-sm-2">
            <p><b>Celkom &euro;</b></p>
        </div>
        <?php $i = 1; ?>
        <?php foreach ($this->cart->contents() as $items): ?>
            <?php echo form_hidden($i . '[rowid]', $items['rowid']); ?>
            <div class="col-sm-4">
                <p><?php echo $items['name']; ?></p>
            </div>
            <div class="col-sm-3">
                <p><?php echo (int)$this->cart->format_number($items['qty']); ?></p>
            </div>
            <div class="col-sm-3">
                <p><?php echo $this->cart->format_number($items['price']); ?></p>
            </div>
            <div class="col-sm-2">
                <p><?php echo $this->cart->format_number($items['subtotal']); ?></p>
            </div>
            <?php $i++; ?>
        <?php endforeach; ?>
        <div class="col-sm-4">
            <p>Doprava <?php echo $this->session->userdata('shipping_options'); ?>,
                Platba <?php echo $this->session->userdata('payment_options'); ?>
            </p>
        </div>
        <div class="col-sm-3">
            <p>1</p>
        </div>
        <div class="col-sm-3">
            <p><?php echo $this->session->userdata('delivery_price'); ?></p>
        </div>
        <div class="col-sm-2">
            <p><?php echo $this->session->userdata('delivery_price'); ?></p>
        </div>
    </div>
    <a href="<?php echo base_url('ShippingOptions?id=2'); ?>" class="btn btn-default">
        <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Spat
    </a>
    <a style="float: right" href="<?php echo base_url('CompleteOrder?id=4'); ?>" class="btn btn-success">Dalej
        <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
    </a>
</div>
