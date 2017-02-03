<?php defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryModel extends CI_Model {
    private $table = 'category';
    private $subCategoryTable = 'subcategory';

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
        return $query = $this->db->join($this->subCategoryTable, $this->subCategoryTable . '.category_id = ' . $this->table . '.id',
            'right')->get($this->table)->result();
    }

    function insertCategory($data)
    {
        $this->db->insert($this->table, $data);
    }

    function insertSubCategory($data)
    {
        $this->db->insert('subcategory', $data);
    }

    function updateSubCategory($data, $condition)
    {
        $this->db->set($data)->where($condition)->update($this->subCategoryTable);
    }

    function updateCategory($data, $condition)
    {
        $this->db->set($data)->where($condition)->update($this->table);
    }
}