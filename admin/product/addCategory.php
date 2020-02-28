<?php
session_start();
if (!isset($_SESSION["loggedIn"]) && $_SESSION["type"] == 0) {
    header('Location: /php_project/login/index.php');
}
$userName = $_SESSION["name"];
$userImg = $_SESSION["image"];
?>
<!DOCTYPE html>
<html lang="en">

<body>
    <?php
    include '../../layout/adminHeader.php';
    ?>
    <form id="form" class="addCategory" method="POST" action="" enctype="multipart/form-data">

     <div class="form-group">
     <label>Category</label>
     <input type="text" class="form-control" id="exampleInputEmail1" name="Category_name" aria-describedby="emailHelp" placeholder="Category Name" >
    </div>
    <div class="form-group">
                    <input id="saveForm" class="btn btn-primary col-3" type="submit" name="submit" value="Save" />
    </div>
    </form>
  <?php  
         include '../../datbaseFiles/databaseConfig.php';

          $name = $_POST["Category_name"];

          $query = "INSERT INTO category (name) VALUES (?)";

          $stmt = $db->prepare($query);
          $stmt->execute([$name]);

          header('Location: addproductall.php');?>       
</body>
</html>