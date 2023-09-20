<?php
 include('config.php');

 class Database
 {
    public function __construct($database) {
        global $host,$username,$password;
        $this->link = new mysqli($host, $username, $password, $database);
        if($this->link->connect_error){
            die($this->link->connect_error);
        }
        //$this->link->select_db($database);
    }
    
    public function query($sql){
        $result = $this->link->query($sql);
        return $result;
    }

    public function __destruct(){
        $this->link->close();
    }
 }
?>