<?php require_once("includes/config.php"); uye_baglan();?>
<?php
	error_reporting(0);

	if($_GET["kayit"]==1)
	{

		$tablo_adi="uye_bilgi";

				$ctrl="Lütfen Seçiniz...";
				if(!isset($_POST["tc_no"])			||		empty($_POST["tc_no"]))			{$hata="TC Kimlik Numarası girilmek zorundadır.";}
				else if(!isset($_POST["sifre"])			||		empty($_POST["sifre"]))				{$hata="Üye Şifreyi doldurmanız gerekiyor.";}
				else if(!isset($_POST["adi"])			||		empty($_POST["adi"]))				{$hata="Üye Adını doldurmanız gerekiyor.";}
				else if(!isset($_POST["soyadi"])		||		empty($_POST["soyadi"]))			{$hata="Üye Soyadını doldurmanız gerekiyor.";}
				else if(!isset($_POST["sinif"])		||		$_POST["sinif"]==$ctrl)			{$hata="Üye Sınıfını seçmeniz gerekiyor.";}
				else if(!isset($_POST["yas_aralik"])		||		$_POST["yas_aralik"]==$ctrl)			{$hata="Üye Yaş Aralığını seçmeniz gerekiyor.";}
				else if(!isset($_POST["tel_no"])		||		empty($_POST["tel_no"]))			{$hata="Telefon Numarası girilmek gerekiyor.";}
				else if(!isset($_POST["unvan"])		||		$_POST["unvan"]==$ctrl)			{$hata="Üye Ünvanını seçmeniz gerekiyor.";}
				else{$hata="Boş";}
				$srg=mysql_query("Select * from $tablo_adi where tc_no='$_POST[tc_no]'");
				if(mysql_num_rows($srg) == 0 ){
					if ($hata=="Boş"){
							if(isset($_FILES["dosya"])){
								$gidecegi_konum="images/uye_fotograflar/";
								$dosya_adi=$_FILES["dosya"]["name"];
								$dosya_yol=$_FILES["dosya"]["tmp_name"];

								$buay= date("Y-m");
								if(!is_dir($gidecegi_konum.$buay)){
									mkdir($gidecegi_konum.$buay);
									chmod($gidecegi_konum.$buay,0777);
								}
								$uzanti=end(explode(".",$dosya_adi));
								$yeni= substr(md5(microtime()),0,16);
								$knm= $gidecegi_konum.$buay."/".$yeni.".".$uzanti;
								move_uploaded_file($dosya_yol, $knm);
							}
							if (substr($knm,-1)==".") {
								$knm="";
							}
							$sifre=md5($_POST["sifre"]);
							$sorgu="
							insert into $tablo_adi set
							tc_no='$_POST[tc_no]',
							sifre='$sifre',
							adi='$_POST[adi]',
							soyadi='$_POST[soyadi]',
							sinif='$_POST[sinif]',
							yas_aralik='$_POST[yas_aralik]',
							tel_no='$_POST[tel_no]',
							unvan='$_POST[unvan]',
							e_mail='$_POST[e_mail]',
							adresi='$_POST[adresi]',
							uye_foto_url='$knm' ";
							mysql_query($sorgu);
					}
				}
				else{$ht="TC Kimlik Numarası Kayıtlıdır.";}
	}
?>
<?php require_once("includes/header.php");?>


               	<form action="uye_kayit.php?kayit=1"  enctype="multipart/form-data" method="post">
                    <?php if(isset($hata) and $hata!="Boş"){echo "<p><h3>".$hata."</h3></p>";}?>
                    <?php if($ht){echo "<p><h3>".$ht."</h3></p>";}?>


             <div class="col-6">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">TC Kimlik No:</span>
                  </div>
                  <input type="text" maxlength="11"  name="tc_no" class="form-control" id="formGroupExampleInput" >
                </div>
						</div>

						<div class="col-6">
							 <div class="input-group mb-3">
								 <div class="input-group-prepend">
									 <span class="input-group-text" id="inputGroup-sizing-default">Üye Şifre:</span>
								 </div>
								 <input type="password"  name="sifre" class="form-control" id="formGroupExampleInput" >
							 </div>
						</div>
              <div class="col-6">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Üye Adı:</span>
                  </div>
                  <input type="text"   name="adi" class="form-control" id="formGroupExampleInput" >
                </div>
                </div>
                <div class="col-6">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Üye Soyadı:</span>
                  </div>
                  <input type="text"   name="soyadi" class="form-control" id="formGroupExampleInput" >
                </div>
                </div>

              <div class="col-6">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect02">Sınıfı:</label>
                  </div>
                 <select class="form-control" id="exampleFormControlSelect1" name="sinif">	<option>Lütfen Seçiniz...</option>
                 <?php
                $sorgu=mysql_query("Select * from sinif_tablosu order by sinif_adi asc");
                while($row=mysql_fetch_array($sorgu))
                {
						$id=$row['sinif_id'];
                        echo "<option value=$id >".htmlspecialchars($row['sinif_adi'])."</option>";
                    }

                ?></select></div></div>

								<div class="col-6">
	                <div class="input-group mb-3">
	                  <div class="input-group-prepend">
	                    <label class="input-group-text" for="inputGroupSelect02">Yaş Aralığı:</label>
	                  </div>
	                 <select class="form-control" id="exampleFormControlSelect1" name="yas_aralik">	<option>Lütfen Seçiniz...</option>
	                 <?php
	                $sorgu=mysql_query("Select * from yas_aralik_tablosu order by yas_adi asc");
	                while($row=mysql_fetch_array($sorgu))
	                {
							$id=$row['yas_id'];
	                        echo "<option value=$id >".htmlspecialchars($row['yas_adi'])."</option>";
	                    }

	                ?></select></div></div>

                <div class="col-6">
                    <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Telefon No:</span>
                  </div>
                  <input type="text" maxlength="15" name="tel_no" class="form-control" id="formGroupExampleInput" >
                </div>
                    </div>

                <div class="col-6">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect02">Ünvanı:</label>
                  </div>
                <select class="form-control" id="exampleFormControlSelect1"  name="unvan">	<option>Lütfen Seçiniz...</option>
                 <?php
					$sorgu=mysql_query("Select * from unvan_tablosu order by unvan_adi asc");
					while($row=mysql_fetch_array($sorgu))
					{
						$id=$row['unvan_id'];
							echo "<option value=$id >".htmlspecialchars($row['unvan_adi'])."</option>";
						}

                ?></select></div></div>

                 <div class="col-6">
                    <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">E-Posta:</span>
                  </div>
                  <input type="text"   name="e_mail" class="form-control" id="formGroupExampleInput" >
                </div>
                    </div>


           <div class="col-6">
                 <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Adresi: </label>
                      </div>
                      <textarea class="form-control" name="adresi" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
          </div>

					<div class="col-6">
							<div class="input-group mb-3">
									 <div class="input-group-prepend">
										 <label class="input-group-text" for="inputGroupSelect01">Kitap Resmi: </label>
									 </div>
									 <input type="file" name="dosya" class="custom-file-input" id="inputGroupFile04">
									 <label class="custom-file-label" for="inputGroupFile04">Dosya seçilmedi...</label>
						 </div>
					</div>


                  <div class="col-6">
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Kaydet</button>
                  </div>

                 </form>

  <?php require_once("includes/footer.php");?>
