<?php
    $dsn = 'mysql:dbname=cafe;host=127.0.0.1;port=3306;';
    $user = 'root';
    $password = 'R12!dff2svF0';
    try{
        $db = new PDO($dsn , $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch (PDOException $e) {
        echo 'Failed to connect to database'. $e->getMessage();
    }
?>
