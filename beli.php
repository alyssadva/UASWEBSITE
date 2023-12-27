<?php 
session_start();
$id_produk=$_GET['id'];



if (isset($_SESSION['cart'][$id_produk])) {
	$_SESSION['cart'][$id_produk]+=1;
}


else
{
	$_SESSION['cart'][$id_produk]=1;
}




echo "<script>alert('produk telah masuk ke menu Cart');</script>";

echo "<script>location='cart.php';</script>";

 ?>
