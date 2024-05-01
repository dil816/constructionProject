<?php
	session_start();

    include("./config/database.php");

	if($_SERVER['REQUEST_METHOD']=="POST"){
		$Fullname=$_POST['fullname'];
        $UserName=$_POST['username'];
        $Password=$_POST['password'];
        $NIC=$_POST['nic'];
        $Address=$_POST['address'];
        $Email=$_POST['email'];
        $DOB=$_POST['dob'];
        $Mobile=$_POST['mobile'];
		
		if(!empty($Email) && !empty($Password) && !is_numeric($Email)){
			
			$query ="INSERT INTO user(fullname, username, password, nic, address, email, dob, mobile) VALUES('$Fullname', '$UserName', '$Password', '$NIC', '$Address', '$Email', '$DOB', '$Mobile')";
			
			mysqli_query($conn, $query);
			echo "<script type='text/javascript'>alert('Successfully Registered')</script>";
			header("Location: logIn.php");
			exit; // Ensure no further output after redirection
		}
		else{
			echo "<script type='text/javascript'>alert('Please Enter some Valid Details')</script>";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="./style/register.css"/>
</head>
<body>
    <form method="post" action="">
        <fieldset class="fieldset">
           <legend><h2>Registration</h2></legend>
            <div1>
              <table >
                 <tr>
                    <td><label><b>Full Name:</b></label></td>
                    <td><input type="text" name="fullname" size="40" placeholder="Hiniduma Gamage Janitha Suranjana Lakshan" autofocus required autocomplete="off"><br></td> 
                 </tr>
                 <tr>
                    <td><label><b>User name:</b></lable></td>
                    <td><input type="text" name="username" size="40" placeholder="HGJS Lakshan" required autocomplete="off"><br></td>
                 </tr>
                 <tr>
                    <td><label><b>Password:</b></lable></td>
                    <td><input type="password" name="password" size="40" placeholder="************" required autocomplete="off"><br></td>
                 </tr>
                 <tr>
                    <td><label><b>NIC:</b></lable></td>
                    <td><input type="text" name="nic" size="40" placeholder="200135300667" required autocomplete="off"><br></td>
                 </tr>
                 <tr>
                    <td><label><b>Address:</b></label></td>
                    <td><input type="text" name="address" size="40" placeholder="E/103,16th Ln, Malabe" required autocomplete="off"><br></td>
                 </tr>
                 <tr>
                    <td><label><b>E-mail:</b></lable></td>
                    <td><input type="email" name="email" size="40" placeholder="janithasuranjana2001@gmail.com" required autocomplete="off"><br></td>
                 </tr>
                 <tr>
                    <td><label><b>Date of birth:</b></lable></td>
                    <td><input type="date" name="dob" required autocomplete="off"><br></td>
                 </tr>
                 <tr>
                    <td><label><b>Mobile number:</b></lable></td>
                    <td><input type="tel" name="mobile" size="40" placeholder="074-3288572" pattern="[0-9]{10}" required autocomplete="off"><br><br></td>
                 </tr>
                 <tr>
                    <td></td>
                    <td><button class="button1" type="submit" name="submit">Register</button><br></td>
                 </tr>
                 <tr>
                     <td><label><b>Already have an account:</b></label></td>
                     <td><button class="button1" type="submit" name="login">Login</button><br></td>
                 </tr>
              </table> 
            </div1>
        
        </fieldset>
    </form>    
</body>
</html>
