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

    function selectProductForPaggination($data, $limit, $offset, $sort, $stock)
    {
        if ($data['subcategory_id'] == 0)
        {
            return $this->db->where('default_rating > ', 3)->get($this->table, $limit, $offset)->result();

        } else
        {
            if ($stock == 'true')
            {
                return $this->db->where('subcategory_id', $data['subcategory_id'])->where('product_quantity > ', 0)->order_by('product_price', $sort)->get($this->table, $limit, $offset)->result();
            } else
            {
                return $this->db->where('subcategory_id', $data['subcategory_id'])->order_by('product_price', $sort)->get($this->table, $limit, $offset)->result();
            }
        }
    }

    function selectNumberOfProduct($data)
    {
        if ($data['subcategory_id'] == 0)
        {
            return $this->db->where('default_rating > ', 3)->get($this->table)->num_rows();
        } else
        {
            if ($data['stock'] == 'true')
            {
                return $this->db->where('subcategory_id', $data['subcategory_id'])->where('product_quantity > ', 0)->get($this->table)->num_rows();
            } else
            {
                return $this->db->where('subcategory_id', $data['subcategory_id'])->get($this->table)->num_rows();
            }
        }
    }

    public function selectDefaultRating($data)
    {
        return $this->db->get_where($this->table, $data)->row()->default_rating;
    }

    public function updateDefaultRating($data)
    {
        $this->db->set('default_rating', $data['default_rating'])->where('id', $data['id'])->update($this->table);
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