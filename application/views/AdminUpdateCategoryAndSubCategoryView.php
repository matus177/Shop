<div class="col-md-9">
    <?php $this->load->view('FlashMessagesView'); ?>
</div>
<div class="col-sm-4">
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="panel-title">Presunutie podkategorie do inej kategorie</div>
        </div>
        <div class="panel-body">
            <?php echo form_open('Admin/updateSubCategory',
                ['id' => 'form_category', 'class' => 'form-horizontal', 'role' => 'form']); ?>
            <div class="form-group">
                <label for="subcategory_id" class="control-label col-sm-4">Podkategoria</label>
                <div class="col-sm-8">
                    <select class="form-control" name="subcategory_id" id="subcategory_id_0" required>
                        <option selected disabled>Vyberte podkategoriu</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="category_id" class="control-label col-sm-4">Presunut do kategorie</label>
                <div class="col-sm-8">
                    <select class="form-control" name="category_id" id="category_id_0" required>
                        <option selected disabled>Vyberte kategoriu</option>
                    </select>
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
<div class="col-sm-4">
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="panel-title">Premenovanie kategorie</div>
        </div>
        <div class="panel-body">
            <?php echo form_open('Admin/updateCategory',
                ['id' => 'form_category', 'class' => 'form-horizontal', 'role' => 'form']); ?>
            <div class="form-group">
                <label for="category_id" class="control-label col-sm-4">Kategoria</label>
                <div class="col-sm-8">
                    <select class="form-control" name="category_id" id="category_id_1" required>
                        <option selected disabled>Vyberte kategoriu</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="category_name" class="control-label col-sm-4">Novy nazov</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="category_name" id="category_name"
                           placeholder="Novy nazov kategorie" required>
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
<div class="col-sm-4 col-sm-offset-3">
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="panel-title">Premenovanie podkategorie</div>
        </div>
        <div class="panel-body">
            <?php echo form_open('Admin/updateSubCategory',
                ['id' => 'form_category', 'class' => 'form-horizontal', 'role' => 'form']); ?>
            <div class="form-group">
                <label for="subcategory_id" class="control-label col-sm-4">Podkategoria</label>
                <div class="col-sm-8">
                    <select class="form-control" name="subcategory_id" id="subcategory_id_2" required>
                        <option selected disabled>Vyberte podkategoriu</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="subcategory_name" class="control-label col-sm-4">Novy nazov</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="subcategory_name" id="subcategory_name"
                           placeholder="Novy nazov podkategorie" required>
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
<script>
    getSubcategoryForAdminUpdate(<?php echo $isAdmin ? 1 : 0; ?>, 3);
</script>