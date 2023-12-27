<?php  				
session_start();
//koneksi ke database
$koneksi = new mysqli("localhost","root","","lysaccshop");

if (!isset($_SESSION['pelanggan'])) 
{
    echo "<script>alert('Anda harus login!');</script>";
    echo "<script>location='login.php';</script>";
   
}
if (!isset($_SESSION['cart'])) {
    echo "<script>alert('Belum ada pemesanan, Silahkan Pesan terlebih dahulu!');</script>";
    echo "<script>location='index.php';</script>";
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Checkout</title>
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
        <h1>Keranjang Belanja</h1>
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subharga</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php $nomor=1; ?>
                <?php $totalbelanja=0; ?>
                <?php foreach ($_SESSION["cart"] as $id_produk => $jumlah): ?>
                <?php 
                $ambil=$koneksi->query("SELECT * 
                    FROM produk WHERE id_produk='$id_produk'"); 
                $pecah=$ambil->fetch_assoc();
                $subharga=$pecah["harga_produk"]*$jumlah;
                ?>

                <tr>
                    <td><?php echo$nomor; ?></td>
                    <td><?php echo $pecah["nama_produk"]; ?></td>
                    <td>Rp. <?php echo number_format($pecah["harga_produk"]); ?></td>
                    <td><?php echo  $jumlah; ?></td>
                    <td>Rp. <?php echo number_format($subharga); ?></td>
                   
                </tr>
                <?php $nomor++; ?>
                <?php $totalbelanja+=$subharga; ?>
                <?php endforeach ?>
            </tbody>
            <tfoot>
            	<tr>
            		<th colspan="4">Total Belanja</th>
            		<th>Rp. <?php echo number_format($totalbelanja) ?></th>
            	</tr>
            </tfoot>
        </table>
        
        <form method="post">
        	<div class="form-group">
        	</div>
        	<div class="row">
        		<div class="col-md-4">
        			<input type="text" readonly value="<?php echo $_SESSION['pelanggan']['nama_pelanggan']  ?>" class="form-control">
        		</div>
        		<div class="col-md-4">
        			<input type="text" readonly value="alamat <?php echo $_SESSION['pelanggan']['alamat_rumah']  ?>" class="form-control">
        		</div>
        		<div class="col-md-4">
        			<select class="form-control" name="id_metode">
        				<option value="">Pilih Metode Pembayaran</option>
        				<?php  
        				$ambil=$koneksi->query("SELECT * FROM metode");
        				while ($permetode=$ambil->fetch_assoc()){
        				?>
        				<option value="<?php echo $permetode['id_metode'] ?>">
        					<?php echo $permetode['nama_metode'] ?>
        				</option>
        			<?php } ?>
        			</select>
        		</div>
        	</div>
        	<button class="btn btn-primary" name="checkout">Checkout</button>
        </form>

        <?php 
        if (isset($_POST['checkout'])) 
        {
        	$id_pelanggan=$_SESSION['pelanggan']['id_pelanggan'];
        	$tanggal_pembelian=date("Y=m-d");
        	$total_pembelian=$totalbelanja;
        	$id_metode=$_POST['id_metode'];

        	$koneksi->query("INSERT INTO pembelian (id_pelanggan,tanggal_pembelian,total_pembelian,id_metode) VALUES ('$id_pelanggan','$tanggal_pembelian','$total_pembelian','$id_metode')");

        	$id_pembelian_barusan=$koneksi->insert_id;

        	foreach ($_SESSION['cart'] as $id_produk => $jumlah_pembelian) 
        	{
        		$koneksi->query("INSERT INTO pembelian_produk (id_pembelian,id_produk,jumlah_pembelian) VALUES ('$id_pembelian_barusan','$id_produk','$jumlah_pembelian')");
        	}


        	unset($_SESSION['cart']);

        	echo "<script>alert('pembelian sukses!');</script>";
			echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";

        }

         ?>

    </div>
</section>

</body>
</html>