<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="adminOrderPage.css">
    <title>Home</title>
</head>
<body>

    <nav>
        <ul>
            <li><a href="">Home</a></li>
            <li><a href="">Products</a></li>
            <li><a href="">Users</a></li>
            <li><a href="">Manual Order</a></li>
            <li><a href="">Checks</a></li>

        </ul>
        <p>User Name</p>
    </nav>

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

            <div class="users">Select User:
                <select name="users" id="users" class="usersMenu">
                
                    <?php
                        include 'databaseConnection.php';
                        $sql = "SELECT * FROM users";
                        $stmt = $db->query($sql); 
                        $result=$stmt->setFetchMode(PDO::FETCH_ASSOC);
                        while($row=$stmt->fetch()){
                            echo "<option value='{$row["user_id"]}'>".$row["name"]."</option>";
                        }
                        $db=null;
                        
                    ?>
                </select>
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
    <div style="font-size:20px" class="footer">&copy; 2020 قهوة العمدة</div>
    <script src="adminOrderPage.js"></script>
</body>
</html>