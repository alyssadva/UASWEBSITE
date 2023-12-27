<?php  				
session_start();
//koneksi ke database
$koneksi = new mysqli("localhost","root","","lysaccshop");

if (!isset($_SESSION['pelanggan']) OR empty($_SESSION['pelanggan'])) 
{
    echo "<script>alert('anda harus login');</script>";
    echo "<script>location='login.php';</script>";
   
}


?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Riwayat Belanja</title>
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

<section class="riwayat">
	<div class="container" style="background-color: rgba(255, 255, 255, 1); padding: 20px; border-radius: 10px;">
		<h3>Riwayat Belanja <?php echo $_SESSION['pelanggan']['nama_pelanggan'] ?></h3>

		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Tanggal</th>
					<th>Total</th>
					<th>Opsi</th>
				</tr>
			</thead>
			<tbody>
				<?php $nomor=1; ?>
				<?php 
				$id_pelanggan=$_SESSION['pelanggan']['id_pelanggan'];
				$ambil=$koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan'");  
				while ($pecah=$ambil->fetch_assoc()){
				?>
				<tr>
					<td><?php echo $nomor; ?></td>
					<td><?php echo $pecah["tanggal_pembelian"]; ?></td>
					<td>Rp. <?php echo number_format($pecah["total_pembelian"]); ?></td>
					<td>
						<a href="nota.php?id=<?php echo $pecah['id_pembelian'];  ?>" class="btn btn-info">Nota</a>
						
					</td>
				</tr>
				<?php $nomor++; ?>
			<?php } ?>
			</tbody>
		</table>
	</div>
</section>

</body>
</html>