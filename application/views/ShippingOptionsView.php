<div class="col-md-9 col-sm-offset-3">
    <?php $this->load->view('FlashMessagesView'); ?>
    <div id="logged_user_info" hidden>
        <hr>
        <div class="review_order">
            <div class="col-sm-6">
                <p><b>Fakturačné údaje</b></p>
                <p><?php echo $this->encryption->decrypt($userData['fact_name']) . ' ' . $this->encryption->decrypt($userData['fact_surname']) ?></p>
                <p><?php echo $userData['fact_street'] ?></p>
                <p><?php echo $userData['fact_zip'] . ' ' . $userData['fact_city'] ?></p>
            </div>
            <div class="col-sm-6">
                <p><b>Dodacie údaje</b></p>
                <p><?php if (strlen($this->encryption->decrypt($userData['deliv_name']) . ' ' . $this->encryption->decrypt($userData['deliv_surname'])) > 1)
                    {
                        echo $this->encryption->decrypt($userData['deliv_name']) . ' ' . $this->encryption->decrypt($userData['deliv_surname']);
                    } else
                    {
                        echo $this->encryption->decrypt($userData['fact_name']) . ' ' . $this->encryption->decrypt($userData['fact_surname']);
                    } ?></p>
                <p><?php if (strlen($userData['deliv_street']) > 0)
                    {
                        echo $userData['deliv_street'];
                    } else
                    {
                        echo $userData['fact_street'];
                    } ?></p>
                <p><?php if (strlen($userData['deliv_zip'] . ' ' . $userData['deliv_city']) > 1)
                    {
                        echo $userData['deliv_zip'] . ' ' . $userData['deliv_city'];
                    } else
                    {
                        echo $userData['fact_zip'] . ' ' . $userData['fact_city'];
                    } ?></p>
            </div>
        </div>
        <a href="<?php echo base_url('ShippingAndBilling?id=1'); ?>" class="btn btn-default">
            <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Spat
        </a>
        <button class="btn btn-primary" id="change_user_data_button" type="button">Zmenit</button>
        <a style="float: right" href="<?php echo base_url('ReviewAndPayment?id=3'); ?>" class="btn btn-success">Dalej
            <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
        </a>
    </div>
    <div class="panel-body" id="change_user_info" hidden>
        <hr>
        <p><b>Fakturačné údaje</b></p>
        <?php echo form_open('ShippingOptions/checkShippingOptions',
            ['id' => 'form_shipping_options', 'class' => 'form-horizontal', 'role' => 'form']); ?>
        <div class="required-fields">
            <div class="form-group">
                <label for="email" class="col-md-3 control-label">Email</label>
                <div class="col-md-7">
                    <input type="email" class="form-control" id="email"
                           onclick="updatePersonalData(this.id, <?php echo $userData['id'] ?: 0; ?>)"
                           name="email"
                           placeholder="Email" value="<?php echo $userData['email'] ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="fact_name" class="col-md-3 control-label">Meno</label>
                <div class="col-md-7">
                    <input type="text" class="form-control" id="fact_name"
                           onclick="updatePersonalData(this.id, <?php echo $userData['id'] ?: 0; ?>)"
                           name="fact_name"
                           placeholder="Meno" value="<?php echo $this->encryption->decrypt($userData['fact_name']) ?>"
                           required>
                </div>
            </div>
            <div class="form-group">
                <label for="fact_surname" class="col-md-3 control-label">Priezvisko</label>
                <div class="col-md-7">
                    <input type="text" class="form-control" id="fact_surname"
                           onclick="updatePersonalData(this.id, <?php echo $userData['id'] ?: 0; ?>)"
                           name="fact_surname"
                           placeholder="Priezvisko"
                           value="<?php echo $this->encryption->decrypt($userData['fact_surname']) ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="fact_street" class="col-md-3 control-label">Ulica</label>
                <div class="col-md-7">
                    <input type="text" class="form-control fact_street_search" id="fact_street"
                           onclick="updatePersonalData(this.id, <?php echo $userData['id'] ?: 0; ?>)" name="fact_street"
                           placeholder="Ulica" value="<?php echo $userData['fact_street'] ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="fact_city" class="col-md-3 control-label">Mesto</label>
                <div class="col-md-7">
                    <input type="text" onmouseover="zipForCity('fact_city_search', 'fact_zip_search')" id="fact_city"
                           onclick="updatePersonalData(this.id, <?php echo $userData['id'] ?: 0; ?>)"
                           class="form-control fact_city_search"
                           name="fact_city" placeholder="Mesto" value="<?php echo $userData['fact_city'] ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="fact_zip" class="col-md-3 control-label">PSČ</label>
                <div class="col-md-7">
                    <input type="text" class="form-control fact_zip_search zip_mask" id="fact_zip"
                           onclick="updatePersonalData(this.id, <?php echo $userData['id'] ?: 0; ?>)" name="fact_zip"
                           placeholder="PSČ"
                           value="<?php echo $userData['fact_zip'] ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="fact_phone" class="col-md-3 control-label">Telefón</label>
                <div class="col-md-7">
                    <input type="text" class="form-control phone_mask" id="fact_phone"
                           onclick="updatePersonalData(this.id, <?php echo $userData['id'] ?: 0; ?>)" name="fact_phone"
                           placeholder="Telefón" value="<?php echo $userData['fact_phone'] ?: '+421' ?>"
                           pattern=".{7,}" title="+421 xxx xxx xxx" required>
                </div>
            </div>
        </div>
        <div class="control-label">
            <div class="checkbox">
                <label><input type="checkbox" class="show-delivery-data" data-toggle="collapse"
                              data-target="#delivery-data"> Vyplnit dodacie údaje</label>
            </div>
            <div id="delivery-data" class="collapse">
                <hr>
                <div class="form-group">
                    <label class="col-md-6 control-label">Dodacie udaje. Vyplňte v prípade, že sa líšia od
                        fakturačných.</label>
                </div>
                <div class="form-group">
                    <label for="deliv_name" class="col-md-3 control-label">Meno</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" id="deliv_name"
                               onclick="updateDeliveryData(this.id, <?php echo $userData['id'] ?: 0; ?>)"
                               name="deliv_name" placeholder="Meno"
                               value="<?php echo $this->encryption->decrypt($userData['deliv_name']) ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="deliv_surname" class="col-md-3 control-label">Priezvisko</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" id="deliv_surname"
                               onclick="updateDeliveryData(this.id, <?php echo $userData['id'] ?: 0; ?>)"
                               name="deliv_surname" placeholder="Priezvisko"
                               value="<?php echo $this->encryption->decrypt($userData['deliv_surname']) ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="deliv_company" class="col-md-3 control-label">Firma</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" id="deliv_company"
                               onclick="updateDeliveryData(this.id, <?php echo $userData['id'] ?: 0; ?>)"
                               name="deliv_company" placeholder="Firma"
                               value="<?php echo $userData['deliv_company'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="deliv_street" class="col-md-3 control-label">Ulica</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control deliv_street_search" id="deliv_street"
                               onclick="updateDeliveryData(this.id, <?php echo $userData['id'] ?: 0; ?>)"
                               name="deliv_street"
                               placeholder="Ulica" value="<?php echo $userData['deliv_street'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="deliv_city" class="col-md-3 control-label">Mesto</label>
                    <div class="col-md-7">
                        <input type="text" onmouseover="zipForCity('deliv_city_search', 'deliv_zip_search')"
                               id="deliv_city"
                               class="form-control deliv_city_search"
                               onclick="updateDeliveryData(this.id, <?php echo $userData['id'] ?: 0; ?>)"
                               name="deliv_city"
                               placeholder="Mesto"
                               value="<?php echo $userData['deliv_city'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="deliv_zip" class="col-md-3 control-label">PSČ</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control deliv_zip_search zip_mask" id="deliv_zip"
                               onclick="updateDeliveryData(this.id, <?php echo $userData['id'] ?: 0; ?>)"
                               name="deliv_zip"
                               placeholder="PSČ"
                               value="<?php echo $userData['deliv_zip'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="deliv_info" class="col-md-3 control-label">Informacie</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" id="deliv_info"
                               onclick="updateDeliveryData(this.id, <?php echo $userData['id'] ?: 0; ?>)"
                               name="deliv_info"
                               placeholder="Informacie napr.: poschodie, cas..."
                               value="<?php echo $userData['deliv_info'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="deliv_phone" class="col-md-3 control-label">Telefón</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control phone_mask" id="deliv_phone"
                               onclick="updateDeliveryData(this.id, <?php echo $userData['id'] ?: 0; ?>)"
                               name="deliv_phone"
                               placeholder="Kontaktny telefon pre dopravcu"
                               value="<?php echo $userData['deliv_phone'] ?: '+421' ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="control-label">
            <div class="checkbox" style="padding-bottom: 7px">
                <label><input type="checkbox" class="show-company-data" data-toggle="collapse"
                              data-target="#company-data"> Vyplnit firemné údaje</label>
            </div>
            <div id="company-data" class="collapse">
                <hr>
                <div class="form-group">
                    <label class="col-md-6 control-label">Firemne udaje. Nezabudnite vyplniť IČO a IČ DPH, ak ste
                        firma.</label>
                </div>
                <div class="form-group">
                    <label for="comp_ico" class="col-md-3 control-label">IČO</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="comp_ico" id="comp_ico"
                               onclick="updateCompanyData(this.id, <?php echo $userData['id'] ?: 0 ?>)"
                               placeholder="IČO" value="<?php echo $userData['comp_ico'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="comp_dic" class="col-md-3 control-label">DIČ</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="comp_dic" id="comp_dic"
                               onclick="updateCompanyData(this.id, <?php echo $userData['id'] ?: 0; ?>)"
                               placeholder="DIČ" value="<?php echo $userData['comp_dic'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="comp_icdph" class="col-md-3 control-label">IČ DPH</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="comp_icdph" placeholder="IČ DPH" id="comp_icdph"
                               onclick="updateCompanyData(this.id, <?php echo $userData['id'] ?: 0; ?>)"
                               value="<?php echo $userData['comp_icdph'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="comp_bic" class="col-md-3 control-label">BIC (SWIFT)</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="comp_bic" placeholder="BIC (SWIFT)" id="comp_bic"
                               onclick="updateCompanyData(this.id, <?php echo $userData['id'] ?: 0; ?>)"
                               value="<?php echo $userData['comp_bic'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="comp_iban" class="col-md-3 control-label">IBAN</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="comp_iban" placeholder="IBAN" id="comp_iban"
                               onclick="updateCompanyData(this.id, <?php echo $userData['id'] ?: 0; ?>)"
                               value="<?php echo $this->encryption->decrypt($userData['comp_iban']) ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="comp_bank_owner" class="col-md-3 control-label">Meno majiteľa bankového
                        účtu</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="comp_bank_owner" id="comp_bank_owner"
                               onclick="updateCompanyData(this.id, <?php echo $userData['id'] ?: 0; ?>)"
                               placeholder="Meno majiteľa bankového účtu"
                               value="<?php echo $this->encryption->decrypt($userData['comp_bank_owner']) ?>">
                    </div>
                </div>
            </div>
        </div>
        <a href="<?php echo base_url('ShippingAndBilling?id=1'); ?>" class="btn btn-default">
            <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Spat
        </a>
        <button style="float: right" type="submit" class="btn btn-success">Dalej
            <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
        </button>
        <?php echo form_close(); ?>
    </div>
</div>
<script>
    autocompleteCityStreetZip();
    shippingOptionsForm();
</script>