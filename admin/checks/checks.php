<?php
  session_start();
  if(!isset($_SESSION["loggedIn"]) && $_SESSION["type"] == 0 ){
       header('Location: ../../login/index.php');
    }
        include '../../layout/adminHeader.php';
        //include '../../datbaseFiles/databaseConfig.php';
?>
<style>
body {
  font-family: "Segoe UI", -apple-system, BlinkMacSystemFont, Roboto,
    Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
  line-height: 1.4;
  background: #fefefe;
  color: #333;
  margin: 0 1em;
}

table {
  margin: 1em 0;
  border-collapse: collapse;
}

caption {
  text-align: left;
  font-style: italic;
  padding: 0.25em 0.5em 0.5em 0.5em;
}

th,
td {
  padding: 0.25em 0.5em 0.25em 1em;
  vertical-align: text-top;
  text-align: left;
  text-indent: -0.5em;
}

th {
  vertical-align: bottom;
  background-color: rgba(0, 0, 0, 0.75);
  color: #fff;
  font-weight: bold;
}

.row td:nth-of-type(2), .cell td:nth-of-type(3) {
  font-style: italic;
}

.row th:nth-of-type(3),
.row td:nth-of-type(3),
.cell th:nth-of-type(4),
.cell td:nth-of-type(4) {
  text-align: center;
}

td[colspan] {
  background-color: #eee;
  color: #000;
  font-weight: normal;
  font-style: italic;
  padding: 0;
  text-indent: 0;
}

tr.shown, tr.hidden {
  background-color: #eee;
  display: table-row;
}

tr.hidden {
  display: none;
}

.row button {
  background-color: transparent;
  border: .1em solid transparent;
  font: inherit;
  padding: 0.25em 0.25em 0.25em .25em;
  width: 100%;
  text-align: left;
}

.row button:focus, .row button:hover {
  background-color: #ddd;
  outline: .2em solid #00f;
}

.row button svg {
  width: .8em;
  height: .8em;
  margin: 0 0 -.05em 0;
  fill: #66f;
  transition: transform 0.25s ease-in;
  transform-origin: center 45%;
}

.row button:hover svg,
.row button:focus svg {
  fill: #00c;
}

/* Lean on programmatic state for styling */
.row button[aria-expanded="true"] svg {
  transform: rotate(180deg);
}

.cell button {
  /* font-size: 60%; */
  color: #000;
  background-color: #00f;
  /* padding: 0.2em 0.2em 0.2em 0.2em; */
  border: 0.2em solid #00f;
  border-radius: 50%;
  /* line-height: 1; */
  width:2em;
  height:2em;
  text-align: center;
  text-indent: 0;
  /* transform: rotate(270deg); */
}

.cell button:hover,
.cell button:focus {
  background-color: #fff;
  outline: none;
}

.cell button:hover svg,
.cell button:focus svg {
  fill: #00f;
}

/* Lean on programmatic state for styling */
.cell button[aria-expanded="true"] svg {
  transform: rotate(90deg);
}

/* Proven method to visually hide something but */
/* still make it available to assistive technology */
.visually-hidden {
  position: absolute;
  top: auto;
  overflow: hidden;
  clip: rect(1px 1px 1px 1px); /* IE 6/7 */
  clip: rect(1px, 1px, 1px, 1px);
  width: 1px;
  height: 1px;
  white-space: nowrap;
}
.tableWidth{
  width: 400px ;
}
.tableWidthC1{
  width: 50px ;
}
.productImage{
  width: 200px;
  height: 150px;
  margin-left: 10px;
  margin-right: 10px;
}
#myInput {
  background-image: url('/css/searchicon.png');
  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}
.Tsub{
  background-color:gray !important;
}
.Tsub1{
  vertical-align: bottom;
  background-color: rgba(0, 0, 0, 0.75);
  color: #000;
  font-weight: bold;
}
</style>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<link rel="stylesheet" href="fontawesome-free-5.12.1-web/css/all.css">
<link rel="stylesheet" href="../../css/website.css">
<h2>checks</h2>
<form action="checks.php">
<label>from</label><input id="dateFrom" name="from" type="date" value=<?= $_GET['from'] ?> >
<label>to</label><input id="dateTo" name="to" type="date" value=<?= $_GET['to'] ?> >
<button>search</button>
</form>
<select id="userSelector" onchange="search()">
<option value="">all</option>
  <?php 
  $servername = "localhost";
  $username = "root";
  $password = "root";
  $dbname = "cafe";
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT * from users");
     $stmt->execute();
 
     // set the resulting array to associative
     $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
     $tempUId=-1;
     $tempOId=-1;
     while ($row = $stmt->fetch()) {
      echo "<option value='{$row['user_id']}'>{$row['name']}</option>";
     }
  ?>
