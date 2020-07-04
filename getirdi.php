<?php  require_once("includes/config.php"); eser_baglan();

  $sorgu="Update odunc_alinanlar_tablosu set
          getirildi='1'
          where uye_tc='$_GET[tc]' and kitap_no='$_GET[kno]'";
          mysql_query($sorgu);
          header("Location: alinan_eserler.php");
?>
