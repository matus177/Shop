<div class="col-md-9">
    <?php $this->load->view('FlashMessagesView'); ?>
    <div class="col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">Vytvorenie novej kategorie</div>
            </div>
            <div class="panel-body">
                <?php echo form_open('Admin/createNewCategory',
                    ['id' => 'form_category', 'class' => 'form-horizontal', 'role' => 'form']); ?>
                <div class="form-group">
                    <label for="category_name" class="control-label col-sm-4">Nova kategoria</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="category_name" id="category_name"
                               placeholder="Nazov kategorie" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-success pull-right">Potvrdit</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">Vytvorenie novej podkategorie</div>
            </div>
            <div class="panel-body">
                <?php echo form_open('Admin/createNewSubCategory',
                    ['id' => 'form_subcategory', 'class' => 'form-horizontal', 'role' => 'form']); ?>
                <div class="form-group">
                    <label for="category_id" class="control-label col-sm-4">Kategoria</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="category_id" id="category_id" required>
                            <option selected disabled>Vyberte kategoriu</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="subcategory_name" class="control-label col-sm-4">Nova podkategoria</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="subcategory_name" id="subcategory_name"
                               placeholder="Nazov podkategorie" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="control-label">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success pull-right">Potvrdit</button>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">Vytvorenie noveho produktu</div>
            </div>
            <div class="panel-body">
                <?php echo form_open_multipart('Admin/createNewProduct',
                    ['id' => 'form_product', 'class' => 'form-horizontal', 'role' => 'form']); ?>
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
                    <label for="subcategory_id" class="control-label col-sm-4">Podkategoria</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="subcategory_id" id="subcategory_id" required>
                            <option selected disabled>Vyberte podkategoriu</option>
                        </select>
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
                    <textarea class="form-control" rows="6" name="product_description" id="product_description"
                              placeholder="Popis produktu" required></textarea>
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
                        <input type="text" class="form-control" name="product_quantity" id="product_quantity"
                               placeholder="Pocet kusov" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="product_image" class="control-label col-sm-4">Foto</label>
                    <div class="col-sm-8">
                        <input type="file" class="form-control" name="product_image">
                    </div>
                </div>
                <div class="form-group">
                    <div class="control-label">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success pull-right">Potvrdit</button>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<script>
    getCategoryDropdowns(<?php echo $isAdmin; ?>);
</script>