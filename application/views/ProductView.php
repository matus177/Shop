<div class="col-md-9">
    <?php $this->load->view('FlashMessagesView'); ?>
    <div class="col-md-12">
        <?php if ($searchTerm)
        { ?>
            <h3>Vysledky hladania:
                <a href="<?php echo base_url('Product/index/') . $subCategoryId; ?>" style="cursor: pointer; color: red"
                   class="glyphicon glyphicon-remove" aria-hidden="true"></a>
            </h3>
        <?php } ?>
        Len skladom <input type="checkbox" id="stock_sort" name="stock_only" onclick="sortProductByStock()">
        <div class="col-md-3" style="float: right">
            <?php echo form_open('Product/index/' . $subCategoryId,
                ['id' => 'form_search', 'class' => 'form-horizontal', 'role' => 'form']); ?>
            <div class="input-group">
                <input type="hidden" name="subcategory_id"
                       value="<?php echo $subCategoryId ?>"/>
                <input type="text" class="form-control" name="product_description"
                       placeholder="Hladat velkost RAM, CPU...">
                <span class="input-group-btn"><button class="btn btn-default" type="submit"><span
                                class="glyphicon glyphicon-search"></span></button></span>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <ul class="nav nav-tabs">
        <li class="favorite_sort" onclick="sortProductByFavorite()"><a data-toggle="tab" href="#">Najpredavanejsie</a>
        </li>
        <li class="lowest_price" onclick="sortProductByLowestPrice();"><a
                    href="<?php echo base_url('Product/index/') . $subCategoryId . '/' . $resultPerPage . '/ASC?page=1'; ?>">Najlacnejsie</a>
        </li>
        <li class="highest_price" onclick="sortProductByHighestPrice();"><a
                    href="<?php echo base_url('Product/index/') . $subCategoryId . '/' . $resultPerPage . '/DESC?page=1'; ?>">Najdrahsie</a>
        </li>
    </ul>
    <br>
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
                            <form class="form-horizontal" action="Admin/updateProduct" method="post"
                                  enctype="multipart/form-data">
                                <input type="hidden" name="id" id="id" required>
                                <div class="form-group">
                                    <label for="subcategory" class="control-label col-sm-4">Zmenit podkategoriu</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="subcategory" id="subcategory"
                                                required></select>
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
                                        <input type="file" class="form-control" class="btn" name="product_image">
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
</div>
<script>
    $(document).ready(function () {
        var counter = 0;
        $.ajax({
            url: window.location.origin + '/Shop/Product/a',
            type: 'GET',
            data: {subcategory_id: <?php echo $subCategoryId; ?>},
            success: function (response) {
                var html = '';
                $.each(JSON.parse(response), function (i, product) {
                    var productId = product.id;
                    var productDescription = product.product_description;
                    var productImage = product.product_image;
                    var productName = product.product_name;
                    var productPrice = product.product_price;
                    var productPriceDph = product.product_price_dph;
                    var subcategoryId = product.product_subcategory_id;
                    var productQuantity = product.product_quantity;
                    var productAvailabe;
                    var editButton;

                    if (<?php echo $isAdmin ?>) {
                        editButton = '<button type="button" class="btn btn-warning" onclick="abc(' + productId + ')">Upravit</button>';
                    } else {
                        editButton = '';
                    }

                    if (productQuantity == 0) {
                        productAvailabe = '<p style="text-align: center"><span style="color:orange"><b>Na objednavku.</b></span></p>'
                    } else {
                        productAvailabe = '<p style="text-align: center"><span style="color:green"><b>Na sklade ' + productQuantity + 'ks.</b></span></p>'
                    }

                    if (counter == 0) {
                        html += '<div class="row">';
                    }
                    if (counter % 4 == 0 && counter != 0) {
                        html += '</div><div class="row">';
                    }
                    html += '<div class="col-md-3">';
                    html += '<div class="col-md-12"><a href="#"><img src="' + window.location.origin + '/Shop/assets/img/' + productImage + '"></a></div> ';
                    html += '<div class="col-md-12"><h5>' + productName + '</h5></div> ';
                    html += '<div class="col-md-12"><p>' + productDescription + '</p></div> ';
                    html += '<div class="col-md-12">' + productAvailabe + '</div> ';
                    html += '<div class="col-md-12"><button type="button" class="btn btn-success">Kupit</button> ' + editButton + '</div> ';
                    html += '<div class="col-md-12"><p style="text-align: center">Cena bez DPH ' + (productPrice - productPriceDph).toFixed(2) + ' &euro;</p></div> ';
                    html += '<div class="col-md-12"><p style="text-align: center">Cena s DPH ' + productPrice + ' &euro;</p></div> ';
                    html += '</div>';
                    ++counter;
                });
                $('#products').append(html);
            }
        });
    });

    function abc(productId) {
        $(document).ready(function () {
            $.ajax({
                url: window.location.origin + '/Shop/Product/modal',
                type: 'GET',
                data: {modalData: productId},
                success: function (response) {
                    $('.modal-body').append(response);
                    getSubcategoryForAdminUpdate(<?php echo 1; ?>, <?php echo 2; ?>);
                }
            });
        });
    }
    addRatingStarsToEachProduct(<?php echo 0; ?>);
    loadSortOptions();
    productsPaggination(<?php echo 0; ?>);
</script>