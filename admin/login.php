<?php
session_start();
// skrip koneksi
$koneksi = new mysqli("localhost","root","","step_up");
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Free Bootstrap Admin Template : Binary Admin</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="container">
        <div class="row text-center d-flex align-items-center justify-content-center">
            <div class="col-md-12">
            <br /><br />
             <!-- Logo Sepatu -->
            <img src="assets/img/logo_sepatu.png" alt="Logo Sepatu" style="max-width: 150px; margin-right: 10px;">
            <h2 class="text-primary d-inline-block">Step UP : Login</h2>
            <h5 class="d-inline-block ml-2">( Silahkan untuk Admin melakukan login)</h5>
                <br />
            </div>
        </div>
        <div class="row ">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-body text-center">
    <form role="form" method="post">
        <br />
        <div class="form-group input-group">
            <span class="input-group-addon"><i class="fa fa-tag"></i>
            </span>
            <input type="text" class="form-control" name="user" />
        </div>
        <div class="form-group input-group">
            <span class="input-group-addon"><i class="fa fa-lock"></i>
            </span>
            <input type="password" class="form-control" name="pass" />
        </div>
        <div class="form-group">
            <label class="checkbox-inline">
        <input type="checkbox" /> Remember me
    </label>
    <span class="pull-right">
        <a href="#">Forget password?</a>
    </span>
</div>
            <button class="btn btn-primary btn-block" name="login">Login</button>
                <hr class="my-4" />
                Not registered? <a href="registration.html" class="text-primary">click here</a>
</form>
<?php
if (isset($_POST['login']))
{
  $ambil = $koneksi->query("SELECT * FROM admin WHERE username='$_POST[user]' AND password ='$_POST[pass]' ");  
  $yangcocok = $ambil->num_rows;
  if ($yangcocok==1)
  {
    $_SESSION['admin']=$ambil->fetch_assoc();
    echo "<div class='alert alert-info'>Login Sukses</div>";
    echo "<meta http-equiv='refresh' content='1;url=index.php'>";
  }
  else
  {
    echo "<div class='alert alert-danger'>Login gagal</div>";
    echo "<meta http-equiv='refresh' content='1;url=login.php'>";
  }
 
}
?>
                    <!-- Panel content will go here -->
                </div>
            </div>
        </div>
    </div>
</div>


<script src="assets/js/jquery-1.10.2.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.metisMenu.js"></script>
<script src="assets/js/custom.js"></script>

</body>
</html>