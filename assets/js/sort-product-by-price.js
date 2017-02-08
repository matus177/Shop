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