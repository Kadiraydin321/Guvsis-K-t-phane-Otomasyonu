<?php require_once("includes/config.php"); eser_baglan();?>
<?php require_once("includes/header.php");?>
<?php
$kitap_no=$_GET["kitap_no"];
$sorgu="Select * from kitap_bilgi where kitap_no='$kitap_no'";
$slct=mysql_query($sorgu);
$row=mysql_fetch_array($slct);
	$k_no		=	$_GET["kitap_no"];
	$k_adi		=	$row["kitap_adi"];
	$c_no		=	$row["cilt_no"];
	$y_evi		=	$row["yayin_evi"];
	$y_adi		=	$row["yazar"];
	$kat		=	$row["kategori"];
	$tr			=	$row["tur"];
	$dlp_adi	=	$row["dolap_adi"];
	$bas_tar	=	$row["basim_tarihi"];
	$bas_say	=	$row["baskisi"];
	$say_say	=	$row["sayfa_sayisi"];
	$dil		=	$row["kitap_dili"];
	if($row["kitap_foto_url"]==""){	$knm="images/resim.jpg";	} else{$knm=$row["kitap_foto_url"];}
	$ozet 		=	html_entity_decode($row["kitap_ozeti"], ENT_QUOTES,"UTF-8");
?>
<div class="container-fluid">
<br>
		<div class="row">
			<div class="col-4 align-middle">

						<p><h5 class="text-center">
				<?php
				$srg=mysql_query("Select * from kategori_tablosu where kategori_id=$kat");
				$rw=mysql_fetch_array($srg);
				echo "Kitap Kategorisi: ".$rw["kategori_adi"];
				?>
			</h5></p>

						<p><h5 class="text-center">
				<?php
				$srg=mysql_query("Select * from tur_tablosu where tur_id=$tr");
				$rw=mysql_fetch_array($srg);
				echo "Kitap Türü: ".$rw["tur_adi"];
				?>
			</h5></p>

						<p><h5 class="text-center">
				<?php
				$srg=mysql_query("Select * from dil_tablosu where dil_id=$dil");
				$rw=mysql_fetch_array($srg);
				echo "Kitap Dili: ".$rw["dil_adi"];
				?>
			</h5></p>

						<p><h5 class="text-center">
				<?php
				$srg=mysql_query("Select * from dolap_tablosu where dolap_id=$dlp_adi");
				$rw=mysql_fetch_array($srg);
				echo "Bulunduğu Dolap: ".$rw["dolap_adi"];
				?>
			</h5></p>

				</div>
			<div class="col-4">

				<img src="<?php echo $knm;?>" class="img-fluid" height="550" alt="resim" />

			</div>
			<div class="col-4 align-middle">
				<p><h5 class="text-center"><?php $tarih=substr("$bas_tar",0,4);	 echo "Basım Tarihi: ".$tarih; ?></h5></p>

		    <p><h5 class="text-center"><?php echo "Basım Sayısı: ".$bas_say; ?></h5></p>

		    <p><h5 class="text-center"><?php echo "Sayfa Sayısı: ".$say_say; ?></h5></p>

				<p><h5 class="text-center"><?php echo "Cilt Numarası: ".$c_no; ?></h5></p>
			</div>
		</div>
		<p> </p>

		<div class="col-12 text-center">
		<p><h5><?php echo "Kitap Yazarı: ".$y_adi; ?></h5></p>
		<p><h5><?php echo "Kitap Yayınevi: ".$y_evi; ?></h5></p>
		</div>

		<p> </p>

		<div class="col-12 text-center">
		<p><h1><font face="Times New Roman"><?php echo strtoupper("$k_adi"); ?></font></h1></p>
		</div>

		<p> </p>
		<div class="row">
			<div class="col"></div>
		 <div class="col-10 text-center">
     		<p><h5><font color="#666666" face="Times New Roman"><?php echo $ozet; ?></h5></font></p>
	 	 		</br>
     </div>
		 <div class="col"></div>
	 </div>
</div>
<?php require_once("includes/footer.php");?>
