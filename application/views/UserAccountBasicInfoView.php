<?php if ( ! $this->session->userdata("logged_in"))
{
    die('Chyba pri nastaveni Vasho konta.');
} ?>
<div class="col-md-9">
    <?php $this->load->view('FlashMessagesView'); ?>
    <table id="table_basic_info">
        <tbody>
        <tr>
            <td>
                <p>Prihlasovací e-mail:</p>
            </td>
            <td>
                <div class="update_email form-inline" style="cursor: pointer">
                    <p id="updateEmail" class="email" style="margin-left: 15px"><?php echo $data['email'] ?> <a
                                class="glyphicon glyphicon-pencil" aria-hidden="true"></a></p>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <p>Telefón:</p>
            </td>
            <td>
                <div class="update_phone" style="cursor: pointer">
                    <p id="updatePhone" class="phone phone_mask"
                       style="margin-left: 15px"><?php echo $data['fact_phone'] ?></p>
                </div>
            </td>
            <td>
                <a id="phone_pencil" style="padding-bottom: 15px; padding-left: 5px; cursor: pointer"
                   class="update_phone glyphicon glyphicon-pencil"></a>
            </td>
        </tr>
        <tr>
            <td>
                <a type="button" href="" class="btn btn-primary as" data-toggle="modal"
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
    <hr>
    <p><b>Fakturačné údaje</b></p>
    <table id="table_facture_info" class="table_size">
        <tbody>
        <tr>
            <td>
                <div class="form-group">
                    IČO
                    <input type="text" id="comp_ico" onclick="updateCompanyData(this.id, <?php echo $data['id']; ?>)"
                           class="form-control ico_mask"
                           name="comp_ico"
                           value="<?php echo $data['comp_ico'] ?>">
                </div>
            </td>
            <td>
                <div class="inline_inputs form-group">
                    IČ DPH
                    <input type="text" id="comp_icdph" onclick="updateCompanyData(this.id, <?php echo $data['id']; ?>)"
                           class="form-control icdph_mask"
                           name="comp_icdph"
                           value="<?php echo $data['comp_icdph'] ?>">
                </div>
            </td>
            <td>
                <div class="inline_inputs form-group">
                    DIČ
                    <input type="text" id="comp_dic" onclick="updateCompanyData(this.id, <?php echo $data['id']; ?>)"
                           class="form-control dic_mask"
                           name="comp_dic"
                           value="<?php echo $data['comp_dic'] ?>">
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="form-group">
                    Meno
                    <input type="text" id="fact_name" onclick="updatePersonalData(this.id, <?php echo $data['id']; ?>)"
                           class="form-control"
                           name="fact_name"
                           value="<?php echo $this->encryption->decrypt($data['fact_name']) ?>">
                </div>
            </td>
            <td colspan="2">
                <div class="inline_inputs form-group">
                    Priezvisko
                    <input type="text" id="fact_surname"
                           onclick="updatePersonalData(this.id, <?php echo $data['id']; ?>)" class="form-control"
                           name="fact_surname"
                           value="<?php echo $this->encryption->decrypt($data['fact_surname']) ?>">
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="form-group">
                    Mesto
                    <input type="text" onmouseover="zipForCity('fact_city_search', 'fact_zip_search')"
                           id="fact_city"
                           onclick="updatePersonalData(this.id, <?php echo $data['id']; ?>)"
                           class="form-control fact_city_search"
                           name="fact_city"
                           value="<?php echo $data['fact_city'] ?>">
                </div>
            </td>
            <td>
                <div class="inline_inputs form-group">
                    Ulica
                    <input type="text" onclick="updatePersonalData(this.id, <?php echo $data['id']; ?>)"
                           class="form-control fact_street_search"
                           id="fact_street"
                           name="fact_street"
                           value="<?php echo $data['fact_street'] ?>">
                </div>
            </td>
            <td>
                <div class="inline_inputs form-group">
                    PSC
                    <input type="text" onclick="updatePersonalData(this.id, <?php echo $data['id']; ?>)"
                           id="fact_zip"
                           class="form-control fact_zip_search zip_mask" name="fact_zip"
                           value="<?php echo $data['fact_zip'] ?>">
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="form-group">
                    BIC (SWIFT)
                    <input type="text" id="comp_bic" onclick="updateCompanyData(this.id, <?php echo $data['id']; ?>)"
                           class="form-control"
                           name="comp_bic"
                           value="<?php echo $data['comp_bic'] ?>">
                </div>
            </td>
            <td>
                <div class="inline_inputs form-group">
                    IBAN
                    <input type="text" id="comp_iban" onclick="updateCompanyData(this.id, <?php echo $data['id']; ?>)"
                           class="form-control"
                           name="comp_iban"
                           value="<?php echo $this->encryption->decrypt($data['comp_iban']) ?>">
                </div>
            </td>
            <td>
                <div class="inline_inputs form-group">
                    Meno majitela uctu
                    <input type="text" id="comp_bank_owner"
                           onclick="updateCompanyData(this.id, <?php echo $data['id']; ?>)" class="form-control"
                           name="comp_bank_owner"
                           value="<?php echo $this->encryption->decrypt($data['comp_bank_owner']) ?>">
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
    updateUserEmail(<?php echo $data['id']; ?>);
    updateUserPhone(<?php echo $data['id']; ?>);
    autocompleteCityStreetZip();
</script>