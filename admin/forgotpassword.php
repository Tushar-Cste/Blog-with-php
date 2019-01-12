<?php
	include '../lib/Session.php';
	Session::checklogin();
?>

<!-- for database connection include following file -->
<?php include '../config/config.php';?>
<?php include '../lib/Database.php';?>
<?php include '../helpers/Format.php';?>



<?php 
	$db = new Database;
	$fm = new Format;
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$email = $fm->validation($_POST['email']);
		$email = mysqli_real_escape_string($db->link,$email);
		if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
			echo "Email is invalid.";
		}else{
		
			$query = "SELECT * FROM users where email = '$email' limit 1";
			$result = $db->select($query);
			if($result != false){
				while($user = $result->fetch_assoc()){
					$userid = $user['id'];
					$username = $user['name'];
				}
				$text = substr($email,0,3);
				$rand = rand(1000,9999);
				$newpass = "$text$rand";
				$password = md5($newpass);
				$query = "Update users set password = '$password' where id='$userid' AND email = '$email'";
				$updated_row = $db->update($query);
				$to = $email;
				$from ="mollahasan512@gmail.com";
				$header = "From: $from\n";
				$header .= "MIME-Version: 1.0 \r\n";
				$header .= "Content-type: text/html; charset=iso-8859-1 \r\n";
				$subject = "Your Password";
				$message = "Your username is:".$username." and Password is:".$newpass."\n Visit the website login page.";
				$sendmail($to,$subject,$message,$header);
				if($sendmail){
					echo "<span style='color:green;font-size:18px'>Please check your mail.</span>";
				}
			}
			else{
				echo "<span style='color:red;font-size:18px'>Email not Exit!</span>";
			}
		}
	}
	
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Password Recovery</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>


<div class="container">
	<section id="content">
		<form action="login.php" method="post">
			<h1>Password Recovery</h1>
			<div>
				<input type="text" placeholder="Enter Valid Password" name="email"/>
			</div>
			
			<div>
				<input type="submit" value="Send mail" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="login.php">Login</a>
		</div>
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>