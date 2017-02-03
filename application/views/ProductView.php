<div class="col-md-9">
    <?php $this->load->view('FlashMessagesView'); ?>
    <ul class="list-unstyled" id="products" data-role="list">
        <?php $i = 0; ?>
        <?php foreach ($product as $value): ?>
            <li class="span3 col-md-3">
                <div class="thumbnail">
                    <a href="product_details.html"><img
                                src="<?php echo base_url('assets/img/') . $value->product_image; ?>"/></a>
                    <div class="caption" style="height: 300px; overflow: hidden">
                        <h5><?php echo $value->product_name; ?></h5>
                        <p><?php echo $value->product_description; ?></p>
                    </div>
                    <div class="product_footer caption">
                        <?php if ($value->product_quantity == 0)
                        { ?>
                            <p style="text-align: center"><span style="color:orange"><b>Na objednavku.</b></span></p>
                        <?php } else
                        { ?>
                            <p style="text-align: center">
                                <span style="color:green">
                                    <b>Na sklade <?php echo $value->product_quantity ?> ks.</b>
                                </span>
                            </p>
                        <?php } ?>
                        <h3><a type="button" id="<?php echo $value->id ?>" class="btn btn-success buy_button">Kupit</a>
                            <?php if ($this->encryption->decrypt($this->session->role) == 'Admin')
                            { ?>
                                <button href="" type="button" id="<?php echo $value->id ?>" class="btn btn-warning"
                                        data-toggle="modal" data-target="#modal_<?php echo $i; ?>">Upravit
                                </button>
                            <?php } ?>
                            <span class="pull-right"><?php echo $value->product_price; ?> &euro;</span></h3>
                        <div class="modal fade" id="modal_<?php echo $i ?>" data-backdrop="static"
                             data-keyboard="false">
                            <div class="modal-dialog">
                                <div class="modal-body"><?php $this->load->view('AdminProductUpdateView', array('product' => $product,
                                        'id' => $value->id)) ?>
                                </div>
                            </div>
                        </div>
                        <p style="text-align: center">Cena bez
                            DPH <?php echo $value->product_price - $value->product_price_dph; ?> &euro;</p>
                    </div>
                </div>
            </li>
            <?php $i++; ?>
        <?php endforeach; ?>
    </ul>
</div>
<script>
    getSubcategoryForAdminUpdate(<?php echo $isAdmin; ?>, <?php echo sizeof($product); ?>);
</script>