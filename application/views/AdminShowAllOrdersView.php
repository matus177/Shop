<div class="col-md-9">
    <h3>Vsetky objednavky</h3>
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
           data-url="<?php echo base_url('Admin/fillUserAllOrdersTable'); ?>">
        <thead>
        <tr>
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
<script>
    function detailFormatter(index, row) {
        var html = [];
        $.each(row, function (key, value) {
            html.push('<p><b>' + key + ':</b> ' + value + '</p>');
        });
        return html.join('');
    }
</script>
