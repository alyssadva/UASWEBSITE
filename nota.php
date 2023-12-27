<?php  				
//koneksi ke database
session_start();
$koneksi = new mysqli("localhost","root","","lysaccshop");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nota Pembelian</title>
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
        
<h2>Detail Pembelian</h2>
<?php
$ambil=$koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
$detail=$ambil->fetch_assoc();  
?>

<?php 
$idpelangganyangbeli = $detail['id_pelanggan'];
$idpelangganyanglogin=$_SESSION['pelanggan']['id_pelanggan'];

if ($idpelangganyangbeli!==$idpelangganyanglogin) {
    echo "<script>alert('anda tidak dapat melihat nota orang lain!');</script>";
     echo "<script>location='riwayat.php';</script>";
}


 ?>



<div class="row">
    <div class="col-md-4">
        <h3>Pembelian</h3>
         Tanggal: <?php echo $detail['tanggal_pembelian'];?><br>
         Total: <?php echo number_format($detail['total_pembelian']); ?>
    </div>
    <div class="col-md-4">
        <h3>Pelanggan</h3>
        <strong><?php echo $detail['nama_pelanggan']; ?></strong> <br>
        <?php echo $detail['telepon_pelanggan']; ?><br>
        <?php echo $detail['email_pelanggan']; ?>
    </div>
    <?php  
        $ambil=$koneksi->query("SELECT * FROM metode");
        while ($permetode=$ambil->fetch_assoc()){
        ?>
    <div class="col-md-4">
        <h3>Pengiriman</h3>
        <strong>Alamat <?php echo $detail['alamat_rumah']; ?></strong><br>
        Metode Pembayaran: <?php echo $permetode['nama_metode']; ?>
    </div>
     <?php   }?>
</div>



<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Produk</th>
			<th>Harga</th>
			<th>Jumlah</th>
			<th>Subtotal</th>
		</tr>
	</thead>
	<tbody>
	<?php $nomor=1; ?>
	<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk WHERE pembelian_produk.id_pembelian='$_GET[id]'");  ?>
	<?php while($pecah=$ambil->fetch_assoc()){ ?>
	<tr>
		<td><?php echo $nomor; ?></td>
		<td><?php echo $pecah['nama_produk']; ?></td>
		<td><?php echo $pecah['harga_produk']; ?></td>
		<td><?php echo $pecah['jumlah_pembelian']; ?></td>
		<td>
			<?php echo $pecah['harga_produk']*$pecah['jumlah_pembelian']; ?>
		</td>	
	</tr>
	<?php $nomor++; ?>
	<?php } ?>
	</tbody>
</table>

<div class="row">
    <div class="col-md-7">
        <div class="alert alert-info">
            <p>
                Silahkan menyerahkan pembayaran Rp. <?php echo number_format($detail['total_pembelian']); ?> <br>
                <strong></strong>
            </p>
        </div>
    </div>
</div>
<a href="index.php" class="btn btn-primary">Belanja lagi</a>
    </div>
</section>

</body>
</html>