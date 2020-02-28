<?php
session_start();
if (!isset($_SESSION["loggedIn"]) && $_SESSION["type"] == 0) {
    header('Location: /php_project/login/index.php');
}
$userName = $_SESSION["name"];
$userImg = $_SESSION["image"];
?>
<?php
if ($_POST) {
    $flag = 0;
    if (empty($_POST['fullName'])) {
        echo "<h3># Please enter a valid username</h3>";
        $flag = 1;
    }
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        echo "<h3># Please enter a valid Email</h3>";
        $flag = 1;
    }
    if ($_POST['password'] == $_POST['passwordConfirm']) {
        if (!preg_match("/[a-z0-9@]{8}/", $_POST['password'])) {
            echo "<h3># Please enter a valid password</h3>";
            $flag = 1;
        }
    } else {
        echo "<h3># Please enter a valid password</h3>";
        $flag = 1;
    }
    if (empty($_POST['roomnumber'])) {
        echo "<h3># Please select a room </h3>";
        $flag = 1;
    }
    if (empty($_POST['extnumber'])) {
        echo "<h3># Please select a room </h3>";
        $flag = 1;
    }
    if (!empty($_FILES['profilePic']['name'])) {
        $errors = array();
        // var_dump($_FILES);

        $file_name = $_FILES['profilePic']['name'];
        $file_size = $_FILES['profilePic']['size'];
        $file_tmp = $_FILES['profilePic']['tmp_name'];
        $file_type = $_FILES['profilePic']['type'];
        $ext = explode('.', $_FILES['profilePic']['name']);
        $file_ext = strtolower(end($ext));

        $extensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "extension not allowed, please choose a JPEG or PNG file. \n";
            $flag = 1;
        }
        if ($file_size > 1097152) {
            $errors[] = 'File size must be excately 1 MB \n';
            $flag = 1;
        }
        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "/var/www/html/php_project/Images/" . $file_name);
            $image = $file_name;
        }
    }
    if ($flag != 1) {
        include '../../datbaseFiles/databaseConfig.php';
        $query = "INSERT INTO users (`name`,`password`,email,`image`,ext,room,`type`) VALUES (?,?,?,?,?,?,?)";
        $statement = $db->prepare($query);
        $parameters = [$_POST['fullName'], $_POST['password'], $_POST['email'], "$image", $_POST['extnumber'], $_POST['roomnumber'], 1];
        $statement->execute($parameters);
        // echo "<br>we are officially connected..";
        header('Location: alluserspage.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="adduser.css">
</head>

<body>
    <form action="adduser.php" method="POST" enctype="multipart/form-data">
        <div class="userinput">
            <div class="input">
                <div class="">
                    <span class=""> <i class="fa fa-user"></i> </span>
                </div>
                <input name="fullName" class="" placeholder="please fill your Fullname" type="text">
            </div>
            <div class="input">
                <div class="">
                    <span class=""> <i class="fa fa-envelope"></i> </span>
                </div>
                <input name="email" class="" placeholder="please enter your Email address" type="text">
            </div>
            <div class="input">
                <div class="">
                    <span class=""> <i class="fa fa-lock"></i> </span>
                </div>
                <input name="password" class="" placeholder="please write down your password" type="password">
            </div>
            <div class="input">
                <div class="">
                    <span class=""> <i class="fa fa-lock"></i> </span>
                </div>
                <input name="passwordConfirm" class="" placeholder="please confirm your password" type="password">
            </div>
            <div class="input">
                <div class="">
                    <span class=""> <i class="fa fa-building"></i> </span>
                </div>
                <input name="roomnumber" class="" placeholder="please enter your room number" type="text">
            </div>
            <div class="input">
                <div class="">
                    <span class=""> <i class="fa fa-phone"></i> </span>
                </div>
                <input name="extnumber" class="" placeholder="please enter your ext. number" type="text">
            </div>
        </div>
        <div class="choosefile">
            <input type="file" name="profilePic" class="" id="">
            <br>
        </div>
        <div class="">
            <button type="submit" class="btn"> Save </button>
            <button type="reset" class="btn"> reset </button>
        </div>
    </form>
</body>

</html>