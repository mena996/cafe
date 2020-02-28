
<?php
    session_start();
    if(!isset($_SESSION["loggedIn"])){
       header('Location: ../../login/index.php');
    }
    $userName = $_SESSION["name"];
    // $userImg = $_SESSION["image"];
?>
<head>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="adduser.css">
    <link rel="stylesheet" href="website.css">

	<title>Update User</title>
	
</head>
<body id="main_body" >
	
	<div id="form_container" >
	
		<h1><a>Update user</a></h1>
        <form id="form" class="updateuser" method="POST" action="" enctype="multipart/form-data">
      
        <table class="list">
                <tr>

                    <td> User Name 
                    <div class="">
                    <span class=""> <i class="fa fa-user"></i> </span>
                    </div>
                    </td>

                    <td> <input id="user_name" name="user_name"  placeholder="please fill your Fullname" class="user_name" type="text" maxlength="255"
                            value="" />
                            <span class="error">*</span></td>
                                                 
                </tr>
                <tr>

                    <td> Email 
                    <div class="">
                    <span class=""> <i class="fa fa-envelope"></i> </span>
                    </div>
                    </td>

                    <td> <input name="email" class="" placeholder="please enter your Email address" type="text">
                        <span class="error">*</span></td>
                       
                </tr>
                <tr>

                    <td> Password 
                    <div class="">
                    <span class=""> <i class="fa fa-lock"></i> </span>
                    </div>
                    </td>

                    <td>  <input name="password" class="" placeholder="please write down your password" type="password">
                        <span class="error">*</span></td>
                </tr>
                <tr>

                    <td> Confirm password
                    <div class="">
                    <span class=""> <i class="fa fa-lock"></i> </span>
                    </div> </td>

                    <td> <input name="passwordConfirm" class="" placeholder="please confirm your password" type="password">
                        <span class="error">*</span></td>
                </tr>
                <tr>

                    <td> Room number
                    <div class="">
                    <span class=""> <i class="fa fa-building"></i> </span>
                    </div> </td>

                    <td>  <input name="roomnumber" class="" placeholder="please enter your room number" type="text">
                        <span class="error">*</span></td>
                </tr>
                <tr>
                <td> Ext 
                <div class="">
                    <span class=""> <i class="fa fa-phone"></i> </span>
                </div></td>
                    <td>   <input name="extnumber" class="" placeholder="please enter your ext. number" type="text">
                        <span class="error">*</span></td>
                </tr>
                <tr>
                <td> Profile Picture </td>

                    <td class="choosefile">
                        <input type="file" name="profilePic" class="" id="">
                        <br>
                      
                </tr>
                       
				<tr class="buttons">
                    <td>
                    <input id="saveForm" class="btn" type="submit" name="submit" value="Save" />
                    </td>
                    </tr>
        </table>			
		</form>
	
	</div>
    <div class="alert-danger" style=" margin: auto;
  width: 30%;
  
  padding: 10px;background-color:indianred;color:black;">
    <?php  if($_POST){
                $nameErr=$emailErr=$extErr=$roomErr=$passwordErr="";

                        echo " <ul>";
                         if(empty($_POST['user_name'])){
                            $nameErr="<li>Please enter a valid username</li>";
                            echo $nameErr;
                              }
                             if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
                                $emailErr="<li>Please enter a valid Email</li>";
                                echo $emailErr;
                              }
                             if ($_POST['password'] == $_POST['passwordConfirm'] ) {
                                if (!preg_match("/[a-z0-9@]{8}/",$_POST['password'])) {
                                $passwordErr= "<li>Please enter a valid password</li>";
                                echo $passwordErr;
                                   }
                              }
                             else {
                                $passwordErr= "<li>Please enter confirm password</li>";
                                echo $passwordErr;
                                  }
                             if(!empty($_POST['roomnumber'])){
                                $num_length = strlen($_POST['roomnumber']);
                                
                                if (!preg_match("/[a-z0-9@]/",$_POST['roomnumber'])||$num_length != 4) {
                                $roomErr= "<li>Please enter a valid room number of 4 characters[a-z or 0-9]</li>";
                                echo $roomErr;
                                }
                                
                                }
                                else{
                                $roomErr= "<li>Please enter a valid room number</li>";
                                echo $roomErr;
                                }
                             if(!empty($_POST['extnumber'])){
                                if (!preg_match("/^\d{4}$/",$_POST['extnumber'])) {

                                $extErr= "<li>Please enter a valid external number 4 digits only </li>";
                                echo $extErr;
                                }
                            }
                            else{
                                $extErr= "<li>Please enter a valid external number </li>";
                                echo $extErr;
                            }
                            echo "</ul>";    
                            }

                                ?>                                         
    </div>
    </body>
    <?php
        $number = $_GET['row'];
        $image=$_GET['image'];          
        $name=$email=$ext=$room=$password="";

        if(!empty( $_FILES['profilePic']['name'])){
            $errors= array();  
            // var_dump($_FILES);
            
            $file_name = $_FILES['profilePic']['name'];
            $file_size =$_FILES['profilePic']['size'];
            $file_tmp =$_FILES['profilePic']['tmp_name'];
            $file_type=$_FILES['profilePic']['type'];
            $ext=explode('.',$_FILES['profilePic']['name']);
            $file_ext=strtolower(end($ext));

            $extensions= array("jpeg","jpg","png");
            
            if(in_array($file_ext,$extensions)=== false){
                $errors[]="extension not allowed, please choose a JPEG or PNG file. \n";
                $flag=1;
            }
            if($file_size > 1097152){
                $errors[]='File size must be excately 1 MB \n';
                $flag=1;
            }
            if(empty($errors)==true){
                move_uploaded_file($file_tmp,"/var/www/html/".$file_name);
                $image=$file_name;
            }
        }

        if(empty($errors)&&empty($nameErr)&&empty($emailErr)&&empty($extErr)&&empty($roomErr)&&empty($passwordErr))
         // connecting to database;
{
            include '../../datbaseFiles/databaseConfig.php';
          
             $name=$_POST['user_name'];
          
             $password=$_POST['password'];
          
             $email=$_POST['email'];
             
             $ext=$_POST['extnumber'];
          
             $room=$_POST['roomnumber'];
            
            $query="UPDATE users SET name='$name',email='$email',password='$password',ext='$ext',room='$room',image='$image' WHERE user_id=$number";
            
            $stmt=$db->prepare($query);
            $stmt->execute([$name,$email,$password,$ext,$room,$image]);
           
            // $result=$stmt->fetch(PDO::FETCH_OBJ);
            header('Location: alluserspage.php');
           
 

        }
?>
</html>
 