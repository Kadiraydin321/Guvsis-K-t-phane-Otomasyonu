<?php require_once("includes/config.php"); uye_baglan();?>
<?php if(isset($_SESSION["uye"])){$ssn=$_SESSION["uye"];} elseif (isset($_SESSION["admin"])) {$ssn=$_SESSION["admin"];} else { header("Location: eserler.php");}?>
<?php require_once("includes/header.php");?>
<?php
	$sorgu="Select * from uye_bilgi where tc_no='$_GET[tc_no]'";
	$slct=mysql_query($sorgu);
	$row=mysql_fetch_array($slct);
	$tc_no=$_GET["tc_no"];
	$adi="value=\"".$row["adi"]."\" ";
	$soyadi="value=\"".$row["soyadi"]."\" ";
	$sinif=$row["sinif"];
	$tel_no="value=\"".$row["tel_no"]."\" ";
	$unvan=$row["unvan"];
	$e_mail="value=\"".$row["e_mail"]."\" ";
	$adresi=$row["adresi"];
?>


        <form action="uye_guncel.php?tc_no=<?php echo $tc_no;?>" enctype="multipart/form-data" method="post">

				    	<div class="col-6">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">TC Kimlik  No:</span>
                  </div>
                   <input type="text" maxlength="11" disabled="disabled" value="<?php echo $tc_no;?>" name="tc_no" class="form-control" id="formGroupExampleInput" >
                </div>
             </div>

						 <div class="col-6">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Üye Şifre:</span>
                  </div>
                  <input type="password" name="sifre" class="form-control" id="formGroupExampleInput" >
                </div>
							</div>

             <div class="col-6">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Üye Adı:</span>
                  </div>
                  <input type="text" <?php echo $adi;?>  name="adi" class="form-control" id="formGroupExampleInput" >
                </div>
							</div>

              <div class="col-6">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Üye Soyadı:</span>
                  </div>
                  <input type="text" <?php echo $soyadi;?>  name="soyadi" class="form-control" id="formGroupExampleInput" >
                </div>
                </div>


              <div class="col-6">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect02">Sınıfı:</label>
                  </div>
                 <select class="form-control " id="exampleFormControlSelect1" name="sinif">	<option>Lütfen Seçiniz...</option>
                 <?php
                $sorgu=mysql_query("Select * from sinif_tablosu order by sinif_adi asc");
                while($row=mysql_fetch_array($sorgu))
                {
						$selected="";
						$id=$row['sinif_id'];
						if($sinif==$row['sinif_id']){$selected="selected=\"selcted\"";}
                        echo "<option ".$selected." value=$id >".htmlspecialchars($row['sinif_adi'])."</option>";
                    }

                ?></select></div></div>

								<div class="col-6">
	                <div class="input-group mb-3">
	                  <div class="input-group-prepend">
	                    <label class="input-group-text" for="inputGroupSelect02">Yaş Aralığı:</label>
	                  </div>
	                 <select class="form-control " id="exampleFormControlSelect1" name="yas_aralik">	<option>Lütfen Seçiniz...</option>
	                 <?php
	                $sorgu=mysql_query("Select * from yas_aralik_tablosu order by yas_adi asc");
	                while($row=mysql_fetch_array($sorgu))
	                {
							$selected="";
							$id=$row['yas_id'];
							if($sinif==$row['yas_id']){$selected="selected=\"selcted\"";}
	                        echo "<option ".$selected." value=$id >".htmlspecialchars($row['yas_adi'])."</option>";
	                    }

	                ?></select></div></div>



            	<div class="col-6">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Telefon No:</span>
                  </div>
                  <input type="text" <?php echo $tel_no;?>  name="tel_no" class="form-control" id="formGroupExampleInput" >
                </div>
                </div>

               <div class="col-6">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Ünvanı:</label>
                  </div>
                <select class="form-control" id="exampleFormControlSelect1"  name="unvan">	<option>Lütfen Seçiniz...</option>
                <?php
                $sorgu=mysql_query("Select * from unvan_tablosu order by unvan_id asc");
                while($row=mysql_fetch_array($sorgu))
                {
						$selected="";
						$id=$row['unvan_id'];
						if($unvan==$row['unvan_id']){$selected="selected=\"selcted\"";}
                        echo "<option ".$selected." value=$id >".htmlspecialchars($row['unvan_adi'])."</option>";
                    }

                ?></select></div>
                </div>



                	<div class="col-6">
                    <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">E Posta:</span>
                  </div>
                  <input type="text" <?php echo $e_mail;?>  name="e_mail" class="form-control" id="formGroupExampleInput" >
                </div>
                    </div>

                <div class="col-6">
                 <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Adresi: </label>
                              </div>
                              <textarea class="form-control" name="adresi" id="exampleFormControlTextarea1" rows="3"><?php echo $adresi; ?></textarea>
                        </div></div>

										<div class="col-6">
											<div class="input-group mb-3">
													 <input type="file" name="dosya" class="custom-file-input" id="inputGroupFile04">
													 <label class="custom-file-label" for="inputGroupFile04">Dosya seçilmedi...</label>
											</div>
										</div>

								  <div class="col-6">
                  		<button class="btn btn-outline-success my-2 offset-md-0 my-sm-0" type="submit">Güncelle</button>
                  </div>

                  </form>

    <?php require_once("includes/footer.php");?>
