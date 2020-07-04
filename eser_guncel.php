<?php require_once("includes/config.php"); eser_baglan();?>
<?php if (isset($_SESSION["admin"])) {$ssn=$_SESSION["admin"];} else { header("Location: eserler.php");}?>
<?php
$ozt=htmlentities($_POST["kitap_ozeti"], ENT_QUOTES, "UTF-8");
if(isset($_FILES["dosya"]["tmp_name"]) and $_FILES["dosya"]["tmp_name"] != ""){
	$gidecegi_konum="images/eser_fotograflar/";
	$dosya_adi=$_FILES["dosya"]["name"];
	$dosya_yol=$_FILES["dosya"]["tmp_name"];

	$buay= date("Y-m");
	if(!is_dir($gidecegi_konum.$buay)){
		mkdir($gidecegi_konum.$buay);
		chmod($gidecegi_konum.$buay,0777);
	}
	$uzanti=end(explode(".",$dosya_adi));
	$yeni= substr(md5(microtime()),0,16);
	$knm= $gidecegi_konum.$buay."/".$yeni.".".$uzanti;
	move_uploaded_file($dosya_yol, $knm);

	$sorgu="Update kitap_bilgi set
					kitap_adi='$_POST[kitap_adi]',
					cilt_no='$_POST[cilt_no]',
					yayin_evi='$_POST[yayin_evi]',
					yazar='$_POST[yazar]',
					dolap_adi='$_POST[dolap_adi]',
					kategori='$_POST[kategori]',
					tur='$_POST[tur]',
					basim_tarihi='$_POST[basim_tarihi]',
					baskisi='$_POST[baskisi]',
					sayfa_sayisi='$_POST[sayfa_sayisi]',
					stok_sayisi='$_POST[stok_sayisi]',
					kitap_dili='$_POST[kitap_dili]',
					kitap_foto_url='$knm',
					kitap_ozeti='$ozt'
					where kitap_no='$_GET[kitap_no]' ";

}
else{$sorgu="Update kitap_bilgi set
				kitap_adi='$_POST[kitap_adi]',
				cilt_no='$_POST[cilt_no]',
				yayin_evi='$_POST[yayin_evi]',
				yazar='$_POST[yazar]',
				dolap_adi='$_POST[dolap_adi]',
				kategori='$_POST[kategori]',
				tur='$_POST[tur]',
				basim_tarihi='$_POST[basim_tarihi]',
				baskisi='$_POST[baskisi]',
				sayfa_sayisi='$_POST[sayfa_sayisi]',
				stok_sayisi='$_POST[stok_sayisi]',
				kitap_dili='$_POST[kitap_dili]',
				kitap_ozeti='$ozt'
				where kitap_no='$_GET[kitap_no]' ";}
mysql_query($sorgu) or die(mysql_error());
?>
<?php header("Location: eser_guncelleme.php?kitap_no=$_GET[kitap_no]"); ?>
