<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ReviewAndPayment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $datas['data'] = $this->a();
        $this->load->view('HeaderView');
        $this->load->view('UpperMenuView');
        $this->load->view('LeftMenuView');
        $this->load->view('CheckoutView', $datas);
        $this->load->view('ReviewAndPaymentView');
        $this->load->view('FooterView');
    }

    public function a()
    {
        return $_GET['id'];
    }
}