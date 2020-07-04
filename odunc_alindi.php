<?php require_once("includes/config.php"); eser_baglan();
  if(isset($_SESSION["uye"])){$ssn=$_SESSION["uye"];} elseif (isset($_SESSION["admin"])) {$ssn=$_SESSION["admin"];} else { header("Location: eserler.php");}
  $tarih = date("d.m.Y");
  $gelecek= date("d.m.Y",strtotime('+15 days'));
  mysql_query("insert into odunc_alinanlar_tablosu set
          uye_tc='$ssn',
          kitap_no='$_GET[kitap_no]',
          odunc_alinan_trh='$tarih',
          geri_gelecek_trh='$gelecek'");
  header("Location: javascript:history.back()");
?>
