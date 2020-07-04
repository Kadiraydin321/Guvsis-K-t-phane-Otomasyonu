<?php require_once("../includes/functions.php");

 //    Eser fotoğraf kayıt........

		if (isset($_POST["kitap_id"])) {

				$kitap_id= $_POST["kitap_id"];

				if(isset($_FILES["dosya"])){
					$gidecegi_konum="images/eser_fotograflar/";
					$dosya_adi=$_FILES["dosya"]["name"];
					$dosya_yol=$_FILES["dosya"]["tmp_name"];
					dosya_upload($dosya_adi,$dosya_yol,$gidecegi_konum,$kitap_id,0);
				}


				header("Location: ../eser_foto_kayit.php");
		}


		//  Üye fotoğraf kayıt

		if (isset($_POST["uye_id"])) {

				$uye_id= $_POST["uye_id"];

				if(isset($_FILES["dosya"])){
					$gidecegi_konum="../images/uye_fotograflar/";
					$dosya_adi=$_FILES["dosya"]["name"];
					$dosya_yol=$_FILES["dosya"]["tmp_name"];
					dosya_upload($dosya_adi,$dosya_yol,$gidecegi_konum,0,$uye_id);
				}

				header("Location: ../uye_foto_kayit.php");
		}
?>
