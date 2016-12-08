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

    public function updateOldPassword()
    {
        $inputDatas = $this->input->post();
        $userId = $this->encryption->decrypt($this->session->id);
        $userData = $this->session->userdata;

        $this->form_validation->set_rules('oldPass', 'Stare heslo', 'required|xss_clean|max_length[30]');
        $this->form_validation->set_rules('newPass', 'Nove heslo', 'required|matches[cPass]|xss_clean|max_length[30]');
        $this->form_validation->set_rules('cPass', 'Opakovane heslo', 'required|xss_clean|max_length[30]');
        $this->form_validation->set_message('matches', 'Hesla sa nezhoduju.');
        $this->session->unset_userdata($userData);

        if ($this->form_validation->run()) {
            if (!is_null($this->UserModel->checkOldPassword($inputDatas['oldPass'], $userId))) {
                $newPass = hash('sha512', $inputDatas['newPass']);
                $this->UserModel->updateOldPassword($newPass, $userId);
                $this->session->unset_userdata($userData);
                $this->session->set_flashdata('category_success', 'Heslo bolo zmenene. Boli ste odhlaseny.');
                redirect('Home');
            } else {
                $this->session->set_flashdata('category_danger', 'Chybne zadane stare heslo.');
            }
        } else {
            $this->session->set_flashdata('category_warning', validation_errors());
        }

        redirect('UserAccountSettings/updateAccount/UserAccountBasicInfoView');
    }
}