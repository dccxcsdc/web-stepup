<?php
session_start();
// Pastikan koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "step_up");

// Periksa apakah koneksi berhasil
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Cek apakah ada ID pelanggan yang diterima dari URL
if (isset($_GET['id'])) {
    $id_pelanggan = $_GET['id'];

    // Ambil data pelanggan berdasarkan ID
    $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");

    if ($ambil->num_rows > 0) {
        // Hapus data pelanggan dari database
        $query = $koneksi->query("DELETE FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");

        if ($query) {
            echo "<script>alert('Pelanggan berhasil dihapus');</script>";
            echo "<script>location='index.php?halaman=pelanggan';</script>"; // Kembali ke halaman pelanggan setelah penghapusan
        } else {
            echo "<script>alert('Gagal menghapus pelanggan');</script>";
        }
    } else {
        echo "<script>alert('Pelanggan tidak ditemukan');</script>";
        echo "<script>location='index.php?halaman=pelanggan';</script>"; // Kembali ke halaman pelanggan jika pelanggan tidak ditemukan
    }
} else {
    echo "<script>alert('ID pelanggan tidak ditemukan');</script>";
    echo "<script>location='index.php?halaman=pelanggan';</script>"; // Kembali ke halaman pelanggan jika ID tidak ada
}
?>
