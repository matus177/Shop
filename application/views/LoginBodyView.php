<div class="container">
    <div id="loginbox" class="mainbox col-md-9">
        <div class="panel panel-info">
            <div class="panel-heading">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="panel-title">Prihlasenie</div>
            </div>
            <div class="panel-body">
                <?php echo form_open('Login/login',
                    ['id' => 'form_login', 'class' => 'form-horizontal', 'role' => 'form']); ?>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input id="login-username" type="email" class="form-control" name="email" placeholder="Email"
                           required>
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="login-password" type="password" class="form-control" name="password"
                           placeholder="Heslo" required>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 controls">
                        <button type="submit" class="btn btn-success">Prihlasit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Zatvorit</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
                <?php echo form_open('ResetPassword/resetPasswordByEmail',
                    ['id' => 'form_resert_password', 'class' => 'form-horizontal', 'role' => 'form']); ?>
                <div class="form-group">
                    <div class="col-md-12">
                        <a href="<?php echo base_url('registration'); ?>">Registracia</a>
                        <div class="forgot-pass">
                            <a style="cursor:pointer" id="reset_password_button" class="reset_password"
                               data-toggle="collapse"
                               data-target="#reset_password">Zabudli Ste Heslo?</a>
                        </div>
                    </div>
                </div>
                <div id="reset_password" class="collapse">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input id="login-username" type="email" class="form-control" name="email"
                               placeholder="Email pre obnovu hesla" required>
                    </div>
                    <button type="submit" class="btn btn-success">Poslat heslo</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>