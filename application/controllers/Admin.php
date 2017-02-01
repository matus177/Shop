<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This controller can be accessed
 * for Admin group only
 */
class Admin extends MY_Controller {
    protected $access = 'Admin';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('CategoryModel');
        $this->load->model('ProductModel');
        $this->load->model('OrderModel');
    }

    public function index($view)
    {
        $this->load->view('HeaderView');
        $this->load->view('UpperMenuView');
        $this->load->view('LeftMenuView');
        $this->load->view($view,
            array('isAdmin' => ($this->encryption->decrypt($this->session->role) == 'Admin')));
        $this->load->view('FooterView');
    }

    public function createNewCategory()
    {
        $request = $this->input->post();

        if ( ! empty($request))
        {
            $this->CategoryModel->insertCategory($request);
            //set flash message
        } else
        {
            return NULL;
        }
        redirect(base_url('Admin/index/AdminAddProductView'));
    }

    public function createNewSubCategory()
    {
        $request = $this->input->post();

        if ( ! empty($request))
        {
            $this->CategoryModel->insertSubCategory($request);
        } else
        {
            return NULL;
        }
        redirect(base_url('Admin/index/AdminAddProductView'));
    }

    public function getCategoryDropdown()
    {
        $result = $this->CategoryModel->selectCategory();

        echo json_encode($result);
    }

    public function createNewProduct()
    {
        $request = $this->input->post();

        if ( ! empty($request))
        {
            $config['file_name'] = str_replace(" ", "_", $_FILES["userfiles"]['product_image']);
            $config['upload_path'] = './assets/img/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 100;
            $config['max_width'] = 1024;
            $config['max_height'] = 768;
            $config['remove_spaces'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->do_upload('product_image');
            if ($this->upload->data('file_name') != '')
            {
                $request['product_image'] = $this->upload->data('file_name');
            }

            $productQuantity = (int)$request['product_quantity'];
            $request['product_id'] = $this->ProductModel->insertProduct($request);
            if ($this->db->affected_rows() == 1)
            {
                unset($request['product_quantity']);
                unset($request['subcategory_id']);
                unset($request['product_name']);
                unset($request['product_price']);
                unset($request['product_type']);
                unset($request['product_description']);
                unset($request['product_image']);

                for ($i = 1; $i <= $productQuantity; $i++)
                {
                    $this->ProductModel->insertProductToStorage($request);
                }
            }

            redirect(base_url('Admin/index/AdminAddProductView'));
        } else
        {
            return NULL;
        }
    }

    public function getSubCategoryDropdown()
    {
        $result = $this->CategoryModel->selectCategorySubCategory();

        echo json_encode($result);
    }

    public function fillUserLoggedOutOrdersTable()
    {
        $logOutOrders = $this->OrderModel->selectLogOutOrder();
        for ($i = 0; $i < sizeof($logOutOrders); $i++)
        {
            $logOutOrders[$i]->fact_name = $this->encryption->decrypt($logOutOrders[$i]->fact_name);
            $logOutOrders[$i]->fact_surname = $this->encryption->decrypt($logOutOrders[$i]->fact_surname);
            $logOutOrders[$i]->deliv_name = $this->encryption->decrypt($logOutOrders[$i]->deliv_name);
            $logOutOrders[$i]->deliv_surname = $this->encryption->decrypt($logOutOrders[$i]->deliv_surname);
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($logOutOrders));
    }

    public function fillUserAllOrdersTable()
    {
        $allUserOrder = array_merge($this->OrderModel->selectAllOrder(), $this->OrderModel->selectLogOutOrder());
        for ($i = 0; $i < sizeof($allUserOrder); $i++)
        {
            $allUserOrder[$i]->fact_name = $this->encryption->decrypt($allUserOrder[$i]->fact_name);
            $allUserOrder[$i]->fact_surname = $this->encryption->decrypt($allUserOrder[$i]->fact_surname);
            $allUserOrder[$i]->deliv_name = $this->encryption->decrypt($allUserOrder[$i]->deliv_name);
            $allUserOrder[$i]->deliv_surname = $this->encryption->decrypt($allUserOrder[$i]->deliv_surname);
            $allUserOrder[$i]->comp_iban = $this->encryption->decrypt($allUserOrder[$i]->comp_iban);
            $allUserOrder[$i]->comp_bank_owner = $this->encryption->decrypt($allUserOrder[$i]->comp_bank_owner);
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($allUserOrder));
    }
}