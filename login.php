<?php
include("ayar.php");

$userName =$_POST["userName"];
$userPass =$_POST["userPass"];

Class User{
	public $id;
	public $userName;
	//public $userPass;
}

$user = new User();

$Control = mysqli_fetch_assoc(mysqli_query($baglan,"select*from dotauserlist where mail ='$userName' and password = '$userPass'"));

$user->id = $Control["id"];
$user->userName = $Control["nick"];
//$user->userPass = $Control["userPass"];

echo(json_encode($user));

?>