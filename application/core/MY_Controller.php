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
    }

    public function login_check()
    {
        if ($this->access != "Buser")
        {
            // here we check the role of the user
            if ( ! $this->permission_check())
            {
                die("Access denied");
            }

            // if user try to access logged in page
            // check does he/she has logged in
            // if not, redirect to login page
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

    public function isUserLogged()
    {
        return $this->session->userdata('logged_in');
    }

    public function getShippingPrices()
    {
        return $this->ProductModel->selectShippingPrices();
    }
}