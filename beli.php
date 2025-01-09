<?php 
session_start();
//mendapatkan id_produk dari url
$id_produk = $_GET['id'];

// jika sudah ada produk di keranjang, maka produk tersebut jumlahnya ditambah +1
if(isset($_SESSION['keranjang'][$id_produk]))
{
	$_SESSION['keranjang'][$id_produk]+=1;
}

// selain itu (belum ada di keranjang), maka produk tersebut dianggap  dibeli 1 biji
else
{
	$_SESSION['keranjang'][$id_produk]=1;
}



//echo "<pre>";
//print_r($_SESSION);
//echo"</pre>";

//larikan ke halaman keranjang
echo "<script>alert('produk telah ditambahkan di keranjang');</script>";
echo "<script>location='keranjang.php';</script>";
?>