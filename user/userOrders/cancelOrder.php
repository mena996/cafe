<?php

    include '../../datbaseFiles/databaseConfig.php';
    $orderId = $_POST["orderId"];
    // echo json_encode($_POST["products"]);

    $sql = "DELETE FROM orders WHERE order_id=$orderId";
    $db ->exec($sql);
    $sql = "DELETE FROM order_items WHERE order_id=$orderId";
    $db ->exec($sql);

    $db=null;

?>