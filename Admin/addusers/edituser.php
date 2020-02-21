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
                    <td> <a href="Home.php?">Home | </a></td>
                    <td> <a href="Products.php?">Products | </a></td>
                    <td> <a href="Users.php?">Users | </a></td>
                    <td> <a href="ManualOrders.php?">Manual orders | </a></td>
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
$flag = 0;
if(empty($_POST['user_name'])){
    echo "<h3># Please enter a valid username</h3>";
    $flag = 1;
}
if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
    echo "<h3># Please enter a valid Email</h3>";
    $flag=1;
}
if ($_POST['password'] == $_POST['passwordConfirm'] ) {
    if (!preg_match("/[a-z0-9@]{8}/",$_POST['password'])) {
        echo "<h3># Please enter a valid password</h3>";
        $flag = 1;
    }
}
else {
    echo "<h3># Please enter a valid password</h3>";
    $flag = 1;
}
if(empty($_POST['roomnumber'])){
    echo "<h3># Please select a room </h3>";
        $flag=1;
}
if(empty($_POST['extnumber'])){
    echo "<h3># Please select a room </h3>";
        $flag=1;
}

if($flag != 1){
    // echo "<br>connecting to database<br>";

       $dsn='mysql:dbname=cafe;host=127.0.0.1;';

       $user='basma';
       $password='basma12345';
    //    var_dump($_POST);
  
            try{
            $db=new PDO ($dsn,$user,$password);
            // var_dump($db);
            // echo "<br>";
            $number = $_POST['id'];
            //  echo $_POSt['id'];
             $name=$_POST['user_name'];
            //  echo $name;
             $password=$_POST['password'];
            //  echo $password;
             $email=$_POST['email'];
            //  echo $email;
             $ext=$_POST['extnumber'];
            //  echo $ext;
             $room=$_POST['roomnumber'];
            //  echo $room;
            //  echo "Number: ".$number;
            $query="UPDATE users SET name='$name',email='$email',password='$password',ext='$ext',room='$room' WHERE user_id=$number";
            
            $stmt=$db->prepare($query);
            $stmt->execute([$name,$email,$password,$ext,$room]);

            $result=$stmt->fetchAll();
      
            $queryselect="SELECT * FROM users ";
            $stmt=$db->prepare($queryselect);
            $stmt->execute();
           
        
            $resultselect=$stmt->fetch(PDO::FETCH_OBJ);
            
        //    var_dump($resultselect);
       
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
             <a href='editUser.php?row=".$num."'>Edit\n\n</a><a href='deleteuser.php?row=".$num."'>Delete</a></td></tr>");
           
           }

           echo "</table>";
        
          $resultselect->free_result();

       }
       catch(PDOException $e){
        echo "Connection failed:".$e->getMessage();
    }
 
}

?>
</html>
