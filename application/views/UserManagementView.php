<div class="col-md-9">
    <?php $this->load->view('FlashMessagesView'); ?>
    <h3>Sprava uzivatelov</h3>
    <table id="table" data-toggle="table"
           data-toolbar="#toolbar"
           data-search="true"
           data-show-refresh="true"
           data-show-toggle="true"
           data-show-columns="true"
           data-show-export="true"
           data-minimum-count-columns="2"
           data-show-pagination-switch="true"
           data-pagination="true"
           data-id-field="id"
           data-page-list="[10, 25, 50, 100, ALL]"
           data-show-footer="false"
           data-url="<?php echo base_url('UserManagement/fillUserManagementTable'); ?>">
        <thead>
        <tr>
            <th data-field="operate" data-formatter="operateFormatter" data-events="operateEvents">Akcie</th>
            <th data-field="fact_name" data-sortable="true">Meno</th>
            <th data-field="fact_surname" data-sortable="true">Priezvisko</th>
            <th data-field="fact_city" data-sortable="true">Obec</th>
            <th data-field="fact_street" data-sortable="true">Ulica</th>
            <th data-field="email" data-sortable="true">E-mail</th>
            <th data-field="status" data-sortable="true">Stav</th>
        </tr>
        </thead>
    </table>
</div>
<?php $this->load->view('UserManagementStatusChangeModalView'); ?>
<script>
    function operateFormatter(value, row, index) {
        if (row.status == 1) {
            return [
                '<a class="btn-sm btn-danger status_block" data-toggle="modal" data-target="#user_status_change" href="" title="Zablokovat uzivatela">',
                '<span class="glyphicon glyphicon-ban-circle"></span>',
                '</a>  '
            ].join('');
        } else {
            return [
                '<a class="btn-sm btn-success status_active" data-toggle="modal" data-target="#user_status_change" href="" title="Odblokovat uzivatela">',
                '<span class="glyphicon glyphicon-ok-circle"></span>',
                '</a>  '
            ].join('');
        }
    }

    window.operateEvents = {
        'click .status_block': function (e, value, row, index) {
            $('.user_id_input').val(row.id);
            $('.user_status_input').val(2);
            $('.alert_message').text('Ste si naozaj isty ze chcete zablokovat uzivatela?');

        },
        'click .status_active': function (e, value, row, index) {
            $('.user_id_input').val(row.id);
            $('.user_status_input').val(1);
            $('.alert_message').text('Ste si naozaj isty ze chcete odblokovat uzivatela?');
        }
    };
</script>