<div class="col-md-10 col-md-offset-1">
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="panel-title">Registracia</div>
        </div>
        <div class="panel-body">
            <?php echo form_open('Registration/registerNewUser', ['id' => 'form-register', 'class' => 'form-horizontal', 'role' => 'form']); ?>
            <div class="required-fields">
                <div class="form-group">
                    <label for="email" class="col-md-3 control-label">Email</label>
                    <div class="col-md-9">
                        <input type="email" class="form-control" name="email"
                               placeholder="Email slúži ako login" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-md-3 control-label">Heslo</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control" name="password" placeholder="Heslo" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cpassword" class="col-md-3 control-label">Potvrdenie hesla</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control" name="cpassword"
                               placeholder="Potvrdenie hesla" required>
                    </div>
                </div>
            </div>
            <div class="control-label">
                <button type="button" onClick="changeIcon('facture-data', this.id)" id="facture_data_button"
                        class="btn btn-info col-md-12" data-toggle="collapse"
                        data-target="#facture-data"><span class="glyphicon glyphicon-plus"></span> Fakturačné údaje
                </button>
                <div id="facture-data" class="collapse">
                    <div class="required-fields">
                        <div class="form-group">
                            <label for="fact_name" class="col-md-3 control-label">Meno</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="fact_name"
                                       placeholder="Meno" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fact_surname" class="col-md-3 control-label">Priezvisko</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="fact_surname"
                                       placeholder="Priezvisko" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fact_street" class="col-md-3 control-label">Ulica</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control street-search" name="fact_street"
                                       placeholder="Ulica" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fact_city" class="col-md-3 control-label">Mesto</label>
                            <div class="col-md-9">
                                <input type="text" onmouseover="zipForCity('city-search', 'zip-search_fact')"
                                       class="form-control city-search"
                                       name="fact_city" placeholder="Mesto" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fact_zip" class="col-md-3 control-label">PSČ</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control zip-search_fact zip_mask" name="fact_zip"
                                       placeholder="PSČ" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fact_phone" class="col-md-3 control-label">Telefón</label>
                            <div class="col-md-9">
                                <input type="tel" class="form-control phone_mask" name="fact_phone"
                                       placeholder="Telefón" value="+421"
                                       pattern=".{7,}" title="+421 xxx xxx xxx" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="control-label">
                <button type="button" onClick="changeIcon('delivery-data', this.id)" id="delivery_data_button"
                        class="btn btn-info col-md-12 show-delivery-data" data-toggle="collapse"
                        data-target="#delivery-data"><span class="glyphicon glyphicon-plus"></span> Dodacie údaje
                </button>
                <div id="delivery-data" class="collapse">
                    <div class="form-group">
                        <label class="col-md-5 control-label">Vyplňte v prípade, že sa líšia od
                            fakturačných.</label>
                    </div>
                    <div class="form-group">
                        <label for="deliv_name" class="col-md-3 control-label">Meno</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="deliv_name"
                                   placeholder="Meno">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="deliv_surname" class="col-md-3 control-label">Priezvisko</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="deliv_surname"
                                   placeholder="Priezvisko">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="deliv_company" class="col-md-3 control-label">Firma</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="deliv_company"
                                   placeholder="Firma">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="deliv_street" class="col-md-3 control-label">Ulica</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control street-search" name="deliv_street"
                                   placeholder="Ulica">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="deliv_city" class="col-md-3 control-label">Mesto</label>
                        <div class="col-md-9">
                            <input type="text" onmouseover="zipForCity('deliv-city-search', 'zip-search_deliv')"
                                   class="form-control deliv-city-search" name="deliv_city" placeholder="Mesto">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="deliv_zip" class="col-md-3 control-label">PSČ</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control zip-search_deliv zip_mask" name="deliv_zip"
                                   placeholder="PSČ">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="deliv_info" class="col-md-3 control-label">Informacie</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="deliv_info"
                                   placeholder="Informacie napr.: poschodie, cas...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="deliv_phone" class="col-md-3 control-label">Telefón</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control phone_mask" name="deliv_phone"
                                   placeholder="Kontaktny telefon pre dopravcu" value="+421">
                        </div>
                    </div>
                </div>
            </div>
            <div class="control-label">
                <button type="button" onClick="changeIcon('company-data', this.id)" id="company_data_button"
                        class="btn btn-info col-md-12 show-company-data" data-toggle="collapse"
                        data-target="#company-data"><span class="glyphicon glyphicon-plus"></span> Firemné údaje
                </button>
                <div id="company-data" class="collapse">
                    <div class="form-group">
                        <label class="col-md-5 control-label">Nezabudnite vyplniť IČO a IČ DPH, ak ste
                            firma.</label>
                    </div>
                    <div class="form-group">
                        <label for="comp_ico" class="col-md-3 control-label">IČO</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="comp_ico"
                                   placeholder="IČO">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="comp_dic" class="col-md-3 control-label">DIČ</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="comp_dic"
                                   placeholder="DIČ">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="comp_icdph" class="col-md-3 control-label">IČ DPH</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="comp_icdph" placeholder="IČ DPH">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="comp_bic" class="col-md-3 control-label">BIC (SWIFT)</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="comp_bic" placeholder="BIC (SWIFT)">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="comp_iban" class="col-md-3 control-label">IBAN</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="comp_iban" placeholder="IBAN">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="comp_bank_owner" class="col-md-3 control-label">Meno majiteľa bankového
                            účtu</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="comp_bank_owner"
                                   placeholder="Meno majiteľa bankového účtu">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12 control-label">
                    <button id="button-register" type="submit" class="btn btn-success">Registrovat</button>
                </div>
            </div>
            <?php $this->load->view('FlashMessagesView'); ?>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<script>
    function changeIcon(divId, buttonId) {
        $('#' + divId).on('shown.bs.collapse', function () {
            $('#' + buttonId).find(".glyphicon").removeClass("glyphicon-plus").addClass("glyphicon-minus");
        });
        $('#' + divId).on('hidden.bs.collapse', function () {
            $('#' + buttonId).find(".glyphicon").removeClass("glyphicon-minus").addClass("glyphicon-plus");
        });
    }
</script>
<script>
    $(function () {
        $(".city-search").autocomplete({
            source: 'Registration/searchCity'
        });
        $(".deliv-city-search").autocomplete({
            source: 'Registration/searchCity'
        });
        $(".zip-search").autocomplete({
            source: 'Registration/searchZip'
        });
        $(".street-search").autocomplete({
            source: 'Registration/searchStreet'
        });
    })
</script>
<script>
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
                    $('.' + factOrDelivZip).val(data);
                }
            })
        });
    }
</script>
<script>
    $(".phone_mask").mask("+000 000 000 000");
    $(".zip_mask").mask("000 00");
</script>