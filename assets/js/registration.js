function changeIcon(divId, buttonId) {
    $('#' + divId).on('shown.bs.collapse', function () {
        $('#' + buttonId).find(".glyphicon").removeClass("glyphicon-plus").addClass("glyphicon-minus");
    });
    $('#' + divId).on('hidden.bs.collapse', function () {
        $('#' + buttonId).find(".glyphicon").removeClass("glyphicon-minus").addClass("glyphicon-plus");
    });
}