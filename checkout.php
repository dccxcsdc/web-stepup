<?php
session_start();
include 'koneksi.php';



//jika tidak ada session pelanggan(belum login), maka akan di redirect ke login.php
 
if (!isset($_SESSION["pelanggan"])) 
{
	echo "<script>alert('silakan login');</script>";
	echo "<script>location='login.php';</script>";
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>checkout</title>
	<link rel="stylesheet"  href="admin/assets/css/bootstrap.css">
</head>
<body>



<?php include 'menu.php';  ?>

</nav>

<section class="konten">
	<div class="container">
		<h1>Keranjang Belanja</h1>
		<hr>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Produk</th>
					<th>Harga</th>
					<th>Jumlah</th>
					<th>Subtotal</th>
				</tr>
			</thead>
			<tbody>
				<?php $nomor=1 ?>
				<?php $totalbelanja = 0; ?>
				<?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah): ?> 
				<!-- menampilkan produk yang sedang diperulangkan berdasarkan id_produk -->
				<?php  
				$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
				$pecah = $ambil->fetch_assoc();
				$subharga=$pecah["harga_produk"]*$jumlah;
				
				?>
				<tr>
					<td><?php echo $nomor;  ?></td>
					<td><?php echo $pecah["nama_produk"];  ?></td>
					<td>Rp. <?php echo number_format($pecah["harga_produk"]);  ?></td>
					<td><?php echo $jumlah; ?></td>
					<td>Rp. <?php  echo number_format ($subharga); ?></td>
				</tr>
				<?php $nomor++;  ?>
				<?php $totalbelanja+=$subharga; ?>
				<?php endforeach  ?>
			</tbody>
			<tfoot>
				<tr>
					<th colspan="4">Total Belanja</th>
					<th>Rp. <?php echo number_format($totalbelanja) ?> </th>
				</tr>
			</tfoot>
		</table>

		<form method="post">
			
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['nama_pelanggan']  ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['telepon_pelanggan']  ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-4">
					<select class="form-control" name="id_ongkir">
						<option value="">Pilih Ongkos Kirim</option>
						<?php  
						$ambil = $koneksi->query("SELECT * FROM ongkir ");
						while($perongkir = $ambil->fetch_assoc()){
						?>
						<option value="<?php echo $perongkir["id_ongkir"]  ?>">
							<?php echo $perongkir['nama_kota'] ?> -
							Rp. <?php echo number_format($perongkir['tarif']) ?> 
						</option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label>Alamat Lengkap Pengiriman</label>
				<textarea class="form-control" name="alamat_pengiriman" placeholder="Masukan alamat lengkap pengiriman"></textarea>
			</div>
			<button class="btn btn-primary" name="checkout">Checkout</button>
		</form>

		<?php  
if (isset($_POST["checkout"])) {
    // Pastikan data session dan input POST ada
    if (!isset($_SESSION["pelanggan"]["id_pelanggan"]) || !isset($_POST["id_ongkir"])) {
        die("Input tidak valid atau sesi telah berakhir.");
    }

    $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
    $id_ongkir = $_POST["id_ongkir"];
    $tanggal_pembelian = date("y-m-d");
    $alamat_pengiriman = $_POST['alamat_pengiriman'];

    // Ambil data ongkir
    $ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
    if ($ambil->num_rows > 0) {
        $arrayongkir = $ambil->fetch_assoc();
        $nama_kota = $arrayongkir['nama_kota'];
        $tarif = $arrayongkir['tarif'];
    } else {
        die("Data ongkir tidak ditemukan!");
    }
    

    // Pastikan total belanja terdefinisi
    if (!isset($totalbelanja)) {
        $totalbelanja = 0; // Default jika tidak ada nilai
    }

    // Hitung total pembelian
    $total_pembelian = $totalbelanja + $tarif;

    // Simpan data pembelian
    $koneksi->query("INSERT INTO pembelian (id_pelanggan, id_ongkir, tanggal_pembelian, total_pembelian, nama_kota, tarif, alamat_pengiriman) VALUES ('$id_pelanggan', '$id_ongkir', '$tanggal_pembelian', '$total_pembelian', '$nama_kota', '$tarif', '$alamat_pengiriman')");


    // mendapatkan id_pembelian yang terjadi
    $id_pembelian = $koneksi->insert_id;

    foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) 
    {
    	//mendapatkan data produk berdasarkan id_produk
    	$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
    	$perproduk = $ambil->fetch_assoc();

    	$nama = $perproduk['nama_produk'];
    	$harga = $perproduk['harga_produk'];
    	$berat = $perproduk['berat_produk'];

    	$subberat = $perproduk['berat_produk']*$jumlah;
    	$subharga = $perproduk['harga_produk']*$jumlah;
    	$koneksi->query("INSERT INTO pembelian_produk (id_pembelian, id_produk, nama, harga, berat, subberat, subharga, jumlah) 
            VALUES ('$id_pembelian', '$id_produk', '$nama', $harga, $berat, $subberat, $subharga, $jumlah)");


    	// update stok
    	$koneksi->query("UPDATE produk SET stok_produk=stok_produk -$jumlah WHERE id_produk='$id_produk'");

    }


    // mengosongkan keranjang belanja 

    unset($_SESSION["keranjang"]);

    // tampilan dialihkan ke halaman nota
    echo "<script>alert('pembelian sukses');</script>";
	echo "<script>location='nota.php?id=$id_pembelian';</script>";


}
?>

	</div>
</section>

<pre><?php print_r($_SESSION['pelanggan'])?></pre>
<pre><?php print_r($_SESSION['keranjang'])?></pre>

</body>
</html>