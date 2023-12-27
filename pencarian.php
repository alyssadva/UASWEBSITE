<?php  				
session_start();
//koneksi ke database
$koneksi = new mysqli("localhost","root","","lysaccshop");
?>
<?php 
$keyword=$_GET['keyword'];
$semuadata=array();
$ambil=$koneksi->query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' OR deskripsi_produk LIKE '%$keyword%'");
while($pecah = $ambil->fetch_assoc()){
	$semuadata[]=$pecah;
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cari Produk</title>
	<link rel="stylesheet" href="admin aku/assets/css/bootstrap.css">
</head>
<body style="background-image: url('images/bg-01.jpg'); background-size: cover;">

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

  <div class="container">
  	<h3>Hasil Pencarian: <?php echo $keyword; ?></h3>
  	
  	<?php if (empty($semuadata)): ?>
  		<div class="alert alert-danger"><strong><?php echo $keyword; ?></strong> tidak ditemukan.</div>
  	<?php endif ?>


  	<div class="row" >

  		<?php foreach ($semuadata as $key => $value): ?>

  		<div class="col-md-3">
  			<div class="thumbnail">
  				<img src="foto_produk/<?php echo $value['foto_produk'] ?>" alt="" class="img-responsive">
  				<div class="caption">
  					<h3><?php echo $value['nama_produk']; ?></h3>
  					<h5>Rp. <?php echo number_format($value['harga_produk']) ; ?></h5>
						<a href="beli.php?id=<?php echo$value['id_produk']; ?>" class="btn btn-primary">Beli</a>
						<a href="detail.php?id=<?php echo $value['id_produk']; ?>" class="btn btn-default">Detail</a>
  				</div>
  			</div>
  		</div>

  		<?php endforeach ?>
  	</div>
  </div>
</body>
</html>