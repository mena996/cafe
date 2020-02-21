<?php
// var_dump($_POST);
// echo "ertyui";
       $dsn='mysql:dbname=cafe;host=127.0.0.1;';
    //    echo "dfghjk";
       $user='basma';
       $password='basma12345';
    //    var_dump($_POST);
        if (empty($_POST["product_name"])) {
           echo  "Product Name is required"."\n";
            // fwrite($filesave,$errors);
            
            echo "<br>";
           
        }

        
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
            //     if(move_uploaded_file($file_tmp,"/var/www/html/".$file_name)){
            //         fwrite($filesave, "File Upload Success");

            //     }
            }
        
            $num="";
        
            $query="INSERT INTO products (name, price, image,category_id) VALUES (?,?,?,?)";
                 
            $stmt=$db->prepare($query);
            $stmt->execute([$productname,$price,$path,$categoryid]);
            $result=$stmt->fetchAll();
            // var_dump($result);
            // echo $result."<br>";
            
             $queryselect="SELECT * FROM products ";
             $stmt=$db->prepare($queryselect);
             $stmt->execute([$productname,$price,$path]);
             $rowcount=$stmt->rowCount();
            
             $resultselect=$stmt->fetch(PDO::FETCH_OBJ);
            //  echo $resultselect."<br>";
            //  var_dump($resultselect);
         
             echo "<table>";
             echo "<tr style='border: 1px solid black;'><th>Product_id</th><th>name</th><th>price</th><th>imagepath</th><th>category_id</th></tr>";
             while($resultselect=$stmt->fetch(PDO::FETCH_OBJ)){
                //  $num=$resultselect->product_id;
              echo ("<tr style='border: 1px solid black;'><td style='font-style: italic;border: 1px solid black;'>".$resultselect->product_id."</td><td style='font-style: italic;border: 1px solid black;'>"
              .$resultselect->name."</td><td style='font-style: italic;border: 1px solid black;'>".$resultselect->price.
              "</td><td style='font-style: italic;border: 1px solid black;'>".$resultselect->image.
              "</td><td style='font-style: italic;border: 1px solid black;'>".$resultselect->category_id."</td>");
            
            }

            // $result->free_result();
            echo "</table>";
         
            
            // echo ($result);
            // echo ($rowcount);
        //    $resultselect->free_result();
       }
       catch(PDOException $e){
        echo "Connection failed:".$e->getMessage();
    }
 }    
}
    

    
   
?>