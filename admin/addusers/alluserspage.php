<?php
    session_start();
    if(!isset($_SESSION["loggedIn"]) && $_SESSION["type"] == 0 ){
       header('Location: ../../login/index.php');
    }
    $userName = $_SESSION["name"];
    $userImg = $_SESSION["image"];
?>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="fontawesome-free-5.12.1-web/css/all.css">
    <link rel="stylesheet" href="../../css/website.css">
   
</head>

<body id="main_body">
    <?php
        include '../../layout/adminHeader.php'
    ?>
        
    </div>
    <div class="form_container d-flex justify-content-center">

                         
        <div class="container mb-5 row justify-content-center col-12"> 
            <div class="allusers row col-12 justify-content-center">
               <h1 class='col-2 row justify-content-center'> <strong>All Users</strong></h1>
            </div>
            <div class="allusers col-10">
                <a class='col-2 btn btn-success text-nowrap' href="adduser.php">add User </a>
            </div>
        
        <table class='table table-light text-center col-md-10'>
        
        <thead class="thead-dark">
            <tr >
                <th class="col-3">Name</th>
                <th class="col-2">Room</th>
                <th class="col-2">Image</th>
                <th class="col-2">Ext</th>
                <th class="col-3">Action</th>
            </tr>
        </thead>
        
<?php


        include '../../datbaseFiles/databaseConfig.php';
        $queryselect="SELECT * FROM users ";
        $stmt=$db->prepare($queryselect);
        $stmt->execute();
                
        while($resultselect=$stmt->fetch(PDO::FETCH_OBJ)){
            $num=$resultselect->user_id;
            $image=$resultselect->image;
        echo ("<tr>
            <td >".$resultselect->name.
            "</td><td >"
            .$resultselect->room."</td>
            <td >
            <img src='../../Images/$resultselect->image' alt='$resultselect->name' height='50' width='50'> 
            </td><td >"
            .$resultselect->ext."</td><td >
            <a href='editUser.php?row=".$num."&image=".$image."' class='btn btn-info text-center text-nowrap'>Edit\n\n</a>
            <a href='deleteUser.php?row=".$num."' class='btn btn-danger text-center'>Delete</a></td></tr>");
        }
        // $resultselect->free_result();
       ?>
            </table>
        </div>
        <?php include '../../layout/footer.php'?>
        </body>
</html>
