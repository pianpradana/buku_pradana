<?php 
session_start();
$status_login=isset($_SESSION['login'])?$_SESSION['login']:'';
if (! $status_login =='approved'){
	header('Location:login.php');
}else{
	include ('admin.class.php');
	$app = new appRevBukuAdmin();
	$app->connect();
}	
?>
<!DOCTYPE html>
<html>
<head>
    <title>Administrasi - <?php $app->ambil_setting('judul');?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="../asset/style.css" />
	<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
    <link rel="shortcut icon" type="image/x-icon" href="img/iconbuku.ico" />
	<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>

</head>

<body>
	<header> 
		<?php $app->ambil_setting('header');?>
		<small><?php echo 'Anda login sebagai: '.$_SESSION['nama_admin'].' | <a href="logout.php">Logout</a>';?> </small>
	</header>
    <main>
        <div id="navbar">
            <div class="card"><nav>
			<h3>Navigasi</h3>
				<ul>
					<li><a href="../index.php" target="_blank">Lihat Website</a></li>
					<li><a href="index.php?menu=setting_app">Setting Aplikasi</a></li>
					<li><a href="index.php?menu=adm_buku">Administrasi Buku</a></li>
					<li><a href="index.php?menu=adm_kategori">Administrasi Kategori</a></li>
					<li><a href="index.php?menu=adm_penerbit">Administrasi Penerbit</a></li>
					<li><a href="index.php?menu=adm_genre">Administrasi Genre</a></li>
					<li><a href="index.php?menu=adm_pengarang">Administrasi Pengarang</a></li>
					<li><a href="index.php?menu=adm_admin">Administrasi User</a></li>
					<li><a href="index.php?menu=adm_menu">Administrasi Menu</a></li>
				</ul>
			</nav></div>
        </div>

        <div id="content-admin">
			<div class="card">
			<?php 
				$menu=isset($_GET['menu'])?$_GET['menu']:'adm_buku';
				$app->buat_halaman_admin($menu);
			?>
			</div>
        </div>
    </main>

    <footer><?php $app->ambil_setting('footer');?></footer>

</body>
 
</html>

