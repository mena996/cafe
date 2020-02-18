<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="userHomePage.css">
    <title>Home</title>
</head>
<body>
    <div class="products">
        <?php
            $serverName = "localhost";
            $userName = "root";
            $password = "";
            $dbName = "Cafe";
            $conn = new mysqli($serverName, $userName, $password, $dbName);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT name, price FROM products";
            $result = $conn->query($sql);
            // var_dump($result);
            echo "<table><tr><th>Name</th><th>Price</th>";
            while($row=$result->fetch_assoc()){
                echo "<tr><td>".$row["name"]."</td><td>".$row["price"]."</td></tr>";
            }
            echo "</table>";
        ?>
    </div>
    <div class="currentOrder">
        <div class="items">My order</div>
        <p>Note:</p>
        <textarea class="notes" cols="30" rows="5"></textarea>
        <p>Room</p>
        <select name="room" id="rooms">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select>
        <hr>
        <button class="confirm" onclick="parent.location='userHomePage.php'" >Confirm</button>
    </div>

</body>
</html
