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
                $dsn = 'mysql:dbname=Cafe;host=127.0.0.1;port=3306;';
                $user = 'root';
                $password = 'Azayem_242007';
                $id=1;
                try{
                    $db = new PDO($dsn , $user, $password);
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "SELECT amount, name, image
                            FROM orders, order_items, products 
                            WHERE orders.user_id=$id
                            AND orders.date_time=(SELECT MAX(date_time) FROM orders WHERE user_id=$id)
                            AND orders.order_id=order_items.order_id 
                            AND products.product_id=order_items.product_id";
                    $stmt = $db->query($sql); 
                    $result=$stmt->setFetchMode(PDO::FETCH_ASSOC);
                    while($row=$stmt->fetch()){
                        echo "<div class='item'>"." <img src='{$row["image"]}' height=\"42\" width=\"42\"> "
                        .$row["name"]."<br>".$row["amount"]."</div>";
                    }
                }catch (PDOException $e) {
                    echo 'Failed to connect to database'. $e->getMessage();
                }
                $db=null;
                
                ?>
        </div>
        <!-- <hr class="sep"> -->
        <div class="products">
            <?php
                $serverName = "localhost";
                $userName = "root";
                $password = "Azayem_242007";
                $dbName = "Cafe";
                $conn = new mysqli($serverName, $userName, $password, $dbName);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT * FROM products";
                $result = $conn->query($sql);
                while($row=$result->fetch_assoc()){
                    echo "<div class='item'>"
                    .$row["name"]."<br>"
                    ." <img class='image' data-id='{$row["product_id"]}' data-name='{$row["name"]}' data-price='{$row["price"]}' 
                    src='{$row["image"]}' height=\"42\" width=\"42\"> "
                    .$row["price"]." LE"."</div>";
                }
                $conn -> close();
                ?>
        </div>
    </div>
        
        
    </div>
    <script src="userHomePage.js"></script>
</body>
</html>