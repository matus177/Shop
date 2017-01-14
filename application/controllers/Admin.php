<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This controller can be accessed
 * for Admin group only
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

        if (!empty($request)) {
            $config['file_name'] = str_replace(" ", "_", $_FILES["userfiles"]['product_image']);
            $config['upload_path'] = './assets/img/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 100;
            $config['max_width'] = 1024;
            $config['max_height'] = 768;
            $config['remove_spaces'] = true;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->do_upload('product_image');
            if ($this->upload->data('file_name') != '')
                $request['product_image'] = $this->upload->data('file_name');

            $productQuantity = (int)$request['product_quantity'];
            $request['product_id'] = $this->ProductModel->insertProduct($request);
            if ($this->db->affected_rows() == 1) {
                unset($request['product_quantity']);
                unset($request['subcategory_id']);
                unset($request['product_name']);
                unset($request['product_price']);
                unset($request['product_type']);
                unset($request['product_description']);
                unset($request['product_image']);

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