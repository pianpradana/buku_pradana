<?php
class appRevBuku  {
    var $host = 'localhost';
    var $user = 'root';
    var $pass = '';
    var $db = 'db_buku';
	var $dbc;

	public function connect(){
		$this->dbc = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
		return $this->dbc;

	}
	
    public function close(){
        return mysqli_close($this->dbc);
    }
	
	public function ambil_setting($jenis=''){
		$qsetting='SELECT * FROM setting WHERE 1';
		$result = mysqli_query($this->dbc, $qsetting);
		$row=mysqli_fetch_assoc($result);
		
		switch ($jenis){
			case 'header':
				echo '
				<img height="72" src="img/'.$row['logo'].'">
				<h1>'.$row['namaWeb'].'</h1>
				<h3>'.$row['slogan'].'</h3>
				<small>'.$row['alamat'].'</small>
				';	
			break;
			
			case 'footer':
				echo '
				<div class="footer">
					<div class="right">
						<h3>'.$row['namaWeb'].'</h3>
						<span>'.$row['slogan'].'</span>
						<ul class="sosmed-footer">
							<li><a href="'.$row['facebook'].'">Facebook</a></li>
							<li><a href="'.$row['youtube'].'">Youtube</a></li>
							<li><a href="'.$row['instagram'].'">Instagram</a></li>					
						</ul>
					</div>	
					<div class="left"><p>Copyright '.$row['copyright'].'. All Rights Reserved</p></div>
				</div>
				';	
			break;
			
			case 'judul':
				echo $row['namaWeb'];
			break;
			
			case 'sidebar':
				echo '<h3>Kategori</h3>';
				echo 
				'<ul>
					<li><a href="'.$row['facebook'].'" target="_blank">Facebook</a></li>
					<li><a href="'.$row['youtube'].'" target="_blank">Youtube</a></li>
					<li><a href="'.$row['instagram'].'" target="_blank">Instagram</a></li>					
				</ul>';
			break;
			
			case 'tentang':
				echo '<article class="card"><h2>Tentang Kami</h2>'.$row['tentang'].'</article>';
			break;
			
			case 'kontak':
				echo 
				'<article class="card"><h2>Hubungi Kami</h2>
				<ul>
					<li>'.$row['alamat'].'</li>
					<li><a href="tel:'.$row['telepon'].'" target="_blank">'.$row['telepon'].'</a></li>
					<li><a href="'.$row['facebook'].'" target="_blank">Facebook</a></li>
					<li><a href="'.$row['youtube'].'" target="_blank">Youtube</a></li>
					<li><a href="'.$row['instagram'].'" target="_blank">Instagram</a></li>					
				</ul></article>';
			break;
			
		}
	}
	
	public function ambil_navigasi(){
		$qmenu='SELECT * FROM menu WHERE status=\'aktif\' ORDER BY idMenu';
		$resultmenu = mysqli_query($this->dbc, $qmenu);
		
		echo '<h3>Navigasi</h3>';
		echo '<ul>';
		while($rowMenu=mysqli_fetch_assoc($resultmenu)){
			//Fetching Main Menu
            echo '<li><a href="'.$rowMenu['url'].'">'.$rowMenu['namaMenu'].'</a></li>';
									
			//Query untuk menampilkan submenu yang idMenu-nya sama dengan idMenu Main Menu
			//$qsub='SELECT * FROM submenu WHERE idMenu='.$rowMenu['idMenu'].' ORDER BY idMenu';
			//$resultSub = mysqli_query($this->dbc, $qsub);
			//Cek apakah jumlah sub menunya ada (>0)?
			//Kalau jumlah sub menunya ada, tampilkan sub menunya disini
			//if($resultSub){
			//	echo '<ul>';
			//		while ($rowSub = $resultSub->fetch_assoc()) {
			//			echo '<li><a href="index.php?jenis=kategori&id='.$rowSub['idSub'].'">'.$rowSub['teksSub'].'</a></li>';
			//		}
			//	echo '</ul>';
			if($rowMenu['namaMenu']=='Perpustakaan'){
				$this->ambil_kategori();
			}
		}
		echo '</ul>';
								
	}
	
	public function ambil_genre(){
		$qgenre='SELECT * FROM genre  WHERE status=\'aktif\' ORDER BY idGenre';
		$resultgenre = mysqli_query($this->dbc, $qgenre);
		
		echo '<h3>Genre Buku</h3>';
		echo '<ul>';
		while($rowGenre=mysqli_fetch_assoc($resultgenre)){
			//Fetching Main Menu
            echo '<li><a href="index.php?jenis=genre&id='.$rowGenre['idGenre'].'">'.$rowGenre['namaGenre'].'</a></li>';
		}
		echo '</ul>';
								
	}
	
	public function ambil_kategori(){
		$qkategori='SELECT * FROM kategori WHERE status= \'aktif\' ORDER BY idKategori';
		$resultkategori = mysqli_query($this->dbc, $qkategori);
		
		echo '<ul>';
		while($rowKategori=mysqli_fetch_assoc($resultkategori)){
			//Fetching Main Menu
            echo '<li><a href="index.php?jenis=kategori&id='.$rowKategori['idKategori'].'">'.$rowKategori['namaKategori'].'</a></li>';
		}
		echo '</ul>';
								
	}
	
