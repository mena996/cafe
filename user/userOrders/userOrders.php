<?php
    session_start();
    if(!isset($_SESSION["loggedIn"])){
       header('Location: ../../login/index.php');
    }
    $userName = $_SESSION["name"];
    $userImg = $_SESSION["image"];
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

    <div class="ordersContainer">
      <div class="orderTable">
        <table id="ordersTable" class="orders">
            <tr>
                <th>Order date</th>
                <th>Status</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            <?php
                $userId = $_SESSION["user_id"];
                include '../../datbaseFiles/databaseConfig.php';

                $sqll = "SELECT sum(amount*price) as totalPrice, status, orders.order_id, date_time
                FROM products, order_items, orders
                WHERE orders.user_id=$userId
                AND orders.order_id=order_items.order_id 
                AND products.product_id=order_items.product_id
                GROUP BY order_items.order_id";
                $sum=0;
                $stmt = $db->query($sqll); 
                $result=$stmt->setFetchMode(PDO::FETCH_ASSOC);
                while($row=$stmt->fetch()){
                    $sum+=$row["totalPrice"];
                    echo "<tr><td><span>".$row["date_time"]
                    ."</span><button data-id='{$row["order_id"]}' class='showBtn' type='button'>Show order details</button></td>"
                    ."<td>".$row["status"]."</td><td>".$row["totalPrice"]." LE</td>";
                    if($row["status"]=="processing"){
                        echo "<td> <button data-id='{$row["order_id"]}' class='cancelBtn' type='button'>Cancel</button>
                        </td></tr>";
                    }else{
                        echo "</tr>";
                    }
                }
            ?>
        </table>
      </div>
        <div id="sum" class='userOrder'>Total sum of orders: <?php echo $sum; ?> LE</div>
        <div id="orderSpecs" class="userOrder"></div>
    </div>
    <?php
        include '../../layout/footer.php';
    ?>
    <script src="userOrders.js"></script>
</body>
</html>