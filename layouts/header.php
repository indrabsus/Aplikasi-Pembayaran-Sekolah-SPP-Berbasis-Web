<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
      #loginB {
        float: right;
      }
    </style>
    <title><?= $config['app_name']; ?></title>
</head>
<body>
<div class="pb-5 mb-5">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
  <a class="navbar-brand" href="<?= $config['home']; ?>"><?= $config['app_name']; ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">

    <?php

                                                            use Faker\Provider\bg_BG\PhoneNumber;

    if (isset($_SESSION['data'])) {
      if ($_SESSION['data']['level'] == 'admin') { ?>
 <li class="nav-item <?= $_GET['page'] == 'home' ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= $config['home']?>admin.php?page=home">Dashboard</a>
      </li>
<li class="nav-item dropdown <?php 
        if($_GET['page'] == 'datasiswa' || $_GET['page'] == 'datapetugas'){
          echo "active";
        }
            ?>">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
          Data
        </a>
       
        <div class="dropdown-menu">
          <a class="dropdown-item" href="<?= $config['home']?>admin.php?page=datasiswa">Data Siswa</a>
          <a class="dropdown-item" href="<?= $config['home']?>admin.php?page=datapetugas">Data Petugas</a>
          <a class="dropdown-item" href="#">Data Kelas</a>
          <a class="dropdown-item" href="#">Data SPP</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Laporan</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Pembayaran</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">History</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?aksi=logout">Logout</a>
      </li>

<?php
      } elseif($_SESSION['data']['level'] == 'petugas' || $_SESSION['data']['level'] == 'admin'){ ?>
        <li class="nav-item">
        <a class="nav-link" href="#">Pembayaran</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">History</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?aksi=logout">Logout</a>
      </li>


<?php
      }
    }
    if(!isset($_SESSION['data'])){ ?>

<li class="nav-item active">
        <a class="nav-link" href="<?= $config['home']; ?>"><?= $fungsi->tanggal(); ?></a>
      </li>

<?php
    }

?>

      
    </ul>
  </div>
  </div>
</nav>
</div>