</select>
<!-- <input type="text" id="myInput" onchange="search()" placeholder="Search for names.." title="Type in a name"></input> -->
<table class="cell" id="myTable">
  <thead>
    <tr>
      <th class="tableWidthC1"><span class="visually-hidden">Toggle</span></th>
      <th class="tableWidth">name</th>
      <th class="tableWidth">Total Amount</th>
    </tr>
  </thead>
  <tbody>
   <?php 
   try {
     if($_GET['from']&&$_GET['to']){
     $stmt = $conn->prepare("SELECT * ,(SELECT sum(order_items.amoiunt * products.price) from order_items LEFT JOIN products on products.product_id=order_items.product_id where orders.order_id=order_items.order_id )as amount , (SELECT sum(order_items.amoiunt * products.price) from (order_items LEFT JOIN products on products.product_id=order_items.product_id)LEFT JOIN orders as ord on ord.order_id=order_items.order_id where orders.user_id=ord.user_id )as total , (select users.name from users where users.user_id=orders.user_id ) as uname from order_items LEFT JOIN orders on order_items.order_id=orders.order_id LEFT join products on order_items.product_id= products.product_id WHERE orders.date_time>? and orders.date_time<? order by orders.user_id ,orders.order_id ");
     $stmt->execute([$_GET['from'],$_GET['to']]);
     }else{
      $stmt = $conn->prepare("SELECT * ,(SELECT sum(order_items.amoiunt * products.price) from order_items LEFT JOIN products on products.product_id=order_items.product_id where orders.order_id=order_items.order_id )as amount , (SELECT sum(order_items.amoiunt * products.price) from (order_items LEFT JOIN products on products.product_id=order_items.product_id)LEFT JOIN orders as ord on ord.order_id=order_items.order_id where orders.user_id=ord.user_id )as total , (select users.name from users where users.user_id=orders.user_id ) as uname from order_items LEFT JOIN orders on order_items.order_id=orders.order_id LEFT join products on order_items.product_id= products.product_id order by orders.user_id ,orders.order_id ");
      $stmt->execute();
     }
     // set the resulting array to associative
     $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
     $tempUId=-1;
     $tempOId=-1;
     while ($row = $stmt->fetch()) {
      if($tempUId!=$row['user_id']){
        $tempUId=$row['user_id'];
       echo "<tr>
                <td>
                <button type='button' id='{$row['order_id']}' aria-expanded='false' onclick=\"toggle(this.id,'.s{$row['user_id']}');\" aria-controls='MS01b MS02b MS03b' aria-label='3 more from' aria-labelledby='btnMSb lblMSb'>
          +
        </button>
                </td>
                <td hidden>{$row['user_id']}</td>
                <td>{$row["uname"]}</td>
                <td>{$row["total"]}</td>
            </tr>
            <tr class='Tsub s{$row['user_id']} hidden'>
      <td></td>
      <td hidden>{$row['user_id']}</td>
      <td>order date</td>
      <td>amount</td>
    </tr>";
  }
  if($tempOId!=$row['order_id']){
    $tempOId=$row['order_id'];
      echo "<tr class='Tsub1 s{$row['user_id']} hidden'>
      <td hidden></td>
      <td hidden>{$row['user_id']}</td>
      <td><button type='button' id='b{$row['order_id']}' aria-expanded='false' onclick=\"toggle(this.id,'.o{$row['order_id']}');\" aria-controls='MS01b MS02b MS03b' aria-label='3 more from' aria-labelledby='btnMSb lblMSb'>
      +
    </button></td>
      <td>{$row["date_time"]}</td>
      <td>{$row["amount"]}</td>
    </tr>
    <tr class='o{$row['order_id']} s{$row['user_id']} subimg hidden'>
    <td></td>
    <td hidden>{$row['user_id']}</td>
      <td colspan='3'>
      ";
  }
  echo "<span><img src='../Images/{$row['image']}' class='productImage'>
        <label>{$row['amoiunt']} X {$row['price']} L.E</lable></span>";
  // echo "</td>
  //   </tr>";
    }
 }
 catch(PDOException $e) {
     echo "Error: " . $e->getMessage();
 }
 
 
 $conn=null;
 $conn2=null;
  ?>
  </tbody>
</table>

<script>
function toggle(btnID, eIDs) {
  // Feed the list of ids as a selector
  var theRows = document.querySelectorAll(eIDs);
  // Get the button that triggered this
  var theButton = document.getElementById(btnID);
  // If the button is not expanded...
  if (theButton.getAttribute("aria-expanded") == "false") {
    // Loop through the rows and show them
    for (var i = 0; i < theRows.length; i++) {
      if(!theRows[i].classList.contains("subimg") || btnID[0]=='b'){
        theRows[i].classList.add("shown");
        theRows[i].classList.remove("hidden");
      }
    }
    // Now set the button to expanded
    theButton.setAttribute("aria-expanded", "true");
    // Otherwise button is not expanded...
    theButton.innerHTML="-";
  } else {
    // Loop through the rows and hide them
    for (var i = 0; i < theRows.length; i++) {
      theRows[i].classList.add("hidden");
      theRows[i].classList.remove("shown");
    }
    // Now set the button to collapsed
    theButton.setAttribute("aria-expanded", "false");
    theButton.innerHTML="+";
  }
}
function search() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("userSelector");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase()==filter || filter=="") {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
<?php
        include '../../layout/footer.php';
    ?>
</body>
</html>
