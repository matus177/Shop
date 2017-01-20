$(document).ready(function () {
    $.ajax({
        url: window.location.origin + '/Shop/Admin/getCategoryDropdown',
        type: 'GET',
        success: function (response) {
            $.each(JSON.parse(response), function (i, category) {
                $("#category_id").append('<option value="' + category.id + '">' + category.category_name + '</option>');
            });
        }
    });
});
$(document).ready(function () {
    $.ajax({
        url: window.location.origin + '/Shop/Admin/getSubCategoryDropdown',
        type: 'GET',
        success: function (response) {
            $.each(JSON.parse(response), function (i, subcategory) {
                $("#subcategory_id").append('<option value="' + subcategory.id + '">' + subcategory.subcategory_name + '</option>');
            });
        }
    });
});