<?php
include("ayar.php");

$buyerId =$_POST["buyerId"];
$output = array();
$row = array();

$item = mysqli_query($baglan,"SELECT * FROM `dotasaleditem` where buyerId = '$buyerId'");


while($selledItemCatch = mysqli_fetch_assoc($item))
{
$selledItemId = $selledItemCatch['itemId'];
$sellerId = $selledItemCatch['sellerId'];


$itemName = mysqli_query($baglan,"SELECT itemName FROM `dotaitemlist` where itemId = '$selledItemId' ");

$itemNameCatch =mysqli_fetch_assoc($itemName);

$currentItemName = $itemNameCatch['itemName'];


$buyer = mysqli_query($baglan,"
SELECT `dotasaleditem`.`buyerId`, `dotauserlist`.`steamId`
FROM `dotasaleditem` 
	LEFT JOIN `dotauserlist` ON `dotasaleditem`.`buyerId` = `dotauserlist`.`id` WHERE `dotasaleditem`.`buyerId` = '$buyerId'");
$buyerIdCatch = mysqli_fetch_assoc($buyer);

$buyerSteamId = $buyerIdCatch['steamId'];

$seller = mysqli_query($baglan,"
SELECT `dotasaleditem`.`sellerId`, `dotauserlist`.`steamId`
FROM `dotasaleditem` 
	LEFT JOIN `dotauserlist` ON `dotasaleditem`.`sellerId` = `dotauserlist`.`id` WHERE `dotasaleditem`.`sellerId` = '$sellerId'");
$sellerIdCatch = mysqli_fetch_assoc($seller);

$sellerSteamId = $sellerIdCatch['steamId'];



if($sellerId != null)
{
$row=array('itemName' => $currentItemName , 'sellerSteamId' => $sellerSteamId ,'buyerSteamId' =>$buyerSteamId);
	array_push($output,$row);
}
}

$output2 =json_encode( $output);
print_r($output2);
?>