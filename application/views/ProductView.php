﻿<div class="col-md-9">
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
    <!--    --><?php
    //    $con = mysqli_connect('localhost', 'root', '');
    //    mysqli_select_db($con, 'test');
    //    $con->query("SET NAMES 'utf8'");
    //    $con->query("SET CHARACTER SET utf8");
    //    $con->query("SET SESSION collation_connection = 'utf8_unicode_ci'");
    //    $sql = "SELECT * FROM products WHERE subcategory_id = " . $subCategoryId . " ORDER BY product_price " . $sort;
    //    $result = mysqli_query($con, $sql);
    //    $numberOfProducts = mysqli_num_rows($result);
    //    $numberOfPages = ceil($numberOfProducts / $resultPerPage);
    //    if ( ! isset($_GET['page']))
    //    {
    //        $page = 1;
    //    } else
    //    {
    //        $page = $_GET['page'];
    //    }
    //
    //    $pageFirstResult = ($page - 1) * $resultPerPage;
    //    if ($searchTerm)
    //    {
    //        $like = implode(' OR ', $searchTerm);
    //        $sql = "SELECT * FROM products WHERE subcategory_id = " . $subCategoryId . " AND " . $like . " ORDER BY product_price " . $sort . " LIMIT " . $pageFirstResult . ", " . $resultPerPage;
    //    } else
    //    {
    //        $sql = "SELECT * FROM products WHERE subcategory_id = " . $subCategoryId . " ORDER BY product_price " . $sort . " LIMIT " . $pageFirstResult . ", " . $resultPerPage;
    //    }
    //
    //    $result = mysqli_query($con, $sql);
    //    $productCount = 0;
    //    if (mysqli_num_rows($result) != 0)
    //    {
    //        ?>
    <!--        <div class="col-md-12" style="padding-left: 0">-->
    <!--            <ul class="list-unstyled" id="products" data-role="list">-->
    <!--                --><?php
    //                while ($product = mysqli_fetch_array($result))
    //                {
    //                    ?>
    <!--                    <li data-sort="--><?php //echo $product['product_price'] ?><!--" class="col-md-3">-->
    <!--                        <div class="thumbnail">-->
    <!--                            <a href="product_details.html"><img-->
    <!--                                        src="-->
    <?php //echo base_url('assets/img/') . $product['product_image']; ?><!--"/></a>-->
    <!--                            <div class="caption" style="height: 300px; overflow: hidden">-->
    <!--                                <h5>--><?php //echo $product['product_name']; ?><!--</h5>-->
    <!--                                <p>--><?php //echo $product['product_description']; ?><!--</p>-->
    <!--                            </div>-->
    <!--                            <div class="product_footer caption">-->
    <!--                                <div class="--><?php //echo 'rating' . $productCount; ?><!--" id="-->
    <?php //echo $product['id']; ?><!--"-->
    <!--                                     style="text-align: center">-->
    <!--                                </div>-->
    <!--                                --><?php //if ($product['product_quantity'] == 0)
    //                                { ?>
    <!--                                    <p style="text-align: center"><span-->
    <!--                                                style="color:orange"><b>Na objednavku.</b></span>-->
    <!--                                    </p>-->
    <!--                                --><?php //} else
    //                                { ?>
    <!--                                    <p style="text-align: center">-->
    <!--                                <span style="color:green">-->
    <!--                                    <b>Na sklade --><?php //echo $product['product_quantity'] ?><!-- ks.</b>-->
    <!--                                </span>-->
    <!--                                    </p>-->
    <!--                                --><?php //} ?>
    <!--                                <h3><a type="button" id="--><?php //echo $product['id'] ?><!--"-->
    <!--                                       class="btn btn-success buy_button">Kupit</a>-->
    <!--                                    --><?php //if ($this->encryption->decrypt($this->session->role) == 'Admin')
    //                                    { ?>
    <!--                                        <button href="" type="button" id="-->
    <?php //echo $product['id'] ?><!--"-->
    <!--                                                class="btn btn-warning"-->
    <!--                                                data-toggle="modal" data-target="#modal_-->
    <?php //echo $productCount; ?><!--">-->
    <!--                                            Upravit-->
    <!--                                        </button>-->
    <!--                                    --><?php //} ?>
    <!--                                    <span class="pull-right">-->
    <?php //echo $product['product_price']; ?><!-- &euro;</span></h3>-->
    <!--                                <div class="modal fade" id="modal_-->
    <?php //echo $productCount ?><!--" data-backdrop="static"-->
    <!--                                     data-keyboard="false">-->
    <!--                                    <div class="modal-dialog">-->
    <!--                                        <div class="modal-body">--><?php //$this->load->view('AdminProductUpdateView', array('product' => $product, 'productCount' => $productCount,
    //                                                'id' => $product['id'])) ?>
    <!--                                        </div>-->
    <!--                                    </div>-->
    <!--                                </div>-->
    <!--                                <p style="text-align: center">Cena bez-->
    <!--                                    DPH -->
    <?php //echo $product['product_price'] - $product['product_price_dph']; ?><!-- &euro;</p>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </li>-->
    <!--                    --><?php //$productCount++; ?>
    <!--                    --><?php
    //                }
    //                ?>
    <!--            </ul>-->
    <!--        </div>-->
    <!--        <div class="pagination">-->
    <!--            asdasd-->
    <!--        </div>-->
    <!--        <div class="col-md-1">-->
    <!--            <select class="form-control" onchange="productPerPage(--><?php //echo $subCategoryId; ?>, <!--this.value)">
