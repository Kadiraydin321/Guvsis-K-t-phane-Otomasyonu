<?php include_once("includes/config.php");  uye_baglan();

  $tc=$_POST["tc"];
  $sifre=md5($_POST["sifre"]);

  $srg=mysql_query("Select * from uye_bilgi where tc_no='$tc' and sifre='$sifre'");

  if(mysql_num_rows($srg)!=0)
  {
    $rw=mysql_fetch_array($srg);
    if($rw["tc_no"]==50575289102){
    $_SESSION["admin"]=$tc;}
    $_SESSION["uye"]=$tc;
    header("Location: eserler.php");
  }
  else{
    header("Location: eserler.php");
    }

?>
