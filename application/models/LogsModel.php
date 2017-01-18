<?php defined('BASEPATH') OR exit('No direct script access allowed');

class LogsModel extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    public function insertLogs($insertData)
    {
        $this->db->insert('logs', $insertData);
    }
}