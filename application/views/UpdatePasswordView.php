<div id="loginbox" class="mainbox col-md-9">
    <div class="panel panel-info">
        <div class="panel-heading">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="panel-title">Zmena hesla</div>
        </div>
        <div class="panel-body">
            <?php echo form_open('UserAccountSettings/updateOldPassword', ['id' => 'form_update_password', 'class' => 'form-horizontal', 'role' => 'form']); ?>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input id="old_pass" type="password" class="form-control" name="oldPass"
                       placeholder="Zadajte stare heslo" required>
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input id="new_pass" type="password" class="form-control" name="newPass"
                       placeholder="Zadajte nove heslo" required>
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input id="cpass" type="password" class="form-control" name="cPass"
                       placeholder="Zadajte znovu nove heslo" required>
            </div>
            <div class="form-group">
                <div class="col-sm-12 controls">
                    <button type="submit" class="btn btn-success">Zmenit heslo</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Zatvorit</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
