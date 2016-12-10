<?php defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function insertNewUser($userCredentials)
    {
        return $this->db->insert('login', $userCredentials);
    }

    function insertAllUserData($userFactureData, $userDeliveryData, $userCompanyData)
    {
        $this->db->trans_start();
        $this->db->insert('personal_data', $userFactureData);
        $this->db->insert('delivery_data', $userDeliveryData);
        $this->db->insert('company_data', $userCompanyData);
        $this->db->trans_complete();

        return $this->db->trans_status() ? true : false;
    }

    public function validateUser($data)
    {
        $this->load->library('encryption');
        $data['password'] = hash('sha512', $data['password']);
        $query = $this->db->select('login.id, email, role, fact_name, fact_surname')->join('personal_data', 'personal_data.id = login.id', 'left')->get_where('login', $data);

        if ($query->num_rows()) {
            $row = $query->row_array();
            unset($row['password']);
            $row['id'] = $this->encryption->encrypt($row['id']);
            $row['role'] = $this->encryption->encrypt($row['role']);
            $this->_data = $row;
        }

        return $query->row();
    }

    public function isUserExist($email)
    {
        return $this->db->where('email', $email)->get('login')->result() ? true : false;
    }

    public function verifyResetPasswordCode($email, $code)
    {
        return ($code == md5($this->config->item('salt') . $this->db->where('email', $email)->get('login')->row()->email)) ? true : false;
    }

    public function resetPassword()
    {
        $email = $this->input->post('email');
        $password = hash('sha512', $this->config->item('salt') . $this->input->post('password'));

        $this->db->set('password', $password)->where('email', $email)->update('login');

        return ($this->db->affected_rows() === 1) ? true : false;
    }

    public function getData()
    {
        return $this->_data;
    }

    public function getAllUserData($id)
    {
        $query = $this->db->select()->join('personal_data', 'personal_data.id = login.id', 'left')->join('delivery_data', 'delivery_data.id = login.id', 'left')->join('company_data', 'company_data.id = login.id', 'left')->where('login.id', $id)->get('login')->row_array();
        unset($query['password']);
        unset($query['role']);
        return $query;
    }

    public function updateEmail($email, $id)
    {
        return $this->db->set('email', $email)->where('id', $id)->update('login');
    }

    public function updatePhone($phone, $id)
    {
        return $this->db->set('fact_phone', $phone)->where('id', $id)->update('personal_data');
    }

    public function checkOldPassword($oldPass, $userId)
    {
        $pass = $password = hash('sha512', $this->config->item('salt') . $oldPass);

        return $this->db->where('password', $pass)->where('id', $userId)->get('login')->row();
    }

    public function updateOldPassword($pass, $userId)
    {
        return $this->db->set('password', $pass)->where('id', $userId)->update('login');
    }

    public function updateCompanyData($idOfUser, $row, $data)
    {
        return $this->db->set($row, $data)->where('id', $idOfUser)->update('company_data');
    }

    public function updatePersonalData($idOfUser, $row, $data)
    {
        return $this->db->set($row, $data)->where('id', $idOfUser)->update('personal_data');
    }
}