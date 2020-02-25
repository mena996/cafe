
<?php
    session_start();
    if(!isset($_SESSION["loggedIn"])){
       header('Location: /php_project/login/index.php');
    }
    $userName = $_SESSION["name"];
    // $userImg = $_SESSION["image"];
?>
<head>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="adduser.css">

	<title>Update User</title>
	
</head>
<body id="main_body" >
	
	<div id="form_container" >
	
		<h1><a>Update user</a></h1>
        <form id="form" class="updateuser" method="POST" action="edituser.php" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $_GET['row']; ?>">    
        <input type="hidden" name="image" value="<?php echo $_GET['image']; ?>">    

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
  
    </body>
</html>
 