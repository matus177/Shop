<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('LogsModel');
        $this->load->model('UserModel');
    }

    public function login()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|xss_clean|valid_email|max_length[30]');
        $this->form_validation->set_rules('password', 'Heslo', 'required|xss_clean|max_length[30]');
        $this->form_validation->set_message('valid_email', '%s musi obsahovat platny format.');

        if ($this->form_validation->run()) {
            if (!is_null($this->UserModel->validateUser($_POST))) {
                $this->session->set_userdata($this->UserModel->getData());
                $this->session->set_userdata('logged_in', true);
                $this->session->set_flashdata('category_success', 'Uzivatel bol uspesne prihlaseny.');
            } else {
                $this->session->set_flashdata('category_danger', 'Chybne meno alebo heslo.');
            }
        } else {
            $this->session->set_flashdata('category_warning', validation_errors());
        }
        $this->createLog();
        redirect('home');
    }

    public function createLog()
    {
        if ($this->userAgent->is_browser()) {
            $agent = $this->userAgent->browser() . ' ' . $this->userAgent->version();
        } elseif ($this->userAgent->is_robot()) {
            $agent = $this->userAgent->robot();
        } elseif ($this->userAgent->is_mobile()) {
            $agent = $this->userAgent->mobile();
        } else {
            $agent = 'Unidentified User Agent';
        }

        $logData = array(
            'status' => 'success',
            'user_id' => $this->encryption->decrypt($this->session->userdata('id')),
            'first_name' => $this->encryption->decrypt($this->session->userdata('fact_name')),
            'last_name' => $this->encryption->decrypt($this->session->userdata('fact_surname')),
            'ip_address' => $this->input->ip_address(),
            'agent' => $agent,
            'platform' => $this->userAgent->platform(),
            'date' => date('Y-m-d H:i:s', strtotime('2 hour'))
        );

        if ($this->session->userdata('logged_in')) {
            $logMsg = implode(', ', $logData) . PHP_EOL;
            $this->LogsModel->insertLogs($logData);

            if (!write_file('application/logs/log.txt', $logMsg, 'a'))
                $this->session->set_flashdata('category_danger', 'Chyba zapisu logu.');
        } else {
            unset($logData['user_id'], $logData['first_name'], $logData['last_name']);
            $logData['email_input'] = $_POST['email'];
            $logData['password_input'] = $_POST['password'];
            $logData['status'] = 'failed';
            $logMsg = implode(', ', $logData) . PHP_EOL;
            $this->LogsModel->insertLogs($logData);

            if (!write_file('application/logs/log.txt', $logMsg, 'a'))
                $this->session->set_flashdata('category_danger', 'Chyba zapisu logu.');
        }
    }

    public function logout()
    {
        $userData = array('id', 'email', 'role', 'fact_name', 'fact_surname', 'logged_in');
        $this->session->unset_userdata($userData);
        $this->session->set_flashdata('category_success', 'Uzivatel bol uspesne odhlaseny.');

        redirect('home');
    }

    public function resetPassword()
    {
        if (isset($_POST['email']) && !empty($_POST['email'])) {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|max_length[30]');
            $this->form_validation->set_message('max_length', '%s nesmie mat viac ako 30 znakov.');

            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('category_warning', validation_errors());
                redirect('home');
            } else {
                $email = trim($this->input->post('email'));
                $result = $this->UserModel->isUserExist($email);

                if ($result) {
                    $this->sendResetPasswordEmail($email);
                    // redirect to reset password form view
                } else {
                    $this->session->set_flashdata('category_danger', 'Email nebol najdeny.');
                    redirect('Home');
                }
            }
        } else {
            $this->session->set_flashdata('category_danger', 'Email nebol najdeny.ss');
            redirect('Home');
        }
    }

    public function resetPasswordForm($email, $emailCode)
    {
        if (isset($email, $emailCode)) {
            $email = trim($email);
            $emailHash = sha1($email . $emailCode);
            $verified = $this->userModel->verifyResetPasswordCode($email, $emailCode);

            if ($verified) {
                //redirect to update password vies
            } else {
                $this->session->set_flashdata('category_danger', 'Vyskytla sa chyba skuste to este raz.');
                redirect('Home');
            }
        }
    }

    private function sendResetPasswordEmail($email)
    {
        $this->load->library('email');
        $emailCode = md5($this->config->item('salt') . $email);
        $this->email->set_mailtype('html');
        $this->email->from($email);
        $this->email->to($email);
        $this->email->subject('Prosim zmente svoje heslo v Shope');

        $message = '<!DOCTYPE html><html><meta content="text/html" charset="UTF-8" /></head><body>';
        $message .= '<p>Mili zakaznik,</p>';
        $message .= '<p>svoje heslo mozete zmenit <strong><a href="' . base_url('Login/resetPassword/' . $email . '/' . $emailCode) . '">tu</strong></p>';
        $message .= '<p>S pozdravom team Shop.sk</p>';
        $message .= '</body></html>';
        $this->email->message($message);
        var_dump($this->email);
        $this->email->send();
    }
}
