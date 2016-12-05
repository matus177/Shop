<div class="col-sm-3">
    <div class="panel-group" id="accordion">
    </div>
</div>
<script>
    $(document).ready(function () {
        $.ajax({
            url: 'Home/getCategoryMenu',
            type: 'GET',
            success: function (response) {
                $.each(JSON.parse(response), function (i, category) {
                    var categoryId = category.category_id;
                    var categoryName = category.category_name;
                    var subcategoryId = category.id;
                    var subcategoryName = category.subcategory_name;

                    if ($("#collapse" + categoryId).length) {
                        $("#collapse" + categoryId).append('<div class="panel-body"><a href="' + categoryName + '/' + subcategoryName + '">' + subcategoryName + '</a></div>');
                    } else {
                        $("#accordion").append('<div class="panel panel-default"><div class="panel-heading"><h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse' + categoryId + '">' + categoryName + '</a>' +
                            '</h4></div><div id="collapse' + categoryId + '" class="panel-collapse collapse"><div class="panel-body"><a href="' + 'Product/index/' + subcategoryId + '">' + subcategoryName + '</a></div></div></div>');
                    }
                });
            }
        });
    });
</script>
