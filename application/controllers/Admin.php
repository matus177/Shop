<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This controller can be accessed
 * for Admin group onlya
 */
class Admin extends MY_Controller
{
    protected $access = 'Admin';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('CategoryModel');
        $this->load->model('ProductModel');
    }

    public function index()
    {
        $this->load->view('HeaderView');
        $this->load->view('UpperMenuView');
        $this->load->view('LeftMenuView');
        $this->load->view('AdminView');
        $this->load->view('FooterView');
    }

    public function createNewCategory()
    {
        $request = $this->input->post();

        if (!empty($request)) {
            $this->CategoryModel->insertCategory($request);
            //set flash message
        } else {
            return null;
        }
        redirect(base_url('Admin'));
    }

    public function createNewSubCategory()
    {
        $request = $this->input->post();

        if (!empty($request)) {
            $this->CategoryModel->insertSubCategory($request);
        } else {
            return null;
        }
        redirect(base_url('Admin'));
    }

    public function getCategoryDropdown()
    {
        $result = $this->CategoryModel->selectCategory();

        echo json_encode($result);
    }

    public function createNewProduct()
    {
        $request = $this->input->post();
        $productQuantity = (int)$request['product_quantity'];
        if (!empty($request)) {
            $this->ProductModel->insertProduct($request);
            if ($this->db->affected_rows() == 1) {
                $request['product_id'] = $this->db->insert_id();
                unset($request['product_quantity']);
                unset($request['subcategory_id']);
                unset($request['product_name']);
                unset($request['product_price']);
                unset($request['product_type']);
                unset($request['product_description']);
                for ($i = 1; $i <= $productQuantity; $i++)
                    $this->ProductModel->insertProductToStorage($request);
            }
            redirect(base_url('Admin'));
        } else return null;
    }

    public function getSubCategoryDropdown()
    {
        $result = $this->CategoryModel->selectCategorySubCategory();

        echo json_encode($result);
    }
}