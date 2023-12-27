<?php  				
session_start();
//koneksi ke database
$koneksi = new mysqli("localhost","root","","lysaccshop");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Lysacc Shop</title>
	<link rel="stylesheet" href="admin aku/assets/css/bootstrap.css">
</head>
<body style="background-image: url('images/bg-01.jpg'); background-size: cover; ">


<!--navbar-->
<nav class="navbar navbar-default" style="background-image: linear-gradient(to bottom, #8C5B8C, #7E0080); border: none;">
    <div class="container">
        <ul class="nav navbar-nav">
            <li><a href="index.php" style="color: #fff; font-weight: bold; font-family: 'Arial', sans-serif;">Home</a></li>
            <li><a href="cart.php" style="color: #fff; font-weight: bold; font-family: 'Arial', sans-serif;">Cart</a></li>
            <?php if (isset($_SESSION['pelanggan'])): ?>
                <li><a href="riwayat.php" style="color: #fff; font-weight: bold; font-family: 'Arial', sans-serif;">Riwayat Pembelian</a></li>
                <li><a href="logout.php" style="color: #fff; font-weight: bold; font-family: 'Arial', sans-serif;">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php" style="color: #fff; font-weight: bold; font-family: 'Arial', sans-serif;">Login</a></li>
                <li><a href="daftar.php" style="color: #fff; font-weight: bold; font-family: 'Arial', sans-serif;">Daftar</a></li>
            <?php endif ?>
            <li><a href="checkout.php" style="color: #fff; font-weight: bold; font-family: 'Arial', sans-serif;">Checkout</a></li>
        </ul>

        <form action="pencarian.php" method="get" class="navbar-form navbar-right">
            <input type="text" class="form-control" name="keyword" style="background-color: #f5f5f5; font-weight: bold; font-family: 'Arial', sans-serif;">
            <button class="btn btn-primary" style="background-image: linear-gradient(to bottom, #1e88e5, #1565c0); border: none; font-weight: bold; font-family: 'Arial', sans-serif;">Search</button>
        </form>
    </div>
</nav>





<!--konten-->
<section class="konten">
	<div class="container" >
		<h1 style="color: #fff;"><strong>Selamat Datang Di Lysacc Shop</strong></h1><br>
		<h2 style="color: #fff;">Produk Terbaru!</h2>


		<div class="row">

			<?php $ambil=$koneksi->query("SELECT * FROM produk"); ?>
			<?php while($perproduk=$ambil->fetch_assoc()){ ?>

			<div class="col-md-3" style="border-radius: 20px;">
				<div class="thumbnail" style="border-radius: 20px;">
					<img style="border-radius: 20px; width: 200px; height: 200px;" src="foto_produk/<?php echo $perproduk['foto_produk']; ?>" alt="">
					<div class="caption">
						<h3><?php echo $perproduk['nama_produk']; ?></h3>
						<h5>Rp. <?php echo number_format($perproduk['harga_produk']) ; ?></h5>
						<a href="beli.php?id=<?php echo$perproduk['id_produk']; ?>" class="btn btn-primary" style="background-image: linear-gradient(to bottom, #1e88e5, #1565c0); border: none; font-weight: bold; font-family: 'Arial', sans-serif;">Beli</a>
						<a href="detail.php?id=<?php echo $perproduk['id_produk'] ?>" class="btn btn-default">Detail</a>
					</div>
				</div>
			</div>
			<?php } ?>

		</div>
	</div>
</section>

</body>
</html>