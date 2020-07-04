<?php require_once("includes/config.php"); uye_baglan();?>
<?php include("includes/header.php");?>
<?php if(isset($_SESSION["uye"])){$ssn=$_SESSION["uye"];} elseif (isset($_SESSION["admin"])) {$ssn=$_SESSION["admin"];} else { header("Location: eserler.php");}
  if(isset($_SESSION["admin"]) and isset($_GET["tc"])){$tc=$_GET["tc"];$sorgu="Select * from uye_bilgi where tc_no='$tc'";}
  else{$tc=$ssn;$sorgu="Select * from uye_bilgi where tc_no='$tc'";}
  $srg=mysql_query($sorgu);
  $row=mysql_fetch_array($srg);
  $ad=$row["adi"];
  $soyad=$row["soyadi"];
  $tel_no=$row["tel_no"];
  $email=$row["e_mail"];
  $adres=$row["adresi"];
  $sinif=$row["sinif"];
  $unvan=$row["unvan"];
  $foto=$row["uye_foto_url"];
  if($foto==""){$foto="images/resim.jpg";}
  ?>
  <div class="container-fluid">
    <div class="col-12 row">
      <div class="col-3">
        <img src="<?php echo $foto; ?>" width="200" class="img-fluid" alt="1"/>
      </div>
      <div class="col-4">
        <p>Merhaba <?php echo $ad;?></p>
        <p><?php echo $tc;?></p>
        <p><?php echo $soyad;?></p>
        <p><?php
        $sin_sor=mysql_query("Select * from sinif_tablosu where sinif_id='$sinif'");
        $rw1=mysql_fetch_array($sin_sor);
        echo $rw1['sinif_adi'];
        ?></p>
        <p><?php
        $un_sor=mysql_query("Select * from unvan_tablosu where unvan_id='$unvan'");
        $rw2=mysql_fetch_array($un_sor);
        echo $rw2['unvan_adi'];
        ?></p>
        <p><?php echo $tel_no;?></p>
        <p><?php echo $email;?></p>
        <p><?php echo $adres;?></p>
        <p><a href="uye_guncelleme.php?tc_no=<?php echo $tc; ?>" class="btn btn-outline-success">Güncelle</a></p>
      </div>
    </div>
  </div>


<?php include("includes/footer.php");?>
