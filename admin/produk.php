<h2>Produk</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Foto</th>
            <th>Berat</th>
            <th>Stok</th>
            <th>Informasi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $nomor = 1; 
        $ambil = $koneksi->query("SELECT * FROM produk LEFT JOIN kategori_produk ON produk.id_kategori=kategori_produk.id_kategori"); 
        ?>
        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['nama_kategori']; ?></td>
            <td><?php echo $pecah['nama_produk']; ?></td>
            <td>Rp <?php echo number_format($pecah['harga_produk'], 0, ',', '.'); ?></td>
            <td>
                <!-- Debug jalur gambar -->
                <?php 
                $imagePath = "assets/images/" . $pecah['foto_produk']; 
                echo $imagePath; // Menampilkan jalur gambar untuk debug
                ?>
                <br>
                <!-- Menampilkan gambar -->
                <img src="<?php echo $imagePath; ?>" alt="Foto Produk" width="100">
            </td>
            <td><?php echo $pecah['berat_produk']; ?> gram</td>
            <td><?php echo $pecah['stok_produk']; ?></td>
            <td><?php echo $pecah['informasi_produk']; ?></td>
            <td>
                <a href="index.php?halaman=hapusproduk&id=<?php echo $pecah['id_produk']; ?>" class="btn btn-danger">Hapus</a>
                <a href="index.php?halaman=ubahproduk&id=<?php echo $pecah['id_produk']; ?>" class="btn btn-warning">Ubah</a>
            </td>
        </tr>
        <?php $nomor++; ?>
        <?php } ?>
    </tbody>
</table>
<a href="index.php?halaman=tambahproduk" class="btn btn-primary">Tambah Data</a>
