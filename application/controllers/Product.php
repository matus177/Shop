<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function index($subCategoryId, $resultPerPage = 10, $sort = '')
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
        $this->load->view('ProductView', array('isAdmin' => ($this->encryption->decrypt($this->session->role) == 'Admin'), 'searchTerm' => $searchTerm, 'subCategoryId' => $subCategoryId, 'resultPerPage' => $resultPerPage, 'sort' => $sort));
        $this->load->view('FooterView');
    }

    public function loadSortProduct()
    {
        if (array_key_exists('sort_options', $this->session->get_userdata()))
        {
            echo json_encode(['price' => $this->session->get_userdata()['sort_options']['price'], 'stock' => $this->session->get_userdata()['sort_options']['stock']]);
        } else
        {
            echo json_encode(['price' => 'favorite_sort', 'stock' => 'false']);
        }
    }

    public function saveSortProduct()
    {
        $this->session->set_userdata($this->input->get());
    }
}