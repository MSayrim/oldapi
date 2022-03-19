<?php
include("ayar.php");

$userMail =$_POST["userMail"];
$userPass = $_POST["userPass"];
$userNick =$_POST["userNick"];
$userSteamId =$_POST["userSteamId"];
$dogrulamakodu = rand(0,100000);
$durum = 0;
class Result{
			public $result;
			public $tf;
			public $dogrulamaKodu;

}

$result = new Result();

$kontrol = mysqli_query($baglan,"select * from dotauserlist where nick = '$userNick'");
					 
	if(mysqli_num_rows($kontrol)<1){
		
		$ekle = mysqli_query($baglan,"insert into dotauserlist (mail,nick,password,steamId,confirmCode,statu) values 		('$userMail','$userNick','$userPass','$userSteamId','$dogrulamakodu','$durum')");
		$listeLimit = mysqli_query($baglan,"select  id from dotauserlist where nick = '$userNick' and steamId = '$userSteamId'");
		
			$al=mysqli_fetch_assoc($listeLimit);
			$limitID = $al["id"];
		
		$ekleLimit = mysqli_query($baglan,"insert into dotacurrentlisteditem (id,productListLimit,currentListedProduct) values ('$limitID','5','0')");
		
		if($ekle){
			$result->dogrulamaKodu = $dogrulamakodu;
			$result->tf =true;
			$result->result="kayit basarili";
			echo(json_encode($result));
		}
	}
	else{
		$result->result="Boyle Bir Kayit Var";
		$result->tf=false;
		echo(json_encode($result));
	}

?>