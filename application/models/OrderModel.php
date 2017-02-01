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
}