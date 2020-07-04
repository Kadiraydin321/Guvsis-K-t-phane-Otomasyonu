<?php require_once("includes/config.php"); eser_baglan();
  if(isset($_SESSION["uye"])){$ssn=$_SESSION["uye"];} elseif (isset($_SESSION["admin"])) {$ssn=$_SESSION["admin"];} else { header("Location: eserler.php");}?>
<?php include_once("includes/header.php");?>
<div class="container-fluid">
<form action="alinan_eserler.php" method="post">
<p>
<div class="input-group mb-3">
  <input name="arama" type="text" class="form-control" placeholder="Kelimeyi buraya giriniz..." aria-label="Kelimeyi buraya giriniz..." aria-describedby="button-addon2">
  <div class="input-group-append">
    <button class="btn btn-outline-success" type="submit" id="button-addon2">ARA</button>
  </div>
</div>
</p>
</form>
</div>
<?php
error_reporting(0);
$deger=htmlspecialchars($_POST["arama"]);
  $sorgu="Select * from odunc_alinanlar_tablosu where uye_tc like '$deger%' or kitap_no like '$deger%' or odunc_alinan_trh
  like '$deger%' or geri_gelecek_trh like '$deger%' order by odunc_alinan_trh asc";
  $srg=mysql_query($sorgu);

?>
<table class="table table-md table-striped table-hover">
  <thead class="thead-dark">
    <tr>
      <th>#</th> <th>Alan Üyenin TC Kimlik No</th> <th>Alınan Kitap No</th> <th>Ödünç Alınma Tarihi</th> <th>Geri Gelecek Tarih</th> <th>Geri Getirildi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i=0;
    while ($row=mysql_fetch_array($srg) or die(mysql_error())) {
      $i++;
    ?>
    <tr>
      <td><?php echo $i;?></td>
      <td><a href="uye_bilgi.php?tc=<?php echo $row["uye_tc"];?>"><?php echo $row["uye_tc"];?></a></td>
      <td><a href="eser_bilgi_goster.php?kitap_no=<?php echo $row["kitap_no"];?>"><?php echo $row["kitap_no"];?></a></td>
      <td><?php echo $row["odunc_alinan_trh"];?></td>
      <td><?php echo $row["geri_gelecek_trh"];?></td>
      <td><?php  if($row["getirildi"]==0){echo "Hayır - "."<a href=\"getirdi.php?kno=$row[kitap_no]&tc=$row[uye_tc]\">[Getirdi]</a>";}else{echo "Evet";}?></td>
    </tr>

  <?php } ?>
  </tbody>
</table>

<?php include_once("includes/footer.php");?>
