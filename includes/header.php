<html>
<head>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GÜVSİS</title>
</head>

<body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<div class="container-fluid">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="eserler.php"><h2>GÜVSİS</h2></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">

  <?php $lnk=$_SERVER['SCRIPT_NAME'];  ?>

    <ul class="navbar-nav mr-auto">

      <li class="nav-item dropdown <?php if($lnk=="/GUVSIS/eserler.php"){echo "active";} elseif($lnk=="/GUVSIS/eser_kayit_sayfasi.php"){echo "active";}
	  else if($lnk=="/GUVSIS/eser_liste.php"){echo "active";} ?>">
        <a class="nav-link dropdown-toggle" href="eserler.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Kitaplarımız</a>

            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

              <a class="dropdown-item <?php if($lnk=="/GUVSIS/eserler.php"){echo "text-success";} ?>" href="eserler.php">Kitaplarımız</a>
              <?php if(isset($_SESSION["admin"])){ ?>
              <a class="dropdown-item <?php if($lnk=="/GUVSIS/eser_kayit_sayfasi.php"){echo "text-success";} ?>" href="eser_kayit_sayfasi.php">Yeni Kitap Ekle</a>
              <a class="dropdown-item <?php if($lnk=="/GUVSIS/alinan_eserler.php"){echo "text-success";} ?>" href="alinan_eserler.php">Alınan Tüm Kitaplar</a>
              <?php } ?>
              <a class="dropdown-item <?php if($lnk=="/GUVSIS/eser_liste.php"){echo "text-success";} ?>" href="eser_liste.php">Kitap Listesi</a>

            </div>
      </li>
      <?php if(isset($_SESSION["admin"])){ ?>
      <li class="nav-item dropdown <?php if($lnk=="/GUVSIS/uye_kayit.php"){echo "active";}
	  else if($lnk=="/GUVSIS/uye_liste.php"){echo "active";} ?>">
        <a class="nav-link dropdown-toggle" href="uye_liste.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Üyelerimiz</a>

            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

              <a class="dropdown-item <?php if($lnk=="/GUVSIS/uye_liste.php"){echo "text-success";} ?>" href="uye_liste.php">Üyelerimiz</a>

              <a class="dropdown-item <?php if($lnk=="/GUVSIS/uye_kayit.php"){echo "text-success";} ?>" href="uye_kayit.php">Yeni Üye Ekle</a>

            </div>
      </li>
    <?php } ?>
    </ul>

    <form action="eserler.php" method="post" class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" name="arama" placeholder="Kelimeyi buraya giriniz..." aria-label="Kelimeyi buraya giriniz...">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">ARA</button> 
    </form>
    <div>
      <?php if (!isset($_SESSION["admin"]) and !isset($_SESSION["uye"])) { ?>
      <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#exampleModal">Giriş</button>
    <?php } if (isset($_SESSION["admin"]) or isset($_SESSION["uye"])) {?>
      <div class="btn-group" role="group">
        <button id="btnGroupDrop1" type="button" class="btn btn-outline-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Hesap
        </button>
        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
          <a class="dropdown-item" href="uye_bilgi.php">Hesap</a>
          <a class="dropdown-item" href="uye_alinanlar.php">Alınanlar</a>
          <a class="dropdown-item" href="logout.php">Çıkış</a>
        </div>
  </div>
    <?php } ?>
    </div>
  </div>
</nav>
</div>

<?php  //                 Modal Kısmı                 ?>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Giriş</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="ctrl.php" method="post">
      <div class="modal-body">
         <input class="form-control" type="text" maxlength="11" name="tc" placeholder="Lütfen TC Kimlik Numaranızı Giriniz..."></br>
         <input class="form-control" type="password" name="sifre" placeholder="Lütfen Şifrenizi Giriniz...">
      </div>
      <div class="modal-footer">
        <a href="uye_kayit.php"><button class="btn btn-outline-success" type="button">Kaydol</button></a>
         <button class="btn btn-outline-success" type="submit">Giriş</button>
      </form>

      </div>
    </div>
  </div>
</div>

<hr width="%100" color="#00FF33" />
