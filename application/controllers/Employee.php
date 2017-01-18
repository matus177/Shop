<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This controller can be accessed
 * for Employee and Admin group only
 */
class Employee extends MY_Controller {

    protected $access = array("Admin", "Emplo");

    public function index()
    {
        $this->load->view('HeaderView');
        $this->load->view('UpperMenuView');
        $this->load->view('LeftMenuView');
        $this->load->view('EmployeeView');
        $this->load->view('FooterView');
    }
}