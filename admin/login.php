<?php
include ('admin.class.php');
	$app = new appRevBukuAdmin();
	$app->connect();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Administrasi - <?php $app->ambil_setting('judul');?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="../asset/style.css" />
    <link rel="shortcut icon" type="image/x-icon" href="img/iconbuku.ico" />
	<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
</head>

<body>
	<header><?php $app->ambil_setting('header');?></header>
    <main>

        <div id="content-login">
			<div class="card">
			<?php 
				$app->buat_halaman_login();
			?>
			</div>
        </div>
    </main>

    <footer><?php $app->ambil_setting('footer');?></footer>
</body>
</html>

