<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ProductModel');
    }

    public function index()
    {
        $orderData['orderStep'] = 0;
        $this->load->view('HeaderView');
        $this->load->view('UpperMenuView');
        $this->load->view('LeftMenuView');
        $this->load->view('CheckoutView', $orderData);
        $this->load->view('CartView', $this->addToCart());
        $this->load->view('FooterView');
    }

    public function addToCart()
    {
        $id = $this->uri->segment(3);
        $arrayOfProducts = $this->ProductModel->selectProductToCart($id);

        $cartData = array();
        foreach ($arrayOfProducts as $product)
        {
            $updatedQuantity = array(
                'product_quantity' => $product->product_quantity - 1
            );

            $cartData = array(
                'id' => $product->id,
                'qty' => 1,
                'price' => $product->product_price,
                'name' => $product->product_name
            );
        }

        if ($this->cart->insert($cartData))
        {
            $this->ProductModel->updateProduct($id, $updatedQuantity);
            $this->ProductModel->updateStorage($id, 'C', 'A');

        } else
        {
            echo 'error';
        }
    }

    public function updateCart()
    {
        $updatedCartData = $this->input->post();

        for ($i = 1; $i <= sizeof($this->cart->contents()); $i++)
        {
            if ($this->cart->contents()[$updatedCartData[$i]['rowid']]['rowid'] == $updatedCartData[$i]['rowid'])
            {
                $productQunatity = $this->ProductModel->selectProductToCart($this->cart->contents()[$updatedCartData[$i]['rowid']]['id'])[0]->product_quantity;

                if ($this->cart->contents()[$updatedCartData[$i]['rowid']]['qty'] > $updatedCartData[$i]['qty'])
                {
                    $result = $this->cart->contents()[$updatedCartData[$i]['rowid']]['qty'] - $updatedCartData[$i]['qty'];
                    for ($j = 1; $j <= $result; $j++)
                    {
                        $this->ProductModel->updateStorage($this->cart->contents()[$updatedCartData[$i]['rowid']]['id'], 'A', 'C');
                    }

                    $resultQuantity = $productQunatity + ($this->cart->contents()[$updatedCartData[$i]['rowid']]['qty'] - $updatedCartData[$i]['qty']);
                    $this->ProductModel->updateProduct($this->cart->contents()[$updatedCartData[$i]['rowid']]['id'], array('product_quantity' => $resultQuantity));
                } else
                {
                    $result = $updatedCartData[$i]['qty'] - $this->cart->contents()[$updatedCartData[$i]['rowid']]['qty'];
                    for ($j = 2; $j <= $result; $j++)
                    {
                        $this->ProductModel->updateStorage($this->cart->contents()[$updatedCartData[$i]['rowid']]['id'], 'C', 'A');
                    }

                    $resultQuantity = $productQunatity - ($updatedCartData[$i]['qty'] - $this->cart->contents()[$updatedCartData[$i]['rowid']]['qty']);
                    if ($resultQuantity >= 0)
                    {
                        $this->ProductModel->updateProduct($this->cart->contents()[$updatedCartData[$i]['rowid']]['id'], array('product_quantity' => $resultQuantity));
                        $this->ProductModel->updateStorage($this->cart->contents()[$updatedCartData[$i]['rowid']]['id'], 'C', 'A');
                    } else
                    {
                        $this->session->set_flashdata('category_warning', 'Na skalde je len ' . $productQunatity . ' ks.');
                        redirect('Cart');
                    }
                }
            }
        }

        $this->cart->update($updatedCartData);
        $this->session->set_flashdata('category_success', 'Kosik bol aktualizovany.');
        redirect('Cart');
    }

    public function isCartEmpty()
    {
        echo empty($this->cart->contents());
    }
}