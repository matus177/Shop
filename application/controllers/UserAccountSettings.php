<?php defined('BASEPATH') OR exit('No direct script access allowed');

class UserAccountSettings extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
    }

    public function updateAccount($view)
    {
        $this->load->view('HeaderView');
        $this->load->view('UpperMenuView');
        $this->load->view('UserAccountSettingsMenuView', array('markCurrentBar' => $view));
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
        if ($this->UserModel->isUserExist($email))
        {
            echo 'emailIsUsed';
        } else
        {
            $this->UserModel->updateEmail($email, $id);
        }
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
        $userData = array('id', 'email', 'role', 'fact_name', 'fact_surname', 'logged_in');

        $this->form_validation->set_rules('oldPass', 'Stare heslo', 'required|xss_clean|max_length[30]');
        $this->form_validation->set_rules('newPass', 'Nove heslo', 'required|xss_clean|min_length[8]|max_length[30]|callback_password_check');
        $this->form_validation->set_rules('cPass', 'Opakovane heslo', 'required|matches[newPass]|xss_clean');
        $this->form_validation->set_message('matches', 'Hesla sa nezhoduju.');
        $this->form_validation->set_message('min_length', 'Heslo musi mat minimalne 8 znakov.');
        $this->form_validation->set_message('max_length', '%s nesmie mat viac ako 30 znakov.');

        if ($this->form_validation->run())
        {
            if ( ! is_null($this->UserModel->checkOldPassword($inputDatas['oldPass'], $userId)))
            {
                $newPass = hash('sha512', $inputDatas['newPass']);
                $this->UserModel->updateOldPassword($newPass, $userId);
                $this->session->unset_userdata($userData);
                $this->session->set_flashdata('category_success', 'Heslo bolo zmenene. Boli ste odhlaseny.');
                echo json_encode(array($this->security->get_csrf_hash(), 'ok'));
            } else
            {
                echo  json_encode(array($this->security->get_csrf_hash(), 'badPass'));
            }
        } else
        {
            echo  json_encode(array($this->security->get_csrf_hash(), validation_errors()));
        }
    }

    public function updateCompanyData()
    {
        $idOfUser = $this->input->get('id');
        $idOfInput = $this->input->get('input');
        $data = $this->input->get('data');

        switch ($idOfInput)
        {
            case 'comp_ico':
                $this->UserModel->updateCompanyData($idOfUser, $idOfInput, $data);
                break;
            case 'comp_dic':
                $this->UserModel->updateCompanyData($idOfUser, $idOfInput, $data);
                break;
            case 'comp_icdph':
                $this->UserModel->updateCompanyData($idOfUser, $idOfInput, $data);
                break;
            case 'comp_bic':
                $this->UserModel->updateCompanyData($idOfUser, $idOfInput, $data);
                break;
            case 'comp_iban':
                $data = $this->encryption->encrypt($data);
                $this->UserModel->updateCompanyData($idOfUser, $idOfInput, $data);
                break;
            case 'comp_bank_owner':
                $data = $this->encryption->encrypt($data);
                $this->UserModel->updateCompanyData($idOfUser, $idOfInput, $data);
                break;
            default:
                echo 'System error';
        }
    }

    public function updateDeliveryData()
    {
        $idOfUser = $this->input->get('id');
        $idOfInput = $this->input->get('input');
        $data = $this->input->get('data');

        switch ($idOfInput)
        {
            case 'deliv_name':
                $data = $this->encryption->encrypt($data);
                $this->UserModel->updateDeliveryData($idOfUser, $idOfInput, $data);
                break;
            case 'deliv_surname':
                $data = $this->encryption->encrypt($data);
                $this->UserModel->updateDeliveryData($idOfUser, $idOfInput, $data);
                break;
            case 'deliv_company':
                $this->UserModel->updateDeliveryData($idOfUser, $idOfInput, $data);
                break;
            case 'deliv_street':
                $this->UserModel->updateDeliveryData($idOfUser, $idOfInput, $data);
                break;
            case 'deliv_city':
                $this->UserModel->updateDeliveryData($idOfUser, $idOfInput, $data);
                break;
            case 'deliv_zip':
                $this->UserModel->updateDeliveryData($idOfUser, $idOfInput, $data);
                break;
            case 'deliv_info':
                $this->UserModel->updateDeliveryData($idOfUser, $idOfInput, $data);
                break;
            case 'deliv_phone':
                $this->UserModel->updateDeliveryData($idOfUser, $idOfInput, $data);
                break;
            default:
                echo 'System error';
        }
    }

    public function updatePersonalData()
    {
        $idOfUser = $this->input->get('id');
        $idOfInput = $this->input->get('input');
        $data = $this->input->get('data');

        switch ($idOfInput)
        {
            case 'email':
                $this->UserModel->updatePersonalData($idOfUser, $idOfInput, $data);
                break;
            case 'fact_name':
                $data = $this->encryption->encrypt($data);
                $this->UserModel->updatePersonalData($idOfUser, $idOfInput, $data);
                break;
            case 'fact_surname':
                $data = $this->encryption->encrypt($data);
                $this->UserModel->updatePersonalData($idOfUser, $idOfInput, $data);
                break;
            case 'fact_street':
                $this->UserModel->updatePersonalData($idOfUser, $idOfInput, $data);
                break;
            case 'fact_city':
                $this->UserModel->updatePersonalData($idOfUser, $idOfInput, $data);
                break;
            case 'fact_zip':
                $this->UserModel->updatePersonalData($idOfUser, $idOfInput, $data);
                break;
            case 'fact_phone':
                $this->UserModel->updatePersonalData($idOfUser, $idOfInput, $data);
                break;
            default:
                echo 'System error';
        }
    }
}