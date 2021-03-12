<?php
class appRevBukuAdmin  {
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
	
	public function ambil_setting($jenis){
		$qsetting='SELECT * FROM setting WHERE 1';
		$result = mysqli_query($this->dbc, $qsetting);
		$row=mysqli_fetch_assoc($result);
		
		switch ($jenis){
			case 'header':
				echo '
				<a href="../index.php" target="_blank"><img height="72" src="../img/'.$row['logo'].'"></a>
				<h1>'.$row['namaWeb'].'</h1>
				<h3>'.$row['slogan'].'</h3>
				';	
			break;
			
			case 'footer':
				echo '
				<div class="footer">
					<div class="right">
						<h3>'.$row['namaWeb'].'</h3>
						<span>'.$row['slogan'].'</span>
						<ul class="sosmed-footer">
							<li><a href="'.$row['facebook'].'" target="_blank">Facebook</a></li>
							<li><a href="'.$row['youtube'].'" target="_blank">Youtube</a></li>
							<li><a href="'.$row['instagram'].'" target="_blank">Instagram</a></li>					
						</ul>
					</div>	
					<div class="left"><p>Copyright '.$row['copyright'].'. All Rights Reserved</p></div>
				</div>
				';	
			break;
			
			case 'judul':
				echo $row['namaWeb'];
			break;
			
		}
	}

