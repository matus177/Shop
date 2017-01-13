<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($id)
    {
        $data['product'] = $this->ProductModel->selectProduct($id);
        $this->load->view('HeaderView');
        $this->load->view('UpperMenuView');
        $this->load->view('LeftMenuView');
        $this->load->view('ProductView', $data);
        $this->load->view('FooterView');
    }
}