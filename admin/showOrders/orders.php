<?php
    $current_id=$_POST['user_id'];
    echo ($current_id)."<br>";
    $servername="localhost";
    $username="root";
    $password="R12!dff2svF0";
    $dbname="cafe";
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM users INNER JOIN orders ON users.user_id = orders.user_id WHERE users.user_id=${current_id} AND status='inProgress'");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    // while ($row = $stmt->fetch()) {
    //     echo $row["user_id"]." ".$row["name"]." ".$row["email"]." ".$row["date_time"]." ".$row["status"]."</br>";
    // }
    }catch(\ exception $e){
    echo "error in db connection";
    }
    


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<table align="center" border="5" bordercolor="blue" bgcolor="white" style="width:100%;">
    <tr>
        <th>date_time</th>
        <th>name</th>
        <th>room</th>
        <th>ext</th>
        <th>status</th>
    </tr>
    <?php 
        while ($row = $stmt->fetch()) {
                echo "<tr id={$row['user_id']}>
                <td>{$row["date_time"]}</td>
                <td>{$row["name"]}</td>
               <td>{$row["room"]}</td>
               <td>{$row["ext"]}</td>
               <td>{$row["status"]}</td>
               </tr>";
         }
          ?>
    
</table>
</body>
</html>
