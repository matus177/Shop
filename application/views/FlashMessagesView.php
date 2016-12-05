<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if ($this->session->flashdata('category_success')) { ?>
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong><?= $this->session->flashdata('category_success') ?></strong>
    </div>
<?php } ?>
<?php if ($this->session->flashdata('category_danger')) { ?>
    <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong><?= $this->session->flashdata('category_danger') ?></strong>
    </div>
<?php } ?>
<?php if ($this->session->flashdata('category_info')) { ?>
    <div class="alert alert-info">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong><?= $this->session->flashdata('category_info') ?></strong>
    </div>
<?php } ?>
<?php if ($this->session->flashdata('category_warning')) { ?>
    <div class="alert alert-warning">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong><?= $this->session->flashdata('category_warning') ?></strong>
    </div>
<?php } ?>
