<?php

$flag = 0;
if(empty($_POST['fullName'])){
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
echo "uploading..";
if(!empty($_FILES["profilePic"]["name"])){   //always use $post when uploading files
    echo "initializing uploading the file.."; //sudo tail -f /var/log/httpd/error_log check for errors
    // $target_dir = "uploads/";
    $target_file = "uploads/" . basename($_FILES["profilePic"]["name"]);
    $flag=0;
    $imageFileType = strtolower(pathinfo("uploads/" . basename($_FILES["profilePic"]["name"]),PATHINFO_EXTENSION));

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $flag=1;
    }

    if (move_uploaded_file($_FILES["profilePic"]["tmp_name"],"uploads/" . basename($_FILES["profilePic"]["name"]))) {
        echo "The file ". basename( $_FILES["profilePic"]["name"]). " has been uploaded.";
        $flag=0;
    } else {
        echo "Sorry, there was an error uploading your file.";
        $flag=1;
    }    
}
    
else {
    echo "<h3># Please select a valid file  </h3>";
    $flag=1;
}
echo "<br>";
$output = "Fullname: ".$_POST['fullName']."\n"."email: ".$_POST['email']."\n";
file_put_contents("/var/www/html/lab2.txt",$output);
echo "<br>";
echo "everything is good so far";
if($flag != 1){
    echo "<br>connecting to database<br>";
    include '../../datbaseFiles/databaseConfig.php';
    $query="INSERT INTO cafe.users (`name`,`password`,email,`image`,ext,room) VALUES (?,?,?,?,?,?)";
    $statement = $db->prepare($query);
    $parameters = [ $_POST['fullName'],$_POST['password'],$_POST['email'],$target_file,$_POST['extnumber'],$_POST['roomnumber']];
    $statement->execute($parameters);
    echo "<br>we are officially connected..";
    
}



?>