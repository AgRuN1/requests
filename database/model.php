<?php
 include('db.php');

 abstract class Model
 {
    public function __construct() {
        $this->db = new Database('data');
    }

    abstract public function get($id);
    abstract public function delete($id);
    abstract public function update($id, $data);
    abstract public function create($data);
 }
?>