<div class="col-sm-3">
    <div class="sidebar-nav">
        <div class="navbar navbar-default" role="navigation">
            <div class="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li id="basic_info">
                        <a href='<?php echo base_url('UserAccountSettings/updateAccount/UserAccountBasicInfoView'); ?>'>Zakladne
                            informacie
                        </a>
                    </li>
                    <li id="delivery_info">
                        <a href='<?php echo base_url('UserAccountSettings/updateAccount/UserAccountDeliveryAddressView'); ?>'>Dorucovacie
                            adresy
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<script>
    markCurrentBar('<?php echo $markCurrentBar; ?>');
</script>