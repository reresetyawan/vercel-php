<?php
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
	echo '<ul class="menu-logout">
    	    <li><a href="../index.php"><span>Kembali ke Website</span></a></li>
			<li class="current"></li>';
}else{ ?>
    	<ul class="menu">
        	<li><a class="home" href="module.php?module=home"></a></li>
	        <li class="current"><a href="#"><span>Setting</span></a>
	            <div><ul>
                	<li><a href="module.php?module=identitas"><span>Profil Website</span></a></li>
                	<li><a href="module.php?module=menuutama"><span>Manajemen Menu</span></a></li>
                	<li><a href="module.php?module=users"><span>Manajemen User</span></a></li>
				</ul></div>
			</li>
	        <li><a href="#"><span>Content</span></a>
	            <div><ul>
                	<li><a href="module.php?module=agenda"><span>Agenda</span></a></li>
                	<li><a href="module.php?module=berita"><span>Artikel / Berita</span></a></li>
                	<li><a href="module.php?module=kategori"><span>Kategori</span></a></li>
                	<li><a href="module.php?module=tag"><span>Tag / label</span></a></li>
				</ul></div>
        	</li>
	        <li><a href="#"><span>Media</span></a>
	            <div><ul>
                	<li><a href="module.php?module=homebanner"><span>Banner Berenda</span></a></li>
                	<li><a href="module.php?module=banner"><span>Banner</span></a></li>
                	<li><a href="module.php?module=download"><span>Download</span></a></li>
                	<li><a href="module.php?module=album"><span>Album Foto</span></a></li>
                	<li><a href="module.php?module=galerifoto"><span>Foto</span></a></li>
				</ul></div>
			</li>
	        <li><a href="module.php?module=hubungi"><span>Hubingi Kami</span></a></li>
	    </ul>
        <ul class="menu-logout">
    	    <li><a href="../index.php" target="_blank"><span>Lihat Website</span></a></li>
        	<li class="last"><a href="logout.php"><span>Keluar &raquo;</span></a></li>
<?php } ?>
		</ul>

