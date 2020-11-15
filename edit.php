<?php
session_start();

if ($_SESSION['login'] == 0 || !isset($_SESSION['login']))
	header("Location: home.php");


$t2 = $_SESSION['paas'];
$temp = $_SESSION['naam'];
$sql = "SELECT `uname`, `phone`, `email`, `gender`, `address`, `pincode`, `areaofinterest` from user where uname = '$temp' and password = '$t2'";
$conn = new mysqli("localhost", "root", "", "exp6_wdl");
if ($conn->connect_error)
	die("Connection failed: " . $conn->connect_error);

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<link rel="stylesheet" href="edit.css">

<h2>UPDATE YOUR INFORMATION</h2>
<form class="leave__space2" action="editchanges.php" method="post">
	<br><br> NAME: <input type="text" name="newname" placeholder="<?php echo $row['uname']; ?>">

	<br><br> PHONE: <input type="number" name="newphone" placeholder="<?php echo $row['phone']; ?>">

	<br><br> EMAIL: <input type="email" name="newemail" placeholder="<?php echo $row['email']; ?>">

	<br><br> GENDER:
	<br><input type="radio" name="newgender" value="male" <?php if ($row['gender'] == "male") echo "checked";  ?>> Male<br>
	<input type="radio" name="newgender" value="female" <?php if ($row['gender'] == "female") echo "checked";  ?>> Female<br>
	<input type="radio" name="newgender" value="other" <?php if ($row['gender'] == "other") echo "checked";  ?>> Other<br>

	<br>

	<br><br> ADDRESS: <input type="text" style="width: 400" name="newaddress" placeholder="<?php echo $row['address']; ?>">

	<br><br> PINCODE: <input type="number" name="newpincode" placeholder="<?php echo $row['pincode']; ?>">

	<br><br> AREA OF INTERESTS: <br><br>
	<input type="checkbox" name="aoi[]" value="movies" <?php if (strpos($row['areaofinterest'], "ovies")) echo "checked";  ?>> Movies<br>
	<input type="checkbox" name="aoi[]" value="surfing" <?php if (strpos($row['areaofinterest'], "surfing")) echo "checked";  ?>> Surfing<br>
	<input type="checkbox" name="aoi[]" value="Reading" <?php if (strpos($row['areaofinterest'], "Reading")) echo "checked";  ?>> Reading<br>
	<input type="checkbox" name="aoi[]" value="blogging" <?php if (strpos($row['areaofinterest'], "blogging")) echo "checked"; ?>> Blogging
	<input class="edit__button" type="submit">
</form>

<a href="changepass.php">
	<button class="change__pass">Change password</button>
</a>
<a href="userpage.php">
	<button class="back__button">Back</button>
</a>