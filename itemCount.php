<?php
include("ayar.php");


$sec = mysqli_query($baglan,"SELECT `dotaitemlist`.*, `dotasaleitemlist`.`id`
FROM `dotaitemlist` 
	LEFT JOIN `dotasaleitemlist` ON `dotasaleitemlist`.`itemId` = `dotaitemlist`.`itemId`;");


$output4 = array();
$row2 = array();
$sec2 = mysqli_query($baglan,"SELECT itemID, (SELECT COUNT(itemID) FROM dotasaleitemlist WHERE itemID=itemD.itemId) AS saleItem FROM dotaitemlist AS itemD GROUP BY itemId;");
while($take=mysqli_fetch_assoc($sec2))
{
$takeItemId = $take["itemID"];
$takeItemCount = $take["saleItem"];
$row2=array('itemId' => $takeItemId, 'itemCount' => $takeItemCount);

array_push($output4,$row2);
}



$output3 =json_encode($output4);

print_r($output3);







?>