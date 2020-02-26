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
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>
<link rel="stylesheet" href="fontawesome-free-5.12.1-web/css/all.css">
<link rel="stylesheet" href="../../css/website.css">
<?php
include '../../layout/adminHeader.php';
?>
<br><br>
<h2>Available Products</h2>
<!-- <form action="addproductall.php" method="get">
    <input type="submit" value="add new product" style="width:200px!important"/>
</form> -->
<a href="addproductall.php">Add product</a>
<br>

<table id="myTable">
  <tr>
    <th>name</th>
    <th>image</th>
    <th>price</th>
    <th>category</th>
    <th>update</th>
    <th>delete</th>
  </tr>
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
               <td><form action='http://localhost/database/update.php' method='get'><input type='submit' value='update' text='update'/><input type='hidden' name='id' value='{$row["id"]}' /> </form></td>
               <td><button onclick='delete1({$row["id"]})'>delete</button></td>
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