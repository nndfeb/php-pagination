<?php

class Pagination
{

    private $db, $table, $total_records, $limit = 5;

    // PDO CONNECTION

    public function __construct($table)
    {
        $this->db = new PDO("mysql:host=localhost; dbname=faker", "root", "");
        $this->table = $table;
        $this->set_total_records();
    }

    function set_total_records()
    {
        $stmt = $this->db->prepare("SELECT id FROM $this->table");
        $stmt->execute();
        $this->total_records = $stmt->rowCount();
    }
    public function get_data()
    {
        $start = 0;
        $stmt = $this->db->prepare("SELECT * FROM $this->table LIMIT $start, $this->limit");
    }
}
