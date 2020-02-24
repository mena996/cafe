<?php

    include '../../datbaseFiles/databaseConfig.php';
    $orderId = $_POST["orderId"];
    // header('Content-Type: application/json');

    $sql = "DELETE FROM orders WHERE order_id=$orderId";
    $db ->exec($sql);
    $sql = "DELETE FROM order_items WHERE order_id=$orderId";
    $db ->exec($sql);

    $db=null;

?>