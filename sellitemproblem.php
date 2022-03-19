<?php
include("ayar.php");

$itemId = 6;               //$_POST["itemId"];
$sellerId =   8;           //$_POST["sellerId"];
$count =        4;         //$_POST["count"];
$paymentType =    "sanane";       //$_POST["paymentType"];
$price =          4;       //$_POST["price"];
$dogrulamakodu = rand(0,100000);
$durum = 0;

class Result{
			public $result;
			public $tf;
			public $satisKodu;
			public $dogrulamaKodu;

}

$result = new Result();

$kontrol = mysqli_query($baglan,"select * from dotasaleitemlist where sellerId = '$sellerId' and itemId = '$itemId'");


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
			echo(json_encode($result));
		}

}
		else{
		$result->result="daha once boyle bir urun eklenmis.";
		$result->tf=false;
		echo(json_encode($result));
	}


?>