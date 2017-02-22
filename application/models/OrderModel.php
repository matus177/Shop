<?php defined('BASEPATH') OR exit('No direct script access allowed');

class OrderModel extends CI_Model {
    private $tableLogIn = 'user_orders_login';
    private $tableLogOut = 'user_orders_logout';

    public function __construct()
    {
        parent::__construct();
    }

    public function insertLogInOrder($data)
    {
        $this->db->insert($this->tableLogIn, $data);
    }

    public function insertLogOutOrder($data)
    {
        $this->db->insert($this->tableLogOut, $data);
    }

    public function selectLogInOrder($id)
    {
        return $this->db->get_where($this->tableLogIn, array('user_id' => $id))->result();
    }

    public function selectLogOutOrder()
    {
        return $this->db->get($this->tableLogOut)->result();
    }

    public function selectAllOrder()
    {
        return $this->db->select($this->tableLogIn . '.*, ' . 'personal_data.*, delivery_data.*, company_data.*,' . $this->tableLogIn . '.id AS order_id')
            ->join('personal_data', 'personal_data.id = ' . $this->tableLogIn . '.user_id')
            ->join('delivery_data', 'delivery_data.id = ' . $this->tableLogIn . '.user_id')
            ->join('company_data', 'company_data.id = ' . $this->tableLogIn . '.user_id')
            ->get($this->tableLogIn)->result();
    }

    public function updateLogInOrderTable($data)
    {
        return $this->db->set('status', $data['status'])->where('id', $data['id'])->update($this->tableLogIn);
    }

    public function updateLogOutOrderTable($data)
    {
        return $this->db->set('status', $data['status'])->where('id', $data['id'])->update($this->tableLogOut);
    }

    public function selectNumberOfUnclosedLogInOrders($data)
    {
        return $this->db->where(array('status !=' => $data))->get($this->tableLogIn)->num_rows();
    }

    public function selectNumberOfUnclosedLogOutOrders($data)
    {
        return $this->db->where(array('status !=' => $data))->get($this->tableLogOut)->num_rows();
    }
}