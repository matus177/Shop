<?php if ( ! $this->session->userdata("logged_in"))
{
    die('Chyba pri nastaveni Vasho konta.');
} ?>
<div class="col-md-9">
    <?php $this->load->view('FlashMessagesView'); ?>
    <p><b>Dorucovacie údaje</b></p>
    <table id="table_delivery_info" class="table_size">
        <tbody>
        <tr>
            <td>
                Meno
                <input type="text" id="deliv_name" onclick="updateDeliveryData(this.id)" class="form-control"
                       name="deliv_name"
                       value="<?php echo $this->encryption->decrypt($data['deliv_name']) ?>">
            </td>
            <td>
                <div class="inline_inputs">
                    Priezvisko
                    <input type="text" id="deliv_surname" onclick="updateDeliveryData(this.id)" class="form-control"
                           name="deliv_surname"
                           value="<?php echo $this->encryption->decrypt($data['deliv_surname']) ?>">
                </div>
            </td>
            <td>
                <div class="inline_inputs">
                    Firma
                    <input type="text" id="deliv_company" onclick="updateDeliveryData(this.id)" class="form-control"
                           name="deliv_company"
                           value="<?php echo $data['deliv_company'] ?>">
                </div>
            </td>
        </tr>
        <tr>
            <td class="format_inputs_top">
                Mesto
                <input type="text" onclick="updateDeliveryData(this.id)"
                       onmouseover="zipForCity('deliv_city_search', 'deliv_zip_search')"
                       class="form-control deliv_city_search"
                       name="deliv_city"
                       value="<?php echo $data['deliv_city'] ?>">
            </td>
            <td class="format_inputs_top">
                <div class="inline_inputs">
                    Ulica
                    <input type="text" onclick="updateDeliveryData(this.id)" class="form-control deliv_street_search"
                           name="deliv_street"
                           value="<?php echo $data['deliv_street'] ?>">
                </div>
            </td>
            <td class="format_inputs_top">
                <div class="inline_inputs">
                    PSC
                    <input type="text" onclick="updateDeliveryData(this.id)"
                           class="form-control deliv_zip_search zip_mask" name="deliv_zip"
                           value="<?php echo $data['deliv_zip'] ?>">
                </div>
            </td>
        </tr>
        <tr>
            <td class="format_inputs_top" colspan="2">
                Poznamka
                <input type="text" id="deliv_info" onclick="updateDeliveryData(this.id)" class="form-control"
                       name="deliv_info"
                       value="<?php echo $data['deliv_info'] ?>">
            </td>
            <td class="format_inputs_top">
                <div class="inline_inputs">
                    Telefon
                    <input type="text" id="deliv_phone" onclick="updateDeliveryData(this.id)"
                           class="form-control phone_mask"
                           name="deliv_phone"
                           value="<?php echo $data['deliv_phone'] ?: '+421' ?>"
                           pattern=".{7,}" title="+421 xxx xxx xxx">
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    <div class="format_inputs_top">
        <p><i class="glyphicon glyphicon-info-sign"></i> Zmeny sa ukladaju automaticky.</p>
    </div>
    <a class="btn btn-default" href='<?php echo base_url('Home'); ?>'><i class="glyphicon glyphicon-home"></i> Domov</a>
</div>
<script>
    function updateDeliveryData(idOfInput) {
        $(document).ready(function () {
            $('#' + idOfInput).on("autocompletechange change keyup", function () {
                var data = $('#' + idOfInput).val();
                var idOfUser = '<?php echo $data['id']; ?>';
                $.ajax({
                    url: window.location.origin + '/Shop/UserAccountSettings/updateDeliveryData',
                    type: 'GET',
                    data: {input: idOfInput, data: data, id: idOfUser},
                    success: function (response) {
                        if (response == 'System error')
                            alert('Systemova chyba, kontaktujte spravcu webu.');
                        else {
                            document.getElementById(idOfInput).style.borderColor = "green";
                        }
                    }
                })
            });
        });
    }
</script>
<script>
    autocompleteCityStreetZip();
</script>