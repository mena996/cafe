<?php
    session_start();
    if(!isset($_SESSION["loggedIn"]) && $_SESSION["type"] == 0 ){
       header('Location: /php_project/login/index.php');
    }
    $userName = $_SESSION["name"];
    $userImg = $_SESSION["image"];
    include '../../layout/adminHeader.php';
    $current_id=$_POST['user_id'];
    echo ($current_id)."<br>";
    
    include '../../datbaseFiles/databaseConfig.php';
    
    $stmt = $db->prepare("SELECT * FROM users INNER JOIN orders ON users.user_id = orders.user_id WHERE users.user_id=${current_id} AND status='processing'");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    // while ($row = $stmt->fetch()) {
    //     echo $row["user_id"]." ".$row["name"]." ".$row["email"]." ".$row["date_time"]." ".$row["status"]."</br>";
    // }

    


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../css/website.css">
    <title>Admin dashboard </title>
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
