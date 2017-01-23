function autocompleteCityStreetZip() {
    $(".fact_city_search, .deliv_city_search").autocomplete({
        source: window.location.origin + '/Shop/Registration/searchCity'
    });
    $(".fact_zip_search, .deliv_zip_search").autocomplete({
        source: window.location.origin + '/Shop/Registration/searchZip'
    });
    $(".fact_street_search, .deliv_street_search").autocomplete({
        source: window.location.origin + '/Shop/Registration/searchStreet'
    });
}

function zipForCity(city, factOrDelivZip) {
    $('.' + city).on("autocompletechange", function () {
        var searchTerm = {
            city: $('.' + city).val()
        };
        $.ajax({
            url: window.location.origin + '/Shop/Registration/searchZipForCity',
            type: 'GET',
            data: searchTerm,
            success: function (data) {
                $('.form-group input').click();
                $('.' + factOrDelivZip).val(data).change();
            }
        })
    });
}
$(".phone_mask").mask("+000 000 000 000");
$(".zip_mask").mask("000 00");