<?php
$seminggu = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
$hari = date("w");
$hari_ini = $seminggu[$hari];

$tgl_sekarang = date("Ymd");
$thn_sekarang = date("Y");
$jam_sekarang = date("H:i:s");

$nama_bln = array(1=>"Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

function tgl_indo($tgl){
	$tanggal = substr($tgl, 8, 2);
	$bulan	 = get_bulan(substr($tgl, 5, 2));	
	$tahun	 = substr($tgl, 0, 4);	
	return $tanggal.' '.$bulan.' '.$tahun;
}

function get_bulan($bln){
	switch($bln){
		case 1: return "Januari";
			break;
		case 2: return "Februari";
			break;
		case 3: return "Maret";
			break;
		case 4: return "April";
			break;
		case 5: return "Mei";
			break;
		case 6: return "Juni";
			break;
		case 7: return "Juli";
			break;
		case 8: return "Agustus";
			break;
		case 9: return "September";
			break;
		case 10: return "Oktober";
			break;
		case 11: return "November";
			break;
		case 12: return "Desember";
			break;
	}
}

/*** FUNGSI COMBO BOX ***/
function combotgl($awal, $akhir, $var, $terpilih){
  echo "<select name=$var>";
  for ($i=$awal; $i<=$akhir; $i++){
    if ($i==$terpilih)
      echo "<option value=$i selected>$i</option>";
    else
      echo "<option value=$i>$i</option>";
  }
  echo "</select> ";
}

function combothn($awal, $akhir, $var, $terpilih){
  echo "<select name=$var>";
  for ($i=$awal; $i<=$akhir; $i++){
    if ($i==$terpilih)
      echo "<option value=$i selected>$i</option>";
    else
      echo "<option value=$i>$i</option>";
  }
  echo "</select> ";
}

function combobln($awal, $akhir, $var, $terpilih){
	$nama_bln = array(1=>"Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	echo "<select name=$var >";
	for($bln=$awal; $bln<=akhir; $bln++){
		if($bln==$terpilih){
			echo "
			<option value=$bln selected=selected>$nama_bln[$bln]</option>";
		}else{
			echo "
			<option value=$bln>$nama_bln[$bln]</option>";
		}
	}
	echo "</select>";
}

function combonamabln($awal, $akhir, $var, $terpilih){
  $nama_bln=array(1=> "Januari", "Februari", "Maret", "April", "Mei", 
                      "Juni", "Juli", "Agustus", "September", 
                      "Oktober", "November", "Desember");
  echo "<select name=$var>";
  for ($bln=$awal; $bln<=$akhir; $bln++){
      if ($bln==$terpilih)
         echo "<option value=$bln selected>$nama_bln[$bln]</option>";
      else
        echo "<option value=$bln>$nama_bln[$bln]</option>";
  }
  echo "</select> ";
}

/** FUNGSI SEO **/
function seo_title($s) {
    $c = array (' ');
    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');

    $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
    
    $s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
    return $s;
}
?>