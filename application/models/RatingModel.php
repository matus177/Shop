<?php defined('BASEPATH') OR exit('No direct script access allowed');

class RatingModel extends CI_Model {
    private $table = 'rating_products';

    public function __construct()
    {
        parent::__construct();
    }

    public function inserUserRating($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function isProductRatedByUser($data)
    {
        return $this->db->get_where($this->table, array('user_id' => $data['user_id'], 'product_id' => $data['product_id']))->result();
    }

    public function selectTemporaryRating($data)
    {
        return $this->db->get_where($this->table, array('product_id' => $data['product_id']))->result();
    }
}