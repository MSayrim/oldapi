<?php
include("ayar.php");

$itemId = $_POST["itemId"];
$sellerId =   $_POST["sellerId"];
$count =                $_POST["count"];
$paymentType =    $_POST["paymentType"];
$price =   $_POST["price"];
$dogrulamakodu = rand(0,100000);
$durum = 0;

$dogrulamakodu = rand(0,100000);
$durum = 0;

class Result{
			public $result;
			public $tf;
			public $satisKodu;
			public $dogrulamaKodu;

}

$result = new Result();


$kontrolLimit = mysqli_query($baglan,"select * from dotacurrentlisteditem where id = '$sellerId'");
$check=mysqli_fetch_assoc($kontrolLimit);
$userLimit = $check["productListLimit"];
$userCurrentItem = $check["currentListedProduct"];

$kontrol = mysqli_query($baglan,"select * from dotasaleitemlist where sellerId = '$sellerId' and itemId = '$itemId'");

if($userLimit>$userCurrentItem)
{
	if(mysqli_num_rows($kontrol)<1){
	
		$ekle = mysqli_query($baglan,"insert into dotasaleitemlist (itemId,sellerId,paymentType,price,count,confirmCode,confirmStatu) values ('$itemId','$sellerId','$paymentType','$price','$count','$dogrulamakodu','$durum')");
		
		if($ekle){
			$satisListeId = mysqli_query($baglan,"select  id from dotasaleitemlist where sellerId = '$sellerId' and itemId = '$itemId'");
			$al=mysqli_fetch_assoc($satisListeId);
			$productSaleListId = $al["id"];
			$result->satisKodu = $productSaleListId;
			$result->dogrulamaKodu = $dogrulamakodu;
			$result->tf =true;
			$result->result="Listeleme basarili";
			$userCurrentItem = $userCurrentItem + 1;
			$increase = mysqli_query($baglan,"UPDATE `dotacurrentlisteditem` SET `currentListedProduct`='$userCurrentItem' WHERE id = '$sellerId'");
			echo(json_encode($result));
		}

}
		else{
		$result->result="daha once boyle bir urun eklenmis.";
		$result->tf=false;
		echo(json_encode($result));
	}
}
else{
		$result->result="Maksimum listeleme limitine ulasildi";
		$result->tf=false;
		echo(json_encode($result));
	}


?>