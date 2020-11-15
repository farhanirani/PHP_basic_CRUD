<?php
session_start();
if (!isset($_SESSION['login']) || ($_SESSION['login'] == 0)) {
	header("Location: home.php");
}
$temp1 = $_SESSION['naam'];
$temp2 = $_SESSION['paas'];
if (!empty($_POST['password'])) {
	if (!strcmp($_POST['password'], $_POST['repassword'])) {
		$pas = $_POST['password'];
		$conn = new mysqli("localhost", "root", "", "exp6_wdl");
		$sql = "UPDATE user set password = '$pas' where uname = '$temp1' and password = '$temp2' ";
		mysqli_query($conn, $sql);
		$_SESSION['paas'] = $pas;
		header("Location: userpage.php");
	} elseif (strcmp($_POST['password'], $_POST['repassword'])) {
		echo "<br><br><br> PASSWORDS DO NOT MATCH!!!!! <br><br><br>";
	}
}


?>
<link rel="stylesheet" href="edit.css">

<h2>Update your Password</h2>
<br><br><br><br><br>
<form class="leave__space2" action="changepass.php" method="post">
	NEW PASSWORD: <input type="password" name="password" id="pass" required><br><br>
	CONFIRM NEW PASSWORD: <input type="password" name="repassword" id="repass" required><br>
	<input class="edit__button" type="submit" onclick="return Validatefn()">
</form>

<script type="text/javascript">
	function Validatefn() {
		var pass = document.getElementById("pass").value;
		var repass = document.getElementById("repass").value;
		if (pass != repass) {
			alert("PASSWORDS DO NOT MATCH");
			return false;
		}
		return true;
	}
</script>

<a href="userpage.php">
	<button class="back__button">Cancek</button>
</a>