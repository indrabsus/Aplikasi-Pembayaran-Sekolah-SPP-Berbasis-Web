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
    <title>Dashboard Siswa</title>
</head>
<body>
<div class="pb-5 mb-5">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
  <a class="navbar-brand" href="">Dashboard Siswa</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">

    <li class="nav-item">
        <a class="nav-link" href="index.php?aksi=logout">Logout</a>
      </li>

      
    </ul>
  </div>
  </div>
</nav>
</div>

<?php
session_start();

include "system/fungsi.php";
$fungsi = new Fungsi;
$config = $fungsi->config();

if(isset($_SESSION['data'])){
    if($_SESSION['data']['nis'] == null){
        header('location: index.php');
    }
    
}

if(empty($_GET['page'])){
    header('location: siswa.php?page=home');
}


include "layouts/footer.php";

?>