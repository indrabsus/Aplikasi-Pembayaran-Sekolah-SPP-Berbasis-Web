<?php

class Fungsi{
    public function kon(){
        $kon = mysqli_connect('localhost', 'root', 'root', 'webku');
        return $kon;
    }
    public function config(){
        $config =
            [
                'home' => 'http://localhost:8888/ujikom/',
                'img' => 'http://localhost:8888/ujikom/img/',
                'nama_sekolah' => 'SMK Sangkuriang 1 Cimahi',
                'app_name' => 'Aplikasi SPP Online'
            ];
        return $config;
    }
    public function tanggal(){
        $convert = date('l, d M Y');
        return $convert;
    }

    public function siswa($halaman, $per_page){
        $halaman_view = $halaman > 1 ? ($halaman * $per_page) - $per_page : 0;
        $previous = $halaman - 1;
        $next = $halaman + 1;

        $sql = "SELECT * FROM siswa LEFT JOIN kelas ON siswa.id_kelas=kelas.id_kelas";
        $data = mysqli_query($this->kon(), $sql);

        if(isset($_GET['siswa'])){
            if($_GET['siswa'] != null) {
                $cari = $_GET['siswa'];
                $datasiswa = mysqli_query($this->kon(), "SELECT * FROM siswa LEFT JOIN kelas ON siswa.id_kelas=kelas.id_kelas LEFT JOIN spp ON siswa.id_spp=spp.id_spp WHERE nama LIKE '%$cari%' ORDER BY nisn DESC");
                $data = $datasiswa;
            } elseif($_GET['siswa'] == ''){
                $datasiswa = mysqli_query($this->kon(), "SELECT * FROM siswa LEFT JOIN kelas ON siswa.id_kelas=kelas.id_kelas LEFT JOIN spp ON siswa.id_spp=spp.id_spp ORDER BY nisn DESC LIMIT $halaman_view, $per_page");
            }
        } else {
            $datasiswa = mysqli_query($this->kon(), "SELECT * FROM siswa LEFT JOIN kelas ON siswa.id_kelas=kelas.id_kelas LEFT JOIN spp ON siswa.id_spp=spp.id_spp ORDER BY nisn DESC LIMIT $halaman_view, $per_page");

        }
        $jumlah_data = mysqli_num_rows($data);
        $total_halaman = ceil($jumlah_data / $per_page);
        $no = $halaman_view + 1;

        if(mysqli_num_rows($datasiswa)>0){
            while($d = mysqli_fetch_assoc($datasiswa)){
                $select[] = $d;
            } 
        } else {
            $select = null;
        }
        $result['total_halaman'] = $total_halaman;
        $result['data'] = $select;
        $result['next'] = $next;
        $result['previous'] = $previous;
        $result['no'] = $no;
        return $result;
    }
    public function kelas(){
        $sql = "SELECT * FROM kelas";
        $query = mysqli_query($this->kon(), $sql);
        while($d = mysqli_fetch_assoc($query)){
            $select[] = $d;
        }
        return $select;
    }
    public function tahun(){
        $sql = "SELECT * FROM spp";
        $query = mysqli_query($this->kon(), $sql);
        while($d = mysqli_fetch_assoc($query)){
            $select[] = $d;
        }
        return $select;
    }
    public function inputSiswa($data){
        $nisn = $data['nisn'];
        $nis = $data['nis'];
        $nama = $data['nama'];
        $id_kelas = $data['id_kelas'];
        $alamat = $data['alamat'];
        $no_telp = $data['no_telp'];
        $id_spp = $data['id_spp'];
        $sql = "INSERT INTO siswa VALUES ('$nisn','$nis','$nama','$id_kelas','$alamat','$no_telp','$id_spp')";
        if(mysqli_query($this->kon(), $sql)){
            header('location: admin.php?page=datasiswa&status=inputberhasil');
            
        }
    }
    public function editSiswa($nisn){
        $sql = "SELECT * FROM siswa LEFT JOIN kelas ON siswa.id_kelas=kelas.id_kelas LEFT JOIN spp ON siswa.id_spp=spp.id_spp WHERE nisn='$nisn'";
        $query = mysqli_query($this->kon(), $sql);

        while($d = mysqli_fetch_assoc($query)){
            $hasil[] = $d;
        }
        return $hasil;
    }
    public function updateSiswa($data){
        $nisn = $data['nisn'];
        $nis = $data['nis'];
        $nama = $data['nama'];
        $id_kelas = $data['id_kelas'];
        $alamat = $data['alamat'];
        $no_telp = $data['no_telp'];
        $id_spp = $data['id_spp'];
        $sql = "UPDATE siswa SET nisn='$nisn', nis='$nis', nama='$nama', id_kelas='$id_kelas', alamat='$alamat', no_telp='$no_telp', id_spp='$id_spp' WHERE nisn='$nisn'";
        if(mysqli_query($this->kon(), $sql)){
            header('location: admin.php?page=datasiswa&status=editberhasil');
            
        }
    }
    public function deleteSiswa($nisn){
        $sql = "DELETE FROM siswa WHERE nisn='$nisn'";
        $query = mysqli_query($this->kon(), $sql);
        header('location: admin.php?page=datasiswa&status=berhasilhapus');
    }


    public function petugas($halaman, $per_page){
        $halaman_view = $halaman > 1 ? ($halaman * $per_page) - $per_page : 0;
        $previous = $halaman - 1;
        $next = $halaman + 1;

        $sql = "SELECT * FROM petugas";
        $data = mysqli_query($this->kon(), $sql);

        if(isset($_GET['petugas'])){
            if($_GET['petugas'] != null) {
                $cari = $_GET['petugas'];
                $datapetugas = mysqli_query($this->kon(), "SELECT * FROM petugas WHERE nama_petugas LIKE '%$cari%' ORDER BY id_petugas DESC");
                $data = $datapetugas;
            } elseif($_GET['petugas'] == ''){
                $datapetugas = mysqli_query($this->kon(), "SELECT * FROM petugas ORDER BY id_petugas DESC");
            }
        } else {
            $datapetugas = mysqli_query($this->kon(), "SELECT * FROM petugas ORDER BY id_petugas DESC");

        }
        $jumlah_data = mysqli_num_rows($data);
        $total_halaman = ceil($jumlah_data / $per_page);
        $no = $halaman_view + 1;

        if(mysqli_num_rows($datapetugas)>0){
            while($d = mysqli_fetch_assoc($datapetugas)){
                $select[] = $d;
            } 
        } else {
            $select = null;
        }
        $result['total_halaman'] = $total_halaman;
        $result['data'] = $select;
        $result['next'] = $next;
        $result['previous'] = $previous;
        $result['no'] = $no;
        return $result;
    }
    public function insertpetugas($username, $password, $nama_petugas){
        $sql = "INSERT INTO petugas VALUES (null,'$username', '$password', '$nama_petugas', 'petugas')";
        $query = mysqli_query($this->kon(), $sql);
        header('location: admin.php?page=datapetugas&status=inputberhasil');
    }
    public function editPetugas($id_petugas){
        $sql = "SELECT * FROM petugas WHERE id_petugas='$id_petugas'";
        $query = mysqli_query($this->kon(), $sql);

        while($d = mysqli_fetch_assoc($query)){
            $hasil[] = $d;
        }
        return $hasil;
    }
  
}