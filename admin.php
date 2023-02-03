<?php
session_start();

include "system/fungsi.php";
$fungsi = new Fungsi;
$config = $fungsi->config();

if(isset($_SESSION['data'])){
    if($_SESSION['data']['level'] != 'admin'){
        header('location: index.php');
    }
    
}
include "layouts/header.php";

if(empty($_GET['page'])){
    header('location: admin.php?page=home');
}
if($_GET['page'] == 'home'){
    include "user/main.php";
} elseif($_GET['page'] == 'datasiswa'){
    include "user/datasiswa.php";
} 
elseif($_GET['page'] ==  'formsiswa') {
    include "user/formsiswa.php";
} elseif($_GET['page'] == 'insertsiswa'){
    $data = [
        'nisn' => $_POST['nisn'],
        'nis' => $_POST['nis'],
        'nama' => $_POST['nama'],
        'id_kelas' => $_POST['id_kelas'],
        'alamat' => $_POST['alamat'],
        'no_telp' => $_POST['no_telp'],
        'id_spp' => $_POST['id_spp']
    ];
    
    $fungsi->inputSiswa($data);
} elseif($_GET['page'] == 'editsiswa'){
    include "user/formeditsiswa.php";
} elseif($_GET['page'] == 'updatesiswa'){
    $data = [
        'nisn' => $_POST['nisn'],
        'nis' => $_POST['nis'],
        'nama' => $_POST['nama'],
        'id_kelas' => $_POST['id_kelas'],
        'alamat' => $_POST['alamat'],
        'no_telp' => $_POST['no_telp'],
        'id_spp' => $_POST['id_spp']
    ];
    $fungsi->updateSiswa($data);
} elseif($_GET['page']=='deletesiswa'){
    $fungsi->deleteSiswa($_GET['nisn']);
} elseif($_GET['page'] == 'datapetugas'){
    include "user/datapetugas.php";
} elseif($_GET['page'] == 'formpetugas'){
    include "user/formpetugas.php";
} elseif($_GET['page'] == 'insertpetugas'){
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $nama_petugas = $_POST['nama_petugas'];
    $fungsi->insertpetugas($username, $password, $nama_petugas);
} elseif($_GET['page'] == 'editpetugas'){
    include "user/formeditpetugas.php";
}






$cari = isset($_GET['cari']) ? $_GET['cari'] : "";
$siswa = isset($_GET['siswa']) ? $_GET['siswa'] : "";

    if($cari == 'cari'){
        if($siswa != null){
            header('location: admin.php?page=datasiswa&siswa='.$_GET['siswa']);
        } elseif($siswa == null){
            header('location: admin.php?page=datasiswa');
        }
    }

    $petugas = isset($_GET['petugas']) ? $_GET['petugas'] : "";

    if($cari == 'cari'){
        if($petugas != null){
            header('location: admin.php?page=datapetugas&petugas='.$_GET['petugas']);
        } elseif($petugas == null){
            header('location: admin.php?page=datapetugas');
        }
    }


include "layouts/footer.php";

?>