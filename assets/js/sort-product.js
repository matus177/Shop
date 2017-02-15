function sortProductByLowestPrice() {
    var list = $('.list-unstyled');
    var listItems = list.find('li').sort(function (a, b) {
        return $(a).attr('data-sort') - $(b).attr('data-sort');
    });
    list.find('li').remove();
    list.append(listItems);
}

function sortProductByHighestPrice() {
    var list = $('.list-unstyled');
    var listItems = list.find('li').sort(function (a, b) {
        return $(b).attr('data-sort') - $(a).attr('data-sort');
    });
    list.find('li').remove();
    list.append(listItems);
}

function sortProductByStock() {
    var list = $('.list-unstyled');
    var listItems = list.find('li');

    for (i = 0; i < listItems.length; i++) {
        var string = listItems[i].textContent;
        var result = string.match(/Na objednavku./i);

        if (result && $('#stock_sort').is(':checked')) {
            listItems[i].hidden = true;
        } else {
            listItems[i].hidden = false;
        }
    }
}

function productsPaggination(numberOfProducts) {
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
}