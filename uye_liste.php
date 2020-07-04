<?php require_once("includes/config.php"); uye_baglan();?>
<?php if (isset($_SESSION["admin"])) {$ssn=$_SESSION["admin"];} else { header("Location: eserler.php");}?>
<?php include_once("includes/header.php"); ?>

<div class="container-fluid">
<form action="uye_liste.php" method="post">
<p>
<div class="input-group mb-3">
  <input name="arama" type="text" class="form-control" placeholder="Kelimeyi buraya giriniz..." aria-label="Kelimeyi buraya giriniz..." aria-describedby="button-addon2">
  <div class="input-group-append">
    <button class="btn btn-outline-success" type="submit" id="button-addon2">ARA</button>
  </div>
</div>
</p>
</form>

  <table class="table table-md table-striped table-hover">
<?php
			error_reporting(0);
			$deger=$_POST["arama"];
				$sorgu="Select * from uye_bilgi where tc_no like '$deger%' or adi COLLATE UTF8_GENERAL_CI like '$deger%' or soyadi
				COLLATE UTF8_GENERAL_CI like '$deger%' or tel_no COLLATE UTF8_GENERAL_CI like '$deger%'
				or e_mail COLLATE UTF8_GENERAL_CI like '$deger%' order by adi asc";
				$slct=mysql_query($sorgu);
				if(mysql_num_rows($slct)==0)
				{
					echo "<h2>Aranan Bulunamadı...</h2>";
				}
				else
				{
					echo "<thead class=\"thead-dark\">";
					echo "<tr>";
					echo "<th scope=\"col\">#</th><th scope=\"col\">ÜYE TC</th> <th scope=\"col\">ÜYE ADI</th> <th scope=\"col\">ÜYE  SOYADI</th>  <th scope=\"col\">TELEFON NUMARASI</th>
					<th scope=\"col\">E POSTA</th> <th scope=\"col\">ÜYE ADRESİ</th> <th scope=\"col\"> </th>";
					echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					$i=0;
					while($row=mysql_fetch_array($slct))
					{
						$i++;
						echo "<tr>";
						echo "<td scope=\"row\">$i</td>";
            echo "<td><a href=\"uye_bilgi.php?tc=$row[tc_no]\">$row[tc_no]</a></td>";
						echo "<td>".$row["adi"]."</td>";
						echo "<td>".$row["soyadi"]."</td>";
						echo "<td>".$row["tel_no"]."</td>";
						echo "<td>".$row["e_mail"]."</td>";
						if(strlen($row["adresi"])>30){
						$adres=substr($row["adresi"],0,30)."...";
						}
						else{$adres=$row["adresi"];}
						echo "<td>".$adres."</td>";
						echo "<td> <a class=\"text-success\" href=uye_guncelleme.php?tc_no=$row[tc_no]>[GÜNCELLE]</a></td>";
						echo "</tr>";
					}
					echo "</tbody>";
				}
			?>
</table>
</div>
<?php include_once("includes/footer.php"); ?>
