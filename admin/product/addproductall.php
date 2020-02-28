<?php
session_start();
if (!isset($_SESSION["loggedIn"]) && $_SESSION["type"] == 0) {
    header('Location: /php_project/login/index.php');
}
$userName = $_SESSION["name"];
$userImg = $_SESSION["image"];
?>
<?php
    include '../../layout/adminHeader.php';
    ?>
<?php
if ($_POST) {
    $productname = $price = $categoryid = "";
    echo "<div class='errors' style=''>";
    if($_POST){
          $nameErr=$priceErr=$categoryErr="";
 
                  echo " <ul>";
                  if (empty($_POST["product_name"])) {
                      $nameErr="<li>you must enter product name </li>";
                      echo $nameErr;
                   }
                  if (empty($_POST["category"])) {
                      $categoryErr= "<li>please enter category </li>";;   
                      echo  $categoryErr;
                  }
                  if (empty($_POST["price"])) {
                      $priceErr="<li> You must enter price </li>";   
                      echo $priceErr;
                  }
                  if(isset($_FILES['Product_Picture'])){
                      $errors= array();  
                      // var_dump($_FILES);
                      
                      $file_name = $_FILES['Product_Picture']['name'];
                      $file_size =$_FILES['Product_Picture']['size'];
                      $file_tmp =$_FILES['Product_Picture']['tmp_name'];
                      $file_type=$_FILES['Product_Picture']['type'];
                      $ext=explode('.',$_FILES['Product_Picture']['name']);
                      $file_ext=strtolower(end($ext));
          
                      $extensions= array("jpeg","jpg","png");
                      
                      if(in_array($file_ext,$extensions)=== false){
                          $errors[]="extension not allowed, please choose a JPEG or PNG file. \n";
                          echo "<li>extension not allowed, please choose a JPEG or PNG file. </li>";
                          
                      }
                      if($file_size > 1097152){
                          $errors[]='File size must be excately 1 MB <br>';
                         echo '<li>File size must be excately 1 MB </li>';
                      }
                      if(empty($errors)==true){
                          move_uploaded_file($file_tmp,"../../Images/".$file_name);
                          $path=$file_name;
                      }
                
                  }
                 
                      echo "</ul>";    
                      }
 
 
 echo "</div>"; 
    if (empty($errors) == true && empty($nameErr) && empty($categoryErr)&&empty($priceErr)) {
        include '../../datbaseFiles/databaseConfig.php';


        $path = $file_name;
        $productname .= $_POST["product_name"];

        $price .= $_POST["price"];

        $categoryid .= $_POST["category"];

        $query = "INSERT INTO products (name, price, image,category_id) VALUES (?,?,?,?)";

        $stmt = $db->prepare($query);
        $stmt->execute([$productname, $price, $path, $categoryid]);

        header('Location: allProducts.php');
    }
}
?>

<head>
    <meta charset="UTF-8">
    <title>Admin dashboard </title>
    <link rel="stylesheet" href="fontawesome-free-5.12.1-web/css/all.css">
    <link rel="stylesheet" href="../../css/website.css">
  
</head>

<body id="main_body">
    
    <div id="form_container"></div>
    <div class="container row justify-content-center col-12">
        <div class="col-8">
                <h1 class='col-6 row justify-content-center'> <strong>AddProducts</strong></h1>
            </div>
            <form id="form" class="addproduct" method="POST" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="product_name" aria-describedby="emailHelp" placeholder="Product Name" >
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input type="number" min=0 name='price' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Price" >
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select class="custom-select my-1 mr-sm-2" id="category" name="category">
                       <?php 
                        include '../../datbaseFiles/databaseConfig.php';
                        $query = "SELECT * FROM category";
                        $stmt = $db->prepare($query);
                        $stmt->execute();
                        while($resultselect=$stmt->fetch(PDO::FETCH_OBJ)){
                            echo ("<option value=".$resultselect->category_id.">"
                            .$resultselect->name."</option>");
                          }
                        ?>
                       
                    </select>
                </div>
                <div class="form-group">
                    <label>Product Picture</label>
                    <input type="file" name="Product_Picture" class="form-control-file">
                    <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                </div>
                <div class="form-group">
                    <input id="saveForm" class="btn btn-primary col-3" type="submit" name="submit" value="Save" />
                    <input id="reset" class="btn col-3" type="reset" name="reset" value="reset" />
                </div>
            </form>
        </div>
                  
    </div>
 <?php
    include '../../layout/footer.php';
    ?>
    
</body>

</html>
