<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>Add Product </title>
    <link rel="stylesheet" href="fontawesome-free-5.12.1-web/css/all.css">
</head>

<body id="main_body">

    <div id="form_container">
        <div class="title">
            <div class="menu">
                <table>
                    <td> <a href="userHomePage.php?">Home | </a></td>
                    <td> <a href="addproductall.php?">Products | </a></td>
                    <td> <a href="alluserspage.php?">Users | </a></td>
                    <td> <a href="adminOrderPage.php?">Manual orders | </a></td>
                    <td> <a href="Checks.php?">Checks </a></td>
                </table>
            </div>
            <div class="header">
                <h6 class="adminname">Admin</h6>
                <i class="fas fa-heart" id="admin"></i>
            </div>
        </div>
        <h1 class="addproductheader"> Add Product</h1>

        <form id="form" class="addproduct" method="POST" action="" enctype="multipart/form-data">
            <table class="list">
                <tr>

                    <td> Product </td>

                    <td> <input id="product_name" name="product_name" class="product_name" type="text" maxlength="255"
                            value="" />
                        <span class="error">*</span></td>
                </tr>

                <tr id="price">
                    <td> Price </td>

                    <td> <input id="price" name="price" class="price" type="number" maxlength="255" min="1" step="0.5" value="1" />
                        <span class="error">*</span></td>

                </tr>


                <tr id="cat">
                    <td> Category </td>
                    <td> <select class="category" id="category" name="category">
                            <option value="1">Hot Drinks</option>
                            <option value="2">Soft Drinks</option>
                            <option value=""></option>
                        </select> <span class="error">*</span>
                        <a href="addcategory.php?">add category</a></td>

                </tr>
                <tr id="productpicture">
                    <td> Product Picture</td>
                    <td> <input type="file" name="Product_Picture">
                        <input type="hidden" name="MAX_FILE_SIZE" value="1000000"></td>

                </tr>

                <tr class="buttons">
                    <td></td>
                    <td> <input id="saveForm" class="button_text" type="submit" name="submit" value="Save" />
                        <input id="resetForm" class="button_text" type="reset" name="reset" value="Reset" /></td>
                </tr>
            </table>
        </form>

    </div>
    <style>
        .error {
            color: #FF0000;
        }

        .menu {
            display: flex;
            flex-direction: row;

        }

        .header {
            display: flex;
            flex-direction: row-reverse;

        }

        .title {
            display: flex;
            justify-content: space-between;
        }

        .adminname {
            text-decoration: underline;
            font-size: 80%;
            margin-right: 5%;
        }

        #admin {
            font-size: 250%;
            padding: 0%;
            margin: 0%;
        }

        .addproductheader {
            padding: 0%;
            margin: 0%;
        }
    </style>
</body>
<?php
// var_dump($_POST);
// echo "ertyui";
       $dsn='mysql:dbname=cafe;host=127.0.0.1;';
    //    echo "dfghjk";
       $user='basma';
       $password='basma12345';
    //    var_dump($_POST);
       

        
        if (empty($_POST["price"])) {
            echo "price You must enter "."\n";
            echo "<br>";
            // fwrite($filesave,$errors);

        }
         
        if (empty($_POST["category"])) {
            echo "please enter category "."\n";
            echo "<br>";
            // fwrite($filesave,$errors);
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
                echo "ext";
            }
            if($file_size > 1097152){
                $errors[]='File size must be excately 1 MB \n';
                echo "size";
            }
            if(empty($errors)==true){
            
            // var_dump($_POST);
            try{
            $db=new PDO ($dsn,$user,$password);
            // var_dump($db);
            // echo "<br>";
       
            $productname="";
            $productname.=$_POST["product_name"];
           
            $price="";
            $price.=$_POST["price"];
            
            
            $categoryid="";
            $categoryid.=$_POST["category"];
            
            
            
            if(empty($errors)==true){
                $path="/var/www/html/".$file_name;
                // move_uploaded_file($file_tmp,"/var/www/html/".$file_name)
            //         fwrite($filesave, "File Upload Success");

            }
        
           
        
            $query="INSERT INTO products (name, price, image,category_id) VALUES (?,?,?,?)";
                 
            $stmt=$db->prepare($query);
            $stmt->execute([$productname,$price,$path,$categoryid]);
            $result=$stmt->fetchAll();
            // var_dump($result);
            // echo $result."<br>";
            

            $result->free_result();
         
       }
       catch(PDOException $e){
        echo "Connection failed:".$e->getMessage();
    }
 }    
}

?>
</html>