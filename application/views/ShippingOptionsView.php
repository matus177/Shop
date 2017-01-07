<div class="col-md-9 col-sm-offset-3">
    <?php $this->load->view('FlashMessagesView'); ?>
    <div class="panel-body">
        <hr>
        <p><b>Fakturačné údaje</b></p>
        <?php echo form_open('ShippingOptions/checkShippingOptions', ['id' => 'form_shipping_options', 'class' => 'form-horizontal', 'role' => 'form']); ?>
        <div class="required-fields">
            <div class="form-group">
                <label for="email" class="col-md-3 control-label">Email</label>
                <div class="col-md-7">
                    <input type="email" class="form-control" name="email"
                           placeholder="Email">
                </div>
            </div>
            <div class="form-group">
                <label for="fact_name" class="col-md-3 control-label">Meno</label>
                <div class="col-md-7">
                    <input type="text" class="form-control" name="fact_name"
                           placeholder="Meno">
                </div>
            </div>
            <div class="form-group">
                <label for="fact_surname" class="col-md-3 control-label">Priezvisko</label>
                <div class="col-md-7">
                    <input type="text" class="form-control" name="fact_surname"
                           placeholder="Priezvisko">
                </div>
            </div>
            <div class="form-group">
                <label for="fact_street" class="col-md-3 control-label">Ulica</label>
                <div class="col-md-7">
                    <input type="text" class="form-control street-search" name="fact_street"
                           placeholder="Ulica">
                </div>
            </div>
            <div class="form-group">
                <label for="fact_city" class="col-md-3 control-label">Mesto</label>
                <div class="col-md-7">
                    <input type="text" onmouseover="zipForCity('city-search', 'zip-search_fact')"
                           class="form-control city-search"
                           name="fact_city" placeholder="Mesto">
                </div>
            </div>
            <div class="form-group">
                <label for="fact_zip" class="col-md-3 control-label">PSČ</label>
                <div class="col-md-7">
                    <input type="text" class="form-control zip-search_fact" name="fact_zip" placeholder="PSČ">
                </div>
            </div>
            <div class="form-group">
                <label for="fact_phone" class="col-md-3 control-label">Telefón</label>
                <div class="col-md-7">
                    <input type="text" class="form-control" name="fact_phone"
                           placeholder="Telefón">
                </div>
            </div>
        </div>
        <div class="control-label">
            <div class="checkbox">
                <label><input type="checkbox" class="show-delivery-data" data-toggle="collapse"
                              data-target="#delivery-data"> Zobrazit dodacie údaje</label>
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
                        <input type="text" class="form-control" name="deliv_name" placeholder="Meno">
                    </div>
                </div>
                <div class="form-group">
                    <label for="deliv_surname" class="col-md-3 control-label">Priezvisko</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="deliv_surname" placeholder="Priezvisko">
                    </div>
                </div>
                <div class="form-group">
                    <label for="deliv_company" class="col-md-3 control-label">Firma</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="deliv_company" placeholder="Firma">
                    </div>
                </div>
                <div class="form-group">
                    <label for="deliv_street" class="col-md-3 control-label">Ulica</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control street-search" name="deliv_street" placeholder="Ulica">
                    </div>
                </div>
                <div class="form-group">
                    <label for="deliv_city" class="col-md-3 control-label">Mesto</label>
                    <div class="col-md-7">
                        <input type="text" onmouseover="zipForCity('deliv-city-search', 'zip-search_deliv')"
                               class="form-control deliv-city-search" name="deliv_city" placeholder="Mesto">
                    </div>
                </div>
                <div class="form-group">
                    <label for="deliv_zip" class="col-md-3 control-label">PSČ</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control zip-search_deliv" name="deliv_zip" placeholder="PSČ">
                    </div>
                </div>
                <div class="form-group">
                    <label for="deliv_info" class="col-md-3 control-label">Informacie</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="deliv_info"
                               placeholder="Informacie napr.: poschodie, cas...">
                    </div>
                </div>
                <div class="form-group">
                    <label for="deliv_phone" class="col-md-3 control-label">Telefón</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="deliv_phone"
                               placeholder="Kontaktny telefon pre dopravcu">
                    </div>
                </div>
            </div>
        </div>
        <div class="control-label">
            <div class="checkbox" style="padding-bottom: 7px">
                <label><input type="checkbox" class="show-company-data" data-toggle="collapse"
                              data-target="#company-data"> Zobrazit firemné údaje</label>
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
                        <input type="text" class="form-control" name="comp_ico"
                               placeholder="IČO">
                    </div>
                </div>
                <div class="form-group">
                    <label for="comp_dic" class="col-md-3 control-label">DIČ</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="comp_dic"
                               placeholder="DIČ">
                    </div>
                </div>
                <div class="form-group">
                    <label for="comp_icdph" class="col-md-3 control-label">IČ DPH</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="comp_icdph" placeholder="IČ DPH">
                    </div>
                </div>
                <div class="form-group">
                    <label for="comp_bic" class="col-md-3 control-label">BIC (SWIFT)</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="comp_bic" placeholder="BIC (SWIFT)">
                    </div>
                </div>
                <div class="form-group">
                    <label for="comp_iban" class="col-md-3 control-label">IBAN</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="comp_iban" placeholder="IBAN">
                    </div>
                </div>
                <div class="form-group">
                    <label for="comp_bank_owner" class="col-md-3 control-label">Meno majiteľa bankového
                        účtu</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="comp_bank_owner"
                               placeholder="Meno majiteľa bankového účtu">
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
                url: 'Registration/searchZipForCity',
                type: 'GET',
                data: searchTerm,
                success: function (data) {
                    $('.' + factOrDelivZip).val(data);
                }
            })
        });
    }
</script>