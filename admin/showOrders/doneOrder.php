<?php
include '../../datbaseFiles/databaseConfig.php';
$orderId = $_POST["orderId"];
$sql = "UPDATE orders
        SET status = 'delivered'
        WHERE order_id = $orderId;";
$db ->exec($sql);
?>