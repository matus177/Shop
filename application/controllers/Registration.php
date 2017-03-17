<?php

class Registration extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->model('SearchCityZipAndStreetModel');
    }

    public function index()
    {
        $this->load->view('HeaderView');
        $this->load->view('UpperMenuView');
        $this->load->view('RegistrationBodyView');
        $this->load->view('FooterView');
    }

    function registerNewUser()
    {
        $this->form_validation->set_rules('email', 'Email',
            'trim|required|valid_email|is_unique[login.email]|xss_clean|max_length[30]');
        $this->form_validation->set_rules('password', 'Heslo',
            'trim|required|xss_clean|min_length[8]|max_length[30]|callback_password_check');
        $this->form_validation->set_rules('cpassword', 'Reheslo', 'trim|matches[password]');
        $this->form_validation->set_rules('fact_name', 'Fakturacne Meno', 'trim|required|max_length[30]');
        $this->form_validation->set_rules('fact_surname', 'Fakturacne Priezvisko', 'trim|required|max_length[30]');
        $this->form_validation->set_rules('fact_street', 'Fakturacna Ulica', 'trim|required|max_length[30]');
        $this->form_validation->set_rules('fact_city', 'Fakturacne Mesto', 'trim|required|max_length[30]');
        $this->form_validation->set_rules('fact_zip', 'Fakturacne PSC', 'trim|required|max_length[8]');
        $this->form_validation->set_rules('fact_phone', 'Fakturacny Telefon', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('deliv_name', 'Dodacie Meno', 'max_length[30]');
        $this->form_validation->set_rules('deliv_surname', 'Dodacie Meno', 'max_length[30]');
        $this->form_validation->set_rules('deliv_company', 'Firma', 'max_length[30]');
        $this->form_validation->set_rules('deliv_street', 'Dodacia Ulica', 'max_length[30]');
        $this->form_validation->set_rules('deliv_city', 'Dodacie Mesto', 'max_length[30]');
        $this->form_validation->set_rules('deliv_zip', 'Dodacie PSC', 'max_length[8]');
        $this->form_validation->set_rules('deliv_info', 'Informacie', 'max_length[150]');
        $this->form_validation->set_rules('deliv_phone', 'Dodaci Telefon', 'max_length[30]');
        $this->form_validation->set_rules('comp_ico', 'ICO', 'max_length[30]');
        $this->form_validation->set_rules('comp_dic', 'DIC', 'max_length[30]');
        $this->form_validation->set_rules('comp_icdph', 'IC DPH', 'max_length[30]');
        $this->form_validation->set_rules('comp_bic', 'BIC (SWIFT)', 'max_length[30]');
        $this->form_validation->set_rules('comp_iban', 'IBAN', 'max_length[30]');
        $this->form_validation->set_rules('comp_bank_owner', 'Majitel Uctu', 'max_length[40]');

        $this->form_validation->set_message('is_unique', 'Zadany %s sa pouziva zvolte iny prosim.');
        $this->form_validation->set_message('valid_email', '%s musi obsahovat platny format.');
        $this->form_validation->set_message('max_length', '%s nesmie mat viac ako 30 znakov.');
        $this->form_validation->set_message('required', '%s je povinny udaj.');
        $this->form_validation->set_message('matches', 'Hesla sa nezhoduju.');
        $this->form_validation->set_message('min_length', 'Heslo musi mat minimalne 8 znakov.');

        if ($this->form_validation->run())
        {
            $userCredentials = array(
                'email' => $this->input->post('email'),
                'password' => hash('sha512', $this->input->post('password'))
            );
            $userFactureData = array(
                'fact_name' => $this->encryption->encrypt($this->input->post('fact_name')),
                'fact_surname' => $this->encryption->encrypt($this->input->post('fact_surname')),
                'fact_street' => $this->input->post('fact_street'),
                'fact_city' => $this->input->post('fact_city'),
                'fact_zip' => $this->input->post('fact_zip'),
                'fact_phone' => $this->input->post('fact_phone')
            );
            $userDeliveryData = array(
                'deliv_name' => $this->encryption->encrypt($this->input->post('deliv_name')),
                'deliv_surname' => $this->encryption->encrypt($this->input->post('deliv_surname')),
                'deliv_company' => $this->input->post('deliv_company'),
                'deliv_street' => $this->input->post('deliv_street'),
                'deliv_city' => $this->input->post('deliv_city'),
                'deliv_zip' => $this->input->post('deliv_zip'),
                'deliv_info' => $this->input->post('deliv_info'),
                'deliv_phone' => $this->input->post('deliv_phone')
            );
            $userCompanyData = array(
                'comp_ico' => $this->input->post('comp_ico'),
                'comp_dic' => $this->input->post('comp_dic'),
                'comp_icdph' => $this->input->post('comp_icdph'),
                'comp_bic' => $this->input->post('comp_bic'),
                'comp_iban' => $this->encryption->encrypt($this->input->post('comp_iban')),
                'comp_bank_owner' => $this->encryption->encrypt($this->input->post('comp_bank_owner'))
            );

            if ($this->UserModel->insertNewUser($userCredentials))
            {
                $id = $this->db->insert_id();
                $userFactureData['id'] = $id;
                $userDeliveryData['id'] = $id;
                $userCompanyData['id'] = $id;
                if ($this->UserModel->insertAllUserData($userFactureData, $userDeliveryData, $userCompanyData))
                {
                    $this->session->set_flashdata('category_success', 'Registracia prebehla uspesne.');
                    redirect('home');
                } else
                {
                    $this->session->set_flashdata('category_danger', 'Registracia zlyhala');
                }
            } else
            {
                $this->session->set_flashdata('category_danger', 'Registracia zlyhala');
            }
        } else
        {
            $this->session->set_flashdata('category_warning', validation_errors());
        }
        redirect('registration');
    }

    public function searchCity()
    {
        $searchTerm = $_GET['term'];
        $query = $this->SearchCityZipAndStreetModel->searchCity($searchTerm);

        foreach ($query->result() as $row)
        {
            $data[] = $row->city;
        }

        echo json_encode($data);
    }

    public function searchZip()
    {
        $searchTerm = $_GET['term'];
        $query = $this->SearchCityZipAndStreetModel->searchZip($searchTerm);

        foreach ($query->result() as $row)
        {
            $data[] = $row->zip;
        }

        echo json_encode(array_unique($data));
    }

    public function searchStreet()
    {
        $searchTerm = $_GET['term'];
        $query = $this->SearchCityZipAndStreetModel->searchStreet($searchTerm);

        foreach ($query->result() as $row)
        {
            $data[] = $row->street;
        }

        echo json_encode(array_unique($data));
    }

    public function searchZipForCity()
    {
        $city = $_GET['city'];
        echo $this->SearchCityZipAndStreetModel->searchZipIfExist($city);
    }
}