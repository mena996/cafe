<?php

    include 'databaseConnection.php';
    $products = $_POST["products"];
    // echo json_encode($_POST["products"]);

        $sql = "INSERT INTO orders (status, date_time, user_id) 
                VALUES ('proccessing',now(),'1')";
        $db ->exec($sql);
        $last_id = $db->lastInsertId();
        foreach ($products as $product_id=>$amount ){
            $sql = "INSERT INTO order_items (order_id, product_id, amount) 
            VALUES ('$last_id','$product_id','$amount')";
            $db ->exec($sql);
        }
        // header("Location: userHomePage.php");
    $db=null;

?>