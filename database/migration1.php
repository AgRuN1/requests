<?php
include('migration.php');

class Migration1 extends BaseMigration
{
    public function up(){
        $sql = "CREATE TABLE `data`.`requests` (
            `id` INT NULL AUTO_INCREMENT , 
            `name` VARCHAR(40) NULL , 
            `created_date` DATETIME NULL , 
            `updated_date` DATETIME NULL , 
            `status` INT NULL , PRIMARY KEY (`id`))";
        $this->execute($sql);
    }

    public function down(){
        $sql = "DROP TABLE `requests`";
        $this->execute($sql);
    }
}
?>