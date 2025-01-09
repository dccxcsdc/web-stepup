<?php
// Ambil data produk berdasarkan ID
$id_produk = $_GET['id'];

// Pastikan koneksi database menggunakan variabel yang benar
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");

if ($ambil->num_rows > 0) {
    $pecah = $ambil->fetch_assoc();
    $fotoproduk = $pecah['foto_produk'];

    // Hapus file foto jika ada
    if (file_exists("../foto_produk/$fotoproduk")) {
        unlink("../foto_produk/$fotoproduk");
    }

    // Hapus data produk dari database
    $query = $koneksi->query("DELETE FROM produk WHERE id_produk='$id_produk'");

    if ($query) {
        echo "<script>alert('Produk terhapus');</script>";
        echo "<script>location='index.php?halaman=produk';</script>";
    } else {
        echo "<script>alert('Gagal menghapus produk');</script>";
    }
} else {
    echo "<script>alert('Produk tidak ditemukan');</script>";
     
}
?>
