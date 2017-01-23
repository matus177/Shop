function shippingOptionsForm() {
    $(document).ready(function () {
        $.ajax({
            url: 'ShippingOptions/isUserLogged',
            type: 'GET',
            success: function (response) {
                if (response) {
                    $('#change_user_info').removeAttr("hidden", "hidden");
                } else {
                    $('#logged_user_info').removeAttr("hidden", "hidden");
                }
            }
        });

        document.getElementById('change_user_data_button').onclick = function () {
            $('#change_user_info').removeAttr("hidden", "hidden");
            $('#logged_user_info').attr("hidden", "hidden");
        };
    });
}