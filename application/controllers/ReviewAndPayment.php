<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ReviewAndPayment extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->model('ProductModel');
        $this->load->library('email');
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
        $factureNumber = mt_rand(100000, 999999);
        $factureName = 'faktura_' . $factureNumber . '.pdf';

        if ( ! file_exists($factureDir) && ! is_dir($factureDir))
        {
            mkdir($factureDir);
        }
        $this->load->file(dirname(__DIR__) . '/core/FPDF.php');
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(80);
        $pdf->Cell(130, 10, 'Faktura c.: ' . $factureNumber);
        $pdf->Ln(10);
        $pdf->Cell(190, 0, '', 1);
        $pdf->Ln(5);
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
        $pdf->Ln(10);
        $pdf->Cell(190, 0, '', 1);
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(130, 10, 'Sposob dopravy a platby:');
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(5);
        $pdf->Cell(130, 10, 'Doprava: ' . ucfirst($shippingAndPaymentData['shipping_options']));
        $pdf->Ln(5);
        $pdf->Cell(5);
        $pdf->Cell(130, 10, 'Platba: ' . ucfirst($shippingAndPaymentData['payment_options']));
        $pdf->Ln(10);
        $pdf->Cell(190, 0, '', 1);
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(130, 10, 'Fakturujeme Vam:');
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(5);
        $pdf->Cell(70, 10, 'Tovar');
        $pdf->Cell(30, 10, 'Kusy');
        $pdf->Cell(35, 10, 'Cena/ks Eur');
        $pdf->Cell(90, 10, 'Celkom Eur');
        $pdf->Ln(7);
        $pdf->Cell(5);
        foreach ($this->cart->contents() as $value)
        {
            $pdf->Cell(70, 10, $value['name']);
            $pdf->Cell(30, 10, $value['qty']);
            $pdf->Cell(35, 10, $value['price']);
            $pdf->Cell(90, 10, $value['subtotal']);
            $pdf->Ln(5);
            $pdf->Cell(5);
        }
        $pdf->Cell(70, 10, 'Doprava');
        $pdf->Cell(30, 10, '1');
        $pdf->Cell(35, 10, $this->session->userdata()['delivery_price']);
        $pdf->Cell(90, 10, $this->session->userdata()['delivery_price']);
        $pdf->Ln(10);
        $pdf->Cell(190, 0, '', 1);
        $pdf->Ln(5);
        $pdf->Cell(135);
        $pdf->Cell(40, 10,
            'Celkom bez DPH: ' . round(($this->session->userdata('delivery_price') + $this->cart->total()) - (($this->session->userdata('delivery_price') + $this->cart->total()) / $this->getShippingPrices()->dph),
                2) . ' Eur');
        $pdf->Ln(5);
        $pdf->Cell(135);
        $pdf->Cell(40, 10,
            'DPH (20%): ' . round(($this->session->userdata('delivery_price') + $this->cart->total()) / $this->getShippingPrices()->dph,
                2) . ' Eur');
        $pdf->Ln(5);
        $pdf->Cell(135);
        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(40, 10, 'K úhrade: ' . ($this->session->userdata('delivery_price') + $this->cart->total()) . ' Eur');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Ln(10);
        $pdf->Cell(5);
        $pdf->Cell(40, 10, 'Dna: ' . date("d. m. Y  H:i:s"));
        $pdf->Output('f', $factureName);

        $this->email->set_mailtype('html');
        $this->email->from('shop-support@seznam.cz', 'Shop support');
        $this->email->to('andrejmat12@gmail.com');
        $this->email->attach(dirname(dirname(__DIR__)) . '/assets/facture/' . $factureName);
        $this->email->subject('Prosim zmente svoje heslo v Shope');
        $message = '<!DOCTYPE html><html><meta content="text/html" charset="UTF-8" /></head><body>';
        $message .= '<p>Mili zakaznik,</p>';
        $message .= '<p>dakujeme za Vas nakup. V prilohe Vam posielame fakturu.</p>';
        $message .= '<p>S pozdravom team Shop.sk</p>';
        $message .= '</body></html>';
        $this->email->message($message);

        redirect('CompleteOrder?id=4');
    }
}