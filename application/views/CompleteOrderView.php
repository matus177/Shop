<div class="col-md-9">
    <?php $this->load->view('FlashMessagesView'); ?>
    <div class="complete_main">
        <h3>5. Dokoncenie</h3>
        <hr>
        <h4>Dakujeme za objednavku</h4>
        <h4>Vasa objednavka bola uspesne prijata</h4>
        <p>Na email: <b><?php echo $userEmail ?></b> bola odoslana elektronicka faktura.</p>
        <a style="float: right" href="<?php echo base_url('Home'); ?>" class="btn btn-success">Dokoncit
            objednavku
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
        </a>
    </div>
</div>
