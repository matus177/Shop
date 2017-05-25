<?php defined('BASEPATH') OR exit('No direct script access allowed');

class UserManagement extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
    }

    public function index()
    {
        $this->load->view('HeaderView');
        $this->load->view('UpperMenuView');
        $this->load->view('LeftMenuView');
        $this->load->view('UserManagementView');
        $this->load->view('FooterView');
    }

    public function fillUserManagementTable()
    {
        $users = $this->UserModel->getAllUserData();

        for ($i = 0; $i < sizeof($users); $i++)
        {
            $users[$i]->fact_name = $this->encryption->decrypt($users[$i]->fact_name);
            $users[$i]->fact_surname = $this->encryption->decrypt($users[$i]->fact_surname);
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($users));
    }

    public function changeUserStatus()
    {
        $this->UserModel->updateStatus($this->input->post());
        redirect(base_url('UserManagement'));
    }
}