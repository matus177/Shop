<div class="col-md-9">
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
           data-url="<?php echo base_url('UserOrders/fillUserOrdersTable'); ?>">
        <thead>
        <tr>
            <th data-field="name" data-sortable="true">Produkt</th>
            <th data-field="price" data-sortable="true">Cena &euro;</th>
            <th data-field="qty" data-sortable="true">Kusy</th>
            <th data-field="subtotal" data-sortable="true">Cena za kusy &euro;</th>
            <th data-field="shipping_options" data-sortable="true">Doprava</th>
            <th data-field="payment_options" data-sortable="true">Platba</th>
            <th data-field="delivery_price" data-sortable="true">Cena za dopravu/platbu &euro;</th>
            <th data-field="date" data-sortable="true">Datum</th>
        </tr>
        </thead>
    </table>
</div>
