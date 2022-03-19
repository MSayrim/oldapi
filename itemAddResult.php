<?php
include("ayar.php");
$item = $_POST["item_name"];
$tumbnail = $_POST["item_tumbnail"];
$price = $_POST["item_price"];
$video = $_POST["item_video"];
$stok = $_POST["item_stock"];

$ekle = mysqli_query($baglan,"insert into item_list (item_name,item_tumbnail,item_price,item_video,item_stock) values ('$item' , '$tumbnail','$price','$video','$stok')");

?>