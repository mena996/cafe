<?php
session_start();
if (!isset($_SESSION["loggedIn"])) {
    header('Location: ../../login/index.php');
}
$userName = $_SESSION["name"];
$userImg = $_SESSION["image"];
?>
<html>

<head>
    <link rel="stylesheet" href="../../css/website.css">
    <title>Orders</title>
</head>

<body>

    <?php
    include '../../layout/userHeader.php';
    ?>
<div class="form_container d-flex justify-content-center form row col-11">
    <h2 class="col-12 text-center">checks</h2>

    <form action="userOrders.php" class="col-10 ">
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">from</label>
        <div class="col-sm-5">
          <input class="form-control" id="dateFrom" name="from" type="date" value=<?= $_GET['from'] ?>>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">to</label>
        <div class="col-sm-5">
          <input class="form-control" id="dateTo" name="to" type="date" value=<?= $_GET['to'] ?>>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-10">
          <button type="submit" class="btn btn-primary">search</button>
        </div>
      </div>
  </div>
  </form>
    <div class="ordersContainer">
        <div class="orderTable">
            <table id="ordersTable" class="table" style='color:red; font-style: italic;'>
                <thead class="thead-dark">
                    <tr>
                        <th>Order date</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <?php
                $userId = $_SESSION["user_id"];
                include '../../datbaseFiles/databaseConfig.php';
                if ($_GET['from'] && $_GET['to']) {
                    $fromDate=$_GET['from'];
                    $toDate=$_GET['to'];
                    $sql = "SELECT sum(amount*price) as totalPrice, status, orders.order_id, date_time
                    FROM products, order_items, orders
                    WHERE orders.user_id=$userId
                    AND orders.date_time >= '$fromDate'
                    AND orders.date_time <= '$toDate'
                    AND orders.order_id=order_items.order_id 
                    AND products.product_id=order_items.product_id
                    GROUP BY order_items.order_id";
                }else{
                    $sql = "SELECT sum(amount*price) as totalPrice, status, orders.order_id, date_time
                    FROM products, order_items, orders
                    WHERE orders.user_id=$userId
                    AND orders.order_id=order_items.order_id 
                    AND products.product_id=order_items.product_id
                    GROUP BY order_items.order_id";
                }

                $sum = 0;
                $stmt = $db->query($sql);
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                while ($row = $stmt->fetch()) {
                    $sum += $row["totalPrice"];
                    echo "<tr><td><span>" . $row["date_time"]
                        . "</span><button data-id='{$row["order_id"]}' class='showBtn btn btn-info' type='button'>Show order details</button></td>"
                        . "<td>" . $row["status"] . "</td><td>" . $row["totalPrice"] . " LE</td>";
                    if ($row["status"] == "processing") {
                        echo "<td> <button data-id='{$row["order_id"]}' class='cancelBtn btn btn-danger' type='button'>Cancel</button>
                        </td></tr>";
                    } else {
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