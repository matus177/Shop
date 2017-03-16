function numberOfOrdersIcon() {
    $(document).ready(function () {
        $.ajax({
            url: window.location.origin + '/Shop/UserOrders/getNumberOfUnclosedLogInOrders',
            type: 'GET',
            success: function (response) {
                if (response == 0) {
                    $(".login_orders").append('<span class="badge progress-bar-success">' + response + '</span>');
                } else {
                    $(".login_orders").append('<span class="badge progress-bar-danger">' + response + '</span>');
                }
            },
            error: function () {
                $(".login_orders").append('<span class="badge progress-bar-danger">Chyba!</span>');
            }
        });
    });
    $(document).ready(function () {
        $.ajax({
            url: window.location.origin + '/Shop/UserOrders/getNumberOfUnclosedLogOutOrders',
            type: 'GET',
            success: function (response) {
                if (response == 0) {
                    $(".logout_orders").append('<span class="badge progress-bar-success">' + response + '</span>');
                } else {
                    $(".logout_orders").append('<span class="badge progress-bar-danger">' + response + '</span>');
                }
            },
            error: function () {
                $(".logout_orders").append('<span class="badge progress-bar-danger">Chyba!</span>');
            }
        });
    });
}

function addRatingStarsToEachProduct(numberOfProduct) {
    $(document).ready(function () {
        for (var i = 0; i < numberOfProduct; i++) {
            (function (i) {
                var productId = $('.rating' + i).attr('id');
                $.ajax({
                    url: window.location.origin + '/Shop/Rating/getDefaultRating',
                    type: 'GET',
                    data: {id: productId},
                    success: function (defaultRating) {
                        $('.rating' + i).mouseleave(function () {
                            addDefaultRating(defaultRating, productId, i);
                        });
                        addDefaultRating(defaultRating, productId, i);
                    }
                });
            })(i);
        }
    });
}

function addDefaultRating(defaultRating, productId, i) {
    $('.rating' + i).empty();
    for (var k = 1; k <= defaultRating; k++) {
        $('.rating' + i).append('<span id="' + productId + '_' + k + '" class="glyphicon glyphicon-star" onmouseover="fillAndEmptyRatingStars(this.id)" onclick="addUserRating(this.id)" style="font-size: 25px; color: yellow;"></span>');
    }
    for (var j = defaultRating; j < 5; j++) {
        $('.rating' + i).append('<span id="' + productId + '_' + (parseInt(j) + 1) + '" class="glyphicon glyphicon-star-empty" onmouseover="fillAndEmptyRatingStars(this.id)" onclick="addUserRating(this.id)" style="font-size: 25px; color: yellow;"></span>');
    }
}

function addUserRating(id) {
    $(document).ready(function () {
        $.ajax({
            url: window.location.origin + '/Shop/Rating/addUserRating',
            type: 'GET',
            data: {rating_data: id},
            success: function (response) {
                if (response == '') {
                    alert('Dakujeme za Vas hlas.')
                } else {
                    alert(response);
                }
            }
        });
    });
}

function fillAndEmptyRatingStars(id) {
    //fill stars
    var productOrder = ("" + id).split("_");
    var userRating = productOrder.pop().toString();
    for (var i = 1; i <= userRating; i++) {
        $('#' + (productOrder + '_' + i)).addClass('glyphicon glyphicon-star').removeClass('glyphicon-star-empty');
    }
    //empty stars
    var maxRate = 5;
    var emptyStar = maxRate - parseInt(userRating);
    for (var j = 1; j <= emptyStar; j++) {
        $('#' + (productOrder + '_' + (maxRate--))).addClass('glyphicon glyphicon-star-empty').removeClass('glyphicon-star');
    }
}

function paggination(subCategoryId, isAdmin) {
    $(document).ready(function () {
        var sort = $("li.highest_price").hasClass('active') ? 'DESC' : 'ASC';
        var stock = $('#stock_sort').is(':checked');
        $.ajax({
            url: window.location.origin + '/Shop/Product/getNumberOfproduct',
            type: 'GET',
            data: {subcategory_id: subCategoryId, stock: stock},
            success: function (numberOfProducts) {
                addButtons(numberOfProducts);

                function addButtons(numberOfProducts) {
                    var limit = ($('.results_per_page').val() == undefined) ? 10 : $('.results_per_page').val();

                    var buts = Math.ceil(numberOfProducts / limit);
                    $('.products_pagination').empty();
                    for (var i = 1; i <= buts; i++) {
                        $('.products_pagination').append('<a id="' + i + '" href="#" onclick="getProduct(' + subCategoryId + ',' + isAdmin + ',' + limit + ',' + i + ',' + limit + ')">' + i + '</a>');
                    }
                    getProduct(subCategoryId, isAdmin, limit, 1, limit);

                    $('#1').addClass('active');
                    for (var j = 4; j < buts; j++) {
                        $('#' + j).prop("hidden", true);
                    }

                    $('.products_pagination a').click(function (button) {
                        $(".products_pagination a").removeClass("active");
                        var currentPage = button.toElement.id;
                        $('#' + currentPage).addClass('active');
                        var start = currentPage - 3,
                            end = parseInt(currentPage) + 3;

                        if (end <= numberOfProducts) {
                            $('.products_pagination a').prop("hidden", false);

                            for (var j = end; j < buts; j++) {
                                $('#' + j).prop("hidden", true);
                            }
                        }
                        if (start >= 0) {
                            for (var k = start; k >= 2; k--) {
                                $('#' + k).prop("hidden", true);
                            }
                        }
                    });
                }
            }
        });
    });
}

