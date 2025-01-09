<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daftar</title>
	<link rel="stylesheet"  href="admin/assets/css/bootstrap.css">
</head>
<body>

<?php include 'menu.php'; ?>
	
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Daftar Pelanggan</h3>    
                </div>
                <div class="panel-body">
                    <form method="post">
                        <!-- Nama -->
                        <div class="form-group" style="margin-bottom: 15px;">
                            <label class="control-label col-md-3" style="padding: 5px;">Nama</label>
                            <div class="col-md-7" style="padding: 5px;">
                                <input type="text" class="form-control" name="nama" required>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="form-group" style="margin-bottom: 15px;">
                            <label class="control-label col-md-3" style="padding: 5px;">Email</label>
                            <div class="col-md-7" style="padding: 5px;">
                                <input type="email" class="form-control" name="email" required>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="form-group" style="margin-bottom: 15px;">
                            <label class="control-label col-md-3" style="padding: 5px;">Password</label>
                            <div class="col-md-7" style="padding: 5px;">
                                <input type="text" class="form-control" name="password" required>
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div class="form-group" style="margin-bottom: 15px;">
                            <label class="control-label col-md-3" style="padding: 5px;">Alamat</label>
                            <div class="col-md-7" style="padding: 5px;">
                                <textarea class="form-control" name="alamat" required></textarea>
                            </div>
                        </div>

                        <!-- No Telepon -->
                        <div class="form-group" style="margin-bottom: 15px;">
                            <label class="control-label col-md-3" style="padding: 5px;">No Telepon</label>
                            <div class="col-md-7" style="padding: 5px;">
                                <input type="text" class="form-control" name="notelepon" required>
                            </div>
                        </div>

                        <!-- Tombol Daftar -->
                        <div class="form-group" style="margin-bottom: 15px;">
                            <div class="col-md-7 col-md-offset-3" style="padding: 5px;">
                                <button class="btn btn-primary" name="daftar">Daftar</button>
                            </div>
                        </div>
                    </form>
                    <?php  
                    // jika ada tombol daftar (ditekan tombol daftar)
                    if (isset($_POST["daftar"])) 
                    {
                    	// mengambila isian nama,email,password,alamat,telepon
                    	$nama = $_POST["nama"];
                    	$email = $_POST["email"];
                    	$password = $_POST["password"];
                    	$alamat = $_POST["alamat"];
                    	$telepon = $_POST["telepon"];  

                    	//cek email sudah digunakan
                    	$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email'");
                    	$yangcocok = $ambil->num_rows;
                    	if ($yangcocok==1) 
                    	{
                    		echo "<script>alert('pendaftaran gagal, email sudah digunakan');</script>";
                    		echo "<script>location='daftar.php';</script>";
                    	}
                    	else
                    	{
                    		//query insert ke tabel pelanggan 
                    		$koneksi->query("INSERT INTO pelanggan (email_pelanggan, password_pelanggan, nama_pelanggan, telepon_pelanggan, alamat_pelanggan) VALUES ('$email', '$password', '$nama', '$telepon', '$alamat')");


                    			echo "<script>alert('pendaftaran sukses, silahkan login');</script>";
                    			echo "<script>location='login.php';</script>";
                    	}

                    }
                    ?>
                </div>            
            </div>                
        </div>
    </div>
</div>


</body>
</html>