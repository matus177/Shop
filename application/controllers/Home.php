<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('CategoryModel');
    }

    public function index()
    {
        $this->load->view('HeaderView');
        $this->load->view('UpperMenuView');
        $this->load->view('LeftMenuView');
        $this->load->view('HomeBodyView');
        $this->load->view('FooterView');
    }

    public function getCategoryMenu()
    {
        $result = $this->CategoryModel->selectCategorySubCategory();
        echo json_encode($result);
    }
}