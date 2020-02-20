<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="userHomePage.css">
    <title>Home</title>
</head>
<body>
    <div class="latestOrder">Latest Order:</div>
    <hr class="sep">
    <div class="products">
    <?php
                $dsn = 'mysql:dbname=Cafe;host=127.0.0.1;port=3306;';
                $user = 'root';
                $password = '';
                $id=1;
                try{
                    $db = new PDO($dsn , $user, $password);
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "SELECT amount, name
                            FROM orders, order_items, products 
                            WHERE orders.user_id=$id
                            AND orders.date_time=(SELECT MAX(date_time) FROM orders WHERE user_id=$id)
                            AND orders.order_id=order_items.order_id 
                            AND products.product_id=order_items.product_id";
                    $stmt = $db->query($sql); 
                    $result=$stmt->setFetchMode(PDO::FETCH_ASSOC);
                    while($row=$stmt->fetch()){
                        echo "<div class='item'>".$row["name"]."<br>".$row["amount"]."</div>";
                    }
                }catch (PDOException $e) {
                    echo 'Failed to connect to database'. $e->getMessage();
                }
                $db=null;
    
            ?>
        </div>

    </div>
    <form id="order-form">
    <!-- <form action="confirmOrder.php" method="post"> -->
       
    <div class="currentOrder">
            <div id="myOrder" class="items">My order:</div>
            <p>Note:</p>
            <textarea class="notes" cols="30" rows="5"></textarea>
            <p>Room</p>
            <select name="room" id="rooms">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
            <hr>
            <div class="total">Total:<span id="bill"></span></div>
            <button type="submit" class="confirm">Confirm</button>
        </div>
        
    </form>
    <script src="userHomePage.js"></script>
</body>
</html
