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
        $this->load->view('OrdersSingleUserTableView');
        $this->load->view('FooterView');
    }

    public function fillLoggedOutOrdersTable()
    {
        $logOutOrders = $this->OrderModel->selectLogOutOrder();
        for ($i = 0; $i < sizeof($logOutOrders); $i++)
        {
            $logOutOrders[$i]->fact_name = $this->encryption->decrypt($logOutOrders[$i]->fact_name);
            $logOutOrders[$i]->fact_surname = $this->encryption->decrypt($logOutOrders[$i]->fact_surname);
            $logOutOrders[$i]->deliv_name = $this->encryption->decrypt($logOutOrders[$i]->deliv_name);
            $logOutOrders[$i]->deliv_surname = $this->encryption->decrypt($logOutOrders[$i]->deliv_surname);
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($logOutOrders));
    }

    public function fillLoggedInOrdersTable()
    {
        $logInOrders = $this->OrderModel->selectAllOrder();
        for ($i = 0; $i < sizeof($logInOrders); $i++)
        {
            $logInOrders[$i]->fact_name = $this->encryption->decrypt($logInOrders[$i]->fact_name);
            $logInOrders[$i]->fact_surname = $this->encryption->decrypt($logInOrders[$i]->fact_surname);
            $logInOrders[$i]->deliv_name = $this->encryption->decrypt($logInOrders[$i]->deliv_name);
            $logInOrders[$i]->deliv_surname = $this->encryption->decrypt($logInOrders[$i]->deliv_surname);
            $logInOrders[$i]->comp_iban = $this->encryption->decrypt($logInOrders[$i]->comp_iban);
            $logInOrders[$i]->comp_bank_owner = $this->encryption->decrypt($logInOrders[$i]->comp_bank_owner);
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($logInOrders));
    }

    public function fillUserOrdersTable()
    {
        $userId = $this->encryption->decrypt($this->session->userdata('id'));
        $this->output->set_content_type('application/json')->set_output(json_encode($this->OrderModel->selectLogInOrder($userId)));
    }

    public function updateLoggedInOrderStatus()
    {
        $orderData = $this->input->post();
        $this->OrderModel->updateLogInOrderTable($orderData) ? $this->session->set_flashdata('category_success', 'Objednavka bola aktualizovana.') :
            $this->session->set_flashdata('category_danger', 'Objednavka nebola aktualizovana.');
        redirect('Admin/index/OrdersLoggedInTableView');
    }

    public function updateLoggedOutOrderStatus()
    {
        $orderData = $this->input->post();
        $this->OrderModel->updateLogOutOrderTable($orderData) ? $this->session->set_flashdata('category_success', 'Objednavka bola aktualizovana.') :
            $this->session->set_flashdata('category_danger', 'Objednavka nebola aktualizovana.');
        redirect('Admin/index/OrdersLoggedOutTableView');
    }

    public function getNumberOfUnclosedLogInOrders()
    {
        echo $this->OrderModel->selectNumberOfUnclosedLogInOrders('hotovo');
    }

    public function getNumberOfUnclosedLogOutOrders()
    {
        echo $this->OrderModel->selectNumberOfUnclosedLogOutOrders('hotovo');
    }
}