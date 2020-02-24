<?php

    include '../../datbaseFiles/databaseConfig.php';
    $orderId = $_POST["orderId"];
    // header('Content-Type: application/json');

    $sql = "SELECT * FROM order_items WHERE order_id=$orderId";
    $stmt = $db->query($sql);
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
    $db=null;

?>