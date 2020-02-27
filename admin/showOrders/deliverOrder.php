<?php
include '../../datbaseFiles/databaseConfig.php';
$orderId = $_POST["orderId"];
$sql = "UPDATE orders
        SET status = 'out for delivery'
        WHERE order_id = $orderId;";
$db ->exec($sql);
?>