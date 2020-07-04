<?php require_once("../includes/config.php");

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//       İnternet üzerinden url ile dosya indirmek için.

function dosya_indir($link, $konum){
					$buay= date("Y-m");

					if(!is_dir($konum."/".$buay)){
						mkdir($konum."/".$buay);
						chmod($konum."/".$buay,0777);
					}

					$name=substr(md5(microtime()),0,16);
					$link_info = pathinfo($link);  //Yol bilgilerini deðiþkene atýyoruz.
					$imagename=$link_info['basename'];
					$uzanti = strtolower($link_info['extension']); //Dosyanýn uzantýsýný deðiþkene atýyoruz.
					$file = ($name) ? $name.'.'.$uzanti : $link_info['basename'];
					$yol = $konum."/".$buay."/".$file; // Dosya/ buradan cektigimiz dosyanin kaydedilecegi yeri seciyoruz, sonunda / isareti olmak zorunda ve klasorun yazma izni (777) olmali.
					$curl = curl_init($link);
					$fopen = fopen($yol,'w');

					curl_setopt($curl, CURLOPT_HEADER,0);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
					curl_setopt($curl, CURLOPT_HTTP_VERSION,CURL_HTTP_VERSION_1_0);
					curl_setopt($curl, CURLOPT_URL, $link);
					curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
					curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,  2);
					curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
					curl_setopt($curl, CURLOPT_FILE, $fopen);


					curl_close($curl);
					fclose($fopen);

					//   eser Veritabanına aktarma
				  /*if (isset($kitap_id) and $kitap_id !=0) {
						eser_baglan();
						$sql="insert into fotograf_tablosu set fotograf_adi='$imagename',fotograf_url='$yol',kitap_id='$kitap_id' ";
						mysql_query($sql);
						mysql_query("Delete from fotograf_tablosu where fotograf_adi=''");
					}*/

					// uye Veritabanına aktarma
				/*	if (isset($uye_id) and $uye_id != 0) {
						uye_baglan();
					  $sql="insert into fotograf_tablosu set fotograf_adi='$imagename',fotograf_url='$yol',uye_id='$uye_id' ";
						mysql_query($sql);
						mysql_query("Delete from fotograf_tablosu where fotograf_adi=''");
					}*/

			}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//        Seçilen Dosyayı Upload Eder.


  //    ------------------------DÜZENLENECEK---------------------------



function dosya_upload($file_name, $file_tmp_name, $konum, $kitap_id, $uye_id){
			$buay= date("Y-m");
			if(!is_dir($konum.$buay)){
				mkdir($konum.$buay);
				chmod($konum.$buay,0777);
			}
			$uzanti=end(explode(".",$file_name));
			$yeni= substr(md5(microtime()),0,16);
			$knm= $konum.$buay."/".$yeni.".".$uzanti;
			move_uploaded_file($file_tmp_name, $knm);
			//   eser Veri tabanına aktarma
			if (isset($kitap_id) and $kitap_id !=0) {
				eser_baglan();
				$sql="insert into fotograf_tablosu set fotograf_adi='$file_name',fotograf_url='$knm',kitap_id='$kitap_id' ";
				mysql_query($sql);
			}
			//   uye Veri tabanına aktarma
			if (isset($uye_id) and $uye_id != 0) {
				uye_baglan();
				$sql="insert into fotograf_tablosu set fotograf_adi='$file_name',fotograf_url='$knm',uye_id='$uye_id' ";
				mysql_query($sql);
			}
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////







?>
