<?php
    session_start();
    if(!isset($_SESSION["loggedIn"]) && $_SESSION["type"] == 0 ){
       header('Location: ../../login/index.php');
    }
    $userName = $_SESSION["name"];
    $userImg = $_SESSION["image"];
    ?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../../css/website.css">
</head>
<body>
<?php include '../../layout/adminHeader.php';?>
<div class="form_container d-flex justify-content-center">

<div class="container row justify-content-center col-12"> 
            <div class="allusers row col-12 justify-content-center">
               <h1 class='col-6 row justify-content-center'> <strong>Available Products</strong></h1>
            </div>
            <div class="allusers col-10">
                <a class='col-2 btn btn-success text-nowrap' href="addproductall.php">Add product</a>
            </div>
<br>

<table class="table table-light text-center col-md-10">
  <thead class="thead-dark">
    <tr>
      <th class="col-2">Name</th>
      <th class="col-2">image</th>
      <th class="col-2">price</th>
      <th class="col-2">category</th>
      <th class="col-4">Action</th>
    </tr>
  </thead>
<?php 
    
    include '../../datbaseFiles/databaseConfig.php';

    $stmt = $db->prepare("SELECT *,category.name as category,products.name as pname ,products.product_id as id  FROM `products` LEFT JOIN `category` on products.category_id= category.category_id");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    while ($row = $stmt->fetch()) {
      echo "<tr id={$row['id']}>
               <td>{$row["pname"]}</td>
               <td> <img src='../../Images/{$row["image"]}' alt='{$row["pname"]}' height='100' width='100'> </td>
               <td>{$row["price"]}</td>
               <td>{$row["category"]}</td>
               <td>
                    <a href='update.php?id={$row['id']}' class='btn btn-info col-4 text-nowrap'>Edit\n\n</a>
               <button class='btn btn-danger col-4 text-nowrap' onclick='delete1({$row["id"]})'>DELETE</button></td>
            </tr>";
   }


$conn=null;

?>
</table>
<?php
        include '../../layout/footer.php';
    ?>
</body>
</html>
<script>
  function delete1(id) {
        var row = document.getElementById(id);
        row.parentNode.removeChild(row);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "delete.php?id=" + id, true);
        xmlhttp.send();
  }
</script>