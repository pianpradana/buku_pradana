<?php
include ('template/app.class.php');
	$app = new appRevBuku();
	$app->connect();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sinopsis - <?php $app->ambil_setting('judul');?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="asset/style.css" />
    <link rel="shortcut icon" type="image/x-icon" href="img/iconbuku.ico" />
</head>

<body>
	<header> <?php $app->ambil_setting('header');?></header>
    <main>
        <div id="navbar">
            <div class="card"><nav><?php $app->ambil_navigasi();?></nav></div>
        </div>

        <div id="content">
			<?php 
				$idbuku=isset($_GET['idbuku'])?$_GET['idbuku']:0;
				$app->ambil_sinopsis($idbuku);
			?>
        </div>

        <div id="sidebar">
            <div class="card">
				<nav><?php 
				//$app->ambil_setting('sidebar');
				$app->ambil_genre();
				?></nav>
			</div>
        </div>
    </main>

    <footer><?php $app->ambil_setting('footer');?></footer>

</body>
</html>

