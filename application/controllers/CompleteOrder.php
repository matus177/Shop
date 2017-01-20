<?php defined('BASEPATH') OR exit('No direct script access allowed');

class CompleteOrder extends MY_Controller {
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
        $this->load->view('CompleteOrderView', array('userEmail' => $this->databaseOrSessionUserData()['email']));
        $this->load->view('FooterView');
    }
}