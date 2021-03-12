<?php
	session_start();
	include ('admin.class.php');
	$app = new appRevBukuAdmin();
	$app->connect();

	$aksi=isset($_POST['aksi'])?$_POST['aksi']:'';
	
	switch ($aksi){
		case 'login':
		$username=isset($_POST['username'])?$_POST['username']:'';
		$password=isset($_POST['password'])?$_POST['password']:'';

		$q='SELECT * FROM admin WHERE username=\''.$username.'\' and password=\''.$password.'\' and status=\'aktif\'';
		
		$result = mysqli_query($app->dbc, $q);
		$rowcount=mysqli_num_rows($result);

			if ($rowcount>0){
				$row=mysqli_fetch_assoc($result);
				echo 'sukses';
				$_SESSION['username']=$row['username'];
				$_SESSION['nama_admin']=$row['namaAdmin'];
				$_SESSION['login']='approved';
				$_SESSION['mulai'] = time();
			}else{
				echo 'gagal';
			}

		break;
		
		//UPDATE SETTING
		case 'update_setting':
			$filename = $_FILES['logo']['name']; 
			$tempname = $_FILES['logo']['tmp_name'];     
			$folder = '../img/'.$filename;
			
			$filex = isset($_POST['file_lama'])?$_POST['file_lama']:'';
			
			$namaweb = isset($_POST['namaweb'])?$_POST['namaweb']:'';
			$slogan = isset($_POST['slogan'])?$_POST['slogan']:'';
			$alamat = isset($_POST['alamat'])?$_POST['alamat']:'';
			$copyright = isset($_POST['copyright'])?$_POST['copyright']:'';
			$facebook = isset($_POST['facebook'])?$_POST['facebook']:'';
			$youtube = isset($_POST['youtube'])?$_POST['youtube']:'';
			$instagram = isset($_POST['instagram'])?$_POST['instagram']:'';
			$email = isset($_POST['email'])?$_POST['email']:'';
			$whatsapp = isset($_POST['whatsapp'])?$_POST['whatsapp']:'';
			$telepon = isset($_POST['telepon'])?$_POST['telepon']:'';
			$tentang = isset($_POST['tentang'])?$_POST['tentang']:'';
			
			$idx = isset($_POST['id'])?$_POST['id']:0;
			
			if($filename==''){
				$filename=$filex;
			}
			
			$q_update_setting='UPDATE setting SET
				namaWeb=\''.$namaweb.'\',
				slogan=\''.$slogan.'\',
				logo=\''.$filename.'\', 
				alamat=\''.$alamat.'\', 
				copyright='.$copyright.',
				facebook=\''.$facebook.'\', 
				instagram=\''.$instagram.'\',
				youtube=\''.$youtube.'\', 
				email=\''.$email.'\', 
				whatsapp=\''.$whatsapp.'\',
				telepon=\''.$telepon.'\',
				tentang=\''.$tentang.'\'
				WHERE id='.$idx;
				
			$result = mysqli_query($app->dbc, $q_update_setting);
			if ($result){
				$output='<div style="font-size:30px;color: green; margin: 0 auto;padding-top:100px;width:400px">Update setting berhasil</div>';
				if (! $filename==''){
					move_uploaded_file($tempname, $folder);
				}
			}else{
				$output='<div style="font-size:30px;color: red; margin: 0 auto;padding-top:100px;width:400px">Update setting Gagal</div>';
			}
			header('Refresh: 2; URL=index.php?menu=setting_app');
			echo $output;

		break;
		
		case 'simpan_buku':
			$filename = $_FILES['gambar']['name']; 
			$tempname = $_FILES['gambar']['tmp_name'];     
			$folder = '../gambar/'.$filename;
			
			$tanggal = date('Y-m-d H:i:s');
			$judul = isset($_POST['judul'])?$_POST['judul']:'';
			//$gambar = isset($_POST['tahun_terbit'])?$_POST['tahun_terbit']:'';
			$sinopsis = isset($_POST['sinopsis'])?$_POST['sinopsis']:'';
			$halaman = isset($_POST['jumlah_halaman'])?$_POST['jumlah_halaman']:'';
			$tahun = isset($_POST['tahun_terbit'])?$_POST['tahun_terbit']:'';
			$link = isset($_POST['link'])?$_POST['link']:'';
			$idPengarangIndex = isset($_POST['id_pengarang'])?$_POST['id_pengarang']:0;
			$idPenerbitIndex = isset($_POST['id_penerbit'])?$_POST['id_penerbit']:0;
			$idKategoriIndex = isset($_POST['id_kategori'])?$_POST['id_kategori']:0;
			$idBahasaIndex = isset($_POST['id_bahasa'])?$_POST['id_bahasa']:0;
			$idGenreIndex = isset($_POST['id_genre'])?$_POST['id_genre']:0;
			
			$q_simpan_buku='INSERT INTO buku (
				idBuku,
				tanggal,
				judul,
				gambar,
				sinopsis,
				halaman,
				tahun,
				link,
				idPengarang,
				idPenerbit,
				idKategori,
				idBahasa,
				idGenre,
				status
				) VALUES (
				0,
				\''.$tanggal.'\', 
				\''.$judul.'\', 
				\''.$filename.'\', 
				\''.$sinopsis.'\', 
				\''.$halaman.'\', 
				\''.$tahun.'\', 
				\''.$link.'\', 
				\''.$idPengarangIndex.'\', 
				\''.$idPenerbitIndex.'\', 
				\''.$idKategoriIndex.'\', 
				\''.$idBahasaIndex.'\', 
				\''.$idGenreIndex.'\',
				\'aktif\'
				)';
				
			$result = mysqli_query($app->dbc, $q_simpan_buku);
			if ($result){
				$output='<div style="font-size:30px;color: green; margin: 0 auto;padding-top:100px;width:400px">Input buku berhasil</div>';
				move_uploaded_file($tempname, $folder);
			}else{
				$output='<div style="font-size:30px;color: red; margin: 0 auto;padding-top:100px;width:400px">Input buku Gagal!</div>';
			}
			header('Refresh: 2; URL=index.php');
			echo $output;

		break;

		case 'update_buku':
			$filename = $_FILES['gambar']['name']; 
			$tempname = $_FILES['gambar']['tmp_name'];     
			$folder = '../gambar/'.$filename;
			
			$tanggal = date('Y-m-d H:i:s');
			$judul = isset($_POST['judul'])?$_POST['judul']:'';
			$filex = isset($_POST['file_lama'])?$_POST['file_lama']:'';
			$sinopsis = isset($_POST['sinopsis'])?$_POST['sinopsis']:'';
			$halaman = isset($_POST['jumlah_halaman'])?$_POST['jumlah_halaman']:'';
			$tahun = isset($_POST['tahun_terbit'])?$_POST['tahun_terbit']:'';
			$link = isset($_POST['link'])?$_POST['link']:'';
			$idPengarangIndex = isset($_POST['id_pengarang'])?$_POST['id_pengarang']:0;
			$idPenerbitIndex = isset($_POST['id_penerbit'])?$_POST['id_penerbit']:0;
			$idKategoriIndex = isset($_POST['id_kategori'])?$_POST['id_kategori']:0;
			$idBahasaIndex = isset($_POST['id_bahasa'])?$_POST['id_bahasa']:0;
			$idGenreIndex = isset($_POST['id_genre'])?$_POST['id_genre']:0;
			$idx = isset($_POST['id'])?$_POST['id']:0;
			
			if($filename==''){
				$filename=$filex;
			}
			
			$q_update_buku='UPDATE buku SET
				tanggal=\''.$tanggal.'\',
				judul=\''.$judul.'\',
				gambar=\''.$filename.'\', 
				sinopsis=\''.$sinopsis.'\', 
				halaman='.$halaman.',
				tahun=\''.$tahun.'\', 
				link=\''.$link.'\',
				idPengarang=\''.$idPengarangIndex.'\', 
				idPenerbit=\''.$idPenerbitIndex.'\', 
				idKategori=\''.$idKategoriIndex.'\',
				idBahasa=\''.$idBahasaIndex.'\',
				idGenre=\''.$idGenreIndex.'\'
				WHERE idBuku='.$idx;
				
			$result = mysqli_query($app->dbc, $q_update_buku);
			if ($result){
				$output='<div style="font-size:30px;color: green; margin: 0 auto;padding-top:100px;width:400px">Update buku berhasil</div>';
				if (! $filename==''){
					move_uploaded_file($tempname, $folder);
				}
			}else{
				$output='<div style="font-size:30px;color: red; margin: 0 auto;padding-top:100px;width:400px">Update buku Gagal</div>';
			}
			header('Refresh: 2; URL=index.php');
			echo $output;

		break;
		
		case 'hapus_buku':
			$idx = isset($_POST['id'])?$_POST['id']:0;

			$q_hapus_buku='UPDATE buku SET
				status=\'hapus\' WHERE idBuku='.$idx;
				
			$result = mysqli_query($app->dbc, $q_hapus_buku);
			if ($result){
				echo 'sukses';
			}else{
				echo 'gagal';
			}
		break;
		
		//CRUD MENU KATEGORI
		case 'simpan_kategori':
			$namakategori = isset($_POST['nama_kategori'])?$_POST['nama_kategori']:'';
			
			$q_simpan_kategori='INSERT INTO kategori (
				idKategori,
				namakategori,
				status
				) VALUES (
				0,
				\''.$namakategori.'\', 
				\'aktif\'
				)';
				
			$result = mysqli_query($app->dbc, $q_simpan_kategori);
			if ($result){
				$output='<div style="font-size:30px;color: green; margin: 0 auto;padding-top:100px;width:400px">Input kategori berhasil</div>';
			}else{
				$output='<div style="font-size:30px;color: red; margin: 0 auto;padding-top:100px;width:400px">Input kategori Gagal!</div>';
			}
			header('Refresh: 2; URL=index.php?menu=adm_kategori');
			echo $output;

						
		break;

		case 'update_kategori':
			$namakategori = isset($_POST['nama_kategori'])?$_POST['nama_kategori']:'';
			$idx = isset($_POST['id'])?$_POST['id']:0;

			
			$q_update_kategori='UPDATE kategori SET
				namaKategori=\''.$namakategori.'\'
				WHERE idKategori='.$idx;
				
			$result = mysqli_query($app->dbc, $q_update_kategori);
			if ($result){
				$output='<div style="font-size:30px;color: green; margin: 0 auto;padding-top:100px;width:400px">Update kategori berhasil</div>';
			}else{
				$output='<div style="font-size:30px;color: red; margin: 0 auto;padding-top:100px;width:400px">Update kategori Gagal!</div>';
			}
			header('Refresh: 2; URL=index.php?menu=adm_kategori');
			echo $output;
						
		break;
		
		case 'hapus_kategori':
			$idx = isset($_POST['id'])?$_POST['id']:0;

			$q_hapus_kategori='UPDATE kategori SET
				status=\'hapus\' WHERE idKategori='.$idx;
				
			$result = mysqli_query($app->dbc, $q_hapus_kategori);
			if ($result){
				echo 'sukses';
			}else{
				echo 'gagal';
			}
		break;
		
		//CRUD MENU PENERBIT
		case 'simpan_penerbit':
			$namapenerbit = isset($_POST['nama_penerbit'])?$_POST['nama_penerbit']:'';
			
			$q_simpan_penerbit='INSERT INTO penerbit (
				idPenerbit,
				namaPenerbit,
				status
				) VALUES (
				0,
				\''.$namapenerbit.'\', 
				\'aktif\'
				)';
				
			$result = mysqli_query($app->dbc, $q_simpan_penerbit);
			if ($result){
				$output='<div style="font-size:30px;color: green; margin: 0 auto;padding-top:100px;width:400px">Input penerbit berhasil</div>';
			}else{
				$output='<div style="font-size:30px;color: red; margin: 0 auto;padding-top:100px;width:400px">Input penerbit Gagal!</div>';
			}
			header('Refresh: 2; URL=index.php?menu=adm_penerbit');
			echo $output;

						
		break;

		case 'update_penerbit':
			$namapenerbit = isset($_POST['nama_penerbit'])?$_POST['nama_penerbit']:'';
			$idx = isset($_POST['id'])?$_POST['id']:0;

			
			$q_update_penerbit='UPDATE penerbit SET
				namaPenerbit=\''.$namapenerbit.'\'
				WHERE idPenerbit='.$idx;
				
			$result = mysqli_query($app->dbc, $q_update_penerbit);
			if ($result){
				$output='<div style="font-size:30px;color: green; margin: 0 auto;padding-top:100px;width:400px">Update penerbit berhasil</div>';
			}else{
				$output='<div style="font-size:30px;color: red; margin: 0 auto;padding-top:100px;width:400px">Update penerbit Gagal!</div>';
			}
			header('Refresh: 2; URL=index.php?menu=adm_penerbit');
			echo $output;
						
		break;
		
		case 'hapus_penerbit':
			$idx = isset($_POST['id'])?$_POST['id']:0;

			$q_hapus_penerbit='UPDATE penerbit SET
				status=\'hapus\' WHERE idPenerbit='.$idx;
				
			$result = mysqli_query($app->dbc, $q_hapus_penerbit);
			if ($result){
				echo 'sukses';
			}else{
				echo 'gagal';
			}
		break;


		//CRUD MENU GENRE
		case 'simpan_genre':
			$namagenre = isset($_POST['nama_genre'])?$_POST['nama_genre']:'';
			
			$q_simpan_genre='INSERT INTO genre (
				idGenre,
				namaGenre,
				status
				) VALUES (
				0,
				\''.$namagenre.'\', 
				\'aktif\'
				)';
				
			$result = mysqli_query($app->dbc, $q_simpan_genre);
			if ($result){
				$output='<div style="font-size:30px;color: green; margin: 0 auto;padding-top:100px;width:400px">Input genre berhasil</div>';
			}else{
				$output='<div style="font-size:30px;color: red; margin: 0 auto;padding-top:100px;width:400px">Input genre Gagal!</div>';
			}
			header('Refresh: 2; URL=index.php?menu=adm_genre');
			echo $output;

						
		break;

		case 'update_genre':
			$namagenre = isset($_POST['nama_genre'])?$_POST['nama_genre']:'';
			$idx = isset($_POST['id'])?$_POST['id']:0;

			
			$q_update_genre='UPDATE genre SET
				namaGenre=\''.$namagenre.'\'
				WHERE idGenre='.$idx;
				
			$result = mysqli_query($app->dbc, $q_update_genre);
			if ($result){
				$output='<div style="font-size:30px;color: green; margin: 0 auto;padding-top:100px;width:400px">Update genre berhasil</div>';
			}else{
				$output='<div style="font-size:30px;color: red; margin: 0 auto;padding-top:100px;width:400px">Update genre Gagal!</div>';
			}
			header('Refresh: 2; URL=index.php?menu=adm_genre');
			echo $output;
						
		break;
		
		case 'hapus_genre':
			$idx = isset($_POST['id'])?$_POST['id']:0;

			$q_hapus_genre='UPDATE genre SET
				status=\'hapus\' WHERE idGenre='.$idx;
				
			$result = mysqli_query($app->dbc, $q_hapus_genre);
			if ($result){
				echo 'sukses';
			}else{
				echo 'gagal';
			}
		break;

		//CRUD MENU PENGARANG
		case 'simpan_pengarang':
			$namapengarang = isset($_POST['nama_pengarang'])?$_POST['nama_pengarang']:'';
			
			$q_simpan_pengarang='INSERT INTO pengarang (
				idPengarang,
				namaPengarang,
				status
				) VALUES (
				0,
				\''.$namapengarang.'\', 
				\'aktif\'
				)';
				
			$result = mysqli_query($app->dbc, $q_simpan_pengarang);
			if ($result){
				$output='<div style="font-size:30px;color: green; margin: 0 auto;padding-top:100px;width:400px">Input pengarang berhasil</div>';
			}else{
				$output='<div style="font-size:30px;color: red; margin: 0 auto;padding-top:100px;width:400px">Input pengarang Gagal!</div>';
			}
			header('Refresh: 2; URL=index.php?menu=adm_pengarang');
			echo $output;

						
		break;

		case 'update_pengarang':
			$namapengarang = isset($_POST['nama_pengarang'])?$_POST['nama_pengarang']:'';
			$idx = isset($_POST['id'])?$_POST['id']:0;

			
			$q_update_pengarang='UPDATE pengarang SET
				namaPengarang=\''.$namapengarang.'\'
				WHERE idPengarang='.$idx;
				
			$result = mysqli_query($app->dbc, $q_update_pengarang);
			if ($result){
				$output='<div style="font-size:30px;color: green; margin: 0 auto;padding-top:100px;width:400px">Update pengarang berhasil</div>';
			}else{
				$output='<div style="font-size:30px;color: red; margin: 0 auto;padding-top:100px;width:400px">Update pengarang Gagal!</div>';
			}
			header('Refresh: 2; URL=index.php?menu=adm_pengarang');
			echo $output;
						
		break;
		
		case 'hapus_pengarang':
			$idx = isset($_POST['id'])?$_POST['id']:0;

			$q_hapus_pengarang='UPDATE pengarang SET
				status=\'hapus\' WHERE idPengarang='.$idx;
				
			$result = mysqli_query($app->dbc, $q_hapus_pengarang);
			if ($result){
				echo 'sukses';
			}else{
				echo 'gagal';
			}
		break;

		//CRUD MENU admin
		case 'simpan_admin':
			$namaadmin = isset($_POST['nama_admin'])?$_POST['nama_admin']:'';
			$username = isset($_POST['username'])?$_POST['username']:'';
			$password = isset($_POST['password'])?$_POST['password']:'';
			
			$q_simpan_admin='INSERT INTO admin (
				idAdmin,
				namaAdmin,
				username,
				password,
				status
				) VALUES (
				0,
				\''.$namaadmin.'\', 
				\''.$username.'\', 
				\''.$password.'\', 				
				\'aktif\'
				)';
				
			$result = mysqli_query($app->dbc, $q_simpan_admin);
			if ($result){
				$output='<div style="font-size:30px;color: green; margin: 0 auto;padding-top:100px;width:400px">Input admin berhasil</div>';
			}else{
				$output='<div style="font-size:30px;color: red; margin: 0 auto;padding-top:100px;width:400px">Input admin Gagal!</div>';
			}
			header('Refresh: 2; URL=index.php?menu=adm_admin');
			echo $output;
		break;

		case 'update_admin':
			$namaadmin = isset($_POST['nama_admin'])?$_POST['nama_admin']:'';
			$username = isset($_POST['username'])?$_POST['username']:'';
			$password = isset($_POST['password'])?$_POST['password']:'';
			
			$idx = isset($_POST['id'])?$_POST['id']:0;

			$q_update_admin='UPDATE admin SET
				namaadmin=\''.$namaadmin.'\',
				username=\''.$username.'\',
				password=\''.$password.'\'				
				WHERE idAdmin='.$idx;
				
			$result = mysqli_query($app->dbc, $q_update_admin);
			if ($result){
				$output='<div style="font-size:30px;color: green; margin: 0 auto;padding-top:100px;width:400px">Update admin berhasil</div>';
			}else{
				$output='<div style="font-size:30px;color: red; margin: 0 auto;padding-top:100px;width:400px">Update admin Gagal!</div>';
			}
			header('Refresh: 2; URL=index.php?menu=adm_admin');
			echo $output;
		break;
		
		case 'hapus_admin':
			$idx = isset($_POST['id'])?$_POST['id']:0;

			$q_hapus_admin='UPDATE admin SET
				status=\'hapus\' WHERE idAdmin='.$idx;
				
			$result = mysqli_query($app->dbc, $q_hapus_admin);
			if ($result){
				echo 'sukses';
			}else{
				echo 'gagal';
			}
		break;

		//CRUD MENU menu
		case 'simpan_menu':
			$namamenu = isset($_POST['nama_menu'])?$_POST['nama_menu']:'';
			$url = isset($_POST['url'])?$_POST['url']:'';
			
			$q_simpan_menu='INSERT INTO menu (
				idMenu,
				namaMenu,
				url,
				status
				) VALUES (
				0,
				\''.$namamenu.'\', 
				\''.$url.'\', 
				\'aktif\'
				)';
				
			$result = mysqli_query($app->dbc, $q_simpan_menu);
			if ($result){
				$output='<div style="font-size:30px;color: green; margin: 0 auto;padding-top:100px;width:400px">Input menu berhasil</div>';
			}else{
				$output='<div style="font-size:30px;color: red; margin: 0 auto;padding-top:100px;width:400px">Input menu Gagal!</div>';
			}
			header('Refresh: 2; URL=index.php?menu=adm_menu');
			echo $output;
		break;

		case 'update_menu':
			$namamenu = isset($_POST['nama_menu'])?$_POST['nama_menu']:'';
			$url = isset($_POST['url'])?$_POST['url']:'';
			
			$idx = isset($_POST['id'])?$_POST['id']:0;

			$q_update_menu='UPDATE menu SET
				namaMenu=\''.$namamenu.'\',
				url=\''.$url.'\'
				WHERE idMenu='.$idx;
				
			$result = mysqli_query($app->dbc, $q_update_menu);
			if ($result){
				$output='<div style="font-size:30px;color: green; margin: 0 auto;padding-top:100px;width:400px">Update menu berhasil</div>';
			}else{
				$output='<div style="font-size:30px;color: red; margin: 0 auto;padding-top:100px;width:400px">Update menu Gagal!</div>';
			}
			header('Refresh: 2; URL=index.php?menu=adm_menu');
			echo $output;
		break;
		
		case 'hapus_menu':
			$idx = isset($_POST['id'])?$_POST['id']:0;

			$q_hapus_menu='UPDATE menu SET
				status=\'hapus\' WHERE idMenu='.$idx;
				
			$result = mysqli_query($app->dbc, $q_hapus_menu);
			if ($result){
				echo 'sukses';
			}else{
				echo 'gagal';
			}
		break;

		//CRUD LAINNYA TINGGAL DITERUSKAN DENGAN MELIHAT CONTOH DI ATAS

	}
	
?>