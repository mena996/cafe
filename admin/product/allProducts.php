<?php
    session_start();
    if(!isset($_SESSION["loggedIn"]) && $_SESSION["type"] == 0 ){
       header('Location: /php_project/login/index.php');
    }
?>
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
<link rel="stylesheet" href="../../css/website.css">
</head>
<body>
<?php  
    include '../../layout/adminHeader.php';
?>
<p>Available Products</p>
<form action="addproductall.php" method="get">
    <input type="submit" value="add new product" />
</form>

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
    $stmt = $db->prepare("SELECT * FROM products");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    while ($row = $stmt->fetch()) {
      echo "<tr id={$row['product_id']}>
               <td>{$row["name"]}</td>
               <td> <img src='{$row["image"]}' alt='{$row["name"]}' height='100' width='100'></td>
               <td>{$row["price"]}</td>
               <td>{$row["category"]}</td>
               <td><form action='http://localhost/database/update.php' method='get'><input type='submit' value='update' text='update'/><input type='hidden' name='id' value='{$row["id"]}' /> </form></td>
               <td><button onclick='delete1({$row["product_id"]})'>delete</button></td>
           </tr>";
   }


   $db=null;

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
       // xmlhttp.open("GET", "http://localhost/database/delete.php?id=" + id, true);
        xmlhttp.send();
  }
</script>