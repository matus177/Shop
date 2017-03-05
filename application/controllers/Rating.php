<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rating extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('RatingModel');
    }

    public function addUserRating()
    {
        $ratingData = explode('_', $this->input->get()['rating_data']);
        $data['product_id'] = $ratingData[0];
        $data['user_rate'] = $ratingData[1];
        $data['user_id'] = $this->encryption->decrypt($this->session->userdata('id'));

        if ( ! $this->session->userdata('logged_in'))
        {
            echo 'Pre hodnotenie sa musite prihlasit.';
        } elseif ( ! empty($this->RatingModel->isProductRatedByUser($data)))
        {
            echo 'Tento produkt ste uz hodnotili.';
        } else
        {
            $this->RatingModel->inserUserRating($data);
        }
    }

    public function getDefaultRating()
    {
        $ratingData = explode('_', $this->input->get()['rating_data']);
        $data['product_id'] = $ratingData[0];
        $valueOfUserRating = 0;
        $counterOfRating = 0;
        $finalDefaultRating = 0;
        foreach ($this->RatingModel->getDefaultRating($data) as $value => $key)
        {
            $valueOfUserRating += $key->user_rate;
            $counterOfRating++;
            $finalDefaultRating = $valueOfUserRating / $counterOfRating;
        }
        echo round($finalDefaultRating);
    }
}