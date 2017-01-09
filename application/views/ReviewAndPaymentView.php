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

    <a href="<?php echo base_url('ShippingOptions?id=2'); ?>" class="btn btn-default">
        <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Spat
    </a>
    <a style="float: right" href="<?php echo base_url('CompleteOrder?id=4'); ?>" class="btn btn-success">Dalej
        <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
    </a>
</div>
