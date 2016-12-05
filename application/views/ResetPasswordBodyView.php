<div class="container">
    <div id="reset_password_form" class="col-md-8 col-md-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">Zmena hesla</div>
            </div>
            <div class="panel-body">
                <?php echo form_open('ResetPassword/resetPassword', ['id' => 'form_update', 'class' => 'form-horizontal', 'role' => 'form']); ?>
                <div class="input-group">
                    <?php if (isset($emailHash, $emailCode)) { ?>
                        <input type="hidden" value="<?php echo $emailHash ?>" name="emailHash">
                        <input type="hidden" value="<?php echo $emailCode ?>" name="emailCode">
                    <?php } ?>
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <input id="email" type="email" class="form-control"
                           value="<?php echo (isset($email)) ? $email : ''; ?>" name="email" placeholder="Email"
                           required>
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="reset-password" type="password" class="form-control" name="password"
                           placeholder="Heslo" required>
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="reset-confpassword" type="password" class="form-control" name="confpassword"
                           placeholder="Znovu Heslo" required>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 controls">
                        <button type="submit" class="btn btn-success">Zmenit heslo</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>