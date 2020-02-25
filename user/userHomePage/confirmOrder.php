<?php
    session_start();
    if(!isset($_SESSION["loggedIn"])){
        header('Location: /php_project/login/index.php');
     }
    $userId = $_SESSION["user_id"];
    include '../../datbaseFiles/databaseConfig.php';
    $products = $_POST["products"];
    // echo json_encode($_POST["products"]);

        $sql = "INSERT INTO orders (status, date_time, user_id) 
                VALUES ('processing',now(),$userId)";
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