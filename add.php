<html>
<head>
    <title>Add User</title>
</head>

<body>
<?php
include_once("config.php");

if (isset($_POST['submit'])) {	
    $username = mysqli_real_escape_string($mysqli, $_POST['username']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $password = mysqli_real_escape_string($mysqli, $_POST['password']);

    if(empty($username) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($password)) {	
        if(empty($username)) {
            echo "<font color='red'>username field is empty.</font><br/>";
        }
        if(empty($email)) {
            echo "<font color='red'>Email field is empty.</font><br/>";
        }

        if(empty($password)) {
            echo "<font color='red'>Password field is empty.</font><br/>";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<font color='red'>Invalid email format.</font><br/>";
        }

        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $result = mysqli_query($mysqli, "INSERT INTO users(username,email,password) VALUES('$username','$email','$hashedPassword')");

        echo "<font color='green'>Data added successfully.";
        echo "<br/><a href='index.php'>View Result</a>";
    }
}
?>
</body>
</html>