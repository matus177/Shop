<div id="user_status_change" class="mainbox modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="panel panel-info">
            <div class="panel-heading">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="panel-title">Stav uzivatela</div>
            </div>
            <div class="panel-body">
                <?php echo form_open('UserManagement/changeUserStatus',
                    ['class' => 'form-horizontal', 'role' => 'form']); ?>
                <input type="hidden" class="user_id_input" name="id" value=""/>
                <input type="hidden" class="user_status_input" name="status" value=""/>
                <p class="alert_message" style="text-align: center;"></p>
                <div class="col-sm-8">
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