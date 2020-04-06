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
        $stmt = $this->db->prepare("SELECT username FROM $this->table");
        $stmt->execute();
        $this->total_records = $stmt->rowCount();
    }
    public function get_data()
    {
        $start = 0;
        if ($this->current_page() > 1) {
            $start = ($this->current_page() * $this->limit) - $this->limit;
        }

        $stmt = $this->db->prepare("SELECT * FROM $this->table LIMIT $start, $this->limit");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function current_page()
    {
        // default page number 1
        return isset($_GET['page']) ? (int) $_GET['page'] : 1;
    }

    public function get_pagination_numbers()
    {
        // ceil untuk pembulatan angka
        return ceil($this->total_records / $this->limit);

        // 20/5
        // 4
        // 1 2 3 4 
    }
    public function prev_page()
    {
        return ($this->current_page() > 1) ? $this->current_page() - 1 : 1;
    }
    public function next_page()
    {
        return ($this->current_page() < $this->get_pagination_numbers()) ? $this->current_page() + 1 : $this->get_pagination_numbers();
    }

    public function is_active_page($num)
    {
        return ($num == $this->current_page()) ? 'active' : '';
    }
}
