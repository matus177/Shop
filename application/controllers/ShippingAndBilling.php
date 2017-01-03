<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ShippingAndBilling extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ProductModel');
    }

    public function index()
    {
        var_dump($this->a());
        $a['e'] = $this->a();
        $this->load->view('HeaderView');
        $this->load->view('UpperMenuView');
        $this->load->view('LeftMenuView');
        $this->load->view('ShippingAndBillingView', $a);
        $this->load->view('FooterView');
    }

    public function a()
    {
        return $id = $this->uri->segment(3);
    }
}