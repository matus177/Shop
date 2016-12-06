<?php defined('BASEPATH') OR exit('No direct script access allowed');

class UserAccountSettings extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
    }

    public function updateAccount($view)
    {
        var_dump($this->userInfo());
        $this->load->view('HeaderView');
        $this->load->view('UpperMenuView');
        $this->load->view('UserAccountSettingsMenuView');
        $this->load->view($view, array('data' => $this->userInfo()));
        $this->load->view('FooterView');
    }

    public function userInfo()
    {
        $data = $this->encryption->decrypt($this->session->userdata('id'));
        return $this->UserModel->getAllUserData($data);
    }

    public function updateEmail()
    {
        $email = $this->input->get('email');
        $id = $this->input->get('id');
        $this->UserModel->updateEmail($email, $id);
    }

    public function updatePhone()
    {
        $phone = $this->input->get('phone');
        $id = $this->input->get('id');
        $this->UserModel->updatePhone($phone, $id);
    }
}