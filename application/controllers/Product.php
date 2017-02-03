<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function index($subCategoryId)
    {
        $this->load->view('HeaderView');
        $this->load->view('UpperMenuView');
        $this->load->view('LeftMenuView');
        $this->load->view('ProductView', array('product' => $this->ProductModel->selectProduct(array('subcategory_id' => $subCategoryId)), 'isAdmin' => ($this->encryption->decrypt($this->session->role) == 'Admin')));
        $this->load->view('FooterView');
    }
}