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

include "layouts/footer.php";

?>