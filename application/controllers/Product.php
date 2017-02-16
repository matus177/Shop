<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function index($subCategoryId, $resultPerPage = 10)
    {
        $match = FALSE;
        if ($this->input->post('product_description'))
        {
            $match = $this->input->post('product_description');
            $arrayMatch = explode(' ', $match);
            foreach ($arrayMatch as $key => $value)
            {
                $arrayProduct[] = $this->ProductModel->selectProduct(array('subcategory_id' => $subCategoryId), $value);
            }
            $resultProduct = call_user_func_array('array_merge', $arrayProduct);
        }
        $this->load->view('HeaderView');
        $this->load->view('UpperMenuView');
        $this->load->view('LeftMenuView');
        $this->load->view('ProductView', array('product' => $match ? $resultProduct : $this->ProductModel->selectProduct(array('subcategory_id' => $subCategoryId), $match), 'isAdmin' => ($this->encryption->decrypt($this->session->role) == 'Admin'), 'searchTerm' => $this->input->post('product_description'), 'subCategoryId' => $subCategoryId, 'resultPerPage' => $resultPerPage));
        $this->load->view('FooterView');
    }
}