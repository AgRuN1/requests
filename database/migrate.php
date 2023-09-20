<?php
 include('migration1.php');
 include('migration2.php');

 $migrations = [new Migration1(), new Migration2()];
 $method = 'up';
 if(count($argv) > 1 && $argv[1] == 'down'){
    $method = 'down';
    $migrations = array_reverse($migrations);
}

 foreach($migrations as $migration){
    $migration->$method();
 }
?>