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