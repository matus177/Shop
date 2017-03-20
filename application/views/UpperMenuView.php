<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo base_url('Home'); ?>">Matus Shop</a>
        </div>
        <ul class="nav navbar-nav">
            <?php if ($this->encryption->decrypt($this->session->role) == 'Admin')
            { ?>
                <li style="padding-top: 15px; cursor: pointer">
                    <div class="dropdown">
                        <span class="dropdown-toggle admin_button_dropdown" data-toggle="dropdown"><span
                                    class="glyphicon glyphicon-eye-open"></span> Admin <span
                                    class="caret"></span></span>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url("Admin/index/AdminAddProductView"); ?>">Vytvorenie
                                    kategorie, podkategorie a produktu</a></li>
                            <li><a href="<?php echo base_url("Admin/index/AdminUpdateCategoryAndSubCategoryView"); ?>">Uprava/presun
                                    kategorie a podkategorie</a></li>
                            <li class="divider"></li>
                            <li><a class="logout_orders"
                                   href="<?php echo base_url("Admin/index/OrdersLoggedOutTableView"); ?>">
                                    Objednavky neregistrovanych uzivatelov
                                </a>
                            </li>
                            <li><a class="login_orders"
                                   href="<?php echo base_url("Admin/index/OrdersLoggedInTableView"); ?>">
                                    Objednavky registrovanych uzivatelov
                                </a>
                            </li>
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
                <a id="cart" href="<?php echo base_url('Cart'); ?>"><span
                            class="glyphicon glyphicon-shopping-cart"></span> <sup><span
                                class="badge progress-bar-info"><?php echo $this->cart->total_items(); ?></span></sup>
                </a>
            </li>
            <?php if ($this->session->userdata('logged_in'))
            { ?>
                <li style="padding-top: 15px">
                    <span class="glyphicon glyphicon-user"></span> <?php echo $this->encryption->decrypt($this->session->fact_name) . ' ' . $this->encryption->decrypt($this->session->fact_surname); ?>
                </li>
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
        <script>
            numberOfOrdersIcon();
        </script>