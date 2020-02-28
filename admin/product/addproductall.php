<?php
session_start();
if (!isset($_SESSION["loggedIn"]) && $_SESSION["type"] == 0) {
    header('Location: /php_project/login/index.php');
}
$userName = $_SESSION["name"];
$userImg = $_SESSION["image"];
?>
<?php
if ($_POST) {
    $flag = 0;
    $nameErr = $priceErr = $categoryErr = "";
    $productname = $price = $categoryid = "";

    if (isset($_FILES['Product_Picture'])) {
        $errors = array();

        $file_name = $_FILES['Product_Picture']['name'];
        $file_size = $_FILES['Product_Picture']['size'];
        $file_tmp = $_FILES['Product_Picture']['tmp_name'];
        $file_type = $_FILES['Product_Picture']['type'];
        $ext = explode('.', $_FILES['Product_Picture']['name']);
        $file_ext = strtolower(end($ext));

        $extensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "extension not allowed, please choose a JPEG or PNG file. \n";
            echo "extension not allowed, please choose a JPEG or PNG file. <br>";
        }
        if ($file_size > 1097152) {
            $errors[] = 'File size must be excately 1 MB <br>';
            echo 'File size must be excately 1 MB <br>';
        }
        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "/var/www/html/php_project/Images/" . $file_name);
        }
    }

    if (empty($errors) == true && empty($nameErr) && empty($categoryErr)) {
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
    <?php
    include '../../layout/adminHeader.php';
    ?>
    <div id="form_container"></div>
    <div class="container row justify-content-center col-12">
        <div class="col-8">
            <div class="allusers row col-12 justify-content-center">
                <h1 class='col-6 row justify-content-center'> <strong>AddProducts</strong></h1>
            </div>
            <form id="form" class="addproduct" method="POST" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="product_name" aria-describedby="emailHelp" placeholder="Product Name" required>
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input type="number" min=0 name='price' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Price" required>
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <select class="custom-select my-1 mr-sm-2" id="category" name="category">
                        <option value="1">Hot Drinks</option>
                        <option value="2">Soft Drinks</option>
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