<link rel="stylesheet" href="edit.css">
<br><br>

<?php
session_start();

if ($_SESSION['login'] == 0 || !isset($_SESSION['login']))
	header("Location: home.php");

$t2 = $_SESSION['paas'];
$temp = $_SESSION['naam'];

$conn = new mysqli("localhost", "root", "", "exp6_wdl");
$sql = "SELECT `uname`, `phone`, `email`, `gender`, `address`, `pincode`, `areaofinterest` from user where uname = '$temp' and password = '$t2' and status = 'A' ";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (!empty($_POST['newname'])) {
	$uname = $_POST['newname'];
	$sql3 = "SELECT * FROM user WHERE uname = '$uname' ";
	// to check if username is already taken or not-
	$t = mysqli_query($conn, $sql3);

	$t3 = mysqli_fetch_assoc($t);

	if (!empty($t3['userid'])) {
		echo "<script type='text/javascript'>alert('USERNAME $uname TAKEN'); window.location.replace('edit.php');  </script>";
	} else {
		$sql = "UPDATE user set uname = '$uname' where uname = '$temp' and password = '$t2'";
		mysqli_query($conn, $sql);
		echo "NAME updated<br><br><br>";
		$_SESSION['naam'] = $uname;
	}
}


if (!empty($_POST['newphone'])) {
	$phone = $_POST['newphone'];
	$sql = "UPDATE user set phone = '$phone' where uname = '$temp' and password = '$t2'";
	mysqli_query($conn, $sql);
	echo "PHONE updated<br><br>";
}


if (!empty($_POST['newemail'])) {
	$email = $_POST['newemail'];
	$sql = "UPDATE user set email = '$email' where uname = '$temp' and password = '$t2'";
	mysqli_query($conn, $sql);
	echo "email updated<br><br>";
}


if (!empty($_POST['newgender']) &&  $_POST['newgender'] != $row['gender']) {
	$gender = $_POST['newgender'];
	$sql = "UPDATE user set gender = '$gender' where uname = '$temp' and password = '$t2'";
	mysqli_query($conn, $sql);
	echo "gender updated<br><br>";
}


if (!empty($_POST['newaddress'])) {
	$address = $_POST['newaddress'];
	$sql = "UPDATE user set address = '$address' where uname = '$temp' and password = '$t2'";
	mysqli_query($conn, $sql);
	echo "address updated<br><br>";
}


if (!empty($_POST['newpincode'])) {
	$pincode = $_POST['newpincode'];
	$sql = "UPDATE user set pincode = '$pincode' where uname = '$temp' and password = '$t2'";
	mysqli_query($conn, $sql);
	echo "pincode updated<br><br>";
}


$aoi = " ";
if (!empty($_POST['aoi'])) {
	foreach ($_POST['aoi'] as $key)
		$aoi .= $key . " , ";
}

if (strcmp($aoi, $row['areaofinterest']) != 0) {
	$sql = "UPDATE user set areaofinterest = '$aoi' where uname = '$temp' and password = '$t2'";
	mysqli_query($conn, $sql);
	echo "area of interest updated<br><br>";
}
?>


<a href="userpage.php">
	<button class="back__button">Back</button>
</a>