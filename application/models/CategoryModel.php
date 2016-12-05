<?php defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryModel extends CI_Model
{
    private $table = 'category';

    public function __construct()
    {
        parent::__construct();
    }

    function selectCategory()
    {
        return $query = $this->db->get($this->table)->result();
    }

    function selectCategorySubCategory()
    {
        $table2 = 'subcategory';
        return $query = $this->db->join($table2, $table2 . '.category_id = ' . $this->table . '.id', 'right')->get($this->table)->result();
    }

    function insertCategory($data)
    {
        $this->db->insert($this->table, $data);
    }

    function insertSubCategory($data)
    {
        $this->db->insert('subcategory', $data);
    }
}