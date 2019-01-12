<?php include "inc/header.php";?>

<?php 
	$db = new Database;
	$fm = new Format;
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$firstname = $fm->validation($_POST['firstname']);
		$lastname = $fm->validation($_POST['lastname']);
		$email = $fm->validation($_POST['email']);
		$body = $fm->validation($_POST['body']);

		$firstname = mysqli_real_escape_string($db->link,$firstname);
		$lastname = mysqli_real_escape_string($db->link,$lastname);
		$email = mysqli_real_escape_string($db->link,$email);
		$body = mysqli_real_escape_string($db->link,$body);

		$error;
		$msg;
		if(empty($firstname)){
			$error = "Fisrname must not be empty.";
		}elseif(empty($lastname)){
			$error="Lastname must not be empty.";
		}elseif(empty($email)){
			$error = "Email must not be empty.";
		}elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
			$error = "Email is invalid.";
		}elseif(empty($body)){
			$error = "Body must not be empty.";
		}else{
			$query="INSERT INTO contacts(firstname, lastname, email, body) values('$firstname','$lastname','$email','$body')";
            $result = $db->insert($query);
            if($result){
                $msg = "Message send successfully.";
            }
            else{
                $error = "There is some error to send the message";
            }
		}
	}
?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2>Contact us</h2>
				<?php
					if(isset($error)){
						
					echo "<span style='color:red'>$error</span>";
					}elseif(isset($msg)){
						echo "<span style='color:green'>$msg</span>";
					}
					
				?>
			<form action="" method="post">
				<table>
				<tr>
					<td>Your First Name:</td>
					<td>
					<input type="text" name="firstname" placeholder="Enter first name" required="1"/>
					</td>
				</tr>
				<tr>
					<td>Your Last Name:</td>
					<td>
					<input type="text" name="lastname" placeholder="Enter Last name" required="1"/>
					</td>
				</tr>
				
				<tr>
					<td>Your Email Address:</td>
					<td>
					<input type="email" name="email" placeholder="Enter Email Address" required="1"/>
					</td>
				</tr>
				<tr>
					<td>Your Message:</td>
					<td>
					<textarea name="body"></textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
					<input type="submit" name="submit" value="Send"/>
					</td>
				</tr>
		</table>
	</form>				
 </div>
</div>
<?php include 'inc/sidebar.php';?>
	<?php include 'inc/footer.php';?>