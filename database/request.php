<?php
    include('model.php');

    class ModelRequest extends Model
    {
        public function get($id){
            $sql = "SELECT `id`,`name`,`status`,`created_date`,`updated_date` FROM `requests` WHERE `id`={$id}";
            $result = $this->db->query($sql);
            return $result;
        }

        public function all($limit){
            $sql = "SELECT `id`,`name`,`status`,`created_date`,`updated_date` FROM `requests` LIMIT {$limit}";
            $result = $this->db->query($sql);
            return $result;
        }

        public function delete($id){
            $sql = "DELETE FROM `requests` WHERE `id`={$id}";
            $result = $this->db->query($sql);
            return $result;
        }

        public function update($id, $status){
            $sql = "UPDATE `requests` SET `status`={$status}, `updated_date`=NOW() WHERE `id`={$id}";
            $result = $this->db->query($sql);
            return $result;
        }

        public function create($name){
            $sql = "INSERT INTO `requests`(`name`) VALUES('{$name}')";
            $result = $this->db->query($sql);
            return $result;
        }
    }
?>