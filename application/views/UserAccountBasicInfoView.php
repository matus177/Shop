<div class="col-md-9">
    <table class="">
        <tbody>
        <tr>
            <td>
                <p>Prihlasovací e-mail:</p>
            </td>
            <td>
                <p class="email" style="margin-left: 15px"><?php echo $data['email'] ?> <a id="updateEmail"
                                                                                           class="glyphicon glyphicon-pencil"
                                                                                           aria-hidden="true"></a></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Telefón:</p>
            </td>
            <td>
                <p class="phone" style="margin-left: 15px"><?php echo $data['fact_phone'] ?> <a id="updatePhone"
                                                                                                class="glyphicon glyphicon-pencil"></a>
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <button type="button" class="btn btn-primary">Zmenit heslo</button>
            </td>
        </tr>
        </tbody>
    </table>
    <div class="aaaa">
        <p>asdadad</p>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#updateEmail').click(function (e) {
            e.preventDefault();
            var emailValue = $('p.email').text();
            $("p.email").replaceWith('<input type="text" id="email_input" class="form-control" name="email" value="' + emailValue + '">');
            $('div.aaaa').click(function () {
                var newEmailValue = $('#email_input').val();
                var idOfUser = '<?php echo $data['id']; ?>';
                $("#email_input").replaceWith('<p class="email" style="margin-left: 15px">' + newEmailValue + ' <a id="updateEmail" class="glyphicon glyphicon-pencil"></a>');
                $.ajax({
                    url: window.location.origin + '/Shop/UserAccountSettings/updateEmail',
                    type: 'GET',
                    data: {email: newEmailValue, id: idOfUser}
                })
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#updatePhone').click(function (e) {
            e.preventDefault();
            var phoneValue = $('p.phone').text();
            $("p.phone").replaceWith('<input type="text" class="form-control newPhone" name="phone" value="' + phoneValue + '">');
            $('div.aaaa').click(function () {
                var newPhoneValue = $('.newPhone').val();
                var idOfUser = '<?php echo $data['id']; ?>';
                $("input.newPhone").replaceWith('<p class="phone" style="margin-left: 15px">' + newPhoneValue + ' <a id="updatePhone" class="glyphicon glyphicon-pencil"></a>');
                $.ajax({
                    url: window.location.origin + '/Shop/UserAccountSettings/updatePhone',
                    type: 'GET',
                    data: {phone: newPhoneValue, id: idOfUser}
                })
            });
        });
    });
</script>