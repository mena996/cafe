<?php
    $dsn = 'mysql:dbname=Cafe;host=127.0.0.1;port=3306;';
    $user = 'root';
    $password = '';
    $products = $_POST["products"];
    echo json_encode($_POST["products"]);

    try{
        $db = new PDO($dsn , $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
    }catch (PDOException $e) {
        echo 'Failed to connect to database'. $e->getMessage();
    }

?>