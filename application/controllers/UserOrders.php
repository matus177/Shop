<?php defined('BASEPATH') OR exit('No direct script access allowed');

class UserOrders extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('OrderModel');
    }

    public function index()
    {
        $this->load->view('HeaderView');
        $this->load->view('UpperMenuView');
        $this->load->view('LeftMenuView');
        $this->load->view('UserOrdersView');
        $this->load->view('FooterView');
    }

    public function fillUserOrdersTable()
    {
        $userId = $this->encryption->decrypt($this->session->userdata('id'));
        $this->output->set_content_type('application/json')->set_output(json_encode($this->OrderModel->selectLogInOrder($userId)));
    }
}