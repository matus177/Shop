<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    /**
     * 'Buser' all user
     * '@' logged in user
     * 'Admin' for admin
     * 'Emplo' for editor group
     * @var string
     */
    protected $access = "Buser";

    public function __construct()
    {
        parent::__construct();
        $this->login_check();
        $this->load->model('ProductModel');
        $this->load->model('UserModel');
    }

    public function login_check()
    {
        if ($this->access != "Buser")
        {
            if ( ! $this->permission_check())
            {
                die("Access denied");
            }

            if ( ! $this->session->userdata("logged_in"))
            {
                redirect("auth");
            }
        }
    }

    public function permission_check()
    {
        if ($this->access == "@")
        {
            return TRUE;
        } else
        {
            $access = is_array($this->access) ? $this->access : explode(",", $this->access);
            if (in_array($this->encryption->decrypt($this->session->userdata("role")), array_map("trim", $access)))
            {
                return TRUE;
            }

            return FALSE;
        }
    }

    public function getShippingPrices()
    {
        return $this->ProductModel->selectShippingPrices();
    }

    public function databaseOrSessionUserData()
    {
        if ($this->isUserLogged())
        {
            $userId = $this->encryption->decrypt($this->session->userdata('id'));
            return $this->UserModel->getAllUserData($userId);
        } else
        {
            return $this->session->userdata();
        }
    }

    public function isUserLogged()
    {
        return $this->session->userdata('logged_in');
    }

    public function password_check($str)
    {
        if (preg_match('#[0-9]#', $str) && preg_match('#[a-z]#', $str) && preg_match('#[A-Z]#', $str) && preg_match('#[\W]#', $str))
        {
            return TRUE;
        }

        $this->form_validation->set_message('password_check', 'Heslo musi obsahovat velke pismeno, male pismeno, cislo a specialny znak.');
        return FALSE;
    }
}