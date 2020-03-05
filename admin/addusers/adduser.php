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
    // var_dump($_POST);
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
        if (!preg_match("/[a-z0-9@]/", $_POST['password'])) {
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
    }
    include '../../datbaseFiles/databaseConfig.php';
    $query = "INSERT INTO users (`name`,`password`,email,`image`,ext,room,`type`) VALUES (?,?,?,?,?,?,?)";
    $statement = $db->prepare($query);
    $parameters = [$_POST['fullName'], $_POST['password'], $_POST['email'], "$file_name", $_POST['extnumber'], $_POST['roomnumber'], 1];
    $statement->execute($parameters);
    // echo "<br>we are officially connected..";
    header('Location: alluserspage.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {
            background-image: url('../../Images/beans-brew-caffeine-coffee-2059.jpg');
            background-size: cover;
        }
    </style>
</head>

<body>
    <?php
    include '../../layout/adminHeader.php';
    ?>
    <div id="form_container"></div>
    <div class="container  row justify-content-center col-12">
    <div class="allusers row col-12 justify-content-center">
                <h1 class='col-6 row justify-content-center'> <strong class="text-light">Add User</strong></h1>
            </div>
        <div class="col-8 white">
            <form action="adduser.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Fullname</label>
                    <input name="fullName" class="form-control" placeholder="please fill your Fullname" type="text">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input name="email" class="form-control" placeholder="please enter your Email address" type="email">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input name="password" class="form-control" placeholder="please write down your password" type="password">
                </div>
                <div class="form-group">
                    <label>Confirm password</label>
                    <input name="passwordConfirm" class="form-control" placeholder="please confirm your password" type="password">
                </div>
                <div class="form-group">
                    <label>Room number</label>
                    <input name="roomnumber" class="form-control" placeholder="please enter your room number" type="text">
                </div>
                <div class="form-group">
                    <label>Ext number</label>
                    <input name="extnumber" class="form-control" placeholder="please enter your ext. number" type="text">
                </div>


                <div class="form-group">
                    <label>Profile Picture</label>
                    <input type="file" name="profilePic" class="form-control-file">
                    <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                </div>
                <div class="form-group">
                    <input id="saveForm" class="btn btn-primary col-3" type="submit" name="submit" value="Save" />
                    <input id="reset" class="btn col-3" type="reset" name="reset" value="reset" />
                </div>
            </form>
        </div>
    </div>
</body>

</html>