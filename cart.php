<?php 
session_start();

$koneksi = new mysqli("localhost","root","","lysaccshop");

if (empty($_SESSION['cart']) OR !isset($_SESSION['cart'])) {
    echo "<script>alert('Belum ada pemesanan, Silahkan Pesan terlebih dahulu!');</script>";
    echo "<script>location='index.php';</script>";
}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
     <title>Cart</title>
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
    </div>
</nav>

<!--konten-->
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
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor=1; ?>
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
                    <td><a href="hapusproduk.php?id=<?php echo $id_produk  ?>" class="btn btn-danger btn-xs" >Hapus</a></td>
                </tr>
                <?php $nomor++; ?>
                <?php endforeach ?>
            </tbody>
        </table>
        <a href="index.php" class="btn btn-default">Belanja lagi</a>
        <a href="checkout.php" class="btn btn-primary">Checkout</a>
    </div>
</section>
 </body>
 </html>