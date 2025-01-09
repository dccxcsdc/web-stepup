<?php
session_start();
//koneksi ke database
include 'koneksi.php';

// Jika tidak ada session pelanggan atau session pelanggan kosong
if (!isset($_SESSION["pelanggan"]) || empty($_SESSION["pelanggan"])) {
    // Tampilkan pesan peringatan
    echo "<script>alert('Silakan login terlebih dahulu');</script>";
    // Alihkan ke halaman login
    echo "<script>location='login.php';</script>";
    exit();
}


// mendapatkan id_pembelian dari url
$idpem = $_GET['id'];
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
$detpem = $ambil->fetch_assoc();

// mendapatkan id_pelanggan yang beli
$id_pelanggan_beli = $detpem["id_pelanggan"];
// mendapatkan id_pelanggan yang login
$id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];

if ($id_pelanggan_login !==$id_pelanggan_beli) 
{
	// Tampilkan pesan peringatan
    echo "<script>alert('no');</script>";
    // Alihkan ke halaman login
    echo "<script>location='riwayat.php';</script>";
}

echo "<pre>";

print_r($detpem);
print_r($_SESSION);

echo "</pre>";
?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>pembayaran</title>
	<link rel="stylesheet"  href="admin/assets/css/bootstrap.css">
</head>
<body>
	<?php include 'menu.php';  ?>

	<div class="container">
		<h2>Konfirmasi Pembayaran</h2>
		<p>Kirim bukti pembayaran anda disini</p>
		<div class="alert alert-info"> Total tagihan anda <strong>Rp. <?php echo number_format($detpem["total_pembelian"]) ?></strong></div>

		<form method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>Nama penyetor</label>
				<input type="text" class="form-control" name="nama">
			</div>
			<div class="form-group">
				<label>Bank</label>
				<input type="text" class="form-control" name="bank">
			</div>
			<div class="form-group">
				<label>Jumlah</label>
				<input type="number" class="form-control" name="jumlah" min="1">
			</div>		
			<div class="form-group">
				<label>Bukti Pembayaran</label>
				<input type="file" class="form-control" name="bukti">
				<p class="text-danger ">File yang diunggah harus berupa gambar (jpg, jpeg, dan png)</p>
			</div>
			<button class="btn btn-primary" name="kirim">Kirim</button>
		</form>
	</div>

<?php   
// jika ada tombol kirim
if (isset($_POST["kirim"]))
{
	// upload dulu foto bukti
	$namabukti = $_FILES["bukti"]["name"];
	$lokasibukti = $_FILES["bukti"]["tmp_name"];
	$namafiks = date("YmdHis").$namabukti;
	move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafiks");

	$nama = $_POST["nama"];
	$bank = $_POST["bank"];
	$jumlah = $_POST["jumlah"];
	$tanggal = date("Y-m-d");
	// simpan pembayaran
	$koneksi->query("INSERT INTO pembayaran(id_pembelian,nama,bank,jumlah,tanggal,bukti) VALUES ('$idpem','$nama','$bank', '$jumlah', '$tanggal','$namafiks')");

	// update data pembeliannya dari peending menjadi sudah kirim pembayaran
	$koneksi->query("UPDATE pembelian SET status_pembelian='sudah mengirimkan bukti pembayaran' WHERE id_pembelian='$idpem'");

	echo "<script>alert('Terimakasih sudah mengirimkan bukti pembayaran');</script>";
    // Alihkan ke halaman login
    echo "<script>location='riwayat.php';</script>";
}

?>

</body>
</html>