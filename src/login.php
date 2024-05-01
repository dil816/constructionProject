<?php
	
    include("./config/database.php");
	session_start();

	if($_SERVER['REQUEST_METHOD']=="POST"){
		$Email=$_POST['email'];
		$Password=$_POST['Password'];

		
			
			$query ="SELECT * FROM user WHERE email='$Email' && Password='$Password'";
			$result=mysqli_query($conn,$query);
			
			
				if(mysqli_num_rows($result)>0){
					$user_data=mysqli_fetch_array($result);
					$_SESSION['user_id']=$user_data['ID'];
					
					if($user_data['User_Type']=='admin'){
						header("location:adminPage.php");
						die;
					}
					else if($user_data['User_Type']=='User'){
						header("location:userDashboard.php");
						die;
					}
					else if($user_data['User_Type']=='Chef'){
						header("location:chefdashboard.php");
						die;
					}
					else{
						$error[]='Incorrect email or Password';
					}
				}
		
	
	}
?>

<html>

<head>
<title>Recipe System</title>

<link rel="stylesheet" type="text/css" href="style/style.css">
<link rel="stylesheet" type="text/css" href="style/logIn.css">
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<style>
div {
  background-image:url('images/00.jpg');
   background-size:cover;
  background-repeat:no-repeat;
  background-attachment:fixed;
  width: 270px;
  height:380px;
  border: 10px  double black;
  border-radius:40px;
  padding: 50px;
  margin: 20px auto 0;
  opacity: 70%;
}
lable{
	font-weight:bold;
}
</style>
</head>

<body>

<image  class="logo" src="images/logo.png" width="8%">
<h1 class="text1">BakingDaddy<p class='text2'>.Recipe Provider.</p></h1>


<div>
<center>
    <h1>LOG IN</h1>
</center>
<form  method="POST">
     <center>
	 <br>
	 <?php 
	if(isset($error)){
		foreach($error as $error){
			echo'<span class="error-msg">'.$error.'</span>';
		}
	}
    ?>
	 <lable>Email</lable>
    <input type="email" name="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}" required><br/><br/>
        
    <lable>Password</lable>
    <input type="password" name="Password" placeholder="Password"  required><br/><br/>
        
  
   
    <button style="font-weight:bold" type="submit">Log in</button>
	</center>
	<h4 style="font-weight:bold">don't have an account? <a style="color:red;font-size:19px;text-decoration-line:underline;font-weight:bold" href="submitSignUp.php">signup now</a>
	<br><br><center><a style="color:blue;font-size:18px;text-decoration-line:underline;font-weight:bold" href="homepage.html">back to home</a></center></h4>
	</form>	
   </div>
   
    


<br><br><br><br>

<footer>
<image style="float:left" src="images/logo.png" width="7%">
<h5 style="color:white">BakingDaddy <br>16/9 Meta Road,Colombo06</h5>


<ul class="footerIcons">
	<li><a href="https://www.facebook.com/"><ion-icon name="logo-facebook"></ion-icon></li></a>
	<li><a href="https://www.instagram.com/"><ion-icon name="logo-instagram"></ion-icon></li></a>
	<li><a href="https://twitter.com/"><ion-icon name="logo-twitter"></ion-icon></li></a>
</ul>

<ul class="footerMenu">
	<li class="footerNav"><a href="contactus.html">Contact us</a></li>
	<li class="footerNav"><a href="terms & conditions">Terms & conditions</a></li>
	<li class="footerNav"><a href="feedback.html">Feedback</a></li>
</ul>
</footer>
</body>
</html>