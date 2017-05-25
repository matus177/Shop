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
        Len skladom <input type="checkbox" id="stock_sort" name="stock_only">
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
        <li class="lowest_price active"><a href="#">Najlacnejsie</a></li>
        <li class="highest_price"><a href="#">Najdrahsie</a></li>
    </ul>
    <br>
    <div class="col-md-12">
        <div class="row">
            Produkty na stranku
            <div class="col-md-1" style="min-width: 100px">
                <select class="form-control results_per_page">
                    <option>2</option>
                    <option>3</option>
                    <option selected>5</option>
                    <option>10</option>
                    <option>20</option>
                    <option>50</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" id="products"></div>
            <ul class="pagination pagination-sm"></ul>
        </div>
    </div>
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
                                    <label for="prod_category_id" class="control-label col-sm-4">Kategoria</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="prod_category_id"
                                                onchange="getSubCategoryDropdowns(<?php echo $isAdmin; ?>, this.value)"
                                                id="prod_category_id" required>
                                            <option selected disabled>Vyberte kategoriu</option>
                                        </select>
                                    </div>
                                </div>
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
</div>
<script>
    sortProduct(<?php echo $subCategoryId; ?>, <?php echo $isAdmin; ?>);
    paggination('products',<?php echo $subCategoryId; ?>, <?php echo $isAdmin; ?>);
</script>