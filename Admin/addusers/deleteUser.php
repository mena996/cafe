<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>All Users </title>
    <link rel="stylesheet" href="fontawesome-free-5.12.1-web/css/all.css">
   
</head>

<body id="main_body">

    <div id="form_container">
        <div class="title">
            <div class="menu">
                <table class="table">
                    <td> <a href="userHomePage.php?">Home | </a></td>
                    <td> <a href="addproductall.php?">Products | </a></td>
                    <td> <a href="alluserspage.php?">Users | </a></td>
                    <td> <a href="adminOrderPage.php?">Manual orders | </a></td>
                    <td> <a href="Checks.php?">Checks </a></td>
                </table>
            </div>
            <div class="header">
                <h6 class="adminname">Admin</h6>
                <i class="fas fa-heart" id="admin"></i>
            </div>
        </div>
        <div class="allUsers">
            <div class="allusers">
               <h1 > All Users</h1>
            </div>
            <div class="adduser">
              <a href="adduser.html?">add User </a>
            </div>
        </div>
    <style>
      
        .menu {
            display: flex;
            flex-direction: row;
            margin-left:2%;
        }

        .header {
            display: flex;
            flex-direction: row-reverse;
            margin-right:5%;
            
        }

        .title {
            display: flex;
            justify-content: space-between;
        }

        .adminname {
            text-decoration: underline;
            font-size: 80%;
            margin-right: 5%;
        }

        #admin {
            font-size: 250%;
            padding: 0%;
            margin: 0%;
        }

        .allUsers {
            display:flex;
            justify-content: space-between;
        }
        .adduser{
            margin-right:5%;
        }
        .allusers{
            margin-left:3%;
        }
    </style>
</body>
<?php
// Retrieve the URL variables (using PHP).
$dsn='mysql:dbname=cafe;host=127.0.0.1;';
$user='basma';
$password='basma12345';
$number = $_GET['row'];
// echo $_GET['id'];

// echo "Number: ".$number;
try{
    $db=new PDO ($dsn,$user,$password);
    // var_dump($db);
 
    $query="DELETE FROM users WHERE user_id=$number";
   
    $stmt=$db->prepare($query);
    $stmt->execute();
    $result=$stmt->fetchAll();
    // var_dump($result);
    // echo $result;
    
     $queryselect="SELECT * FROM users";
     $stmt=$db->prepare($queryselect);
     $stmt->execute();
    
 
     $resultselect=$stmt->fetch(PDO::FETCH_OBJ);
    //  var_dump($resultselect);
    //  echo $resultselect."\n";
 
        echo "<table style='border: 3px solid black;padding:0px;margin-left:5%;width:90%'>";
        echo "<tr style=' text-align:center;background-color:lightgray;'><th style='border-right: 3px solid black;margin:0%;padding:0%;'>Name</th>
        <th style='border-right: 3px solid black;'>Room</th><th style='border-right: 3px solid black;'>Image</th>
        <th style='border-right: 3px solid black;'>Ext</th><th>Action</th></tr>";
        while($resultselect=$stmt->fetch(PDO::FETCH_OBJ)){
            $num=$resultselect->user_id;
        echo ("<tr>
        <td style='font-style: italic; color: black;border-right: 3px solid black;'>".$resultselect->name.
        "</td><td style='font-style: italic; color: black;border-right: 3px solid black;background-color:mintcream;text-align:center;'>"
        .$resultselect->room."</td><td style='font-style: italic; color: black;border-right: 3px solid black;text-align:center;'>"
        .$resultselect->image."</td><td style='font-style: italic; color: black;background-color:mintcream;border-right: 3px solid black;text-align:center;'>"
        .$resultselect->ext."</td><td style='font-style: italic; color: black;text-align:center;'>
        <a href='editUser.php?row=".$num."'>Edit\n\n</a><a href='
        deleteUser.php?row=".$num."
        '>Delete</a></td></tr>");
    
    }

    echo "</table>";

    $resultselect->free_result();
 
}
catch(PDOException $e){
echo "Connection failed:".$e->getMessage();
}


?>

</html>