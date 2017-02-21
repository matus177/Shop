<div class="col-md-9">
    <h3>Objednavky neregistrovanych uzivatelov</h3>
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
           data-detail-view="true"
           data-detail-formatter="detailFormatter"
           data-id-field="id"
           data-page-list="[10, 25, 50, 100, ALL]"
           data-show-footer="false"
           data-row-style="rowStyle"
           data-url="<?php echo base_url('UserOrders/fillLoggedOutOrdersTable'); ?>">
        <thead>
        <tr>
            <th data-field="operate" data-formatter="operateFormatter" data-events="operateEvents">Akcie</th>
            <th data-field="fact_name" data-sortable="true">Meno</th>
            <th data-field="fact_surname" data-sortable="true">Priezvisko</th>
            <th data-field="fact_city" data-sortable="true">Obec</th>
            <th data-field="fact_street" data-sortable="true">Ulica</th>
            <th data-field="name" data-sortable="true">Produkt</th>
            <th data-field="price" data-sortable="true">Cena &euro;</th>
            <th data-field="qty" data-sortable="true">Kusy</th>
            <th data-field="subtotal" data-sortable="true">Cena za kusy &euro;</th>
            <th data-field="date" data-sortable="true">Datum</th>
        </tr>
        </thead>
    </table>
</div>
<?php $this->load->view('OrdersStatusChangeModalView', array('function' => 'updateLoggedOutOrderStatus')); ?>
<script>
    function detailFormatter(index, row) {
        var html = [];
        html.push('<div style="float: left">');
        html.push('<p><b>Dodacie meno:</b> ' + row.deliv_name + ', ' + row.deliv_surname + '</p>');
        html.push('<p><b>Dodacie mesto:</b> ' + row.deliv_city + '</p>');
        html.push('<p><b>Dodacia ulica:</b> ' + row.deliv_street + '</p>');
        html.push('<p><b>Dodacie info:</b> ' + row.deliv_info + '</p>');
        html.push('</div>');
        html.push('<div style="float: left; text-indent: 15em">');
        html.push('<p><b>Sposob dopravy:</b> ' + row.shipping_options + '</p>');
        html.push('<p><b>Sposob platby:</b> ' + row.payment_options + '</p>');
        html.push('<p><b>Cena dopravy:</b> ' + row.delivery_price + '&euro;</p>');
        html.push('</div>');
        return html.join('');
    }

    function operateFormatter(value, row, index) {
        return [
            '<a class="edit" data-toggle="modal" data-target="#status_change" href="" title="Upravit">',
            '<i class="glyphicon glyphicon-pencil"></i>',
            '</a>  '
        ].join('');
    }

    window.operateEvents = {
        'click .edit': function (e, value, row, index) {
            $('.user_orderId_input').val(row.id);
        }
    };

    function rowStyle(row, index) {
        switch (row.status) {
            case 'prijate' :
                return {
                    classes: 'danger'
                };
                break;
            case 'odosielanie' :
                return {
                    classes: 'warning'
                };
                break;
            case 'hotovo' :
                return {
                    classes: 'success'
                };
                break;
            default :
                return {};
        }
    }
</script>