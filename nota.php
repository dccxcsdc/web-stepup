<?php 
session_start();

include 'koneksi.php';  ?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>nota pembelian</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>

<?php include 'menu.php'; ?>

<section class="konten">
    <div class="container">
        <h2>Detail Pembelian</h2>  
        <?php
        // Ambil data pembelian berdasarkan id
        $id_pembelian = intval($_GET['id']); // Sanitasi input
        $ambil = $koneksi->query("SELECT * FROM pembelian 
                                  JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan 
                                  WHERE pembelian.id_pembelian = '$id_pembelian'");
        $detail = $ambil->fetch_assoc();
        ?>


        <!-- jika pelanggan yang beli tidak sama dengan pelanggan yang login, maka dilarikan ke riwayat.php-->

        <!-- pelanggan yang beli harus pelanggan yang login -->

        <?php 
        $idpelangganyangbeli = $detail["id_pelanggan"];

        // mendapatkan id_pelanggan yang login
        $idpelangganyanglogin = $_SESSION["pelanggan"]["id_pelanggan"];

        if ($idpelangganyangbeli!==$idpelangganyanglogin)
        {
            echo "<script>alert('no');</script>";
            echo "<script>location='riwayat.php';</script>";
            exit();
        }
        ?>





        
        
        <p>   
            Tanggal Pembelian: <?php echo $detail['tanggal_pembelian']; ?> <br>
            Total Pembelian: Rp <?php echo number_format($detail['total_pembelian'], 0, ',', '.'); ?>
        </p>

        <div class="row">
            <div class="col-md-4">
                <h3>Pembelian</h3>
                <strong>No. Pembelian: <?php echo $detail['id_pembelian']  ?></strong><br>
                Tanggal : <?php echo $detail['tanggal_pembelian']; ?><br> Total : <?php echo number_format($detail['total_pembelian'])  ?>
            </div>
            <div class="col-md-4">
                <h3>Pelanggan</h3>
                <strong><?php echo $detail['nama_pelanggan']; ?></strong> <br>
                <p>
                    Email: <?php echo $detail['email_pelanggan']; ?> <br>
                    Telepon: <?php echo $detail['telepon_pelanggan']; ?>
                </p>
            </div>
            <div class="col-md-4">
                <h3>Pengiriman</h3>
                <strong><?php echo $detail['nama_kota'] ?></strong><br> Ongkos Kirim : Rp. <?php echo number_format($detail['tarif']); ?><br>
                Alamat : <?php echo $detail['alamat_pengiriman'] ?>
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Berat</th>
                    <th>Jumlah</th>
                    <th>Subharga</th>
                    <th>Subberat</th>

                </tr>
            </thead>
            <tbody>
                <?php 
                // Ambil detail produk dari tabel pembelian_produk
                $ambil = $koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian = '$_GET[id]'");
                $nomor = 1;
                ?>
                <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $pecah['nama']; ?></td>
                    <td><?php echo $pecah['berat']; ?>gram</td>
                    <td>Rp. <?php echo number_format($pecah['harga'], 0, ',', '.'); ?></td>
                    <td><?php echo $pecah['jumlah']; ?></td>
                    <td>Rp. <?php echo number_format($pecah['subharga'], 0, ',', '.'); ?></td>
        			<td><?php echo $pecah['subberat'] ?>gram</td>
                </tr>
                <?php $nomor++; ?>
                <?php } ?>
            </tbody>
        </table>


        <div class="row">
        	<div class="col-md-7">
        		<div class="alert alert-info">
        			<p>
        				Silakan melakukan pembayaran Rp. <?php echo number_format ($detail['total_pembelian']);  ?> ke <br>
        				<strong>BANK VIRTUAL ACCOUNT MANDIRI 0081234567890123 AN. STEP UP STORE </strong>
        			</p>
        		</div>	
       		</div>
        </div>


    </div>
</section>




</body>
</html>