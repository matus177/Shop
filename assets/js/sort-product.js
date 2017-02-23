function sortProductByFavorite() {
    $(document).ready(function () {
        var stockSort = $('#stock_sort').is(':checked').toString();
        saveSortOption('favorite_sort', stockSort);
    });
}

function sortProductByLowestPrice() {
    $(document).ready(function () {
        var list = $('.list-unstyled');
        var listItems = list.find('li').sort(function (a, b) {
            return $(a).attr('data-sort') - $(b).attr('data-sort');
        });
        list.find('li').remove();
        list.append(listItems);

        var stockSort = $('#stock_sort').is(':checked').toString();
        saveSortOption('lowest_price', stockSort);
    });
}

function sortProductByHighestPrice() {
    $(document).ready(function () {
        var list = $('.list-unstyled');
        var listItems = list.find('li').sort(function (a, b) {
            return $(b).attr('data-sort') - $(a).attr('data-sort');
        });
        list.find('li').remove();
        list.append(listItems);

        var stockSort = $('#stock_sort').is(':checked').toString();
        saveSortOption('highest_price', stockSort);
    });
}

function sortProductByStock() {
    $(document).ready(function () {
        var list = $('.list-unstyled');
        var listItems = list.find('li');
        var priceSort = $('.lowest_price').hasClass('active') ? 'lowest_price' : $('.highest_price').hasClass('active') ? 'highest_price' : 'favorite_sort';
        var isStockSort = $('#stock_sort').is(':checked').toString();

        for (i = 0; i < listItems.length; i++) {
            var string = listItems[i].textContent;
            var result = string.match(/Na objednavku./i);

            if (result && (isStockSort == 'true')) {
                listItems[i].hidden = true;
            } else {
                listItems[i].hidden = false;
            }
        }
        setTimeout(function () {
            (isStockSort == 'true') ? saveSortOption(priceSort, 'true') : saveSortOption(priceSort, 'false');
        }, 300);
    });
}

function productsPaggination(numberOfProducts) {
    $(document).ready(function () {
        var currentPage = parseInt(window.location.href.split('=').pop());
        if (isNaN(currentPage)) {
            currentPage = 1;
        }
        $('#' + currentPage).addClass('active');
        var newPage = window.location.href.substring(0, window.location.href.indexOf('='));
        if (currentPage < 2) {
            $('#previous_page').attr('hidden', 'hidden');
        }
        if (currentPage == numberOfProducts || numberOfProducts == 0) {
            $('#next_page').attr('hidden', 'hidden');
        }
        $('#previous_page').attr('href', newPage + '=' + (currentPage - 1));
        $('#next_page').attr('href', newPage + '=' + (currentPage + 1));
    });
}

function productPerPage(subCategoryId, valueSelected) {
    window.location.href = window.location.origin + '/Shop/Product/index/' + subCategoryId + '/' + valueSelected + '?page=1';
}

function numberOfOrdersIcon() {
    $(document).ready(function () {
        $.ajax({
            url: window.location.origin + '/Shop/UserOrders/getNumberOfUnclosedLogInOrders',
            type: 'GET',
            success: function (response) {
                if (response == 0) {
                    $(".login_orders").append(' <button type="button" class="btn btn-success btn-xs"><span class="badge">' + response + '</span></button>');
                } else {
                    $(".login_orders").append(' <button type="button" class="btn btn-danger btn-xs"><span class="badge">' + response + '</span></button>');
                }
            }
        });
    });
    $(document).ready(function () {
        $.ajax({
            url: window.location.origin + '/Shop/UserOrders/getNumberOfUnclosedLogOutOrders',
            type: 'GET',
            success: function (response) {
                if (response == 0) {
                    $(".logout_orders").append(' <button type="button" class="btn btn-default btn-xs"><span class="badge">' + response + '</span></button>');
                } else {
                    $(".logout_orders").append(' <button type="button" class="btn btn-danger btn-xs"><span class="badge">' + response + '</span></button>');
                }
            }
        });
    });
}

function saveSortOption(priceOption, stockOption) {
    $(document).ready(function () {
        $.ajax({
            url: window.location.origin + '/Shop/Product/saveSortProduct',
            type: 'GET',
            data: {sort_options: {price: priceOption, stock: stockOption}},
            success: function () {

            }
        });
    });
}

function loadSortOptions() {
    $(document).ready(function () {
        $.ajax({
            url: window.location.origin + '/Shop/Product/loadSortProduct',
            type: 'GET',
            success: function (response) {
                if (JSON.parse(response).price != undefined) {
                    switch (JSON.parse(response).price) {
                        case 'favorite_sort':
                            $('.favorite_sort').trigger('click').addClass('active');
                            break;
                        case 'lowest_price':
                            $('.lowest_price').trigger('click').addClass('active');
                            break;
                        case 'highest_price':
                            $('.highest_price').trigger('click').addClass('active');
                            break;
                        default:
                    }
                }
                if (JSON.parse(response).stock != undefined) {
                    switch (JSON.parse(response).stock) {
                        case 'false':
                            $('#stock_sort').prop('checked', false);
                            break;
                        case 'true':
                            $('#stock_sort').trigger('click');
                            break;
                        default:
                    }
                }
            }
        });
    });
}