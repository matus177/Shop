<div class="col-md-9">
    <?php $this->load->view('FlashMessagesView'); ?>
    <style>
        .carousel-inner > .item > img,
        .carousel-inner > .item > a > img {
            margin: auto;
        }

        #myCarousel {
            margin-bottom: 20px;
        }
    </style>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="<?php echo base_url('assets/img/pc-optimazation.jpg'); ?>" alt="Chania" width="1000"
                     height="500">
            </div>
            <div class="item">
                <img src="<?php echo base_url('assets/img/slider.jpg'); ?>" alt="Chania" width="1000"
                     height="500">
            </div>
        </div>
    </div>
    <div class="col-md-12" id="products"></div>
    <div class="modal fade" id="modal" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-body">
                <div id="admin_product_update" class="mainbox col-md-9">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="panel-title">Aktualizovat produkt</div>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" id="modal_product" method="POST"
                                  enctype="multipart/form-data">
                                <input type="hidden" name="id" id="id" required>
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                                       value="<?php echo $this->security->get_csrf_hash(); ?>">
                                <div class="form-group">
                                    <label for="subcategory_id" class="control-label col-sm-4">Zmenit
                                        podkategoriu</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="subcategory_id" id="subcategory_id"
                                        ></select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="product_name" class="control-label col-sm-4">Nazov</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="product_name" id="product_name"
                                               placeholder="Nazov produktu" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="product_description" class="control-label col-sm-4">Popis</label>
                                    <div class="col-sm-8">
                                        <textarea rows="6" class="form-control" name="product_description"
                                                  id="product_description" placeholder="Popis produktu"
                                                  required></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="product_price" class="control-label col-sm-4">Cena</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="product_price" id="product_price"
                                               placeholder="Cena produktu" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="product_quantity" class="control-label col-sm-4">Kusy</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="product_quantity"
                                               id="product_quantity" placeholder="Pocet kusov" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="product_image" class="control-label col-sm-4">Foto</label>
                                    <div class="col-sm-8">
                                        <input type="file" class="form-control" name="product_image">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12 controls">
                                        <button type="submit" class="btn btn-success">Potvrdit</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Zatvorit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="products_pagination"></div>
</div>
<script>
    paggination(<?php echo 0; ?>, <?php echo 1; ?>);
</script>