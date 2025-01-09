<?php  
$datakategori = array();
$ambil = $koneksi->query("SELECT * FROM kategori_produk");
while($tiap=$ambil->fetch_assoc())
{
    $datakategori[] = $tiap;
}

echo "<pre>";
print_r($datakategori);
echo "</pre>";
?>




<h2>Tambah produk</h2>
<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Kategori</label>
        <select class="form-control" name="id_kategori">
            <option value="">Pilih Kategori</option>
            <?php foreach ($datakategori as $key=> $value): ?>
            <option value="<?php echo $value["id_kategori"] ?>"><?php echo $value["nama_kategori"] ?></option>
            <?php endforeach ?>
        </select>
    </div>
	<div class="form-group">
		<label>nama</label>
		<input type="text" class="form-control" name="nama">
	</div>
	<div class="form-group">
		<label>Harga (Rp)</label>
		<input type="number" class="form-control" name="harga">
	</div>
	<div class="form-group">
		<label>Berat (Gr)</label>
		<input type="number" class="form-control" name="berat">
	</div>
	<div class="form-group">
		<label>Informasi</label>
		<textarea class="form-control" name="informasi" rows="10"></textarea>
	</div>
	<div class="form-group">
		<label>Foto</label>
		<input type="file" class="form-control" name="foto">
	</div>
	<div class="form-group">
		<label>Stok</label>
		<input type="number" class="form-control" name="stok">
	</div>
	<button class="btn btn-primary" name="save">Simpan</button>
</form>
<?php
if (isset($_POST['save'])) 
{
    // Ambil data file
    $nama = $_FILES['foto']['name'];
    $lokasi = $_FILES['foto']['tmp_name'];
    $ukuran = $_FILES['foto']['size'];
    $tipe = $_FILES['foto']['type'];

    // Tentukan folder tujuan
    $folder = "../foto_produk/";

    // Cek dan buat folder jika belum ada
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    // Validasi file (hanya gambar)
    $ekstensiValid = ['jpg', 'jpeg', 'png', 'gif'];
    $ekstensiFile = strtolower(pathinfo($nama, PATHINFO_EXTENSION));

    if (!in_array($ekstensiFile, $ekstensiValid)) {
        die("<div class='alert alert-danger'>File yang diunggah harus berupa gambar (jpg, jpeg, png, gif).</div>");
    }

    if ($ukuran > 2000000) { // Maksimal 2MB
        die("<div class='alert alert-danger'>Ukuran file terlalu besar (max: 2MB).</div>");
    }

    // Buat nama file unik untuk menghindari duplikasi
    $namaBaru = time() . '_' . $nama;

    // Pindahkan file
    if (move_uploaded_file($lokasi, $folder . $namaBaru)) {
    // Gunakan prepared statement untuk mencegah SQL injection
    $stmt = $koneksi->prepare("INSERT INTO produk (nama_produk, harga_produk, berat_produk, informasi_produk, foto_produk, stok_produk, id_kategori) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
        "sssssss", // Tambahkan satu "s" untuk mencocokkan jumlah parameter
        $_POST['nama'],
        $_POST['harga'],
        $_POST['berat'],
        $_POST['informasi'],
        $namaBaru,
        $_POST['stok'],
        $_POST['id_kategori'] // Tambahkan koma di sini
    );

        // Eksekusi query
        if ($stmt->execute()) {
            echo "<div class='alert alert-info'>Data tersimpan</div>";
            echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
        } else {
            echo "<div class='alert alert-danger'>Gagal menyimpan data ke database.</div>";
        }

        $stmt->close(); // Tutup statement
    } else {
        echo "<div class='alert alert-danger'>Gagal mengunggah file!</div>";
    }
}
?>
