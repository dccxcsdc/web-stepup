<h2>Data Kategori</h2>
<hr>

<?php  
$semuadata = array();
$ambil = $koneksi->query("SELECT * FROM kategori_produk"); 
while($tiap = $ambil->fetch_assoc())
{
	$semuadata[] = $tiap;
}

echo "<pre>";
print_r($semuadata);     
echo "</pre>"; 
?>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Kategori</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($semuadata as $key=> $value): ?>
		<tr>
			<td><?php echo $key+1 ?></td>
			<td><?php echo $value["nama_kategori"] ?></td>
			<td>
				<a href="" class="btn btn-warning btn-sm">Ubah</a>
				<a href="" class="btn btn-danger">Hapus</a>
			</td>
		</tr>
		<?php endforeach ?>	
	</tbody>
</table>

<a href="" class="btn btn-default">Tambah Data</a>  