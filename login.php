<?php
session_start();
$_SESSION['login'] = 0;
$_SESSION['naam'] = 0;
$_SESSION['paas'] = 0;

if (!empty($_POST['uname'])) {
	$uname = $_POST['uname'];
	$password = $_POST['password'];

	$conn = new mysqli("localhost", "root", "", "exp6_wdl");
	if ($conn->connect_error)
		die("Connection failed: " . $conn->connect_error);

	$sql = "SELECT * from user where uname = '$uname' and password = '$password' and status = 'A' ";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result)) {
		$tres = mysqli_fetch_assoc($result);
		$_SESSION['login'] = 1;
		$_SESSION['naam'] = $uname;
		$_SESSION['paas'] = $password;
		header("Location: userpage.php");
	} else
		echo "<div class='error__message'><h3>INVALID USERNAME / PASSWORD</h3></div>";
}
?>

<link rel="stylesheet" href="login.css">

<h2>LOGIN PAGE</h2>
<form class="center__form" action="login.php" method="post">
	<div>Username: <input type="text" name="uname" autocomplete="off" required></div>
	<div>Password: <input type="password" name="password" required></div>
	<input class="submit__button" type="submit" value="Submit">
</form>
<a href="home.php">
	<button class="back__button">Back</button>
</a>