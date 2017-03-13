<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ProductModel');
    }

    public function index($subCategoryId)
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
        $this->load->view('ProductView', array('isAdmin' => ($this->encryption->decrypt($this->session->role) == 'Admin') ? '1' : '0', 'searchTerm' => $searchTerm, 'subCategoryId' => $subCategoryId));
        $this->load->view('FooterView');
    }

    public function getProduct()
    {
        $limit = $this->input->get()['limit'];
        $offset = $this->input->get()['offset'];
        $sort = array_key_exists('sort', $this->input->get()) ? $this->input->get()['sort'] : 'ASC';
        $stock = $this->input->get()['stock'];

        echo json_encode($this->ProductModel->selectProductForPaggination($this->input->get(), $limit, $offset, $sort, $stock));
    }

    public function getModalData()
    {
        echo json_encode($this->ProductModel->selectProduct($this->input->get()));
    }

    public function getNumberOfproduct()
    {
        echo json_encode($this->ProductModel->selectNumberOfProduct($this->input->get()));
    }
}