	public function ambil_preview($jenis, $id){
		$where = ' WHERE 1';
		
		switch($jenis){
			case 'kategori':
				if (! $id==0){
					$where= ' WHERE idKategori='.$id;
				}
			break;
			
			case 'genre':
				if (! $id==0){
					$where= ' WHERE idGenre='.$id;
				}
			break;
			
		}
		

		$qpreview='SELECT * FROM buku'.$where.' AND status=\'aktif\'';
		$resultprev = mysqli_query($this->dbc, $qpreview);
		$jumlahbuku=mysqli_num_rows($resultprev);
		
		if ($resultprev && $jumlahbuku>0){
			while($rowPrev=mysqli_fetch_assoc($resultprev)){
				echo '
				<article class="card">
						<a class="link-judul" href="sinopsis.php?idbuku='.$rowPrev['idBuku'].'"><h2 class="judul-prev">'.$rowPrev['judul'].'</h2></a>
						<div class="box-prev">

						<a href="sinopsis.php?idbuku='.$rowPrev['idBuku'].'"><img src="gambar/'.$rowPrev['gambar'].'" /></a>
						<div class="text-prev">'.$rowPrev['sinopsis'].'</div>
						</div>
				</article>
				';
			}
		}else{
			echo '
				<article class="card">
					<h2 class="judul-prev">Tidak ditemukan buku dengan kategori/ genre tersebut!</h2>
				</article>
				';
		}

	}
	
	public function ambil_sinopsis($idbuku){
		if (! $idbuku==0){
			$qsinopsis='SELECT * FROM buku 
			LEFT JOIN pengarang ON buku.idPengarang=pengarang.idPengarang 
			LEFT JOIN penerbit ON buku.idPenerbit=penerbit.idPenerbit 
			WHERE buku.idBuku='.$idbuku;
			
			$resultsinopsis = mysqli_query($this->dbc, $qsinopsis);
			$rowSinopsis=mysqli_fetch_assoc($resultsinopsis);
			//$cekhasil = $rowSinopsis->num_rows;
			if($rowSinopsis){
				echo '
				<article class="card">
						<div class="box-sinopsis">
						<h2 class="judul-sinopsis">'.$rowSinopsis['judul'].'</h2>
						<small>Pengarang: '.$rowSinopsis['namaPengarang'].', Penerbit: '.$rowSinopsis['namaPenerbit'].'</small>
						<img src="gambar/'.$rowSinopsis['gambar'].'" />
						<div class="text-sinopsis">'.$rowSinopsis['sinopsis'].'</div>
						</div>
				</article>
				';
			}else{
				echo '<article class="card"><h3>Buku yang anda cari tidak ditemukan!</h3></article>';
			}
		}else{
			echo '<article class="card"><h3>Data yang anda cari tidak ditemukan!</h3></article>';
		}

	}
	
	public function buat_halaman_admin($menu){
		switch($menu){
			case 'adm_buku':
				$q='SELECT * FROM buku 
				LEFT JOIN pengarang ON buku.idPengarang=pengarang.idPengarang 
				LEFT JOIN penerbit ON buku.idPenerbit=penerbit.idPenerbit 
				WHERE 1';

				$result = mysqli_query($this->dbc, $q);
				//$datax=mysqli_fetch_assoc($result);
				
				$rowcount=mysqli_num_rows($result);
				$content='';
				$body='';

				if ($rowcount>0){
					$header= '
					<button type="button" data-dismiss="modal">TAMBAH</button><hr />
					<table id="tq2" class="table display nowrap" style="width:100%">
					<thead><th scope="row">#ID BUKU</th><th scope="row">JUDUL BUKU</th><th scope="row">PENGARANG</th><th scope="row">PENERBIT</th><th scope="row">TAHUN TERBIT</th><th scope="row">AKSI</th></thead>
					<tbody>';
					while($datax=mysqli_fetch_assoc($result)){
						$body.='				
						<tr>
						  <td>#'.$datax['idBuku'].'</td>
						  <td>'.$datax['judul'].'</td>
						  <td>'.$datax['namaPengarang'].'</td>
						  <td>'.$datax['namaPenerbit'].'</td>
						  <td>'.$datax['tahun'].'</td>
						  <td><a href="javascript:void(0);" data="'.$datax['idBuku'].'" class="update_bmn"><span class="icon icon-update"></span>UPDATE</a></td>
						</tr>';
					}
					$footer='</tbody></table>
					<script>	
					$(\'#tq2\').DataTable( {
						\'scrollX\': true,
						\'responsive\': true,
						\'paging\':   true,
						\'searching\': true, 
						\'info\': false,
						\'lengthChange\': false
					});
					</script>';
					$content=$header.$body.$footer;
				}else{
					$content='<div id="info_cari" class="alert alert-danger text-center " role="alert">Data tidak ditemukan!</div>';
				}
				echo $content;

			break;
		}
	}
}
?>