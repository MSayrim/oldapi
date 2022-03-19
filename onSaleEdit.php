<?php
include("ayar.php");

$onSaleItemPrice =$_POST["itemPrice"];
$onSaleItemCount =$_POST["itemCount"];
$command = $_POST["command"];
$sellerId = $_POST["sellerId"];
$itemId =$_POST["itemId"];
class Result{
			public $result;
}

$result = new Result();
	
	
$item = mysqli_query($baglan,"SELECT * FROM `dotasaleitemlist` where sellerId = '$sellerId' and itemId = '$itemId'");

$onSaleItemCatch = mysqli_fetch_assoc($item);

$onSaleItemId = $onSaleItemCatch['id'];


if($command <1)
{
$item1 = mysqli_query($baglan,"DELETE FROM `dotasaleitemlist` WHERE `dotasaleitemlist`.`id` = '$onSaleItemId'");
}
else
{

$item2 = mysqli_query($baglan,"UPDATE `dotasaleitemlist` SET `price` = '$onSaleItemPrice', `count` = '$onSaleItemCount' WHERE `dotasaleitemlist`.`id` = '$onSaleItemId'");
}

		$result->result="done";
		echo(json_encode($result));




?>