<?php require_once("includes/config.php"); eser_baglan();?>
<?php if (isset($_SESSION["admin"])) {$ssn=$_SESSION["admin"];} else { header("Location: eserler.php");}?>
<?php
	if(isset($_GET["kayit"])==1)
	{
		$ctrl="Lütfen Seçiniz...";
		if(!isset($_POST["kitap_adi"])		||		empty($_POST["kitap_adi"]))	{$hata="Kitap Adı'nı doldurmanız gerekiyor.";}
		else if(!isset($_POST["yayin_evi"])	||		empty($_POST["yayin_evi"]))	{$hata="Yayın Evi'ni doldurmanız gerekiyor.";}
		else if(!isset($_POST["yazar"])		||		empty($_POST["yazar"]))		{$hata="Yazar Adı'nı doldurmanız gerekiyor.";}
		else if(!isset($_POST["kategori"])	||		$_POST["kategori"]==$ctrl)		{$hata="Kitap Kategorisi'ni seçmeniz gerekiyor.";}
		else if(!isset($_POST["tur"])			||		$_POST["tur"]==$ctrl)			{$hata="Kitap Türü'nü seçmeniz gerekiyor.";}
		else if(!isset($_POST["dolap_adi"])	||		$_POST["dolap_adi"]==$ctrl)	{$hata="Dolap Adı'nı seçmeniz gerekiyor.";}
		else if(!isset($_POST["kitap_dili"])	||		$_POST["kitap_dili"]==$ctrl)	{$hata="Kitap Dili'ni seçmeniz gerekiyor.";}
		else{$hata="Boş";}
		$ht="";
		if ($hata=="Boş"){

			if(isset($_FILES["dosya"]["tmp_name"])){
				$gidecegi_konum="images/eser_fotograflar/";
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
			$ozt=htmlentities($_POST["kitap_ozeti"], ENT_QUOTES, "UTF-8");
			$tablo_adi="kitap_bilgi";
				$sorgu="insert into $tablo_adi set
				kitap_adi='$_POST[kitap_adi]',
				cilt_no='$_POST[cilt_no]',
				yayin_evi='$_POST[yayin_evi]',
				yazar='$_POST[yazar]',
				dolap_adi='$_POST[dolap_adi]',
				kategori='$_POST[kategori]',
				tur='$_POST[tur]',
				basim_tarihi='$_POST[basim_tarihi]',
				baskisi='$_POST[baskisi]',
				sayfa_sayisi='$_POST[sayfa_sayisi]',
				stok_sayisi='$_POST[stok_sayisi]',
				kitap_dili='$_POST[kitap_dili]',
				kitap_foto_url='$knm',
				kitap_ozeti='$ozt'
				";
				mysql_query($sorgu);

		}

	}
?>
<?php require_once("includes/header.php");?>

            <div class="col">
               	<form action="eser_kayit_sayfasi.php?kayit=1" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="kayit"/>
                    <?php if(isset($hata) and $hata!="Boş"){echo "<p><h3>".$hata."</h3></p>";}?>
                    <?php if(isset($ht)){echo "<p>".$ht."</p>";}?>

             <div class="col-6">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Kitap Adı:</span>
                  </div>
                  <input type="text"   name="kitap_adi" class="form-control" id="formGroupExampleInput" >
                </div>
			</div>



              <div class="col-6">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Yayınevi:</span>
                  </div>
                  <input type="text"   name="yayin_evi" class="form-control" id="formGroupExampleInput" >
                </div>
                </div>
                <div class="col-6">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Yazar Adı:</span>
                  </div>
                  <input type="text"   name="yazar" class="form-control" id="formGroupExampleInput" >
                </div>
                </div>

              <div class="col-6">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect02">Kategorisi:</label>
                  </div>
                 <select class="form-control" id="exampleFormControlSelect1" name="kategori">	<option>Lütfen Seçiniz...</option>
                 <?php
                $sorgu=mysql_query("Select * from kategori_tablosu order by kategori_adi asc");
                while($row=mysql_fetch_array($sorgu))
                {
						$id=$row['kategori_id'];
                        echo "<option value=$id >".htmlspecialchars($row['kategori_adi'])."</option>";
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
					$id=$row['tur_id'];
                        echo "<option value=$id >".htmlspecialchars($row['tur_adi'])."</option>";
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
					$id=$row['dolap_id'];
                        echo "<option value=$id >".htmlspecialchars($row['dolap_adi'])."</option>";
                    }

                ?></select></div>
                </div>

            	<div class="col-6">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Cilt No:</span>
                  </div>
                  <input type="text"  name="cilt_no" class="form-control" id="formGroupExampleInput" >
                </div>
                </div>

                	<div class="col-6">
                    <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Basım Tarihi:</span>
                  </div>
                  <input type="text"  name="basim_tarihi" class="form-control" id="formGroupExampleInput" >
                </div>
                    </div>

                    <div class="col-6">
                    <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Baskı Sayısı:</span>
                  </div>
                  <input type="text"   name="baskisi" class="form-control" id="formGroupExampleInput" >
                </div>
                    </div>

                	<div class="col-6">
                    <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Sayfa Sayısı:</span>
                  </div>
                  <input type="text"   name="sayfa_sayisi" class="form-control" id="formGroupExampleInput" >
                </div>
                    </div>

                    <div class="col-6">
                    <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Stok Sayısı:</span>
                  </div>
                  <input type="text"   name="stok_sayisi" class="form-control" id="formGroupExampleInput" >
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
							$id=$row['dil_id'];
                        echo "<option value=$id >".htmlspecialchars($row['dil_adi'])."</option>";
                            }

                        ?></select> </div>	</div>
                        <div class="col-6">
                         <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Kitap Özeti: </label>
                              </div>
                              <textarea class="form-control" name="kitap_ozeti" id="exampleFormControlTextarea1" rows="3"></textarea>
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

                  <div class="col-6">
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Kaydet</button>
                  </div>
                 </form>
  			</div>

  <?php require_once("includes/footer.php");?>
