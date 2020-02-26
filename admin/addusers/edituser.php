<?php
    session_start();
    if(!isset($_SESSION["loggedIn"])){
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
        $number = $_POST['id'];
        $image=$_POST['image'];            
        $name=$email=$ext=$room=$password="";
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
        if(!empty( $_FILES['profilePic']['name'])){
            $errors= array();  
            // var_dump($_FILES);
            
            $file_name = $_FILES['profilePic']['name'];
            $file_size =$_FILES['profilePic']['size'];
            $file_tmp =$_FILES['profilePic']['tmp_name'];
            $file_type=$_FILES['profilePic']['type'];
            $ext=explode('.',$_FILES['profilePic']['name']);
            $file_ext=strtolower(end($ext));

            $extensions= array("jpeg","jpg","png");
            
            if(in_array($file_ext,$extensions)=== false){
                $errors[]="extension not allowed, please choose a JPEG or PNG file. \n";
                $flag=1;
            }
            if($file_size > 1097152){
                $errors[]='File size must be excately 1 MB \n';
                $flag=1;
            }
            if(empty($errors)==true){
                move_uploaded_file($file_tmp,"/var/www/html/".$file_name);
                $image=$file_name;
            }
        }

        if($flag != 1){
    // echo "<br>connecting to database<br>";

            include '../../datbaseFiles/databaseConfig.php';
          
             $name=$_POST['user_name'];
          
             $password=$_POST['password'];
          
             $email=$_POST['email'];
             
             $ext=$_POST['extnumber'];
          
             $room=$_POST['roomnumber'];
            
            $query="UPDATE users SET name='$name',email='$email',password='$password',ext='$ext',room='$room',image='$image' WHERE user_id=$number";
            
            $stmt=$db->prepare($query);
            $stmt->execute([$name,$email,$password,$ext,$room,$image]);
           
            // $result=$stmt->fetch(PDO::FETCH_OBJ);
            header('Location: /cafe/admin/addusers/alluserspage.php');
           
 
}

?>
</html>
