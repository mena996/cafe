
<?php
    session_start();
    if(!isset($_SESSION["loggedIn"]) && $_SESSION["type"] == 0){
       header('Location: ../../login/index.php');
    }
    $userName = $_SESSION["name"];
    $userImg = $_SESSION["image"];
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/website.css">

	<title>Update Product</title>
	
</head>
<body id="main_body">
<?php
    include '../../layout/adminHeader.php';
?>
    <h1 class='col row justify-content-center'> <strong>Update Product</strong></h1>

    <div id="form_container"class="container row justify-content-center">
   <div class="errors">
    <?php  if($_POST){
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
                                $image=$file_name;
                            }
                          
                        }
                            echo "</ul>";    
                            }

    ?>                                         
    </div>      
    <form id="form" class="addproduct" method="POST" action="" enctype="multipart/form-data">
    <div class="form-group">
                    <label>Product Name</label><span class="error">*</span>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="product_name" aria-describedby="emailHelp" placeholder="Product Name" />
                    
                </div>
                <div class="form-group">
                    <label>Price</label><span class="error">*</span>
                    <input type="number" min=0 name='price' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Price" />
                    
                </div>
                <div class="form-group">
                    <label>Category</label><span class="error">*</span>
                    <select class="custom-select my-1 mr-sm-2" id="category" name="category">
                        <option value="1">Hot Drinks</option>
                        <option value="2">Soft Drinks</option>
                    </select>
                    
                </div>
                <div class="form-group">
                    <label>Product Picture</label><span class="error">*</span>
                    <input type="file" name="Product_Picture" class="form-control-file">
                    <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                    
                </div>
                <div class="form-group">
                    <input id="saveForm" class="btn btn-primary" type="submit" name="submit" value="Save" />
                </div>
           
        </form>
        </div>
 	
   
    <?php
    include '../../layout/footer.php';
    ?>
    </body>
    <?php
   
        $productname=$price= $categoryid="";
        $number = $_GET['id'];
     
       
       
        if(empty($errors)==true&&empty($nameErr)&&empty($categoryErr)){
            include '../../datbaseFiles/databaseConfig.php';
            $productname.=$_POST["product_name"];
         
            $price.=$_POST["price"];
            
            $categoryid.=$_POST["category"];
            if($_POST){
             $query="UPDATE products SET name='$productname',price='$price',image='$image',category_id='$categoryid' WHERE product_id='$number'";  

            $stmt=$db->prepare($query);
            $stmt->execute([$productname,$price,$image,$categoryid]);
        
              header('Location: allProducts.php');
    }
               }     
?>
</html>
 