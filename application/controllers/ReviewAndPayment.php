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
        $orderData['orderStep'] = $_GET['id'];
        $this->load->view('HeaderView');
        $this->load->view('UpperMenuView');
        $this->load->view('LeftMenuView');
        $this->load->view('CheckoutView', $orderData);
        $this->load->view('ReviewAndPaymentView', array(
            'userData' => $this->databaseOrSessionUserData(),
            'shippingPrice' => $this->getShippingPrices(),
            'productData' => $productData
        ));
        $this->load->view('FooterView');
    }

    public function databaseOrSessionUserData()
    {
        if ($this->isUserLogged())
        {
            $userId = $this->encryption->decrypt($this->session->userdata('id'));
            return $this->UserModel->getAllUserData($userId);
        } else
        {
            return $this->session->userdata();
        }
    }

    public function createAndSendFacture()
    {
        $shippingAndPaymentData = $this->session->userdata();
        $factureDir = dirname(dirname(__DIR__)) . '/assets/facture';
        if ( ! file_exists($factureDir) && ! is_dir($factureDir))
        {
            mkdir($factureDir);
        }
        $this->load->file(dirname(__DIR__) . '/core/FPDF.php');
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(80);
        $pdf->Cell(130, 10, 'Faktura c.: ');
        $pdf->Ln(20);
        $pdf->Cell(130, 10, 'Dodavatel: ');
        $pdf->Cell(130, 10, 'Odberatel: ');
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(5);
        $pdf->Cell(130, 10, 'Meno a priezvisko: ');
        $pdf->Cell(130, 10,
            $this->encryption->decrypt($this->databaseOrSessionUserData()['fact_name']) . ' ' . $this->encryption->decrypt($this->databaseOrSessionUserData()['fact_surname']));
        $pdf->Ln(5);
        $pdf->Cell(5);
        $pdf->Cell(130, 10, 'Ulica');
        $pdf->Cell(130, 10, $this->databaseOrSessionUserData()['fact_street']);
        $pdf->Ln(5);
        $pdf->Cell(5);
        $pdf->Cell(130, 10, 'Mesto a PSC: ');
        $pdf->Cell(130, 10,
            $this->databaseOrSessionUserData()['fact_city'] . ' ' . $this->databaseOrSessionUserData()['fact_zip']);
        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(130, 10, 'Sposob dopravy a platby:');
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(5);
        $pdf->Cell(130, 10, 'Doprava: ' . ucfirst($shippingAndPaymentData['shipping_options']));
        $pdf->Ln(5);
        $pdf->Cell(5);
        $pdf->Cell(130, 10, 'Platba: ' . ucfirst($shippingAndPaymentData['payment_options']));
        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(130, 10, 'Fakturujeme Vam:');
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(5);
        $pdf->Cell(70, 10, 'Tovar');
        $pdf->Cell(20, 10, 'Kusy');
        $pdf->Cell(60, 10, 'Cena bez dph');
        $pdf->Cell(90, 10, 'Cena s dph');
        $pdf->Ln(5);
        $pdf->Cell(5);
        $pdf->Cell(130, 10, 'Platba:');
        $pdf->Output();

        redirect('CompleteOrder?id=4');
    }
}