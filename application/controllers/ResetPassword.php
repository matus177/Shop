<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ResetPassword extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
    }

    public function index()
    {
        $this->load->view('HeaderView');
        $this->load->view('UpperMenuView');
        $this->load->view('ResetPasswordBodyView');
        $this->load->view('FooterView');
    }

    public function resetPasswordByEmail()
    {
        if (isset($_POST['email']) && ! empty($_POST['email']))
        {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|max_length[30]');
            $this->form_validation->set_message('max_length', '%s nesmie mat viac ako 30 znakov.');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('category_warning', validation_errors());
                redirect('Home');
            } else
            {
                $email = trim($this->input->post('email'));
                $userExist = $this->UserModel->isUserExist($email);

                if ($userExist)
                {
                    $this->sendResetPasswordEmail($email) ?
                        $this->session->set_flashdata('category_success',
                            'Email bol odoslany, prosim skontrolujte aj SPAM zlozku.') :
                        $this->session->set_flashdata('category_danger', 'Vyskytla sa chyba, email nebol odoslany.');
                    redirect('Home');
                } else
                {
                    $this->session->set_flashdata('category_danger', 'Email nebol najdeny.');
                    redirect('Home');
                }
            }
        } else
        {
            $this->session->set_flashdata('category_danger', 'Systemova chyba. Kontaktujte spravcu webu.');
            redirect('Home');
        }
    }

    private function sendResetPasswordEmail($email)
    {
        $this->load->library('email');
        $emailCode = md5($this->config->item('salt') . $email);
        $this->email->set_mailtype('html');
        $this->email->from('shop-support@seznam.cz', 'Shop support');
        $this->email->to($email);
        $this->email->subject('Prosim zmente svoje heslo v Shope');
        $message = '<!DOCTYPE html><html><meta content="text/html" charset="UTF-8" /></head><body>';
        $message .= '<p>Mili zakaznik,</p>';
        $message .= '<p>svoje heslo mozete zmenit <strong><a href="' . base_url('ResetPassword/resetPasswordForm/' . $email . '/' . $emailCode) . '">tu</strong></p>';
        $message .= '<p>S pozdravom team Shop.sk</p>';
        $message .= '</body></html>';
        $this->email->message($message);

        return $this->email->send() ? TRUE : FALSE;
    }

    public function resetPasswordForm($email, $emailCode)
    {
        if (isset($email, $emailCode))
        {
            $email = trim($email);
            $emailHash = sha1($email . $emailCode);
            $verified = $this->UserModel->verifyResetPasswordCode($email, $emailCode);

            if ($verified)
            {
                $this->load->view('HeaderView');
                $this->load->view('UpperMenuView');
                $this->load->view('ResetPasswordBodyView',
                    array('emailHash' => $emailHash, 'emailCode' => $emailCode, 'email' => $email));
                $this->load->view('FooterView');
            } else
            {
                $this->session->set_flashdata('category_danger', 'Vyskytla sa chyba skuste to este raz.');
                redirect('Home');
            }
        }
    }

    public function resetPassword()
    {
        if ( ! isset($_POST['email'], $_POST['emailHash']) || $_POST['emailHash'] !== sha1($_POST['email'] . $_POST['emailCode']))
        {
            die('Chyba pri resetovani Vasho hesla.');
        }

        $this->form_validation->set_rules('email', 'Email Hash', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|max_length[30]');
        $this->form_validation->set_rules('password', 'Heslo',
            'trim|required|matches[confpassword]|xss_clean|max_length[30]');
        $this->form_validation->set_rules('confpassword', 'Conf Heslo', 'trim|required|xss_clean|max_length[30]');

        $this->form_validation->set_message('max_length', '%s nesmie mat viac ako 30 znakov.');
        $this->form_validation->set_message('required', '%s je povinny udaj.');
        $this->form_validation->set_message('matches', 'Hesla sa nezhoduju.');

        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('category_warning', validation_errors());
            redirect('Home');
        } else
        {
            $this->UserModel->resetPassword() ?
                $this->session->set_flashdata('category_success', 'Heslo bolo zmenene.') :
                $this->session->set_flashdata('category_success', 'Heslo nebolo zmenene, kontaktujte spravcu webu.');
            redirect('Home');
        }
    }
}