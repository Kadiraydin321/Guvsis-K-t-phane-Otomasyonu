<?php require_once("includes/config.php"); eser_baglan();
  if(isset($_SESSION["uye"])){$ssn=$_SESSION["uye"];} elseif (isset($_SESSION["admin"])) {$ssn=$_SESSION["admin"];} else { header("Location: eserler.php");}?>
<?php include_once("includes/header.php");?>
<?php
  $srg=mysql_query("Select * from odunc_alinanlar_tablosu where uye_tc='$ssn' order by odunc_alinan_trh asc");

?>
<table class="table table-md table-striped table-hover">
  <thead class="thead-dark">
    <tr>
      <th>#</th>  <th>Kitap No</th> <th>Ödünç Alınan Tarih</th> <th>Geri Gelecek Tarih</th> <th>Getirildi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i=0;
    while ($row=mysql_fetch_array($srg)) {
      $i++;
    ?>
    <tr>
      <td><?php echo $i;?></td>
      <td><a href="eser_bilgi_goster.php?kitap_no=<?php echo $row["kitap_no"];?>"><?php echo $row["kitap_no"];?></a></td>
      <td><?php echo $row["odunc_alinan_trh"];?></td>
      <td><?php echo $row["geri_gelecek_trh"];?></td>
      <td><?php  if($row["getirildi"]==0){echo "Hayır";}else{echo "Evet";}?></td>
    </tr>

  <?php } ?>
  </tbody>
</table>

<?php include_once("includes/footer.php");?>
