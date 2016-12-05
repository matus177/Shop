<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ProductModel extends CI_Model
{
    private $table = 'products';

    public function __construct()
    {
        parent::__construct();
    }

    function selectProduct($id)
    {
        return $this->db->get_where($this->table, array('subcategory_id' => $id))->result();
    }

    function selectProductToCart($id)
    {
        return $this->db->get_where($this->table, array('id' => $id))->result();
    }

    public function insertProduct($data)
    {
        $this->db->insert($this->table, $data);
    }

    public function insertProductToStorage($data)
    {
        $this->db->insert('storage', $data);
    }
}