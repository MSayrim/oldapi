<?php
include("ayar.php");


$sec = mysqli_query($baglan,"SELECT `dotauserlist`.`nick`,`dotauserlist`.`steamId`, `dotasaleitemlist`.*, `dotarate`.`ratePoint`,`dotarate`.`ratePerson`, `dotaitemlist`.`itemName`
FROM `dotauserlist` 
	LEFT JOIN `dotasaleitemlist` ON `dotasaleitemlist`.`sellerId` = `dotauserlist`.`id` 
	LEFT JOIN `dotarate` ON `dotarate`.`rateId` = `dotauserlist`.`id` 
	LEFT JOIN `dotaitemlist` ON `dotasaleitemlist`.`itemId` = `dotaitemlist`.`itemId`;");

/*"SELECT `dotaitemlist`.*, `dotasaleitemlist`.`id`
FROM `dotaitemlist` 
	LEFT JOIN `dotasaleitemlist` ON `dotasaleitemlist`.`itemId` = `dotaitemlist`.`itemId`;"*/



$outputArr = array();
$output = array();
$row = array();
$rate = 0;
while($al=mysqli_fetch_assoc($sec))
{
	$productId =$al["itemId"];
	$productName = $al["itemName"];
	$productSale = $al["id"];
	$productSeller =$al["sellerId"];
	$productSellerSteamId = $al["steamId"];
	$productSellerNick = $al["nick"];
	$productPrice = $al["price"];
	$productPaymentType=$al["paymentType"];
	$productSellerRate=$al["ratePoint"];
	$productSellerRated=$al["ratePerson"];
	$productCount=$al["count"];
	$productListTime=$al["time"];
	if($productSellerRate != null){
		
	$rate = $productSellerRate/$productSellerRated;
	}

if($productName != null)
{
$row=array('productId' => $productId ,'productName' => $productName , 'productSale'=> $productSale ,'sellerId' =>$productSeller , 'sellerSteamId'=>$productSellerSteamId , 'sellerNick'=>$productSellerNick,'price' =>$productPrice, 'method' =>$productPaymentType ,'rate' => $rate,'count' =>$productCount ,'date' =>$productListTime );

array_push($output,$row);
}

}

//$output2 = json_encode($output);

$output2 =json_encode( $output);
print_r($output2);








?>