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

if(isset($_GET['page'])){
    if($_GET['page'] == 'home'){
        include "user/main.php";
    } 
    elseif($_GET['page'] == 'datasiswa'){
        include "user/datasiswa.php";
    } 
    elseif($_GET['page'] ==  'formsiswa') {
        include "user/formsiswa.php";
    } 
    elseif($_GET['page'] == 'insertsiswa'){
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
    } 
    elseif($_GET['page'] == 'editsiswa'){
        include "user/formeditsiswa.php";
    } 
    elseif($_GET['page'] == 'updatesiswa'){
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
    } 
    elseif($_GET['page']=='deletesiswa'){
        $fungsi->deleteSiswa($_GET['nisn']);
    } 
    elseif($_GET['page'] == 'datapetugas'){
        include "user/datapetugas.php";
    } 
    elseif($_GET['page'] == 'formpetugas'){
        include "user/formpetugas.php";
    } 
    elseif($_GET['page'] == 'insertpetugas'){
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $nama_petugas = $_POST['nama_petugas'];
        $fungsi->insertpetugas($username, $password, $nama_petugas);
    } 
    elseif($_GET['page'] == 'editpetugas'){
        include "user/formeditpetugas.php";
    } 
    elseif($_GET['page'] == 'updatepetugas'){
        $id_petugas = $_POST['id_petugas'];
        $username = $_POST['username'];
        $nama_petugas = $_POST['nama_petugas'];
        $fungsi->updatePetugas($id_petugas, $username, $nama_petugas);
    } 
    elseif($_GET['page']=='deletepetugas'){
        $fungsi->deletePetugas($_GET['id_petugas']);
    } 
    elseif($_GET['page']=='datakelas'){
        include "user/datakelas.php";
    } 
    elseif($_GET['page']=='formkelas'){
        include "user/formkelas.php";
    }  
    elseif($_GET['page'] == 'insertkelas'){
        $nama_kelas = $_POST['nama_kelas'];
        $kompetensi_keahlian = $_POST['kompetensi_keahlian'];
        $fungsi->insertKelas($nama_kelas, $kompetensi_keahlian);
    } 
    elseif($_GET['page'] == 'editkelas'){
        include "user/formeditkelas.php";
    } 
    elseif($_GET['page'] == 'updatekelas'){
        $id_kelas = $_POST['id_kelas'];
        $nama_kelas = $_POST['nama_kelas'];
        $kompetensi_keahlian = $_POST['kompetensi_keahlian'];
        $fungsi->updateKelas($id_kelas, $nama_kelas, $kompetensi_keahlian);
    } 
    elseif($_GET['page'] == 'deletekelas'){
        $fungsi->deleteKelas($_GET['id_kelas']);
    } 
    elseif($_GET['page']=='dataspp'){
        include "user/dataspp.php";
    } 
    elseif($_GET['page']=='formspp'){
        include "user/formspp.php";
    } 
    elseif ($_GET['page'] == 'insertspp') {
        $tahun = $_POST['tahun'];
        $nominal = $_POST['nominal'];
        $fungsi->insertSpp($tahun, $nominal);
    }
    elseif($_GET['page'] == 'editspp'){
        include "user/formeditspp.php";
    }
    elseif($_GET['page'] == 'updatespp'){
        $id_spp = $_POST['id_spp'];
        $tahun = $_POST['tahun'];
        $nominal = $_POST['nominal'];
        $fungsi->updateSpp($id_spp, $tahun, $nominal);
    } 
    elseif($_GET['page'] == 'deletespp'){
        $fungsi->deleteSpp($_GET['id_spp']);
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
    elseif($_GET['page'] == 'deletebayar'){
        $fungsi->deleteBayar($_GET['nisn'],$_GET['id_pembayaran']);
    } 
    elseif($_GET['page'] == 'laporan'){
        include "user/laporan.php";
    } 
}


$cari = isset($_GET['cari']) ? $_GET['cari'] : "";
$siswa = isset($_GET['siswa']) ? $_GET['siswa'] : "";
$petugas = isset($_GET['petugas']) ? $_GET['petugas'] : "";
$kelas = isset($_GET['kelas']) ? $_GET['kelas'] : "";
$spp = isset($_GET['spp']) ? $_GET['spp'] : "";
$laporan = isset($_GET['laporan']) ? $_GET['laporan'] : "";

    if($cari == 'carisiswa'){
        if($siswa != null){
            header('location: admin.php?page=datasiswa&siswa='.$_GET['siswa']);
        } elseif($siswa == null){
            header('location: admin.php?page=datasiswa');
        }
    }

    if($cari == 'caripetugas'){
        if($petugas != null){
            header('location: admin.php?page=datapetugas&petugas='.$_GET['petugas']);
        } elseif($petugas == null){
            header('location: admin.php?page=datapetugas');
        }
    }

    if($cari == 'carikelas'){
        if($kelas != null){
            header('location: admin.php?page=datakelas&kelas='.$_GET['kelas']);
        } elseif($kelas == null){
            header('location: admin.php?page=datakelas');
        }
    }

    if($cari == 'carispp'){
        if($spp != null){
            header('location: admin.php?page=dataspp&spp='.$_GET['spp']);
        } elseif($spp == null){
            header('location: admin.php?page=dataspp');
        }
    }
    if($cari == 'carilaporan'){
        if($laporan != null){
            header('location: admin.php?page=laporan&laporan='.$_GET['laporan']);
        } elseif($laporan == null){
            header('location: admin.php?page=laporan');
        }
    }


include "layouts/footer.php";

?>