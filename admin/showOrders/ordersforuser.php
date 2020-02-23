<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Orders</title>
</head>
<body>
    <?php
    $servername="localhost";
    $username="root";
    $password="R12!dff2svF0";
    $dbname="cafe";
    try{
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM cafe.users");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        }catch(\ exception $e){
            echo "error in db connection";
        }
    ?>
    <form action="orders.php" method="POST" >
        <div class="">
            <div class="">
                <label for="">Please select the name of the user</label>
            </div>
            <!-- <input name="fullName" value="" class="" placeholder="please enter username" type="text"> -->
            <select name="user_id" id="">
                <?php while($row = $stmt->fetch()):;?>
                <option name="" value=<?= "${row['user_id']}"?>><?php echo $row["name"]?></option>
                <?php endwhile;?>
            </select>
        </div>
        <div class="">
            <button type="submit" class="btn" value=<?= "${row['user_id']}"?>> Show </button>
        </div>
    </form>
    <table style="width: 100%;">
        <tr>
            <th>date_time</th>
            <th>name</th>
            <th>room</th>
            <th>ext</th>
            <th>status</th>
        </tr>
        </table>
</body>
</html>