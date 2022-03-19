<?php
include("ayar.php");
$sellerId =$_POST["sellerId"];
$buyerId =$_POST["buyerId"];
$paymentMethod =$_POST["paymentMethod"];
$price =$_POST["price"];
$count =$_POST["count"];
$itemId =$_POST["itemId"];
$dogrulamaKodu = $_POST["dogrulamaKodu"];

if($dogrulamaKodu == "verified")
{

if($count<=1)
{
$bir = mysqli_query($baglan,"DELETE FROM `dotasaleitemlist` WHERE `dotasaleitemlist`.`itemId` = '$itemId' and `dotasaleitemlist`.`sellerId` = '$sellerId'  ");
}
else
{
$count = $count-1;
$iki = mysqli_query($baglan,"UPDATE `dotasaleitemlist` SET `count` = '$count' WHERE `dotasaleitemlist`.`itemId` = '$itemId' and `dotasaleitemlist`.`sellerId` = '$sellerId'  ");
}

	$ekle = mysqli_query($baglan,"insert into dotasaleditem (itemId,sellerId,buyerId,paymentType,price) values 		('$itemId','$sellerId','$buyerId','$paymentMethod','$price')");

	$limit = mysqli_query($baglan,"select * From `dotacurrentlisteditem` WHERE `dotacurrentlisteditem`.`id` = '$sellerId'");
	$al=mysqli_fetch_assoc($limit);
	$currentListedItem = $al['currentListedProduct'];
	$currentListedItem = $currentListedItem-1;

	$limit = mysqli_query($baglan,"UPDATE `dotacurrentlisteditem` SET `currentListedProduct` = '$currentListedItem' WHERE `dotacurrentlisteditem`.`id` = '$sellerId'");
	
	$result = "Satin alma basarili";
	echo(json_encode($result));
}
else{
	$result = "Satin alma basarisiz";
	echo(json_encode($result));
}


?>