
<?php
include("ayar.php");


$sec = mysqli_query($baglan,"SELECT * FROM `dotaitemlist` WHERE 1;");

$output3 =json_encode($take);

$outputArr = array();
$output = array();
$row = array();
while($al=mysqli_fetch_assoc($sec))
{
	$productId =$al["itemId"];
	$productName = $al["itemName"];
	$productTumbnail = $al["itemPic"];
	$productGame = $al["itemGameName"];
	$productHero = $al["itemHero"];



$row=array('productId' => $productId ,'productName' => $productName , 'productPic'=> $productTumbnail , 'productGame' => $productGame,'productHero'=> $productHero);

array_push($output,$row);


}

//$output2 = json_encode($output);

$output2 =json_encode( $output);
print_r($output2);








?>