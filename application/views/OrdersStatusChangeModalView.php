<div id="status_change" class="mainbox modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="panel panel-info">
            <div class="panel-heading">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="panel-title">Stav objednavky</div>
            </div>
            <div class="panel-body">
                <?php echo form_open('UserOrders/' . $function,
                    ['class' => 'form-horizontal', 'role' => 'form']); ?>
                <input type="hidden" class="user_orderId_input" name="id" value=""/>
                <label for="status" class="control-label col-sm-4">Zmenit stav objednavky</label>
                <div class="col-sm-8">
                    <select class="form-control" name="status" id="status" required>
                        <option selected disabled>Vyberte stav</option>
                        <option value="prijate">Prijata...</option>
                        <option value="odosielanie">Odosiela sa...</option>
                        <option value="hotovo">Vybavena...</option>
                    </select>
                    <div class="form-group" style="float: right">
                        <div class="col-sm-12" style="padding-top: 15px">
                            <button type="submit" class="btn btn-success">Potvrdit</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Zatvorit</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>