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
    <table class="orders">
        <tr>
            <th>Order date</th>
            <th>Status</th>
            <th>Amount</th>
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

            $stmt = $db->query($sqll); 
            $result=$stmt->setFetchMode(PDO::FETCH_ASSOC);
            while($row=$stmt->fetch()){
               echo "<tr><td>".$row["date_time"]."</td>"
               ."<td>".$row["status"]."</td><td>".$row["totalPrice"]." LE"."</td>";
               if($row["status"]=="processing"){
                   echo "<td> <button data-id='{$row["order_id"]}' class=\"cancelBtn\" type='button'>Cancel</button>
                   </td></tr>";
               }else{
                   echo "</tr>";
               }
            }
        ?>
    </table>
    </div>
    <div class="push"></div>
    <?php
        include '../../layout/footer.php';
    ?>
    <script src="userOrders.js"></script>
</body>
</html>