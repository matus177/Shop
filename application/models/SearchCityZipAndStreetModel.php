<?php defined('BASEPATH') OR exit('No direct script access allowed');

class SearchCityZipAndStreetModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function searchCity($searchTerm)
    {
        return $this->db->like('city', $searchTerm, 'after')->get('cities');
    }

    function searchZip($searchTerm)
    {
        return $this->db->like('zip', $searchTerm, 'after')->get('cities');
    }

    function searchStreet($searchTerm)
    {
        return $this->db->like('street', $searchTerm, 'after')->get('streets');
    }

    function searchZipIfExist($city)
    {
        if ($result = $this->db->select('zip')->where('city', $city)->get('cities')->row()) {
            return $result->zip;
        } else {
            return null;
        }
    }
}