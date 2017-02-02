<div class="container">
    <div id="admin_product_update" class="mainbox col-md-9">
        <?php for ($i = 0; $i < sizeof($product); $i++)
        {
            if ($product[$i]->id == $id)
            { ?>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <div class="panel-title">Aktualizovat produkt</div>
                    </div>
                    <div class="panel-body">
                        <div class="panel-body">
                            <?php echo form_open_multipart('Admin/updateProduct/' . $product[$i]->id,
                                ['id' => 'form_product_update', 'class' => 'form-horizontal', 'role' => 'form']); ?>
                            <div class="form-group">
                                <label for="product_name" class="control-label col-sm-4">Nazov</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="product_name" id="product_name"
                                           placeholder="Nazov produktu"
                                           value="<?php echo $product[$i]->product_name; ?>"
                                           required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_description" class="control-label col-sm-4">Popis</label>
                                <div class="col-sm-8">
                            <textarea rows="6" class="form-control" name="product_description" id="product_description"
                                      placeholder="Popis produktu"
                                      required><?php echo $product[$i]->product_description; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_price" class="control-label col-sm-4">Cena</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="product_price" id="product_price"
                                           placeholder="Cena produktu"
                                           value="<?php echo $product[$i]->product_price; ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_quantity" class="control-label col-sm-4">Kusy</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="product_quantity"
                                           id="product_quantity"
                                           placeholder="Pocet kusov"
                                           value="<?php echo $product[$i]->product_quantity; ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_image" class="control-label col-sm-4">Foto</label>
                                <div class="col-sm-8">
                                    <input type="file" class="btn" name="product_image">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12 controls">
                                <button type="submit" class="btn btn-success">Potvrdit</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Zatvorit</button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            <?php }
        } ?>
    </div>
</div>