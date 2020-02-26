<?php
    session_start();
    if(!isset($_SESSION["loggedIn"]) && $_SESSION["type"] == 0 ){
       header('Location: ../../login/index.php');
    }
    $userName = $_SESSION["name"];
    // $userImg = $_SESSION["image"];
?>

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
include '../../datbaseFiles/databaseConfig.php';
$number = $_GET['row'];

    $query="DELETE FROM users WHERE user_id=$number";
   
    $stmt=$db->prepare($query);
    $stmt->execute();
    // $result=$stmt->fetchAll();
  
    
    header('Location: alluserspage.php');
 

 
?>

</html>