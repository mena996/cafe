<?php
    session_start();
    if(!isset($_SESSION["loggedIn"]) && $_SESSION["type"] == 0 ){
       header('Location: ../../login/index.php');
    }
    $userName = $_SESSION["name"];
    $userImg = $_SESSION["image"];
?>

<head>
    <meta charset="UTF-8">
    <title>Admin dashboard </title>
    <link rel="stylesheet" href="fontawesome-free-5.12.1-web/css/all.css">
    <link rel="stylesheet" href="../../css/website.css">
</head>

<body id="main_body">
<?php  
    include '../../layout/adminHeader.php';
?>
    <div id="form_container"></div>
        
    <form id="form" class="addproduct" method="POST" action="" enctype="multipart/form-data">
    <h1 class="addproductheader"> Add Product</h1>
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
                move_uploaded_file($file_tmp,"/var/www/html/../Images/".$file_name);
         
                // echo "Success";
            // var_dump($_POST);
            include '../../datbaseFiles/databaseConfig.php';
            // var_dump($db);
            // echo "<br>";
       
            $productname="";
            $productname.=$_POST["product_name"];
           
            $price="";
            $price.=$_POST["price"];
            
            
            $categoryid="";
            $categoryid.=$_POST["category"];
         
            $path="/../Images/".$file_name;
            $query="INSERT INTO products (name, price, image,category_id) VALUES (?,?,?,?)";
                 
            $stmt=$db->prepare($query);
            $stmt->execute([$productname,$price,$path,$categoryid]);
            $result=$stmt->fetchAll();
            // var_dump($result);
            // echo $result."<br>";
            

            $result->free_result();
 }    
}else{
    print_r($errors);
}
// 

?>
</html>