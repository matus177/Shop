function getCategoryDropdowns(isAdmin) {
    if (isAdmin) {
        $(document).ready(function () {
            $.ajax({
                url: window.location.origin + '/Shop/Admin/getCategoryDropdown',
                type: 'GET',
                success: function (response) {
                    $.each(JSON.parse(response), function (i, category) {
                        $("#category_id").append('<option value="' + category.id + '">' + category.category_name + '</option>');
                        $("#prod_category_id").append('<option value="' + category.id + '">' + category.category_name + '</option>');
                    });
                }
            });
        });
    }
}

function getSubCategoryDropdowns(isAdmin, categoryId) {
    if (isAdmin) {
        $(document).ready(function () {
            $.ajax({
                url: window.location.origin + '/Shop/Admin/getSubCategoryDropdown',
                type: 'GET',
                data: {category_id: categoryId},
                success: function (response) {
                    $("#subcategory_id").empty();
                    $.each(JSON.parse(response), function (i, subcategory) {
                        $("#subcategory_id").append('<option value="' + subcategory.id + '">' + subcategory.subcategory_name + '</option>');
                    });
                }
            });
        });
    }
}