<?php
    session_start();
    if(!isset($_SESSION["loggedIn"]) && $_SESSION["type"] == 0 ){
       header('Location: ../../login/index.php');
    }
    $userName = $_SESSION["name"];
    $userImg = $_SESSION["image"];
?>
<html>
<head>
    <link rel="stylesheet" href="../../css/website.css">
    <title>Admin dashboard</title>
</head>
<body>

<?php
    include '../../layout/adminHeader.php'
?>

    <div class="container">

        <div class="currentOrder">
                <form id="order-form">
                    <div id="myOrder" class="items"></div>
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
        <hr style="width: 100%; color: black; height: 1px; background-color:black;">
        <div class="products">
            <p>Menu:</p>
            <?php
                include '../../datbaseFiles/databaseConfig.php';
                $sql = "SELECT * FROM products";
                $stmt = $db->query($sql); 
                $result=$stmt->setFetchMode(PDO::FETCH_ASSOC);
                while($row=$stmt->fetch()){
                echo "<div class='card' style='width:100px;height:150px'>
                    <img class='image' class='card-img-top' data-id='{$row["product_id"]}' 
                    data-name='{$row["name"]}' data-price='{$row["price"]}' 
                    src='../../Images/{$row["image"]}' style='height:50px'>
                    <div class='card-body'>
                    <h6 class='card-title'>{$row["name"]}</h6>
                    <p class='card-text'>Price:{$row["price"]}</p>
                    </div>
                    </div>";
                
                
                    // "<div class='item'>"
                    // .$row["name"]."<br>"
                    // ." <img class='image' data-id='{$row["product_id"]}' 
                    // data-name='{$row["name"]}' data-price='{$row["price"]}' 
                    // src='../../Images/{$row["image"]}' height=\"42\" width=\"100%\"> "
                    // .$row["price"]." LE"."</div>";
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