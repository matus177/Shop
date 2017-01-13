<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ShippingAndBilling extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $orderData['orderStep'] = $_GET['id'];
        $this->load->view('HeaderView');
        $this->load->view('UpperMenuView');
        $this->load->view('LeftMenuView');
        $this->load->view('CheckoutView', $orderData);
        $this->load->view('ShippingAndBillingView', array('shippingData' => $this->getShippingPrices(), 'shippingPrice' => ''));
        $this->load->view('FooterView');
    }

    public function checkShippingAndBilling()
    {
        foreach ($this->input->post() as $key => $value) {
            $shippingAndBillingData[$key] = $value;
            switch ($key) {
                case 'osobny_odber':
                    $shippingAndBillingData['shipping_options'] = 'osobny odber';
                    break;
                case 'courier':
                    $shippingAndBillingData['shipping_options'] = 'kurierom';
                    break;
                case 'slovak_post':
                    $shippingAndBillingData['shipping_options'] = 'postou';
                    break;
                case 'dobierka':
                    $shippingAndBillingData['payment_options'] = 'dobierkou';
                    break;
                case 'hotovost':
                    $shippingAndBillingData['payment_options'] = 'v hotovosti';
                    break;
                case 'card':
                    $shippingAndBillingData['payment_options'] = 'kartou';
                    break;
            }
        }
        $this->session->set_userdata($shippingAndBillingData);
        redirect('ShippingOptions?id=2');
    }
}