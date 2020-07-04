<?php session_start();

	function eser_baglan(){
		$host="localhost";
		$user_name="root";
		$password="";
		$database="guvsis_eser_db";
		$baglan=mysql_connect($host,$user_name,$password) or die ("Mysql Bağlantısı Gerçekleşmedi.");
		mysql_select_db($database,$baglan) or die("Veritabanı Bağlantısı Gerçekleşmedi.");
		mysql_query("SET NAMES UTF8");
	}

	function il_ilce_baglan(){
		$host="localhost";
		$user_name="root";
		$password="";
		$database="guvsis_il_db";
		$baglan=mysql_connect($host,$user_name,$password) or die ("Mysql Bağlantısı Gerçekleşmedi.");
		mysql_select_db($database,$baglan) or die("İl Veritabanına Bağlantısı Gerçekleşmedi.");
		mysql_query("SET NAMES UTF8");
	}

	function uye_baglan(){
		$host="localhost";
		$user_name="root";
		$password="";
		$database="guvsis_eser_db";
		$baglan=mysql_connect($host,$user_name,$password) or die ("Mysql Bağlantısı Gerçekleşmedi.");
		mysql_select_db($database,$baglan) or die("Veritabanına Bağlantısı Gerçekleşmedi.");
		mysql_query("SET NAMES UTF8");
	}
?>
