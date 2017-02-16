<div class="col-md-9">
    <?php $this->load->view('FlashMessagesView'); ?>
    <div class="col-md-12 form-group">
        <?php if ($searchTerm)
        { ?>
            <h3>Vysledky hladania:
                <a href="<?php echo base_url('Product/index/') . $subCategoryId; ?>" style="cursor: pointer; color: red"
                   class="glyphicon glyphicon-remove" aria-hidden="true"></a>
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
    if ($searchTerm)
    {
        $like = implode(' OR ', $searchTerm);
        $sql = "SELECT * FROM products WHERE subcategory_id = " . $subCategoryId . " AND " . $like . " LIMIT " . $pageFirstResult . ", " . $resultPerPage;
    } else
    {
        $sql = "SELECT * FROM products WHERE subcategory_id = " . $subCategoryId . " LIMIT " . $pageFirstResult . ", " . $resultPerPage;
    }

    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) != 0)
    {
        $productCount = 0;
        ?>
        <div class="col-md-12" style="padding-left: 0">
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
                                    <p style="text-align: center"><span
                                                style="color:orange"><b>Na objednavku.</b></span>
                                    </p>
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
                                        <button href="" type="button" id="<?php echo $product['id'] ?>"
                                                class="btn btn-warning"
                                                data-toggle="modal" data-target="#modal_<?php echo $productCount; ?>">
                                            Upravit
                                        </button>
                                    <?php } ?>
                                    <span class="pull-right"><?php echo $product['product_price']; ?> &euro;</span></h3>
                                <div class="modal fade" id="modal_<?php echo $productCount ?>" data-backdrop="static"
                                     data-keyboard="false">
                                    <div class="modal-dialog">
                                        <div class="modal-body"><?php $this->load->view('AdminProductUpdateView', array('product' => $product, 'productCount' => $productCount,
                                                'id' => $product['id'])) ?>
                                        </div>
                                    </div>
                                </div>
                                <p style="text-align: center">Cena bez
                                    DPH <?php echo $product['product_price'] - $product['product_price_dph']; ?> &euro;</p>
                            </div>
                        </div>
                    </li>
                    <?php $productCount++; ?>
                    <?php
                }
                ?>
            </ul>
        </div>
        <div class="col-md-1">
            <select class="form-control" onchange="productPerPage(<?php echo $subCategoryId; ?>, this.value)">
                <option selected="selected" hidden><?php echo $resultPerPage; ?></option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>10</option>
                <option>20</option>
                <option>50</option>
            </select>
        </div>
        Produkty na stranku
        <div class="products_pagination">
            <a id="previous_page">&slarr;</a>
            <?php
            for ($i = 1; $i <= $numberOfPages; $i++)
            {
                ?>
                <a id="<?php echo $i; ?>"
                   href="<?php echo base_url('Product/index/') . $subCategoryId . '/' . $resultPerPage . '?page=' . $i; ?>"><?php echo $i . ' '; ?></a>
                <?php
            }
            ?>
            <a id="next_page">&rarr;</a>
        </div>
    <?php } else
    { ?>
        <h3 class="col-md-12">Nenasli sa ziadne produkty.</h3>
    <?php } ?>
</div>
<script>
    productsPaggination(<?php echo $numberOfPages; ?>);
    getSubcategoryForAdminUpdate(<?php echo $isAdmin ? 1 : 0; ?>, <?php echo $numberOfProducts; ?>);
</script>