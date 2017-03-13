<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ProductModel extends CI_Model {
    private $table = 'products';

    public function __construct()
    {
        parent::__construct();
    }

    function selectProduct($data)
    {
        return $this->db->get_where($this->table, $data)->result();
    }

    function selectProductForPaggination($data, $limit, $offset, $sort)
    {
        return $this->db->where('subcategory_id', $data['subcategory_id'])->order_by('product_price', $sort)->get($this->table, $limit, $offset)->result();
    }

    function selectNumberOfProduct($data)
    {
        return $this->db->get_where($this->table, $data)->num_rows();
    }

    public function updateStorage($id, $data, $condition)
    {
        $this->db->limit(1)->set('flag', $data)->where('product_id',
            $id)->where('flag', $condition)->update('storage');
    }

    function updateProduct($id, $data)
    {
        foreach ($data as $key => $value)
        {
            $this->db->set($key, $value)->where('id',
                $id)->update($this->table);
        }
        if (array_key_exists('product_price', $data))
        {
            foreach ($data as $key => $value)
            {
                if ($key != 'product_price')
                {
                    unset($data[$key]);
                }
            }

            $this->db->set('product_price', $data['product_price'])->where('product_id', $id)->update('tax_prices');
        }
    }

    function selectProductToCart($id)
    {
        return $this->db->get_where($this->table, array('id' => $id))->result();
    }

    public function insertProduct($data)
    {
        $this->db->trans_start();
        $this->db->insert($this->table, $data);
        $lastId = $this->db->insert_id();
        $this->db->trans_complete();
        $idForStorage = NULL;
        if ($this->db->trans_status())
        {
            $data['product_id'] = $lastId;
            foreach ($data as $key => $value)
            {
                if ($key != 'product_price' && $key != 'product_id')
                {
                    unset($data[$key]);
                }
            }

            $idForStorage = $this->db->insert('tax_prices', $data) ? $lastId : NULL;
        }
        return $idForStorage;
    }

    public function insertProductToStorage($data)
    {
        $this->db->insert('storage', $data);
    }

    public function deleteProductFromStorage($data)
    {
        $this->db->limit(1)->delete('storage', $data);
    }

    public function selectShippingPrices()
    {
        return $this->db->limit(1)->get('tax_prices')->row();
    }

    public function selectAllProductsImage($id)
    {
        return $this->db->get_where($this->table, array('id' => $id))->row();
    }
}