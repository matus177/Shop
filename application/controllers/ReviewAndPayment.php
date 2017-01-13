<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ReviewAndPayment extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
    }

    public function index()
    {
        if ($this->isUserLogged()) {
            $userId = $this->encryption->decrypt($this->session->userdata('id'));
            $userData = $this->UserModel->getAllUserData($userId);
        } else {
            $userData = $this->session->userdata();
        }

        $orderData['orderStep'] = $_GET['id'];
        $this->load->view('HeaderView');
        $this->load->view('UpperMenuView');
        $this->load->view('LeftMenuView');
        $this->load->view('CheckoutView', $orderData);
        $this->load->view('ReviewAndPaymentView', array('userData' => $userData, 'shippingPrice' => $this->getShippingPrices()));
        $this->load->view('FooterView');
    }
}