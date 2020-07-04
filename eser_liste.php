<?php require_once("includes/config.php"); eser_baglan();?>
<?php include("includes/header.php"); ?>

<div class="container-fluid">

<form action="eser_liste.php" method="post">
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
				$sorgu="Select * from kitap_bilgi where kitap_no like '$deger%' or kitap_adi COLLATE UTF8_GENERAL_CI like '$deger%' or yazar
				COLLATE UTF8_GENERAL_CI like '$deger%' or yayin_evi COLLATE UTF8_GENERAL_CI like '$deger%' or kategori COLLATE UTF8_GENERAL_CI like '$deger%'
				or tur COLLATE UTF8_GENERAL_CI like '$deger%' order by kitap_adi asc";
				$slct=mysql_query($sorgu);
				if(mysql_num_rows($slct)==0)
				{
					echo "<h2>Aranan Bulunamadı...</h2>";
				}
				else
				{
					echo "<thead class=\"thead-dark\">";
					echo "<tr>";
					echo "<th scope=\"col\">#</th><th scope=\"col\">KİTAP ADI</th> <th scope=\"col\">YAZARI</th> <th scope=\"col\">YAYIN EVİ</th> <th scope=\"col\">KATEGORİ</th>
					<th scope=\"col\">TÜR</th> <th scope=\"col\"> </th>";
          if(isset($_SESSION["admin"]) or isset($_SESSION["uye"])){echo "<th scope=\"col\"> </th>";}
					echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					$i=0;
					while($row=mysql_fetch_array($slct))
					{
						$i++;
						echo "<tr>";
						echo "<th scope=\"row\">$i</th>";
						echo "<td><a class=\"text-success\" href=eser_bilgi_goster.php?kitap_no=$row[kitap_no]>".$row["kitap_adi"]."</td>";
						echo "<td>".$row["yazar"]."</td>";
						echo "<td>".$row["yayin_evi"]."</td>";
						$srg=mysql_query("Select * from kategori_tablosu where kategori_id=$row[kategori]");
						$rw=mysql_fetch_array($srg);
						echo "<td>".$rw["kategori_adi"]."</td>";
						$srg=mysql_query("Select * from tur_tablosu where tur_id=$row[tur]");
						$rw=mysql_fetch_array($srg);
						echo "<td>".$rw["tur_adi"]."</td>";
            echo "<td>";
						if(isset($_SESSION["admin"])){echo "<a class=\"text-success\" href=eser_guncelleme.php?kitap_no=$row[kitap_no]>[GÜNCELLE]</a> - ";}
            if(isset($_SESSION["admin"]) or isset($_SESSION["uye"])){echo "<a class=\"text-success\" href=\"odunc_alindi.php?kitap_no=$row[kitap_no]\" >[Al]</a>";}
            echo "</td>";
            echo "</tr>";
					}
					echo "</tbody>";
				}
			?>
</table>
</div>
<?php include("includes/footer.php"); ?>
