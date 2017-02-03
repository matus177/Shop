<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo base_url('Home'); ?>">Matus Shop</a>
        </div>
        <ul class="nav navbar-nav">
            <?php if ($this->encryption->decrypt($this->session->role) == 'Admin')
            { ?>
                <li>
                    <div class="dropdown admin_button_dropdown">
                        <a class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><span
                                    class="glyphicon glyphicon-eye-open"></span> Admin <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url("Admin/index/AdminAddProductView"); ?>">Vytvorenie
                                    kategorie, podkategorie a produktu</a></li>
                            <li><a href="<?php echo base_url("Admin/index/AdminUpdateCategoryAndSubCategoryView"); ?>">Uprava/presun
                                    kategorie a podkategorie</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo base_url("Admin/index/AdminShowLoggedOutOrdersView"); ?>">Zobrazit
                                    objednavky neregistrovanych uzivatelov</a></li>
                            <li><a href="<?php echo base_url("Admin/index/AdminShowAllOrdersView"); ?>">Zobrazit vsetky
                                    objednavky</a></li>
                        </ul>
                    </div>
                </li>
            <?php } ?>
            <?php if ($this->session->userdata("logged_in"))
            { ?>
                <li>
                    <a href="<?php echo base_url('UserAccountSettings/updateAccount/UserAccountBasicInfoView'); ?>"><span
                                class="glyphicon glyphicon-cog"></span> Nastavenie uctu</a>
                </li>
                <li>
                    <a href="<?php echo base_url('UserOrders'); ?>"><span
                                class="glyphicon glyphicon-search"></span> Moje objednavky</a>
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