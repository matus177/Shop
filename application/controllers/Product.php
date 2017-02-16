<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function index($subCategoryId, $resultPerPage = 10)
    {
        $searchTerm = FALSE;
        if ($this->input->post('product_description'))
        {
            $searchTerms = explode(' ', $this->input->post('product_description'));
            $searchTerm = array();
            foreach ($searchTerms as $term)
            {
                $term = trim($term);
                if ( ! empty($term))
                {
                    $searchTerm[] = "product_description LIKE '%$term%'";
                }
            }
        }

        $this->load->view('HeaderView');
        $this->load->view('UpperMenuView');
        $this->load->view('LeftMenuView');
        $this->load->view('ProductView', array('isAdmin' => ($this->encryption->decrypt($this->session->role) == 'Admin'), 'searchTerm' => $searchTerm, 'subCategoryId' => $subCategoryId, 'resultPerPage' => $resultPerPage));
        $this->load->view('FooterView');
    }
}