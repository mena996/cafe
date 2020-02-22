
<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<title>Update User</title>
	
</head>
<body id="main_body" >
	
	<div id="form_container" >
	
		<h1><a>Update user</a></h1>
        <form id="form" class="updateuser" method="POST" action="edituser.php" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $_GET['row']; ?>">    
        <table class="list">
                <tr>

                    <td> User Name </td>

                    <td> <input id="user_name" name="user_name"  placeholder="please fill your Fullname" class="user_name" type="text" maxlength="255"
                            value="" />
                        <span class="error">*</span></td>
                </tr>
                <tr>

                    <td> Email </td>

                    <td> <input name="email" class="" placeholder="please enter your Email address" type="text">
                        <span class="error">*</span></td>
                </tr>
                <tr>

                    <td> Password </td>

                    <td>  <input name="password" class="" placeholder="please write down your password" type="password">
                        <span class="error">*</span></td>
                </tr>
                <tr>

                    <td> Confirm password </td>

                    <td> <input name="passwordConfirm" class="" placeholder="please confirm your password" type="password">
                        <span class="error">*</span></td>
                </tr>
                <tr>

                    <td> Room number </td>

                    <td>  <input name="roomnumber" class="" placeholder="please enter your room number" type="text">
                        <span class="error">*</span></td>
                </tr>
                <tr>
                <td> Ext </td>

                    <td>   <input name="extnumber" class="" placeholder="please enter your ext. number" type="text">
                        <span class="error">*</span></td>
                </tr>
                <tr>
                <td> Profile Picture </td>

                    <td class="choosefile">
                        <input type="file" name="profilePic" class="" id="">
                        <br>
                        <span class="error">*</span></td>
                </tr>
                       
				<tr class="buttons">
                    <td>
                    <input id="saveForm" class="button_text" type="submit" name="submit" value="Save" />
                    </td>
                    </tr>
        </table>			
		</form>
	
	</div>
  
    </body>
</html>
 