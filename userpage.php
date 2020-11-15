<?php
session_start();

if(!isset($_SESSION['login']) || $_SESSION['login']==0)
	header("Location: home.php");

$temp = $_SESSION['naam'];
$t2=$_SESSION['paas'];

$conn = new mysqli("localhost", "root","", "exp6_wdl");
if ($conn->connect_error) 
	die("Connection failed: " . $conn->connect_error);

$sql2="SELECT `uname`, `phone`, `email`, `gender`, `address`, `pincode`, `areaofinterest` from user where uname = '$temp' and password = '$t2'";

$result2 = mysqli_query($conn,$sql2);
$row2 = mysqli_fetch_assoc($result2);
?>

<link rel="stylesheet" href="userpage.css">

<?php
echo "<h2>".$temp."'s Profile</h2>";
echo "<div class='login__buttons'>";
echo "Name :::".$row2['uname']."<br> Phone :::".$row2['phone']."<br> Email :::".$row2['email']."<br> Gender :: ".$row2['gender']."<br>  Address:::: ".$row2['address']."<br>  Pincode:::".$row2['pincode']."<br> Areas of Interest::::".$row2['areaofinterest']."      ";
echo "</div>"
?>

<a href="edit.php">
   <button class="edit__button">EDIT YOUR INFORMATION</button>
</a>
<a href="home.php">
   <button class="back__button">LOGOUT</button>
</a>