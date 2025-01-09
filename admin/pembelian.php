<h2>anjay</h2>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Pelanggan</th>
			<th>Tanggal </th>
			<th>Total </th>
			<th>Status </th>
			<th>Resi </th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php 
		// Query pembelian dan pelanggan
		$ambil = $koneksi->query("SELECT pembelian.*, pelanggan.nama_pelanggan 
			FROM pembelian 
			JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan"); 
		?>
		<?php while($pecah = $ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_pelanggan']; ?></td>
			<td><?php echo $pecah['tanggal_pembelian']; ?></td>
			<td><?php echo number_format($pecah['total_pembelian']); ?></td>
			<td><?php echo $pecah['status_pembelian']; ?></td>
			<td><?php echo $pecah['resi_pengiriman']; ?></td>
			<td>
				<a href=" index.php?halaman=detail&id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-info">Detail</a>

				<?php if ($pecah['status_pembelian']!=="pending"):  ?>
				<a href="index.php?halaman=pembayaran&id=<?php echo $pecah['id_pembelian'] ?>" class="btn btn-success">Pembayaran</a>
				<?php endif ?>
			</td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
	</tbody>
</table>
