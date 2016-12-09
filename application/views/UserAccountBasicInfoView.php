<div class="col-md-9">
    <?php $this->load->view('FlashMessagesView'); ?>
    <table id="table_basic_info">
        <tbody>
        <tr>
            <td>
                <p>Prihlasovací e-mail:</p>
            </td>
            <td>
                <p class="email" style="margin-left: 15px"><?php echo $data['email'] ?> <a href="" id="updateEmail"
                                                                                           class="glyphicon glyphicon-pencil"
                                                                                           aria-hidden="true"></a></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Telefón:</p>
            </td>
            <td>
                <p class="phone" style="margin-left: 15px"><?php echo $data['fact_phone'] ?> <a href="" id="updatePhone"
                                                                                                class="glyphicon glyphicon-pencil"></a>
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <a type="button" href="" class="btn btn-primary" data-toggle="modal"
                   data-target="#update_password_modal"> Zmenit heslo</a>
                <div class="modal fade" id="update_password_modal" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog">
                        <div class="modal-body"><?php $this->load->view('UpdatePasswordView'); ?></div>
                    </div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    <div class="aaaa">
        <p>asdadad</p>
    </div>
    <hr>
    <p><b>Fakturačné údaje</b></p>
    <table id="table_facture_info" class="table_size">
        <tbody>
        <tr>
            <td>
                IČO
                <input type="text" id="ico" class="form-control" name="comp_ico"
                       value="<?php echo $data['comp_ico'] ?>">
            </td>
            <td>
                <div class="inline_inputs">
                    IČ DPH
                    <input type="text" id="icdph" class="form-control" name="comp_icdph"
                           value="<?php echo $data['comp_icdph'] ?>">
                </div>
            </td>
            <td>
                <div class="inline_inputs">
                    DIČ
                    <input type="text" id="dic" class="form-control" name="comp_dic"
                           value="<?php echo $data['comp_dic'] ?>">
                </div>
            </td>
        </tr>
        <tr>
            <td class="format_inputs_top">
                <div class="required-fields"><label for="email" class="control-label">Meno</label></div>
                <input type="text" id="first_name" class="form-control" name="fact_name"
                       value="<?php echo $this->encryption->decrypt($data['fact_name']) ?>">

            </td>
            <td class="format_inputs_top" colspan="2">
                <div class="inline_inputs">
                    Priezvisko
                    <input type="text" id="last_name" class="form-control" name="fact_surname"
                           value="<?php echo $this->encryption->decrypt($data['fact_surname']) ?>">
                </div>
            </td>
        </tr>
        <tr>
            <td class="format_inputs_top">
                Mesto
                <input type="text" id="fact_city" class="form-control" name="fact_city"
                       value="<?php echo $data['fact_city'] ?>">
            </td>
            <td class="format_inputs_top">
                <div class="inline_inputs">
                    Ulica
                    <input type="text" id="fact_street" class="form-control" name="fact_street"
                           value="<?php echo $data['fact_street'] ?>">
                </div>
            </td>
            <td class="format_inputs_top">
                <div class="inline_inputs">
                    PSC
                    <input type="text" id="fact_zip" class="form-control" name="fact_zip"
                           value="<?php echo $data['fact_zip'] ?>">
                </div>
            </td>
        </tr>
        <tr>
            <td class="format_inputs_top">
                BIC (SWIFT)
                <input type="text" id="comp_bic" class="form-control" name="comp_bic"
                       value="<?php echo $data['comp_bic'] ?>">
            </td>
            <td class="format_inputs_top">
                <div class="inline_inputs">
                    IBAN
                    <input type="text" id="comp_iban" class="form-control" name="comp_iban"
                           value="<?php echo $this->encryption->decrypt($data['deliv_surname']) ?>">
                </div>
            </td>
            <td class="format_inputs_top">
                <div class="inline_inputs">
                    Meno majitela uctu
                    <input type="text" id="comp_bank_owner" class="form-control" name="comp_bank_owner"
                           value="<?php echo $this->encryption->decrypt($data['deliv_surname']) ?>">
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    <div class="format_inputs_top">
        <p><i class="glyphicon glyphicon-info-sign"></i> Zmeny sa ukladaju automaticky.</p>
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