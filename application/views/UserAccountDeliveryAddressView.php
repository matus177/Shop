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
                <div class="form-group">
                    Meno
                    <input type="text" id="deliv_name" onclick="updateDeliveryData(this.id, <?php echo $data['id']; ?>)"
                           class="form-control"
                           name="deliv_name"
                           value="<?php echo $this->encryption->decrypt($data['deliv_name']) ?>">
                </div>
            </td>
            <td>
                <div class="inline_inputs form-group">
                    Priezvisko
                    <input type="text" id="deliv_surname"
                           onclick="updateDeliveryData(this.id, <?php echo $data['id']; ?>)" class="form-control"
                           name="deliv_surname"
                           value="<?php echo $this->encryption->decrypt($data['deliv_surname']) ?>">
                </div>
            </td>
            <td>
                <div class="inline_inputs form-group">
                    Firma
                    <input type="text" id="deliv_company"
                           onclick="updateDeliveryData(this.id, <?php echo $data['id']; ?>)" class="form-control"
                           name="deliv_company"
                           value="<?php echo $data['deliv_company'] ?>">
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="form-group">
                    Mesto
                    <input type="text" onclick="updateDeliveryData(this.id, <?php echo $data['id']; ?>)"
                           id="deliv_city"
                           onmouseover="zipForCity('deliv_city_search', 'deliv_zip_search')"
                           class="form-control deliv_city_search"
                           name="deliv_city"
                           value="<?php echo $data['deliv_city'] ?>">
                </div>
            </td>
            <td>
                <div class="inline_inputs form-group">
                    Ulica
                    <input type="text" onclick="updateDeliveryData(this.id, <?php echo $data['id']; ?>)"
                           class="form-control deliv_street_search"
                           id="deliv_street"
                           name="deliv_street"
                           value="<?php echo $data['deliv_street'] ?>">
                </div>
            </td>
            <td>
                <div class="inline_inputs form-group">
                    PSC
                    <input type="text" onclick="updateDeliveryData(this.id, <?php echo $data['id']; ?>)"
                           id="deliv_zip"
                           class="form-control deliv_zip_search zip_mask" name="deliv_zip"
                           value="<?php echo $data['deliv_zip'] ?>">
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="form-group">
                    Poznamka
                    <input type="text" id="deliv_info" onclick="updateDeliveryData(this.id, <?php echo $data['id']; ?>)"
                           class="form-control"
                           name="deliv_info"
                           value="<?php echo $data['deliv_info'] ?>">
                </div>
            </td>
            <td>
                <div class="inline_inputs form-group">
                    Telefon
                    <input type="text" id="deliv_phone"
                           onclick="updateDeliveryData(this.id, <?php echo $data['id']; ?>)"
                           class="form-control phone_mask"
                           name="deliv_phone"
                           value="<?php echo $data['deliv_phone'] ?: '+421' ?>"
                           pattern=".{7,}" title="+421 xxx xxx xxx">
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    <div class="form-group">
        <p><i class="glyphicon glyphicon-info-sign"></i> Zmeny sa ukladaju automaticky.</p>
    </div>
    <a class="btn btn-default" href='<?php echo base_url('Home'); ?>'><i class="glyphicon glyphicon-home"></i> Domov</a>
</div>
<script>
    autocompleteCityStreetZip();
</script>