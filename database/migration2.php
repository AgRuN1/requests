<?php

class Migration2 extends BaseMigration
{
    public function up(){
        $sql = "CREATE TRIGGER `add_date_status` BEFORE INSERT ON `requests`
        FOR EACH ROW BEGIN
            SET NEW.status = 0;
            SET NEW.created_date = NOW();
            SET NEW.updated_date = NOW();
        END;";
        $this->execute($sql);
    }

    public function down(){
        $sql = "DROP TRIGGER `add_date_status`";
        $this->execute($sql);
    }
}
?>