//     <!--           <option selected="selected" hidden><?php //echo $resultPerPage; ?><!--</option>-->
    <!--                <option>1</option>-->
    <!--                <option>2</option>-->
    <!--                <option>3</option>-->
    <!--                <option>10</option>-->
    <!--                <option>20</option>-->
    <!--                <option>50</option>-->
    <!--            </select>-->
    <!--        </div>-->
    <!--        Produkty na stranku-->
    <!--        <div class="products_pagination">-->
    <!--            <a id="previous_page">&slarr;</a>-->
    <!--            --><?php
    //            for ($i = 1; $i <= $numberOfPages; $i++)
    //            {
    //                ?>
    <!--                <a id="--><?php //echo $i; ?><!--"-->
    <!--                   href="-->
    <?php //echo base_url('Product/index/') . $subCategoryId . '/' . $resultPerPage . '/' . $sort . '?page=' . $i; ?><!--">-->
    <?php //echo $i . ' '; ?><!--</a>-->
    <!--                --><?php
    //            }
    //            ?>
    <!--            <a id="next_page">&rarr;</a>-->
    <!--        </div>-->
    <!--    --><?php //} else
    //    { ?>
    <!--        <h3 class="col-md-12">Nenasli sa ziadne produkty.</h3>-->
    <!--    --><?php //} ?>

    <div class="col-md-12" style="padding-left: 0">
        <ul class="list-unstyled" id="products" data-role="list">
        </ul>
    </div>
</div>
<script>

    $(document).ready(function () {
        var counter = 1;
        $.ajax({
            url: window.location.origin + '/Shop/Product/a',
            type: 'GET',
            data: {subcategory_id: <?php echo $subCategoryId; ?>},
            success: function (response) {
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
                    var modalWindow;

                    if (<?php echo $isAdmin ?>) {
                        editButton = '<button href="" type="button" id="' + productId + '"  class="btn btn-warning" data-toggle="modal" data-target="#modal_' + counter + '" style="margin-left: 5px">Upravit</button>';

                    } else {
                        editButton = '';
                        modalWindow = '';
                    }

                    if (productQuantity == 0) {
                        productAvailabe = '<p style="text-align: center"><span style="color:orange"><b>Na objednavku.</b></span></p>'
                    } else {
                        productAvailabe = '<p style="text-align: center"><span style="color:green"><b>Na sklade ' + productQuantity + 'ks.</b></span></p>'
                    }

                    $("#products").append('<li data-sort="' + productPrice + '" class="col-md-3"><div class="thumbnail"><a href="product_details.html"><img src="' + window.location.origin + '/Shop/assets/img/' + productImage + '"></a>' +
                        '<div class="caption" style="height: 300px; overflow: hidden"><h5>' + productName + '</h5><p>' + productDescription + '</p></div><div class="product_footer caption">' + productAvailabe +
                        '<h3><a type="button" id="' + productId + '" class="btn btn-success buy_button">Kupit</a>' + editButton + '<span class="pull-right">' + productPrice + ' &euro;</span></h3><div class="modal fade" id="modal_' + counter + '" data-backdrop="static" data-keyboard="false"><div class="modal-dialog"><div class="modal-body"></div></div></div><p style="text-align: center">Cena bez DPH ' + (productPrice - productPriceDph).toFixed(2) + ' &euro;</p></div></div></li>');
                    counter++;
                });
            }
        });
    });

    function abc(data) {
        $(document).ready(function () {
            $.ajax({
                url: window.location.origin + '/Shop/Product/modal',
                type: 'GET',
                success: function (response) {
                   // $('#modal_' +data).modal('show');

                }
            });
        });
    }
    addRatingStarsToEachProduct(<?php echo 0; ?>);
    loadSortOptions();
    productsPaggination(<?php echo 0; ?>);
    getSubcategoryForAdminUpdate(<?php echo 0 ? 1 : 0; ?>, <?php echo 0; ?>);
</script>