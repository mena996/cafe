<?php
    $dsn = 'mysql:dbname=Cafe;host=127.0.0.1;port=3306;';
    $user = 'root';
    $password = 'Azayem_242007';
    try{
        $db = new PDO($dsn , $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch (PDOException $e) {
        echo 'Failed to connect to database'. $e->getMessage();
    }
?>