<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="userHomePage.css">
    <title>Home</title>
</head>
<body>
    <div class="container">

        <div class="currentOrder">
                <form id="order-form">
                    <div id="myOrder" class="items">My order:</div>
                    <p class="noteLabel">Note:</p>
                    <textarea class="notes" cols="40" rows="1"></textarea>
                    <p>Room</p>
                    <select name="room" id="rooms">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                    <hr>
                    <div class="total">Total:<span id="bill"></span></div>
                    <button type="submit" class="confirm">Confirm</button>
                </form>
            </div>
        <div class="container2">

            <div class="latestOrder">Latest Order:
                <?php
                $id=1;
                include 'databaseConnection.php';
                $sql = "SELECT amount, name, image
                        FROM orders, order_items, products 
                        WHERE orders.user_id=$id
                        AND orders.date_time=(SELECT MAX(date_time) FROM orders WHERE user_id=$id)
                        AND orders.order_id=order_items.order_id 
                        AND products.product_id=order_items.product_id";
                $stmt = $db->query($sql); 
                $result=$stmt->setFetchMode(PDO::FETCH_ASSOC);
                while($row=$stmt->fetch()){
                    echo "<div class='item'>"." <img src='{$row["image"]}' height=\"42\" width=\"100%\"> "
                    .$row["name"]."<br>".$row["amount"]."</div>";
                }

                $db=null;
                
            ?>
        </div>
        <!-- <hr class="sep"> -->
        <div class="products">
            <?php
                include 'databaseConnection.php';
                $sql = "SELECT * FROM products";
                $stmt = $db->query($sql); 
                $result=$stmt->setFetchMode(PDO::FETCH_ASSOC);
                while($row=$stmt->fetch()){
                echo "<div class='item'>"
                    .$row["name"]."<br>"
                    ." <img class='image' data-id='{$row["product_id"]}' 
                    data-name='{$row["name"]}' data-price='{$row["price"]}' 
                    src='{$row["image"]}' height=\"42\" width=\"100%\"> "
                    .$row["price"]." LE"."</div>";
                }
                $db=null;
            ?>
        </div>
    </div>
        
        
    </div>
    <script src="userHomePage.js"></script>
</body>
</html>