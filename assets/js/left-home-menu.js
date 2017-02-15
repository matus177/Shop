function leftMenu(baseUrl) {
    $(document).ready(function () {
        $.ajax({
            url: window.location.origin + '/Shop/Home/getCategoryMenu',
            type: 'GET',
            success: function (response) {
                $.each(JSON.parse(response), function (i, category) {
                    var categoryId = category.category_id;
                    var categoryName = category.category_name;
                    var subcategoryId = category.id;
                    var subcategoryName = category.subcategory_name;

                    if ($("#collapse" + categoryId).length) {
                        $("#collapse" + categoryId).append('<div class="panel-body"><a href="' + baseUrl + 'Product/index/' + subcategoryId + '?page=1' + '">' + subcategoryName + '</a></div>');
                    } else {
                        $("#accordion").append('<div class="panel panel-default"><div class="panel-heading"><h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse' + categoryId + '">' + categoryName + '</a>' +
                            '</h4></div><div id="collapse' + categoryId + '" class="panel-collapse collapse"><div class="panel-body"><a href="' + baseUrl + 'Product/index/' + subcategoryId + '?page=1' + '">' + subcategoryName + '</a></div></div></div>');
                    }
                });
            }
        });
    });
}