<?php
include("ayar.php");

$rise = "50";
$result = mysqli_query($baglan,"UPDATE `dotacurrentlisteditem` SET `productListLimit` = '$rise' WHERE `dotacurrentlisteditem`.`id` = 3");




		echo(json_encode($result));
?>