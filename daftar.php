<?php
session_start();
$koneksi = new mysqli("localhost","root","","lysaccshop");
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Daftar</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="admin aku/assets/css/bootstrap.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	

<!--navbar-->
<nav class="navbar navbar-default">
    <div class="container">
        <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="cart.php">Cart</a></li>
            <?php if (isset($_SESSION['pelanggan'])): ?>
                <li><a href="riwayat.php">Riwayat Pembelian</a></li>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="daftar.php">Daftar</a></li>
        <?php endif ?>
            <li><a href="checkout.php">Checkout</a></li>
        </ul>
    </div>
</nav>




	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="login100-form validate-form" action="" method="post">

					<span class="login100-form-title p-b-49">
						Daftar Pelanggan
					</span>

					<div class="wrap-input100 validate-input m-b-23" data-validate = "Nama is reauired">
						<span class="label-input100">Nama</span>
						<input class="input100" type="text" name="nama" />
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-23" data-validate = "Email is reauired">
						<span class="label-input100">Email</span>
						<input class="input100" type="email" name="email" />
						<span class="focus-input100" data-symbol=""></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="password" >
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Telp/HP is required">
						<span class="label-input100">Telp/HP</span>
						<input class="input100" type="text" name="telepon" >
						<span class="focus-input100" data-symbol=""></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Alamat Rumah is required">
						<span class="label-input100">Alamat Rumah</span>
						<input class="input100" type="text" name="alamat_rumah" >
						<span class="focus-input100" data-symbol=""></span>
					</div>
					
					
					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit" name="daftar">
								Daftar
							</button>
						
						</div>
					</div>

				
				</form>
				<?php
						if (isset($_POST['daftar'])) {
							$nama=$_POST['nama'];
							$email=$_POST['email'];
							$password=$_POST['password'];
							$telepon=$_POST['telepon'];
							$alamat_rumah=$_POST['alamat_rumah'];



							$ambil=$koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email'");
							$yangcocok=$ambil->num_rows;
							if ($yangcocok==1) {
								echo "<script>alert('pendaftaran Gagal, email sudah digunakan!');</script>";
								echo "<meta http-equiv='refresh' content='1;url=daftar.php'>";
							}
							else{
								$koneksi->query("INSERT INTO pelanggan(email_pelanggan,password_pelanggan,nama_pelanggan,telepon_pelanggan,alamat_rumah) VALUES ('$email','$password','$nama','$telepon','$alamat_rumah')");
								echo "<script>alert('Pendaftaran Berhasil, Silahkan login!');</script>";
								echo "<meta http-equiv='refresh' content='1;url=login.php'>";

							}
						}
						  ?>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>