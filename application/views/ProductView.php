<div class="col-md-9">
    <?php $this->load->view('FlashMessagesView'); ?>
    <div class="col-md-12 form-group">
        <?php if ($searchTerm)
        { ?>
            <h3>Vysledky hladania pre: <i><?php echo $searchTerm; ?></i> <a
                        href="<?php echo base_url('Product/index/') . $subCategoryId; ?>"
                        style="cursor: pointer; color: red" class="glyphicon glyphicon-remove" aria-hidden="true"></a>
            </h3>
        <?php } ?>
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
        Cena: <span class="glyphicon glyphicon-arrow-down" style="cursor: pointer"
                    onclick="sortProductByLowestPrice()"></span><span class="glyphicon glyphicon-arrow-up"
                                                                      style="cursor: pointer"
                                                                      onclick="sortProductByHighestPrice()"></span><br>
        Len skladom <input type="checkbox" id="stock_sort" name="stock_only" onclick="sortProductByStock()">
    </div>
    <?php
    $con = mysqli_connect('localhost', 'root', '');
    mysqli_select_db($con, 'test');
    $resultPerPage = 3;
    $sql = "SELECT * FROM products WHERE subcategory_id = " . $subCategoryId;
    $result = mysqli_query($con, $sql);
    $numberOfProducts = mysqli_num_rows($result);
    $numberOfPages = ceil($numberOfProducts / $resultPerPage);

    if ( ! isset($_GET['page']))
    {
        $page = 1;
    } else
    {
        $page = $_GET['page'];
    }

    $pageFirstResult = ($page - 1) * $resultPerPage;
    $sql = "SELECT * FROM products WHERE subcategory_id = " . $subCategoryId . " LIMIT " . $pageFirstResult . "," . $resultPerPage;
    $result = mysqli_query($con, $sql);
    $i = 0;
    ?>
    <ul class="list-unstyled" id="products" data-role="list">
        <?php
        while ($product = mysqli_fetch_array($result))
        {
            ?>
            <li data-sort="<?php echo $product['product_price'] ?>" class="col-md-3">
                <div class="thumbnail">
                    <a href="product_details.html"><img
                                src="<?php echo base_url('assets/img/') . $product['product_image']; ?>"/></a>
                    <div class="caption" style="height: 300px; overflow: hidden">
                        <h5><?php echo $product['product_name']; ?></h5>
                        <p><?php echo $product['product_description']; ?></p>
                    </div>
                    <div class="product_footer caption">
                        <?php if ($product['product_quantity'] == 0)
                        { ?>
                            <p style="text-align: center"><span style="color:orange"><b>Na objednavku.</b></span></p>
                        <?php } else
                        { ?>
                            <p style="text-align: center">
                                <span style="color:green">
                                    <b>Na sklade <?php echo $product['product_quantity'] ?> ks.</b>
                                </span>
                            </p>
                        <?php } ?>
                        <h3><a type="button" id="<?php echo $product['id'] ?>"
                               class="btn btn-success buy_button">Kupit</a>
                            <?php if ($this->encryption->decrypt($this->session->role) == 'Admin')
                            { ?>
                                <button href="" type="button" id="<?php echo $product['id'] ?>" class="btn btn-warning"
                                        data-toggle="modal" data-target="#modal_<?php echo $i; ?>">Upravit
                                </button>
                            <?php } ?>
                            <span class="pull-right"><?php echo $product['product_price']; ?> &euro;</span></h3>
                        <div class="modal fade" id="modal_<?php echo $i ?>" data-backdrop="static"
                             data-keyboard="false">
                            <div class="modal-dialog">
                                <div class="modal-body"><?php $this->load->view('AdminProductUpdateView', array('product' => $product,
                                        'id' => $product['id'])) ?>
                                </div>
                            </div>
                        </div>
                        <p style="text-align: center">Cena bez
                            DPH <?php echo $product['product_price'] - $product['product_price_dph']; ?> &euro;</p>
                    </div>
                </div>
            </li>
            <?php $i++; ?>
            <?php
        }
        ?>
    </ul>
    <?php
    for ($i = 1; $i <= $numberOfPages; $i++)
    {
        ?><a
        href="<?php echo base_url('Product/index/') . $subCategoryId . '?page=' . $i; ?>"><?php echo $i . ' '; ?></a><?php
    }
    ?>
</div>
<script>
    getSubcategoryForAdminUpdate(<?php echo $isAdmin; ?>, <?php echo $numberOfProducts; ?>);
</script>