<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ShippingOptions extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
    }

    public function index()
    {
        $userId = $this->encryption->decrypt($this->session->userdata('id'));
        $userData['userData'] = $this->UserModel->getAllUserData($userId);
        $orderData['orderStep'] = $_GET['id'];
        $this->load->view('HeaderView');
        $this->load->view('UpperMenuView');
        $this->load->view('LeftMenuView');
        $this->load->view('CheckoutView', $orderData);
        $this->load->view('ShippingOptionsView', $userData);
        $this->load->view('FooterView');
    }

    public function checkShippingOptions()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|max_length[30]');
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

        $this->form_validation->set_message('valid_email', '%s musi obsahovat platny format.');
        $this->form_validation->set_message('max_length', '%s nesmie mat viac ako 30 znakov.');
        $this->form_validation->set_message('required', '%s je povinny udaj.');

        if ($this->form_validation->run()) {
            foreach ($this->input->post() as $key => $value) {
                $this->session->set_userdata($key, $value);
            }

            redirect('ReviewAndPayment?id=3');
        } else {
            $this->session->set_flashdata('category_warning', validation_errors());
            redirect('ShippingOptions?id=2');
        }
    }

    public function isUserLogged()
    {
        echo is_null($this->session->userdata('logged_in'));
    }
}