<h2>ubah produk</h2>
<?php
$id_produk = $_GET['id'];
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$pecah = $ambil->fetch_assoc();

echo "<pre>";
print_r($pecah);
echo "</pre>";
?>

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

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
        <label>Kategori</label>
        <select class="form-control" name="id_kategori">
            <option value="">Pilih Kategori</option>
            <?php foreach ($datakategori as $key=> $value): ?>

            <option value="<?php echo $value["id_kategori"] ?>" 
            	<?php if($pecah["id_kategori"]==$value["id_kategori"]){ echo "selected";}  ?>>
            	<?php echo $value["nama_kategori"] ?>
            	
            </option>
            <?php endforeach ?>
        </select>
    </div>
	<div class="form-group">
		<label>Nama Produk</label>
		<input type="text" name="nama" class="form-control" value="<?php echo $pecah['nama_produk']; ?>">
	</div>
	<div class="form-group">
		<label>harga Rp</label>
		<input type="text" name="harga" class="form-control" value="<?php echo $pecah['harga_produk']; ?>">
	</div>
	<div class="form-group">
		<label>Berat (Gr)</label>
		<input type="text" name="berat" class="form-control" value="<?php echo $pecah['berat_produk']; ?>">
	</div>
	<div class="form-group">
		<label>Stok</label>
		<input type="text" name="stok" class="form-control" value="<?php echo $pecah['stok_produk']; ?>">
	</div>
	<div class="form-group">
		<img src="../foto_produk/<?php echo $pecah['foto_produk'] ?>" widt="200">
	</div>
	<div class="form-group">
		<label>Ganti Foto</label>
		<input type="file" name="foto" class="form-control">
	</div>
	<div class="form-group">
		<label>Informasi produk</label>
		<textarea name="informasi" class="form-control" row="10">
			<?php echo $pecah['informasi_produk']; ?>
		</textarea>
	</div>
	<button class="btn btn-primary" name="ubah">Ubah</button>
</form>
<?php
if (isset($_POST['ubah'])) 
{
	$namafoto=$_FILES['foto']['name'];
	$lokasifoto=$_FILES['foto']['tmp_name'];
	// jika foto dirubah
	if (!empty($lokasifoto)) 
	{
		move_uploaded_file($lokasifoto, "../foto_produk/$namafoto");

		$koneksi->query("UPDATE produk SET 
			nama_produk='$_POST[nama]', 
			harga_produk='$_POST[harga]', 
			berat_produk='$_POST[berat]', 
			foto_produk='$namafoto', 
			stok_produk='$_POST[stok]',  
			informasi_produk='$_POST[informasi]',
			id_kategori='$_POST[id_kategori]'
			WHERE id_produk='$_GET[id]");
	}
	else
	{
		$koneksi->query("UPDATE produk SET 
			nama_produk='$_POST[nama]', 
			harga_produk='$_POST[harga]', 
			berat_produk='$_POST[berat]', 
			stok_produk='$_POST[stok]',  
			informasi_produk='$_POST[informasi]',
			id_kategori='$_POST[id_kategori]'
			WHERE id_produk='$_GET[id]'");
	}
	echo "<script>alert('data produk telah diubah');</script>";
	echo "<script>location='index.php?halaman=produk';</script>";

}
?>