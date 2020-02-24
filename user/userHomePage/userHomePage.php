<?php
    session_start();
    if(!isset($_SESSION["loggedIn"])){
       header('Location: /php_project/login/index.php');
    }
?>
<html>
<head>
    <link rel="stylesheet" href="../../css/website.css">
    <title>Home</title>
</head>
<body>

<?php
    include '../../layout/userHeader.php';
?>

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

            <div class="latestOrder"><p>Latest Order:</p>
                <?php
                $userId = $_SESSION["user_id"];
                include '../../datbaseFiles/databaseConfig.php';
                $sql = "SELECT amount, name, image
                        FROM orders, order_items, products 
                        WHERE orders.user_id=$userId
                        AND orders.date_time=(SELECT MAX(date_time) FROM orders WHERE user_id=$userId)
                        AND orders.order_id=order_items.order_id 
                        AND products.product_id=order_items.product_id";
                $stmt = $db->query($sql); 
                $result=$stmt->setFetchMode(PDO::FETCH_ASSOC);
                while($row=$stmt->fetch()){
                    echo "<div class='item'>".$row["name"]
                    ."<img src='{$row["image"]}' height='42' width='100%'>"
                    ."<br>Amount:".$row["amount"]."</div>";
                }

                $db=null;
                
            ?>
            </div>
        <div class="products">
            <p>Menu:</p>
            <?php
                include '../../datbaseFiles/databaseConfig.php';
                $sql = "SELECT * FROM products";
                $stmt = $db->query($sql); 
                $result=$stmt->setFetchMode(PDO::FETCH_ASSOC);
                while($row=$stmt->fetch()){
                echo "<div class='item'>"
                    .$row["name"]."<br>"
                    ." <img class='image' data-id='{$row["product_id"]}' 
                    data-name='{$row["name"]}' data-price='{$row["price"]}' 
                    src='{$row["image"]}' height=\"50\" width=\"100%\">Price:"
                    .$row["price"]." LE"."</div>";
                }
                $db=null;
            ?>
        </div>
    </div>    
    </div>
    <div class="push"></div>
    <?php
        include '../../layout/footer.php';
    ?>
    <script src="userHomePage.js"></script>
</body>
</html>