<?php  				
session_start();
//koneksi ke database
$koneksi = new mysqli("localhost","root","","lysaccshop");
?>
<?php $id_produk=$_GET['id'];
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$detail = $ambil->fetch_assoc();

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Detail Produk</title>
	<link rel="stylesheet" href="admin aku/assets/css/bootstrap.css">
</head>
<body style="background-image: url('images/bg-01.jpg'); background-size: cover;">
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
    </div>
</nav>
<section class="konten">
	<div class="container" style="background-color: rgba(255, 255, 255, 1); padding: 20px; border-radius: 10px;">
		<div class="row">
			<div class="col-md-6">
				<img src="foto_produk/<?php echo $detail['foto_produk'];?>" alt="" class="img-responsive">
			</div>
			<div class="col-md-6">
				<h2><?php echo $detail["nama_produk"] ?></h2>
				<h4>Rp. <?php echo number_format($detail["harga_produk"]); ?></h4>

				<form method="post">
					<div class="form-group">
						<div class="input-group">
							<input type="number" min="1" class="form-control" name="jumlah">
						<div class="input-group-btn">
							<button class="btn btn-primary" name="beli">Beli</button>
						</div>
						</div>
					</div>
				</form>
				<?php 
					if (isset($_POST["beli"])) 
					{
						$jumlah=$_POST['jumlah'];
						$_SESSION['cart'][$id_produk]=$jumlah;

						echo "<script>alert('produk telah masuk ke menu Cart');</script>";

						echo "<script>location='cart.php';</script>";
					}
				 ?>

				<p><?php echo $detail["deskripsi_produk"]; ?></p>
			</div>
		</div>
		
	</div>
</section>
</body>
</html>
