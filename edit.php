<?php
include_once("config.php");

if (isset($_POST['update'])) {	

	$id = mysqli_real_escape_string($mysqli, $_POST['id']);
	$username = mysqli_real_escape_string($mysqli, $_POST['username']);
	$email = mysqli_real_escape_string($mysqli, $_POST['email']);	
	
	if(empty($username) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {	
			
		if(empty($username)) {
			echo "<font color='red'>username field is empty.</font><br/>";
		}
		
		if(empty($email)) {
			echo "<font color='red'>Email field is empty.</font><br/>";
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<font color='red'>Invalid email format.</font><br/>";
        }	
	} else {	
		$result = mysqli_query($mysqli, "UPDATE users SET username='$username',email='$email' WHERE id=$id");		
		header("Location: index.php");
	}
}
?>
<?php
$id = $_GET['id'];

$result = mysqli_query($mysqli, "SELECT * FROM users WHERE id=$id");

while($res = mysqli_fetch_array($result))
{
	$username = $res['username'];
	$email = $res['email'];
}
?>
<html>
<head>	
	<title>Edit User</title>
</head>

<body>
	<a href="index.php">Home</a>
	
	<form name="form1" method="post" action="edit.php">
		<table border="0">
			<tr> 
				<td>Username</td>
				<td><input type="text" name="username" value="<?php echo $username;?>"></td>
			</tr>
			<tr> 
				<td>Email</td>
				<td><input type="text" name="email" value="<?php echo $email;?>"></td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>
