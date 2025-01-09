<h2>detail pembelian</h2>  
<?php
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
	ON pembelian.id_pelanggan=pelanggan.id_pelanggan 
	WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>

<strong><?php echo $detail['nama_pelanggan']; ?></strong> <br>
<p>
	<?php echo $detail['email_pelanggan']; ?> <br>
	<?php echo $detail['telepon_pelanggan']; ?> 
</p>

<p>
	<?php echo $detail['tanggal_pembelian']; ?> <br>
	<?php echo $detail['total_pembelian']; ?> 
</p>

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
