<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo base_url('Home'); ?>">Matus Shop</a>
        </div>
        <ul class="nav navbar-nav">
            <?php if ($this->encryption->decrypt($this->session->role) == 'Admin')
            { ?>
                <li><a href="<?php echo base_url("Admin"); ?>"><span class="glyphicon glyphicon-eye-open"></span> Admin</a>
                </li>
            <?php } ?>
            <?php if ($this->session->userdata("logged_in"))
            { ?>
                <li>
                    <a href="<?php echo base_url('UserAccountSettings/updateAccount/UserAccountBasicInfoView'); ?>"><span
                                class="glyphicon glyphicon-cog"></span> Nastavenie uctu</a>
                </li>
            <?php } ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li>
                <a id="cart" style="font-size: 20px" href="<?php echo base_url('Cart'); ?>"><span
                            class="glyphicon glyphicon-shopping-cart"><sup><?php echo $this->cart->total_items(); ?></sup></span></a>
            </li>
            <?php if ($this->session->userdata('logged_in'))
            { ?>
                <li><a href="<?php echo base_url('Login/logout'); ?>"><span class="glyphicon glyphicon-log-out">
                        </span> Odhlasit sa</a></li>
            <?php } else
            { ?>
                <li><a href="" data-toggle="modal" data-target="#myModal">
                        <span class="glyphicon glyphicon-log-in"></span> Prihlasit sa</a></li>
                <div class="modal fade" id="myModal" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog">
                        <div class="modal-body"><?php $this->load->view('LoginBodyView'); ?></div>
                    </div>
                </div>
            <?php } ?>
        </ul>
    </div>
</nav>
<div class="container-fluid">
    <div class="row">