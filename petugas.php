<?php
session_start();

include "system/fungsi.php";
$fungsi = new Fungsi;
$config = $fungsi->config();

if(isset($_SESSION['data'])){
    if($_SESSION['data']['level'] != 'petugas'){
        header('location: index.php');
    }
    
}
include "layouts/header.php";

if(empty($_GET['page'])){
    header('location: petugas.php?page=home');
}
if($_GET['page'] == 'home'){
    include "user/main.php";
} 
elseif($_GET['page'] == 'datasiswa'){
    include "user/datasiswa.php";
}
elseif($_GET['page'] == 'pembayaran'){
    include "user/pembayaran.php";
} 
elseif($_GET['page'] == 'ayobayar'){
    $nisn = $_POST['nisn'];
    $bulan_dibayar = $_POST['bulan_dibayar'];
    $id_spp = $_POST['id_spp'];
    $id_petugas = $_POST['id_petugas'];
    $jumlah_bayar = $_POST['jumlah_bayar'];
    $tahun_dibayar = $_POST['tahun_dibayar'];
    $fungsi->ayoBayar($nisn, $bulan_dibayar, $id_spp, $id_petugas, $jumlah_bayar, $tahun_dibayar);
} 
elseif($_GET['page'] == 'history'){
    include "user/history.php";
} 


$cari = isset($_GET['cari']) ? $_GET['cari'] : "";
$siswa = isset($_GET['siswa']) ? $_GET['siswa'] : "";

if($cari == 'carisiswa'){
    if($siswa != null){
        header('location: petugas.php?page=datasiswa&siswa='.$_GET['siswa']);
    } elseif($siswa == null){
        header('location: petugas.php?page=datasiswa');
    }
}

include "layouts/footer.php";

?>