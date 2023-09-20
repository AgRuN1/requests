<?php
 include('db.php');
 
 abstract class BaseMigration
 {
    public function __construct() {
        $this->db = new Database('data');
    }

    protected function execute($sql){
        $this->db->query($sql);
    }

    abstract public function up();
    
    abstract public function down();
}
?>