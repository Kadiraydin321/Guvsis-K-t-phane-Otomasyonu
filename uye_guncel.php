<?php require_once("includes/config.php"); uye_baglan();?>
<?php if(isset($_SESSION["uye"])){$ssn=$_SESSION["uye"];} elseif (isset($_SESSION["admin"])) {$ssn=$_SESSION["admin"];} else { header("Location: eserler.php");}?>
<?php

if(isset($_FILES["dosya"]) and $_FILES["dosya"]["tmp_name"] != ""){
	$gidecegi_konum="images/uye_fotograflar/";
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
	$sorgu="Update uye_bilgi set
					adi='htmlspecialchars($_POST[adi])',
					soyadi='htmlspecialchars($_POST[soyadi])',
					sinif='htmlspecialchars($_POST[sinif])',
					yas_aralik='htmlspecialchars($_POST[yas_aralik])',
					tel_no='htmlspecialchars($_POST[tel_no])',
					unvan='htmlspecialchars($_POST[unvan])',
					e_mail='htmlspecialchars($_POST[e_mail])',
					adresi='htmlspecialchars($_POST[adresi])',
					uye_foto_url='$knm'
					where tc_no='$_GET[tc_no]'";
}
else {		$sorgu="Update uye_bilgi set
						adi='htmlspecialchars($_POST[adi])',
						soyadi='htmlspecialchars($_POST[soyadi])',
						sinif='htmlspecialchars($_POST[sinif])',
						yas_aralik='htmlspecialchars($_POST[yas_aralik])',
						tel_no='htmlspecialchars($_POST[tel_no])',
						unvan='htmlspecialchars($_POST[unvan])',
						e_mail='htmlspecialchars($_POST[e_mail])',
						adresi='htmlspecialchars($_POST[adresi])'
						where tc_no='$_GET[tc_no]'";
			}
				mysql_query($sorgu);
				if(!empty(htmlspecialchars($_POST["sifre"])))
				{
					$sifre=md5(htmlspecialchars($_POST["sifre"]));
					mysql_query("Update uye_bilgi set sifre='$sifre' where tc_no='$_GET[tc_no]'");
				}
?>
<?php header("Location:uye_guncelleme.php?tc_no=$_GET[tc_no]"); ?>
