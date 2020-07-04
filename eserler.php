<?php require_once("includes/config.php"); eser_baglan();?>
<?php include_once("includes/header.php"); ?>
<div class="container-fluid">
<form action="eserler.php" method="post">
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
			$i=0;
			error_reporting(0);
			$deger=$_POST["arama"];
				$sorgu="Select * from kitap_bilgi where kitap_no like '$deger%' or kitap_adi COLLATE UTF8_GENERAL_CI like '$deger%' or yazar
				COLLATE UTF8_GENERAL_CI like '$deger%' or yayin_evi COLLATE UTF8_GENERAL_CI like '$deger%' or kategori COLLATE UTF8_GENERAL_CI like '$deger%'
				or tur COLLATE UTF8_GENERAL_CI like '$deger%' order by kitap_adi asc";
				$slct=mysql_query($sorgu);
				if(mysql_num_rows($slct)==0)
				{
					echo "<div class=\"container-fluid\"><h2>Aranan Bulunamadı...</h2></div>";
				}
				else
				{
					while($row=mysql_fetch_array($slct))
					{
						$i++;
						$ozet=substr(html_entity_decode($row["kitap_ozeti"], ENT_QUOTES,"UTF-8"), 0, 300)."<a href=eser_bilgi_goster.php?kitap_no=$row[kitap_no]><font class=\"text-success\">[...]</font></a>";
            echo "<div class=\"card col\" style=\"max-width: 610px;\">";
              echo "<div class=\"row no-gutters\">";
                  echo "<div class=\"col-4 text-middle\">";

                  if($row["kitap_foto_url"]=="")
                  {echo "<a href=\"eser_bilgi_goster.php?kitap_no=$row[kitap_no]\"><img src=\"images/resim.jpg\" class=\"card-img img-fluid\" alt=".$i."/></a>";}
                  else{ echo "<a href=\"eser_bilgi_goster.php?kitap_no=$row[kitap_no]\"><img src=".$row[kitap_foto_url]." class=\"card-img img-fluid\" alt=".$i."/></a>"; }
                   echo "</div>";
                echo "<div class=\"col-8\">";
                  echo "<div class=\"card-body\">";

        							echo "<h5 class=\"card-title text-success\">".$i.".<a class=\"text-success\" href=eser_bilgi_goster.php?kitap_no=$row[kitap_no]>$row[kitap_adi]</a></h5>";
        							echo "<h5 class=\"card-title\">$row[yazar]</h5>";
        							echo "<p class=\"card-text\">$ozet</p>";
        							if(isset($_SESSION["admin"])){echo "<a href=\"eser_guncelleme.php?kitap_no=$row[kitap_no]\" class=\"btn btn-outline-success\">Güncelle</a>  ";}
                      if(isset($_SESSION["admin"]) or isset($_SESSION["uye"])){echo "<a href=\"odunc_alindi.php?kitap_no=$row[kitap_no]\" class=\"btn btn-outline-success\">Al</a>";}
                echo "</div>";
                echo "</div>";
              echo "</div>";
            echo "</div>";
						echo "<br/>";
					}
				}
			?>



<?php include_once("includes/footer.php"); ?>
