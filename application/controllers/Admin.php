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
            $this->session->set_flashdata('category_success', 'Kategoria bola vytvorena.');
        } else
        {
            $this->session->set_flashdata('category_danger', 'Kategoria nebola vytvorena.');
        }
        redirect(base_url('Admin/index/AdminAddProductView'));
    }

    public function createNewSubCategory()
    {
        $request = $this->input->post();

        if ( ! empty($request))
        {
            $this->CategoryModel->insertSubCategory($request);
            $this->session->set_flashdata('category_success', 'Podkategoria bola vytvorena.');
        } else
        {
            $this->session->set_flashdata('category_danger', 'Podkategoria nebola vytvorena.');
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
            if ($this->upload->do_upload('product_image'))
            {
                if ($this->upload->data('file_name') != '')
                {
                    $request['product_image'] = $this->upload->data('file_name');
                }

                $productQuantity = $request['product_quantity'];
                $request['product_id'] = $this->ProductModel->insertProduct($request);
                if ($this->db->affected_rows() == 1)
                {
                    foreach ($request as $key => $value)
                    {
                        if ($key != 'product_id')
                        {
                            unset($request[$key]);
                        }
                    }

                    for ($i = 1; $i <= $productQuantity; $i++)
                    {
                        $this->ProductModel->insertProductToStorage($request);
                    }
                    $this->session->set_flashdata('category_success', 'Produkt bol vytvoreny.');
                }
            } else
            {
                $this->session->set_flashdata('category_danger', 'Produkt nebol vytvoreny.');
                $this->session->set_flashdata('category_danger', $this->upload->display_errors());
            }
            redirect(base_url('Admin/index/AdminAddProductView'));
        }
    }

    public function getSubCategoryDropdown()
    {
        $result = $this->CategoryModel->selectCategorySubCategory();

        echo json_encode($result);
    }

    public function updateProduct($productId)
    {
        $config['file_name'] = str_replace(" ", "_", $_FILES['userfiles']['product_image']);
        $config['upload_path'] = './assets/img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 100;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);


        if ($_FILES['product_image']['size'] != 0)
        {
            if ( ! $this->upload->do_upload('product_image'))
            {
                $this->session->set_flashdata('category_danger', $this->upload->display_errors());
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

        if ($this->upload->data('file_name') == '')
        {
            $_POST['product_image'] = 'no_photo.jpg';
        } else
        {
            $_POST['product_image'] = $this->upload->data('file_name');
        }

        $productQuantity = $this->input->post('product_quantity') - $this->ProductModel->selectProduct(array('id' => $productId))[0]->product_quantity;
        $this->db->trans_start();
        $this->ProductModel->updateProduct($productId, $this->input->post());
        $this->db->trans_complete();

        if ($this->db->trans_status())
        {
            if ($productQuantity > 0)
            {
                for ($i = 1; $i <= $productQuantity; $i++)
                {
                    $this->ProductModel->insertProductToStorage(array('product_id' => $productId));
                }
            } else
            {
                for ($i = 1; $i <= abs($productQuantity); $i++)
                {
                    $this->ProductModel->deleteProductFromStorage(array('product_id' => $productId, 'flag' => 'A'));
                }
            }
            $this->session->set_flashdata('category_success', 'Produkt bol aktualizovany.');
        } else
        {
            $this->session->set_flashdata('category_danger', 'Produkt nebol aktualizovany.');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function updateSubCategory()
    {
        $this->db->trans_start();
        array_key_exists('subcategory_name', $this->input->post()) ?
            $this->CategoryModel->updateSubCategory(array('subcategory_name' => $this->input->post('subcategory_name')), array('id' => $this->input->post('subcategory_id'))) :
            $this->CategoryModel->updateSubCategory(array('category_id' => $this->input->post('category_id')), array('id' => $this->input->post('subcategory_id')));
        $this->db->trans_complete();
        if ($this->db->trans_status())
        {
            $this->session->set_flashdata('category_success', 'Podkategoria bola aktualizovana.');
        } else
        {
            $this->session->set_flashdata('category_danger', 'Podkategoria nebola aktualizovana.');
        }
        redirect(base_url('Admin/index/AdminUpdateCategoryAndSubCategoryView'));
    }

    public function updateCategory()
    {
        $this->db->trans_start();
        $this->CategoryModel->updateCategory(array('category_name' => $this->input->post('category_name')), array('id' => $this->input->post('category_id')));
        $this->db->trans_complete();
        if ($this->db->trans_status())
        {
            $this->session->set_flashdata('category_success', 'Kategoria bola aktualizovana.');
        } else
        {
            $this->session->set_flashdata('category_danger', 'Kategoria nebola aktualizovana.');
        }
        redirect(base_url('Admin/index/AdminUpdateCategoryAndSubCategoryView'));
    }
}