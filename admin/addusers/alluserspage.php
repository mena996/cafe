<?php
    session_start();
    if(!isset($_SESSION["loggedIn"]) && $_SESSION["type"] == 0 ){
       header('Location: /php_project/login/index.php');
    }
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>All Users </title>
    <link rel="stylesheet" href="fontawesome-free-5.12.1-web/css/all.css">
    <link rel="stylesheet" href="../../css/website.css">
   
</head>

<body id="main_body">
    <?php
        include '../../layout/adminHeader.php'
    ?>
    <div id="form_container">

                <?php

                    $dsn='mysql:dbname=cafe;host=127.0.0.1;';
                    $user='root';
                    $password='';
                
                    try{
                    $db=new PDO ($dsn,$user,$password);
                   
            
                    $query="SELECT image FROM users WHERE name='admin' ";
                    $stmt=$db->prepare($query);
                    $stmt->execute();
                    
                    $result=$stmt->fetch(PDO::FETCH_OBJ);
                    $rowcount=$stmt->rowCount();                 
                    
                    if ($rowcount==1)
                    echo "<img src='$result->image' height='50' width='50'>";
                    else
                    echo " <i class='fas fa-users-cog' id='admin'></i> ";
                                
                    
                    }
                    catch(PDOException $e){
                        echo "Connection failed:".$e->getMessage();
                    }
      
                ?>
         
        <div class="allUsers">
            <div class="allusers">
               <h1 > All Users</h1>
            </div>
            <div class="adduser">
              <a href="adduser.html?">add User </a>
            </div>
        </div>
<?php

    $dsn='mysql:dbname=cafe;host=127.0.0.1;';

    $user='root';
    $password='';

        try{
        $db=new PDO ($dsn,$user,$password);

        $queryselect="SELECT * FROM users ";
        $stmt=$db->prepare($queryselect);
        $stmt->execute();
                
        echo "<table style='border: 3px solid black;padding:0px;margin-left:5%;width:90%'>";
        echo "<tr style=' text-align:center;background-color:lightgray;'><th style='border-right: 3px solid black;margin:0%;padding:0%;'>Name</th>
        <th style='border-right: 3px solid black;'>Room</th><th style='border-right: 3px solid black;'>Image</th>
        <th style='border-right: 3px solid black;'>Ext</th><th>Action</th></tr>";
        while($resultselect=$stmt->fetch(PDO::FETCH_OBJ)){
            $num=$resultselect->user_id;
        echo ("<tr>
            <td style='font-style: italic; color: black;border-right: 3px solid black;'>".$resultselect->name.
            "</td><td style='font-style: italic; color: black;border-right: 3px solid black;background-color:mintcream;text-align:center;'>"
            .$resultselect->room."</td>
            <td style='border-right: 3px solid black;text-align:center;'>
            <img src='$resultselect->image' alt='$resultselect->name' height='50' width='50'> 
            </td><td style='font-style: italic; color: black;background-color:mintcream;border-right: 3px solid black;text-align:center;'>"
            .$resultselect->ext."</td><td style='font-style: italic; color: black;text-align:center;'>
            <a href='editUser.php?row=".$num."'>Edit\n\n</a><a href='deleteUser.php?row=".$num."
            '>Delete</a></td></tr>");
        
        }

        echo "</table>";
    
        $resultselect->free_result();
        }
        catch(PDOException $e){
            echo "Connection failed:".$e->getMessage();
        }

?>
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
        #admin{
            font-size:300%;
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
</html>