	public function buat_seleksi($nama_tabel, $nama_elemen, $terpilih){
		$qselect='SELECT * FROM '.$nama_tabel.' WHERE status=\'aktif\'';
		$resultselect = mysqli_query($this->dbc, $qselect);
		if($resultselect){
			echo '<select name="'.$nama_elemen.'">';
			while($dtselect=mysqli_fetch_array($resultselect)){
				echo str_replace('value="'.$terpilih.'"','value="'.$terpilih.'" selected',
					'<option value="'.$dtselect[0].'">'.$dtselect[1].'</option>
					');
			}
			echo '</select>';
		}
	}
	
	public function buat_halaman_login(){
		echo 
			'<div class="baris-field"><h2 class="judul-halaman" style="text-align:center;">Login Administrator</h2><div id="status-log" style="display:none; text-align: center;" class="alert" role="alert"></div></div>
				<div class="baris-field">
					<div class="judul-field">Username</div>
					<div class="form-field"><input id="username" type="text"></div>
				</div>
				<div class="baris-field">
					<div class="judul-field">Password</div>
					<div class="form-field"><input id="password" type="password"></div>
				</div>	
				<div class="baris-field">
					<div class="form-field"><input id="btn_login" type="button" value="LOGIN"></div>
				</div>
			<script>	
				$(\'#btn_login\').click(function(){
					$.post(\'proses.php\', {aksi: \'login\', username: $(\'#username\').val(), password: $(\'#password\').val()}, function(output) {
						if(output==\'sukses\'){					
							$(\'#status-log\').css(\'color\',\'green\');
							$(\'#status-log\').html(\'Login berhasil\').fadeIn(1000);
							$(\'#status-log\').delay(2000).fadeOut(500);
							//$(location).attr(\'href\', \'index.php\');
							var delay = 2000;
							setTimeout(function() {
							window.location.href = \'index.php\';
							}, delay);
						}else{
							//alert(\'Login Gagal!\');
							$(\'#status-log\').css(\'color\',\'red\');
							$(\'#status-log\').html(\'Login Gagal!\').fadeIn(1000);
							$(\'#status-log\').delay(2000).fadeOut(500);
						}
					})
				});
			</script>
			';

	}
		
	public function buat_halaman_admin($menu){
		switch($menu){
			//UPDATE SETTING APLIKASI
			case 'setting_app':				
				$qsetting='SELECT * FROM setting WHERE 1 LIMIT 0,1';
				$resultsetting = mysqli_query($this->dbc, $qsetting);
				$rowSet=mysqli_fetch_assoc($resultsetting);
				//echo $qupt;
				echo 
					'<form action="proses.php" method="post"  enctype="multipart/form-data">
					<div class="baris-field"><h2 class="judul-halaman">Setting Aplikasi</h2></div>
					<div class="baris-field">
						<div class="judul-field">Logo</div>
						<div class="form-field"><input name="logo" type="file"><br /><img width="120" src="../img/'.$rowSet['logo'].'" />
						<input type="hidden" name="file_lama" value="'.$rowSet['logo'].'">
						</div>
					</div>
					<div class="baris-field">
						<div class="form-field"><small>Jika ingin memasukkan karakter \' gunakan \\\'</small></div>

					</div>
					<div class="baris-field">
						<div class="judul-field">Nama Website</div>
						<div class="form-field"><input name="namaweb" type="text" value="'.str_replace('\'','\\\'',$rowSet['namaWeb']).'"></div>
					</div>
					<div class="baris-field">
						<div class="judul-field">Slogan</div>
						<div class="form-field"><input name="slogan" type="text"  value="'.str_replace('\'','\\\'',$rowSet['slogan']).'"></div>
					</div>	
					<div class="baris-field">
						<div class="judul-field">Alamat</div>
						<div class="form-field"><input name="alamat" type="text"  value="'.$rowSet['alamat'].'"></div>
					</div>				
					<div class="baris-field">
						<div class="judul-field">Copyright</div>
						<div class="form-field"><input name="copyright" type="text"  value="'.$rowSet['copyright'].'"></div>
					</div>	
					<div class="baris-field">
						<div class="judul-field">Facebook</div>
						<div class="form-field"><input name="facebook" type="text"  value="'.$rowSet['facebook'].'"></div>
					</div>	
					<div class="baris-field">
						<div class="judul-field">Youtube</div>
						<div class="form-field"><input name="youtube" type="text"  value="'.$rowSet['youtube'].'"></div>
					</div>	
					<div class="baris-field">
						<div class="judul-field">Instagram</div>
						<div class="form-field"><input name="instagram" type="text"  value="'.$rowSet['instagram'].'"></div>
					</div>	
					<div class="baris-field">
						<div class="judul-field">Email</div>
						<div class="form-field"><input name="email" type="text"  value="'.$rowSet['email'].'"></div>
					</div>						
					<div class="baris-field">
						<div class="judul-field">Whatsapp</div>
						<div class="form-field"><input name="whatsapp" type="text"  value="'.$rowSet['whatsapp'].'"></div>
					</div>						
					
					<div class="baris-field">
						<div class="judul-field">Telepon</div>
						<div class="form-field"><input name="telepon" type="text"  value="'.$rowSet['telepon'].'"></div>
					</div>						
					
					<div class="baris-field">
						<div class="judul-field">Tentang</div>
						<div class="form-field"><input name="tentang" type="text"  value="'.str_replace('\'','\\\'',$rowSet['tentang']).'"></div>
					</div>						
					
					<div class="baris-field">
						<div class="judul-field"><input type="hidden" name="aksi" value="update_setting"><input type="hidden" name="id" value="'.$rowSet['id'].'"></div>
						<div class="form-field"><input name="btn_update" type="submit" value="UPDATE"></div>
					</div>
					</form>
					';
				;
			break;
			
			//ADMINISTRASI BUKU
			case 'adm_buku':
				$q='SELECT * FROM buku 
				LEFT JOIN pengarang ON buku.idPengarang=pengarang.idPengarang 
				LEFT JOIN penerbit ON buku.idPenerbit=penerbit.idPenerbit 
				WHERE buku.status=\'aktif\'';

				$result = mysqli_query($this->dbc, $q);
				//$datax=mysqli_fetch_assoc($result);
				
				$rowcount=mysqli_num_rows($result);
				$content='';
				$body='';

				if ($result){
					$header= '
					<h2 class="judul-halaman">Administrasi Buku</h2>
					<table id="tq2" class="table display nowrap" style="width:100%">
					<thead><th scope="row">#ID</th><th scope="row">JUDUL BUKU</th><th scope="row">PENGARANG</th><th scope="row">PENERBIT</th><th scope="row">TAHUN TERBIT</th><th scope="row">AKSI</th></thead>
					<tbody>';
					while($datax=mysqli_fetch_assoc($result)){
						$body.='				
						<tr>
						  <td>'.$datax['idBuku'].'</td>
						  <td>'.$datax['judul'].'</td>
						  <td>'.$datax['namaPengarang'].'</td>
						  <td>'.$datax['namaPenerbit'].'</td>
						  <td>'.$datax['tahun'].'</td>
						  <td><a href="index.php?menu=update_buku&id='.$datax['idBuku'].'">UPDATE</a> | <a class="hapus-buku" href="#" idx="'.$datax['idBuku'].'" data="'.$datax['judul'].'">HAPUS</a></td>
						</tr>';
					}
					$footer='</tbody></table>
					<script>	
					$(\'.hapus-buku\').click(function(){
						if (confirm(\'Yakin menghapus buku: \' + $(this).attr(\'data\'))) {
							$.post(\'proses.php\', {aksi: \'hapus_buku\', id: $(this).attr(\'idx\')}, function(output) {
								if(output==\'sukses\'){
									alert(\'Buku berhasil dihapus\');
									location.href = \'index.php\';
								}else{
									alert(\'Gagal menghapus buku!\');
								}
							})
						}
						
					})
					
					$(\'#tq2\').DataTable( {
						\'dom\': \'Bfrtip\',
						\'buttons\': [
							{
								\'text\': \'TAMBAH\',
								\'action\': function ( e, dt, node, config ) {
									//alert( \'Button activated\' );
									location.href = \'index.php?menu=tambah_buku\';
								}
							}
						],
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
			
			case 'tambah_buku':
				echo 
					'<form action="proses.php" method="post" enctype="multipart/form-data">
					<div class="baris-field"><h2 class="judul-halaman">Tambah Buku</h2></div>
					<div class="baris-field">
						<div class="judul-field">Judul</div>
						<div class="form-field"><input name="judul" type="text"></div>
					</div>
					<div class="baris-field">
						<div class="judul-field">Tahun Terbit</div>
						<div class="form-field"><input name="tahun_terbit" type="text"></div>
					</div>	
					<div class="baris-field">
						<div class="judul-field">Jumlah Halaman</div>
						<div class="form-field"><input name="jumlah_halaman" type="text"></div>
					</div>						
					<div class="baris-field">
						<div class="judul-field">Gambar Cover</div>
						<div class="form-field"><input name="gambar" type="file"></div>
					</div>					
					<div class="baris-field">
						<div class="judul-field">Pengarang</div>
						<div class="form-field">';
						$this->buat_seleksi('pengarang','id_pengarang','');
					echo '</div>
					</div>	
					<div class="baris-field">
						<div class="judul-field">Penerbit</div>
						<div class="form-field">';
						$this->buat_seleksi('penerbit','id_penerbit','');
					echo '</div>
					</div>	
					<div class="baris-field">
						<div class="judul-field">Kategori</div>
						<div class="form-field">';
						$this->buat_seleksi('kategori','id_kategori','');
					echo '</div>
					</div>	
					<div class="baris-field">
						<div class="judul-field">Genre</div>
						<div class="form-field">';
						$this->buat_seleksi('genre','id_genre','');
					echo '</div>
					</div>	
					<div class="baris-field">
						<div class="judul-field">Bahasa</div>
						<div class="form-field">';
						$this->buat_seleksi('bahasa','id_bahasa','');
					echo '</div>
					</div>	
					
					<div class="baris-field">
						<div class="judul-field">Sinopsis</div>
						<div class="form-field"><textarea name="sinopsis" type="text" row="5"></textarea></div>
					</div>			
					<div class="baris-field">
						<div class="judul-field"><input type="hidden" name="aksi" value="simpan_buku"></div>
						<div class="form-field"><input name="btn_simpan" type="submit" value="SIMPAN"></div>
					</div>
					</form>
					';
				;
			break;
			
			case 'update_buku':
				$idx=isset($_GET['id'])?$_GET['id']:0;
				
				$qupt='SELECT * FROM buku WHERE idBuku='.$idx;
				$resultupt = mysqli_query($this->dbc, $qupt);
				$rowUpt=mysqli_fetch_assoc($resultupt);
				//echo $qupt;
				echo 
					'<form action="proses.php" method="post" enctype="multipart/form-data">
					<div class="baris-field"><h2 class="judul-halaman">Update Buku</h2></div>
					<div class="baris-field">
						<div class="judul-field">Judul</div>
						<div class="form-field"><input name="judul" type="text" value="'.$rowUpt['judul'].'"></div>
					</div>
					<div class="baris-field">
						<div class="judul-field">Tahun Terbit</div>
						<div class="form-field"><input name="tahun_terbit" type="text"  value="'.$rowUpt['tahun'].'"></div>
					</div>	
					<div class="baris-field">
						<div class="judul-field">Jumlah Halaman</div>
						<div class="form-field"><input name="jumlah_halaman" type="text"  value="'.$rowUpt['halaman'].'"></div>
					</div>						
					<div class="baris-field">
						<div class="judul-field">Gambar Cover</div>
						<div class="form-field"><input name="gambar" type="file"><br /><img width="160" src="../gambar/'.$rowUpt['gambar'].'" />
						<input type="hidden" name="file_lama" value="'.$rowUpt['gambar'].'">
						</div>
					</div>					
					<div class="baris-field">
						<div class="judul-field">Pengarang</div>
						<div class="form-field">';
						$this->buat_seleksi('pengarang','id_pengarang', $rowUpt['idPengarang']);
					echo '</div>
					</div>	
					<div class="baris-field">
						<div class="judul-field">Penerbit</div>
						<div class="form-field">';
						$this->buat_seleksi('penerbit','id_penerbit',$rowUpt['idPenerbit']);
					echo '</div>
					</div>	
					<div class="baris-field">
						<div class="judul-field">Kategori</div>
						<div class="form-field">';
						$this->buat_seleksi('kategori','id_kategori',$rowUpt['idKategori']);
					echo '</div>
					</div>	
					<div class="baris-field">
						<div class="judul-field">Genre</div>
						<div class="form-field">';
						$this->buat_seleksi('genre','id_genre',$rowUpt['idGenre']);
					echo '</div>
					</div>	
					<div class="baris-field">
						<div class="judul-field">Bahasa</div>
						<div class="form-field">';
						$this->buat_seleksi('bahasa','id_bahasa',$rowUpt['idBahasa']);
					echo '</div>
					</div>	
					
					<div class="baris-field">
						<div class="judul-field">Sinopsis</div>
						<div class="form-field"><textarea name="sinopsis" type="text" row="5">'.$rowUpt['sinopsis'].'</textarea></div>
					</div>			
					<div class="baris-field">
						<div class="judul-field"><input type="hidden" name="aksi" value="update_buku"><input type="hidden" name="id" value="'.$rowUpt['idBuku'].'"></div>
						<div class="form-field"><input name="btn_update" type="submit" value="UPDATE"></div>
					</div>
					</form>
					';
				;
			break;
			
			//ADMINISTRASI Kategori
			case 'adm_kategori':
				$q='SELECT * FROM kategori WHERE status=\'aktif\'';

				$result = mysqli_query($this->dbc, $q);
				//$datax=mysqli_fetch_assoc($result);
				
				$rowcount=mysqli_num_rows($result);
				$content='';
				$body='';

				if ($result){
					$header= '
					<h2 class="judul-halaman">Administrasi Kategori</h2>
					<table id="tkategori" class="table display nowrap" style="width:100%">
					<thead><th scope="row">#ID KATEGORI</th><th scope="row">NAMA KATEGORI</th><th scope="row">AKSI</th></thead>
					<tbody>';
					while($datax=mysqli_fetch_assoc($result)){
						$body.='				
						<tr>
						  <td>'.$datax['idKategori'].'</td>
						  <td>'.$datax['namaKategori'].'</td>
						  <td><a href="index.php?menu=update_kategori&id='.$datax['idKategori'].'">UPDATE</a> | <a class="hapus-kategori" href="#" idx="'.$datax['idKategori'].'" data="'.$datax['namaKategori'].'">HAPUS</a></td>
						</tr>';
					}
					$footer='</tbody></table>
					<script>	
					$(\'.hapus-kategori\').click(function(){
						if (confirm(\'Yakin menghapus kategori: \' + $(this).attr(\'data\'))) {
							$.post(\'proses.php\', {aksi: \'hapus_kategori\', id: $(this).attr(\'idx\')}, function(output) {
								if(output==\'sukses\'){
									alert(\'Kategori berhasil dihapus\');
									location.href = \'index.php?menu=adm_kategori\';
								}else{
									alert(\'Gagal menghapus kategori!\');
								}
							})
						}
						
					})
					
					$(\'#tkategori\').DataTable( {
						\'dom\': \'Bfrtip\',
						\'buttons\': [
							{
								\'text\': \'TAMBAH\',
								\'action\': function ( e, dt, node, config ) {
									//alert( \'Button activated\' );
									location.href = \'index.php?menu=tambah_kategori\';
								}
							}
						],
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
			
			case 'tambah_kategori':
				echo 
					'<form action="proses.php" method="post">
					<div class="baris-field"><h2 class="judul-halaman">Tambah Kategori</h2></div>
					<div class="baris-field">
						<div class="judul-field">Nama Kategori</div>
						<div class="form-field"><input name="nama_kategori" type="text"></div>
					</div>
					<div class="baris-field">
						<div class="judul-field"><input type="hidden" name="aksi" value="simpan_kategori"></div>
						<div class="form-field"><input name="btn_simpan" type="submit" value="SIMPAN"></div>
					</div>
					</form>
					';
				;
			break;

			case 'update_kategori':
				$idx=isset($_GET['id'])?$_GET['id']:0;
				
				$qkat='SELECT * FROM kategori WHERE idKategori='.$idx;
				$resultkat = mysqli_query($this->dbc, $qkat);
				$rowKat=mysqli_fetch_assoc($resultkat);
				//echo $qupt;
				echo 
					'<form action="proses.php" method="post">
					<div class="baris-field"><h2 class="judul-halaman">Update Kategori</h2></div>
					<div class="baris-field">
						<div class="judul-field">Nama Kategori</div>
						<div class="form-field"><input name="nama_kategori" type="text" value="'.$rowKat['namaKategori'].'"></div>
					</div>
					<div class="baris-field">
						<div class="judul-field"><input type="hidden" name="aksi" value="update_kategori"><input type="hidden" name="id" value="'.$rowKat['idKategori'].'"></div>
						<div class="form-field"><input name="btn_update" type="submit" value="UPDATE"></div>
					</div>
					</form>
					';
				;
			break;

			//ADMINISTRASI Penerbit
			case 'adm_penerbit':
				$q='SELECT * FROM penerbit WHERE status=\'aktif\'';

				$result = mysqli_query($this->dbc, $q);
				//$datax=mysqli_fetch_assoc($result);
				
				$rowcount=mysqli_num_rows($result);
				$content='';
				$body='';

				if ($result){
					$header= '
					<h2 class="judul-halaman">Administrasi Penerbit</h2>
					<table id="tpenerbit" class="table display nowrap" style="width:100%">
					<thead><th scope="row">#ID PENERBIT</th><th scope="row">NAMA PENERBIT</th><th scope="row">AKSI</th></thead>
					<tbody>';
					while($datax=mysqli_fetch_assoc($result)){
						$body.='				
						<tr>
						  <td>'.$datax['idPenerbit'].'</td>
						  <td>'.$datax['namaPenerbit'].'</td>
						  <td><a href="index.php?menu=update_penerbit&id='.$datax['idPenerbit'].'">UPDATE</a> | <a class="hapus-penerbit" href="#" idx="'.$datax['idPenerbit'].'" data="'.$datax['namaPenerbit'].'">HAPUS</a></td>
						</tr>';
					}
					$footer='</tbody></table>
					<script>	
					$(\'.hapus-penerbit\').click(function(){
						if (confirm(\'Yakin menghapus penerbit: \' + $(this).attr(\'data\'))) {
							$.post(\'proses.php\', {aksi: \'hapus_penerbit\', id: $(this).attr(\'idx\')}, function(output) {
								if(output==\'sukses\'){
									alert(\'Penerbit berhasil dihapus\');
									location.href = \'index.php?menu=adm_penerbit\';
								}else{
									alert(\'Gagal menghapus penerbit!\');
								}
							})
						}
						
					})
					
					$(\'#tpenerbit\').DataTable( {
						\'dom\': \'Bfrtip\',
						\'buttons\': [
							{
								\'text\': \'TAMBAH\',
								\'action\': function ( e, dt, node, config ) {
									//alert( \'Button activated\' );
									location.href = \'index.php?menu=tambah_penerbit\';
								}
							}
						],
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
			
			case 'tambah_penerbit':
				echo 
					'<form action="proses.php" method="post">
					<div class="baris-field"><h2 class="judul-halaman">Tambah Penerbit</h2></div>
					<div class="baris-field">
						<div class="judul-field">Nama Penerbit</div>
						<div class="form-field"><input name="nama_penerbit" type="text"></div>
					</div>
					<div class="baris-field">
						<div class="judul-field"><input type="hidden" name="aksi" value="simpan_penerbit"></div>
						<div class="form-field"><input name="btn_simpan" type="submit" value="SIMPAN"></div>
					</div>
					</form>
					';
				;
			break;

			case 'update_penerbit':
				$idx=isset($_GET['id'])?$_GET['id']:0;
				
				$qkat='SELECT * FROM penerbit WHERE idPenerbit='.$idx;
				$resultkat = mysqli_query($this->dbc, $qkat);
				$rowKat=mysqli_fetch_assoc($resultkat);
				//echo $qupt;
				echo 
					'<form action="proses.php" method="post">
					<div class="baris-field"><h2 class="judul-halaman">Update Penerbit</h2></div>
					<div class="baris-field">
						<div class="judul-field">Nama Penerbit</div>
						<div class="form-field"><input name="nama_penerbit" type="text" value="'.$rowKat['namaPenerbit'].'"></div>
					</div>
					<div class="baris-field">
						<div class="judul-field"><input type="hidden" name="aksi" value="update_penerbit"><input type="hidden" name="id" value="'.$rowKat['idPenerbit'].'"></div>
						<div class="form-field"><input name="btn_update" type="submit" value="UPDATE"></div>
					</div>
					</form>
					';
				;
			break;

			//ADMINISTRASI Genre
			case 'adm_genre':
				$q='SELECT * FROM genre WHERE status=\'aktif\'';

				$result = mysqli_query($this->dbc, $q);
				//$datax=mysqli_fetch_assoc($result);
				
				$rowcount=mysqli_num_rows($result);
				$content='';
				$body='';

				if ($result){
					$header= '
					<h2 class="judul-halaman">Administrasi Genre</h2>
					<table id="tgenre" class="table display nowrap" style="width:100%">
					<thead><th scope="row">#ID GENRE</th><th scope="row">NAMA GENRE</th><th scope="row">AKSI</th></thead>
					<tbody>';
					while($datax=mysqli_fetch_assoc($result)){
						$body.='				
						<tr>
						  <td>'.$datax['idGenre'].'</td>
						  <td>'.$datax['namaGenre'].'</td>
						  <td><a href="index.php?menu=update_genre&id='.$datax['idGenre'].'">UPDATE</a> | <a class="hapus-genre" href="#" idx="'.$datax['idGenre'].'" data="'.$datax['namaGenre'].'">HAPUS</a></td>
						</tr>';
					}
					$footer='</tbody></table>
					<script>	
					$(\'.hapus-genre\').click(function(){
						if (confirm(\'Yakin menghapus genre: \' + $(this).attr(\'data\'))) {
							$.post(\'proses.php\', {aksi: \'hapus_genre\', id: $(this).attr(\'idx\')}, function(output) {
								if(output==\'sukses\'){
									alert(\'Genre berhasil dihapus\');
									location.href = \'index.php?menu=adm_genre\';
								}else{
									alert(\'Gagal menghapus genre!\');
								}
							})
						}
						
					})
					
					$(\'#tgenre\').DataTable( {
						\'dom\': \'Bfrtip\',
						\'buttons\': [
							{
								\'text\': \'TAMBAH\',
								\'action\': function ( e, dt, node, config ) {
									//alert( \'Button activated\' );
									location.href = \'index.php?menu=tambah_genre\';
								}
							}
						],
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
			
			case 'tambah_genre':
				echo 
					'<form action="proses.php" method="post">
					<div class="baris-field"><h2 class="judul-halaman">Tambah Genre</h2></div>
					<div class="baris-field">
						<div class="judul-field">Nama Genre</div>
						<div class="form-field"><input name="nama_genre" type="text"></div>
					</div>
					<div class="baris-field">
						<div class="judul-field"><input type="hidden" name="aksi" value="simpan_genre"></div>
						<div class="form-field"><input name="btn_simpan" type="submit" value="SIMPAN"></div>
					</div>
					</form>
					';
				;
			break;

			case 'update_genre':
				$idx=isset($_GET['id'])?$_GET['id']:0;
				
				$qkat='SELECT * FROM genre WHERE idGenre='.$idx;
				$resultkat = mysqli_query($this->dbc, $qkat);
				$rowKat=mysqli_fetch_assoc($resultkat);
				//echo $qupt;
				echo 
					'<form action="proses.php" method="post">
					<div class="baris-field"><h2 class="judul-halaman">Update Genre</h2></div>
					<div class="baris-field">
						<div class="judul-field">Nama Genre</div>
						<div class="form-field"><input name="nama_genre" type="text" value="'.$rowKat['namaGenre'].'"></div>
					</div>
					<div class="baris-field">
						<div class="judul-field"><input type="hidden" name="aksi" value="update_genre"><input type="hidden" name="id" value="'.$rowKat['idGenre'].'"></div>
						<div class="form-field"><input name="btn_update" type="submit" value="UPDATE"></div>
					</div>
					</form>
					';
				;
			break;

			//ADMINISTRASI pengarang
			case 'adm_pengarang':
				$q='SELECT * FROM pengarang WHERE status=\'aktif\'';

				$result = mysqli_query($this->dbc, $q);
				//$datax=mysqli_fetch_assoc($result);
				
				$rowcount=mysqli_num_rows($result);
				$content='';
				$body='';

				if ($result){
					$header= '
					<h2 class="judul-halaman">Administrasi Pengarang</h2>
					<table id="tpengarang" class="table display nowrap" style="width:100%">
					<thead><th scope="row">#ID PENGARANG</th><th scope="row">NAMA PENGARANG</th><th scope="row">AKSI</th></thead>
					<tbody>';
					while($datax=mysqli_fetch_assoc($result)){
						$body.='				
						<tr>
						  <td>'.$datax['idPengarang'].'</td>
						  <td>'.$datax['namaPengarang'].'</td>
						  <td><a href="index.php?menu=update_pengarang&id='.$datax['idPengarang'].'">UPDATE</a> | <a class="hapus-pengarang" href="#" idx="'.$datax['idPengarang'].'" data="'.$datax['namaPengarang'].'">HAPUS</a></td>
						</tr>';
					}
					$footer='</tbody></table>
					<script>	
					$(\'.hapus-pengarang\').click(function(){
						if (confirm(\'Yakin menghapus pengarang: \' + $(this).attr(\'data\'))) {
							$.post(\'proses.php\', {aksi: \'hapus_pengarang\', id: $(this).attr(\'idx\')}, function(output) {
								if(output==\'sukses\'){
									alert(\'Pengarang berhasil dihapus\');
									location.href = \'index.php?menu=adm_pengarang\';
								}else{
									alert(\'Gagal menghapus pengarang!\');
								}
							})
						}
						
					})
					
					$(\'#tpengarang\').DataTable( {
						\'dom\': \'Bfrtip\',
						\'buttons\': [
							{
								\'text\': \'TAMBAH\',
								\'action\': function ( e, dt, node, config ) {
									//alert( \'Button activated\' );
									location.href = \'index.php?menu=tambah_pengarang\';
								}
							}
						],
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
			
			case 'tambah_pengarang':
				echo 
					'<form action="proses.php" method="post">
					<div class="baris-field"><h2 class="judul-halaman">Tambah Pengarang</h2></div>
					<div class="baris-field">
						<div class="judul-field">Nama Pengarang</div>
						<div class="form-field"><input name="nama_pengarang" type="text"></div>
					</div>
					<div class="baris-field">
						<div class="judul-field"><input type="hidden" name="aksi" value="simpan_pengarang"></div>
						<div class="form-field"><input name="btn_simpan" type="submit" value="SIMPAN"></div>
					</div>
					</form>
					';
				;
			break;

			case 'update_pengarang':
				$idx=isset($_GET['id'])?$_GET['id']:0;
				
				$qkat='SELECT * FROM pengarang WHERE idPengarang='.$idx;
				$resultkat = mysqli_query($this->dbc, $qkat);
				$rowKat=mysqli_fetch_assoc($resultkat);
				//echo $qupt;
				echo 
					'<form action="proses.php" method="post">
					<div class="baris-field"><h2 class="judul-halaman">Update Pengarang</h2></div>
					<div class="baris-field">
						<div class="judul-field">Nama Pengarang</div>
						<div class="form-field"><input name="nama_pengarang" type="text" value="'.$rowKat['namaPengarang'].'"></div>
					</div>
					<div class="baris-field">
						<div class="judul-field"><input type="hidden" name="aksi" value="update_pengarang"><input type="hidden" name="id" value="'.$rowKat['idPengarang'].'"></div>
						<div class="form-field"><input name="btn_update" type="submit" value="UPDATE"></div>
					</div>
					</form>
					';
				;
			break;

			//ADMINISTRASI admin
			case 'adm_admin':
				$q='SELECT * FROM admin WHERE status=\'aktif\'';

				$result = mysqli_query($this->dbc, $q);
				//$datax=mysqli_fetch_assoc($result);
				
				$rowcount=mysqli_num_rows($result);
				$content='';
				$body='';

				if ($result){
					$header= '
					<h2 class="judul-halaman">Administrasi User</h2>
					<table id="tadmin" class="table display nowrap" style="width:100%">
					<thead><th scope="row">#ID ADMIN</th><th scope="row">NAMA ADMIN</th><th scope="row">USER NAME</th><th scope="row">AKSI</th></thead>
					<tbody>';
					while($datax=mysqli_fetch_assoc($result)){
						$body.='				
						<tr>
						  <td>'.$datax['idAdmin'].'</td>
						  <td>'.$datax['namaAdmin'].'</td>
						  <td>'.$datax['username'].'</td>
						  <td><a href="index.php?menu=update_admin&id='.$datax['idAdmin'].'">UPDATE</a> | <a class="hapus-admin" href="#" idx="'.$datax['idAdmin'].'" data="'.$datax['namaAdmin'].'">HAPUS</a></td>
						</tr>';
					}
					$footer='</tbody></table>
					<script>	
					$(\'.hapus-admin\').click(function(){
						if (confirm(\'Yakin menghapus admin: \' + $(this).attr(\'data\'))) {
							$.post(\'proses.php\', {aksi: \'hapus_admin\', id: $(this).attr(\'idx\')}, function(output) {
								if(output==\'sukses\'){
									alert(\'admin berhasil dihapus\');
									location.href = \'index.php?menu=adm_admin\';
								}else{
									alert(\'Gagal menghapus admin!\');
								}
							})
						}
						
					})
					
					$(\'#tadmin\').DataTable( {
						\'dom\': \'Bfrtip\',
						\'buttons\': [
							{
								\'text\': \'TAMBAH\',
								\'action\': function ( e, dt, node, config ) {
									//alert( \'Button activated\' );
									location.href = \'index.php?menu=tambah_admin\';
								}
							}
						],
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
			
			case 'tambah_admin':
				echo 
					'<form action="proses.php" method="post">
					<div class="baris-field"><h2 class="judul-halaman">Tambah Admin</h2></div>
					<div class="baris-field">
						<div class="judul-field">Nama Admin</div>
						<div class="form-field"><input name="nama_admin" type="text"></div>
					</div>
					<div class="baris-field">
						<div class="judul-field">User Name</div>
						<div class="form-field"><input name="username" type="text"></div>
					</div>					
					<div class="baris-field">
						<div class="judul-field">Password</div>
						<div class="form-field"><input name="password" type="text"></div>
					</div>					
					<div class="baris-field">
						<div class="judul-field"><input type="hidden" name="aksi" value="simpan_admin"></div>
						<div class="form-field"><input name="btn_simpan" type="submit" value="SIMPAN"></div>
					</div>
					</form>
					';
				;
			break;

			case 'update_admin':
				$idx=isset($_GET['id'])?$_GET['id']:0;
				
				$qkat='SELECT * FROM admin WHERE idadmin='.$idx;
				$resultkat = mysqli_query($this->dbc, $qkat);
				$rowKat=mysqli_fetch_assoc($resultkat);
				//echo $qupt;
				echo 
					'<form action="proses.php" method="post">
					<div class="baris-field"><h2 class="judul-halaman">Update admin</h2></div>
					<div class="baris-field">
						<div class="judul-field">Nama Admin</div>
						<div class="form-field"><input name="nama_admin" type="text" value="'.$rowKat['namaAdmin'].'"></div>
					</div>
					<div class="baris-field">
						<div class="judul-field">User Name</div>
						<div class="form-field"><input name="username" type="text" value="'.$rowKat['username'].'"></div>
					</div>					
					<div class="baris-field">
						<div class="judul-field">Password</div>
						<div class="form-field"><input name="password" type="text" value="'.$rowKat['password'].'"></div>
					</div>					
					<div class="baris-field">
						<div class="judul-field"><input type="hidden" name="aksi" value="update_admin"><input type="hidden" name="id" value="'.$rowKat['idAdmin'].'"></div>
						<div class="form-field"><input name="btn_update" type="submit" value="UPDATE"></div>
					</div>
					</form>
					';
				;
			break;

			//menuISTRASI menu
			case 'adm_menu':
				$q='SELECT * FROM menu WHERE status=\'aktif\'';

				$result = mysqli_query($this->dbc, $q);
				//$datax=mysqli_fetch_assoc($result);
				
				$rowcount=mysqli_num_rows($result);
				$content='';
				$body='';

				if ($result){
					$header= '
					<h2 class="judul-halaman">Administrasi Menu</h2>
					<table id="tmenu" class="table display nowrap" style="width:100%">
					<thead><th scope="row">#ID MENU</th><th scope="row">NAMA MENU</th><th scope="row">URL</th><th scope="row">AKSI</th></thead>
					<tbody>';
					while($datax=mysqli_fetch_assoc($result)){
						$body.='				
						<tr>
						  <td>'.$datax['idMenu'].'</td>
						  <td>'.$datax['namaMenu'].'</td>
						  <td>'.$datax['url'].'</td>
						  <td><a href="index.php?menu=update_menu&id='.$datax['idMenu'].'">UPDATE</a> | <a class="hapus-menu" href="#" idx="'.$datax['idMenu'].'" data="'.$datax['namaMenu'].'">HAPUS</a></td>
						</tr>';
					}
					$footer='</tbody></table>
					<script>	
					$(\'.hapus-menu\').click(function(){
						if (confirm(\'Yakin menghapus menu: \' + $(this).attr(\'data\'))) {
							$.post(\'proses.php\', {aksi: \'hapus_menu\', id: $(this).attr(\'idx\')}, function(output) {
								if(output==\'sukses\'){
									alert(\'menu berhasil dihapus\');
									location.href = \'index.php?menu=adm_menu\';
								}else{
									alert(\'Gagal menghapus menu!\');
								}
							})
						}
						
					})
					
					$(\'#tmenu\').DataTable( {
						\'dom\': \'Bfrtip\',
						\'buttons\': [
							{
								\'text\': \'TAMBAH\',
								\'action\': function ( e, dt, node, config ) {
									//alert( \'Button activated\' );
									location.href = \'index.php?menu=tambah_menu\';
								}
							}
						],
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
			
			case 'tambah_menu':
				echo 
					'<form action="proses.php" method="post">
					<div class="baris-field"><h2 class="judul-halaman">Tambah Menu</h2></div>
					<div class="baris-field">
						<div class="judul-field">Nama Menu</div>
						<div class="form-field"><input name="nama_menu" type="text"></div>
					</div>
					<div class="baris-field">
						<div class="judul-field">URL</div>
						<div class="form-field"><input name="url" type="text"></div>
					</div>					
					<div class="baris-field">
						<div class="judul-field"><input type="hidden" name="aksi" value="simpan_menu"></div>
						<div class="form-field"><input name="btn_simpan" type="submit" value="SIMPAN"></div>
					</div>
					</form>
					';
				;
			break;

			case 'update_menu':
				$idx=isset($_GET['id'])?$_GET['id']:0;
				
				$qkat='SELECT * FROM menu WHERE idMenu='.$idx;
				$resultkat = mysqli_query($this->dbc, $qkat);
				$rowKat=mysqli_fetch_assoc($resultkat);
				//echo $qupt;
				echo 
					'<form action="proses.php" method="post">
					<div class="baris-field"><h2 class="judul-halaman">Update Menu</h2></div>
					<div class="baris-field">
						<div class="judul-field">Nama Menu</div>
						<div class="form-field"><input name="nama_menu" type="text" value="'.$rowKat['namaMenu'].'"></div>
					</div>
					<div class="baris-field">
						<div class="judul-field">URL</div>
						<div class="form-field"><input name="url" type="text" value="'.$rowKat['url'].'"></div>
					</div>					
					<div class="baris-field">
						<div class="judul-field"><input type="hidden" name="aksi" value="update_menu"><input type="hidden" name="id" value="'.$rowKat['idMenu'].'"></div>
						<div class="form-field"><input name="btn_update" type="submit" value="UPDATE"></div>
					</div>
					</form>
					';
				;
			break;

		}
	}
			
}
?>