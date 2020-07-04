<?php require_once("includes/config.php"); eser_baglan();?>
<?php if (isset($_SESSION["admin"])) {$ssn=$_SESSION["admin"];} else { header("Location: eserler.php");}?>
<?php require_once("includes/header.php");?>
<?php
	$sorgu="Select * from kitap_bilgi where kitap_no='$_GET[kitap_no]'";
	$slct=mysql_query($sorgu);
	$row=mysql_fetch_array($slct);
	$k_no=$_GET["kitap_no"];
	$k_adi="value=\"".$row["kitap_adi"]."\" ";
	$c_no="value=\"".$row["cilt_no"]."\" ";
	$y_evi="value=\"".$row["yayin_evi"]."\" ";
	$y_adi="value=\"".$row["yazar"]."\" ";
	$kat=$row["kategori"];
	$tr=$row["tur"];
	$dlp_adi=$row["dolap_adi"];
	$bas_tar="value=\"".$row["basim_tarihi"]."\" ";
	$bas_say="value=\"".$row["baskisi"]."\" ";
	$say_say="value=\"".$row["sayfa_sayisi"]."\" ";
	$sto_say="value=\"".$row["stok_sayisi"]."\" ";
	$dil=$row["kitap_dili"];
	$knm=$row["kitap_foto_url"];
	$ozet=$row["kitap_ozeti"];
?>

            <form action="eser_guncel.php?kitap_no=<?php echo $k_no;?>"  enctype="multipart/form-data" method="post">

							<input type="hidden" value="<?php echo $knm;?>" name="konum">
        	<div class="col-6">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Kitap No:</span>
                  </div>
                   <input type="text" disabled="disabled" value="<?php echo $k_no;?>" name="kitap_no" class="form-control" id="formGroupExampleInput" >
                </div>
             </div>
             <div class="col-6">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Kitap Adı:</span>
                  </div>
                  <input type="text" <?php echo $k_adi;?>  name="kitap_adi" class="form-control" id="formGroupExampleInput" >
                </div>
			</div>



              <div class="col-6">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Yayınevi:</span>
                  </div>
                  <input type="text" <?php echo $y_evi;?>  name="yayin_evi" class="form-control" id="formGroupExampleInput" >
                </div>
                </div>
                <div class="col-6">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Yazar Adı:</span>
                  </div>
                  <input type="text" <?php echo $y_adi;?>  name="yazar" class="form-control" id="formGroupExampleInput" >
                </div>
                </div>




              <div class="col-6">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect02">Kategorisi:</label>
                  </div>
                 <select class="form-control " id="exampleFormControlSelect1" name="kategori">	<option>Lütfen Seçiniz...</option>
                 <?php
                $sorgu=mysql_query("Select * from kategori_tablosu order by kategori_adi asc");
                while($row=mysql_fetch_array($sorgu))
                {
						$selected="";
						$id=$row['kategori_id'];
						if($kat==$row['kategori_id']){$selected="selected=\"selcted\"";}
                        echo "<option ".$selected." value=$id >".htmlspecialchars($row['kategori_adi'])."</option>";
                    }

                ?></select></div></div>

                <div class="col-6">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect02">Türü:</label>
                  </div>
                <select class="form-control" id="exampleFormControlSelect1"  name="tur">	<option>Lütfen Seçiniz...</option>
                 <?php
                $sorgu=mysql_query("Select * from tur_tablosu order by tur_adi asc");
                while($row=mysql_fetch_array($sorgu))
                {
						$selected="";
						$id=$row['tur_id'];
						if($tr==$row['tur_id']){$selected="selected=\"selcted\"";}
                        echo "<option ".$selected." value=$id >".htmlspecialchars($row['tur_adi'])."</option>";
                    }

                ?></select></div></div>



               <div class="col-6">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Dolap Adı:</label>
                  </div>
                <select class="form-control" id="exampleFormControlSelect1"  name="dolap_adi">	<option>Lütfen Seçiniz...</option>
                <?php
                $sorgu=mysql_query("Select * from dolap_tablosu order by dolap_id asc");
                while($row=mysql_fetch_array($sorgu))
                {
						$selected="";
						$id=$row['dolap_id'];
						if($dlp_adi==$row['dolap_id']){$selected="selected=\"selcted\"";}
                        echo "<option ".$selected." value=$id >".htmlspecialchars($row['dolap_adi'])."</option>";
                    }

                ?></select></div>
                </div>

            	<div class="col-6">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Cilt No:</span>
                  </div>
                  <input type="text" <?php echo $c_no;?>  name="cilt_no" class="form-control" id="formGroupExampleInput" >
                </div>
                </div>




                	<div class="col-6">
                    <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Basım Tarihi:</span>
                  </div>
                  <input type="text" <?php echo $bas_tar;?>  name="basim_tarihi" class="form-control" id="formGroupExampleInput" >
                </div>
                    </div>

                    <div class="col-6">
                    <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Baskı Sayısı:</span>
                  </div>
                  <input type="text" <?php echo $bas_say;?>  name="baskisi" class="form-control" id="formGroupExampleInput" >
                </div>
                    </div>





                	<div class="col-6">
                    <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Sayfa Sayısı:</span>
                  </div>
                  <input type="text" <?php echo $say_say;?>  name="sayfa_sayisi" class="form-control" id="formGroupExampleInput" >
                </div>
                    </div>

                    <div class="col-6">
                    <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Stok Sayısı:</span>
                  </div>
                  <input type="text" <?php echo $sto_say;?>  name="stok_sayisi" class="form-control" id="formGroupExampleInput" >
                </div>
                    </div>


                <div class="col-6">
				<div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Kitap Dili: </label>
                  </div>
                 <select class="form-control" id="exampleFormControlSelect1"  name="kitap_dili">	<option>Lütfen Seçiniz...</option>
                <?php
                $sorgu=mysql_query("Select * from dil_tablosu order by dil_adi asc");
                while($row=mysql_fetch_array($sorgu))
                {
						$selected="";
						$id=$row['dil_id'];
						if($dil==$row['dil_id']){$selected="selected=\"selcted\"";}
                        echo "<option ".$selected." value=$id >".htmlspecialchars($row['dil_adi'])."</option>";
                    }

                ?></select> </div></div>

                <div class="col-6">
                 <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Kitap Özeti: </label>
                              </div>
                              <textarea class="form-control" name="kitap_ozeti" id="exampleFormControlTextarea1" rows="3"><?php echo $ozet; ?></textarea>
                        </div></div>

												<div class="col-6">
												 <div class="input-group mb-3">
															<div class="input-group-prepend">
																<label class="input-group-text" for="inputGroupSelect01">Kitap Resmi: </label>
															</div>
															<input type="file" name="dosya" class="custom-file-input" id="inputGroupFile04">
															<label class="custom-file-label" for="inputGroupFile04">Dosya seçilmedi...</label>
												</div>
                  <div class="col-6">
                  <button class="btn btn-outline-success my-2 offset-md-0 my-sm-0" type="submit">Güncelle</button>
                  </div>
                  </form>

    <?php require_once("includes/footer.php");?>
