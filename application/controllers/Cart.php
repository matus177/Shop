<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ProductModel');
    }

    public function index()
    {
        $data['data'] = 0;
        $this->load->view('HeaderView');
        $this->load->view('UpperMenuView');
        $this->load->view('LeftMenuView');
        $this->load->view('CheckoutView', $data);
        $this->load->view('CartView', $this->addToCart());
        $this->load->view('FooterView');
    }

    public function addToCart()
    {
        $id = $this->uri->segment(3);
        $arrayOfProducts = $this->ProductModel->selectProductToCart($id);
        $cartData = array();
        foreach ($arrayOfProducts as $product) {
            $cartData = array(
                'id' => $product->id,
                'qty' => 1,
                'price' => $product->product_price,
                'name' => $product->product_name
            );
        }
        if ($this->cart->insert($cartData))
            $this->ProductModel->updateProduct($id);
    }

    public function updateCart()
    {
        $updatedCartData = $this->input->post();

        for ($i = 1; $i <= sizeof($this->cart->contents()); $i++) {
            if ($this->cart->contents()[$updatedCartData[$i]['rowid']]['rowid'] == $updatedCartData[$i]['rowid']) {
                if ($this->cart->contents()[$updatedCartData[$i]['rowid']]['qty'] > $updatedCartData[$i]['qty']) {
                    $result = $this->cart->contents()[$updatedCartData[$i]['rowid']]['qty'] - $updatedCartData[$i]['qty'];
                    for ($j = 1; $j <= $result; $j++)
                        $this->db->limit(1)->set('flag', 'A')->where('product_id', $this->cart->contents()[$updatedCartData[$i]['rowid']]['id'])->where('flag', 'C')->update('storage');
                } else {
                    $result = $updatedCartData[$i]['qty'] - $this->cart->contents()[$updatedCartData[$i]['rowid']]['qty'];
                    for ($j = 1; $j <= $result; $j++)
                        $this->db->limit(1)->set('flag', 'C')->where('product_id', $this->cart->contents()[$updatedCartData[$i]['rowid']]['id'])->where('flag', 'A')->update('storage');
                }
            }
        }

        $this->cart->update($updatedCartData);
        $this->session->set_flashdata('category_success', 'Kosik bol aktualizovany.');
        redirect('Cart');
    }
}