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
            $userData['userData'] = $this->UserModel->getAllUserData($userId);
            var_dump($userData);

        } else {
            $userData['userData'] = $this->session->userdata();

        }

        $orderData['orderStep'] = $_GET['id'];
        $this->load->view('HeaderView');
        $this->load->view('UpperMenuView');
        $this->load->view('LeftMenuView');
        $this->load->view('CheckoutView', $orderData);
        $this->load->view('ReviewAndPaymentView', $userData);
        $this->load->view('FooterView');
    }
}