<?php
session_start();

$_SESSION['login'] = 0;
$_SESSION['naam'] = 0;
$_SESSION['paas'] = 0;

if (!empty($_POST['password']) && (strcmp($_POST['password'], $_POST['repassword']) == 0)) {
	$conn = new mysqli("localhost", "root", "", "exp6_wdl");
	if ($conn->connect_error)
		die("Connection failed: " . $conn->connect_error);

	$uname = $_POST['uname'];
	$sql = "SELECT * FROM user WHERE uname = '$uname' ";

	// to check if username is already taken or not-
	$t = mysqli_query($conn, $sql);
	$t2 = mysqli_fetch_assoc($t);

	if (!empty($t2['userid'])) {
		echo "<script type='text/javascript'>alert('USERNAME $uname TAKEN');  </script>";
	} else {
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$gender = $_POST['gender'];
		$address = $_POST['address'];
		$pincode = $_POST['pincode'];
		$aoi = " ";
		if (isset($_POST['aoi'])) {
			foreach ($_POST['aoi'] as $aoi1) {
				$aoi .= $aoi1 . " , ";
			}
		}
		$password = $_POST['password'];
		$status = 'A';

		$sql = "INSERT INTO user (`uname`, `phone`, `email`, `gender`, `address`, `pincode`, `areaofinterest`, `password`, `status`) VALUES ('$uname','$phone','$email','$gender','$address','$pincode','$aoi','$password','$status')";
		if (mysqli_query($conn, $sql)) {
			echo "<script type='text/javascript'>alert('ACCOUNT CREATED SUCCESSFULLY'); document.location = 'home.php'; </script>";
		} else
			echo "<script type='text/javascript'>alert('ERROR CREATING ACCOUNT \\n PLEASE TRY AGAIN'); </script>";
	}
} elseif (!empty($_POST['password']) && (strcmp($_POST['password'], $_POST['repassword']) != 0)) {
	echo "PASSWORDS DO NOT MATCH";
}

?>

<link rel="stylesheet" href="edit.css">

<h2>SIGN UP</h2>
<br><br>
<form class="leave__space" action="reg.php" method="post">
	USERNAME: <input type="text" name="uname" id="name1" required><br>
	PHONE: <input type="number" name="phone" required><br>
	EMAIL: <input type="email" name="email" required><br><br>
	GENDER:<br>
	<input type="radio" name="gender" value="male" checked> Male<br>
	<input type="radio" name="gender" value="female"> Female<br>
	<input type="radio" name="gender" value="other"> Other
	<br>
	ADDRESS: <input type="text" style="width: 300" name="address" required><br>
	PINCODE: <input type="number" name="pincode" required><br>
	AREA OF INTEREST:
	<input type="checkbox" name="aoi[]" value="movies"> movies<br>
	<input type="checkbox" name="aoi[]" value="surfing"> surfing<br>
	<input type="checkbox" name="aoi[]" value="Reading"> Reading<br>
	<input type="checkbox" name="aoi[]" value="blogging"> blogging<br><br>
	PASSWORD: <input type="password" name="password" id="txtpassword" required><br>
	CONFIRM PASSWORD: <input type="password" name="repassword" id="txtrepassword" required><br>
	<input class="edit__button" type="submit" onclick="return Validate()">
</form>

<a href="home.php">
	<button class="back__button">Back</button>
</a>

<script type="text/javascript">
	function Validate() {
		var password = document.getElementById("txtpassword").value;
		var repassword = document.getElementById("txtrepassword").value;
		var name1 = document.getElementById("name1").value;
		var flag = 1;


		if (password != repassword) {
			alert("PASSWORDS DO NOT MATCH!!!");
			flag = 0;
		}

		if (/[^a-zA-Z]+$/.test(name1)) {
			alert("ENTER ONLY ALPHABETS FOR NAME!!");
			flag = 0;
		}

		if (name1.localeCompare("admin") == 0) {
			alert("NAME cant be admin");
			flag = 0;
		}

		if (flag == 1) {
			return true;
		} else {
			return false;
		}
	}
</script>