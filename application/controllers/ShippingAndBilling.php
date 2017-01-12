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
        $orderData['orderStep'] = $_GET['id'];
        $this->load->view('HeaderView');
        $this->load->view('UpperMenuView');
        $this->load->view('LeftMenuView');
        $this->load->view('CheckoutView', $orderData);
        $this->load->view('ShippingAndBillingView', array('shippingData' => $this->getShippingPrices(), 'helpVar' => 's'));
        $this->load->view('FooterView');
    }

    public function getShippingPrices()
    {
        return $this->ProductModel->selectShippingPrices();
    }

    public function a()
    {
        var_dump($this->input->post());
        die();
        foreach ($this->input->post() as $key => $value) {
            $shippingAndBillingData[$key] = $value;
        }
        $this->session->set_userdata($shippingAndBillingData);
        redirect('ShippingOptions?id=2');
    }
}