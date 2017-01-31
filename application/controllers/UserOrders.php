<?php defined('BASEPATH') OR exit('No direct script access allowed');

class UserOrders extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        var_dump($this->a());
        $this->load->view('HeaderView');
        $this->load->view('UpperMenuView');
        $this->load->view('LeftMenuView');
        $this->load->view('UserOrdersView');
        $this->load->view('FooterView');
    }

    public function a()
    {
        $this->output->set_content_type('application/json')->set_output(json_encode(array('name' => 'name')));
    }
}