function getProduct(subCategoryId, isAdmin, limit, page) {
    $(document).ready(function () {
        var stock = $('#stock_sort').is(':checked');
        var sort = $("li.highest_price").hasClass('active') ? 'DESC' : 'ASC';
        var offset = (page - 1) * limit;
        var counterOfProduct = 0;
        $.ajax({
            url: window.location.origin + '/Shop/Product/getProduct',
            type: 'GET',
            data: {subcategory_id: subCategoryId, limit: limit, offset: offset, sort: sort, stock: stock},
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

                    if (isAdmin) {
                        editButton = '<button href="" type="button" id="' + productId + '" class="btn btn-warning" data-toggle="modal" data-target="#modal" onclick="getModalData(' + productId + ',' + "'" + 1 + "'" + ')">Upravit</button>';
                    } else {
                        editButton = '';
                    }

                    if (productQuantity == 0) {
                        productAvailabe = '<p style="text-align: center"><span style="color:orange"><b>Na objednavku.</b></span></p>'
                    } else {
                        productAvailabe = '<p style="text-align: center"><span style="color:green"><b>Na sklade ' + productQuantity + 'ks.</b></span></p>'
                    }

                    if (counterOfProduct == 0) {
                        html += '<div class="row">';
                    }
                    if (counterOfProduct % 4 == 0 && counterOfProduct != 0) {
                        html += '</div><div class="row">';
                    }
                    html += '<div class="col-md-3 panel panel-default">';
                    html += '<div class="col-md-12" style="text-align: center"><a href="#"><img src="' + window.location.origin + '/Shop/assets/img/' + productImage + '"></a></div> ';
                    html += '<div class="col-md-12" style="height: 80px"><h5><b>' + productName + '</b></h5></div> ';
                    html += '<div class="col-md-12" style="height: 160px; font-size: small; overflow: auto"><p>' + productDescription + '</p></div> ';
                    html += '<div class="col-md-12"><div class="rating' + counterOfProduct + '" id="' + productId + '" style="text-align: center"></div></div> ';
                    html += '<div class="col-md-12">' + productAvailabe + '</div> ';
                    html += '<div class="col-md-12" style="text-align: center"><a  type="button" onclick="addProductToCart(this.id)" id="' + productId + '" class="btn btn-success buy_button">Kupit</a> ' + editButton + '</div> ';
                    html += '<div class="col-md-12"><p style="text-align: center">Cena bez DPH ' + (productPrice - productPriceDph).toFixed(2) + ' &euro;</p></div> ';
                    html += '<div class="col-md-12"><p style="text-align: center">Cena s DPH ' + productPrice + ' &euro;</p></div> ';
                    html += '</div>';
                    ++counterOfProduct;
                });

                $('#products').empty();
                $('#products').append(html);
                addRatingStarsToEachProduct(counterOfProduct);
            }
        });
    });
}

function getModalData(productId, isAdmin) {
    $(document).ready(function () {
        $.ajax({
            url: window.location.origin + '/Shop/Product/getModalData',
            type: 'GET',
            data: {id: productId},
            success: function (response) {
                $('#modal_product').attr('action', window.location.origin + '/Shop/Admin/updateProduct/' + productId);
                $.each(JSON.parse(response), function (i, modalData) {
                    $('#id').val(modalData.id);
                    $('#product_name').val(modalData.product_name);
                    $('#product_description').val(modalData.product_description);
                    $('#product_price').val(modalData.product_price);
                    $('#product_quantity').val(modalData.product_quantity);
                });
                getCategoryAndSubCategoryDropdowns(isAdmin);
            }
        });
    });
}

function sortProduct(subCategoryId, isAdmin) {
    $(document).ready(function () {
        $('.results_per_page').change(function () {
            paggination(subCategoryId, isAdmin);
        });

        $('#stock_sort').on('click', function () {
            paggination(subCategoryId, isAdmin);
        });

        $('.lowest_price').on('click', function () {
            $(".highest_price").removeClass("active");
            $(".lowest_price").addClass("active");
            paggination(subCategoryId, isAdmin);
        });

        $('.highest_price').on('click', function () {
            $(".lowest_price").removeClass("active");
            $(".highest_price").addClass("active");
            paggination(subCategoryId, isAdmin);
        });
    });
}