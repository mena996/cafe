<?php
    session_start();
    if(!isset($_SESSION["loggedIn"]) && $_SESSION["type"] == 0 ){
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
    include '../../layout/adminHeader.php'
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

            <div class="users">Select User:
                <select name="users" id="users" class="usersMenu">
                
                    <?php
                        include '../../datbaseFiles/databaseConfig.php';
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
                include '../../datbaseFiles/databaseConfig.php';
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
    <?php
        include '../../layout/footer.php';
    ?>
    <script src="adminOrderPage.js"></script>
</body>
</html>