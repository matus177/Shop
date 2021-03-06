<div class="col-md-9">
    <?php $this->load->view('FlashMessagesView'); ?>
    <div class="review_main">
        <div class="review_order">
            <h3>4. Suhrn</h3>
            <hr>
            <?php echo form_open('ReviewAndPayment/createAndSendFacture', ['id' => 'reviewAndPayment_form']); ?>
            <div class="col-sm-4">
                <h4>Fakturačné údaje</h4>
                <div class="panel panel-info">
                    <div class="panel-body form-horizontal">
                        <p><b>Meno a
                                priezvisko:</b> <?php echo $this->encryption->decrypt($userData['fact_name']) . ' ' . $this->encryption->decrypt($userData['fact_surname']) ?>
                        </p>
                        <p><b>Ulica:</b> <?php echo $userData['fact_street'] ?></p>
                        <p><b>PSC a obec:</b> <?php echo $userData['fact_zip'] . ' ' . $userData['fact_city'] ?></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <h4>Dodacie údaje</h4>
                <div class="panel panel-info">
                    <div class="panel-body form-horizontal">
                        <p><b>Meno a
                                priezvisko:</b> <?php if (strlen($this->encryption->decrypt($userData['deliv_name']) . ' ' . $this->encryption->decrypt($userData['deliv_surname'])) > 1)
                            {
                                echo $this->encryption->decrypt($userData['deliv_name']) . ' ' . $this->encryption->decrypt($userData['deliv_surname']);
                            } else
                            {
                                echo $this->encryption->decrypt($userData['fact_name']) . ' ' . $this->encryption->decrypt($userData['fact_surname']);
                            } ?></p>
                        <p><b>Ulica: </b><?php if (strlen($userData['deliv_street']) > 0)
                            {
                                echo $userData['deliv_street'];
                            } else
                            {
                                echo $userData['fact_street'];
                            } ?></p>
                        <p><b>PSC a
                                obec:</b> <?php if (strlen($userData['deliv_zip'] . ' ' . $userData['deliv_city']) > 1)
                            {
                                echo $userData['deliv_zip'] . ' ' . $userData['deliv_city'];
                            } else
                            {
                                echo $userData['fact_zip'] . ' ' . $userData['fact_city'];
                            } ?></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <h4>Kontakty</h4>
                <div class="panel panel-info">
                    <div class="panel-body form-horizontal">
                        <p><b>Email:</b> <?php echo $userData['email'] ?></p>
                        <p><b>Telefón:</b> <?php echo $userData['fact_phone'] ?></p>
                    </div>
                </div>
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
                <div class="col-sm-4 <?php echo $productData[$i]->product_image; ?>" onmouseover="showBigImg()"
                     onmouseout="hideBigImg()">
                    <p class="<?php echo $productData[$i]->product_image; ?>"><img
                                class="<?php echo $productData[$i]->product_image; ?>"
                                src="<?php echo base_url('assets/img/') . $productData[$i]->product_image; ?>"
                                width="20" height="18"/> <?php echo $items['name']; ?></p>
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
            <div class="img_show">
                <p></p>
            </div>
            <hr class="col-lg-12">
            <div class="col-sm-3 col-sm-offset-7">
                <p>Celkom bez DPH</p>
            </div>
            <div class="col-sm-2">
                <p><?php echo round(($this->session->userdata('delivery_price') + $this->cart->total()) - (($this->session->userdata('delivery_price') + $this->cart->total()) / $shippingPrice->dph),
                        2); ?></p>
            </div>
            <div class="col-sm-3 col-sm-offset-7">
                <p>DPH (20%)</p>
            </div>
            <div class="col-sm-2">
                <p><?php echo round(($this->session->userdata('delivery_price') + $this->cart->total()) / $shippingPrice->dph,
                        2); ?></p>
            </div>
            <div class="col-sm-3 col-sm-offset-7">
                <p><b>K úhrade</b></p>
            </div>
            <div class="col-sm-2">
                <p style="color: green; font-size: larger">
                    <b><?php echo $this->session->userdata('delivery_price') + $this->cart->total(); ?>&euro;</b></p>
            </div>
        </div>
    </div>
    <div class="col-sm-5 col-sm-offset-7">
        <h6>Stlačením „Objednať“ súhlasíte s <a href="#">obchodnými podmienkami</a>.</h6>
    </div>
    <a style="float: left" href="<?php echo base_url('ShippingOptions?id=2'); ?>" class="btn btn-default">
        <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Spat
    </a>
    <button style="float: right" type="submit" class="btn btn-success">Objednať <span
                class="glyphicon glyphicon-arrow-right"
                aria-hidden="true"></span>
    </button>
    <?php echo form_close(); ?>

</div>