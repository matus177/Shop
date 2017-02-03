function getSubcategoryForAdminUpdate(isAdmin, numberOfProducts) {
    if (isAdmin) {
        $(document).ready(function () {
            $.ajax({
                url: window.location.origin + '/Shop/Admin/getSubCategoryDropdown',
                type: 'GET',
                success: function (response) {
                    $.each(JSON.parse(response), function (i, subcategory) {
                        for (i = 0; i < numberOfProducts; i++)
                            $("#subcategory_id_" + i).append('<option value="' + subcategory.id + '">' + subcategory.subcategory_name + '</option>');
                    });
                }
            });
        });
        $(document).ready(function () {
            $.ajax({
                url: window.location.origin + '/Shop/Admin/getCategoryDropdown',
                type: 'GET',
                success: function (response) {
                    $.each(JSON.parse(response), function (i, category) {
                        for (i = 0; i < numberOfProducts; i++)
                            $("#category_id_" + i).append('<option value="' + category.id + '">' + category.category_name + '</option>');
                    });
                }
            });
        });
    } else {
        alert('Vyskytla sa chyba.');
    }
}