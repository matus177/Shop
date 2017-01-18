<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ReviewAndPayment extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->model('ProductModel');
    }

    public function index()
    {
        $i = 1;
        foreach ($this->cart->contents() as $items)
        {
            $productData[$i] = $this->ProductModel->selectAllProductsImage($items['id']);
            $i++;
        }

        if ($this->isUserLogged())
        {
            $userId = $this->encryption->decrypt($this->session->userdata('id'));
            $userData = $this->UserModel->getAllUserData($userId);
        } else
        {
            $userData = $this->session->userdata();
        }

        $orderData['orderStep'] = $_GET['id'];
        $this->load->view('HeaderView');
        $this->load->view('UpperMenuView');
        $this->load->view('LeftMenuView');
        $this->load->view('CheckoutView', $orderData);
        $this->load->view('ReviewAndPaymentView', array(
            'userData' => $userData,
            'shippingPrice' => $this->getShippingPrices(),
            'productData' => $productData
        ));
        $this->load->view('FooterView');
    }

    public function createAndSendFacture()
    {
        $factureDir = dirname(dirname(__DIR__)) . '/assets/facture';
        if ( ! file_exists($factureDir) && ! is_dir($factureDir))
        {
            mkdir($factureDir);
        }
        $this->load->file(dirname(__DIR__) . '/core/FPDF.php');
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(40, 10, 'Hello World!');
        $pdf->Output();

        redirect('CompleteOrder?id=4');
    }
}