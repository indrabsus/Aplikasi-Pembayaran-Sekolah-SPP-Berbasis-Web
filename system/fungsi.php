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
        $convert = date('d F Y');
        return $convert;
    }
    public function hari_ini(){
        $hari = date ("D");
     
        switch($hari){
            case 'Sun':
                $hari_ini = "Minggu";
            break;
     
            case 'Mon':			
                $hari_ini = "Senin";
            break;
     
            case 'Tue':
                $hari_ini = "Selasa";
            break;
     
            case 'Wed':
                $hari_ini = "Rabu";
            break;
     
            case 'Thu':
                $hari_ini = "Kamis";
            break;
     
            case 'Fri':
                $hari_ini = "Jumat";
            break;
     
            case 'Sat':
                $hari_ini = "Sabtu";
            break;
            
            default:
                $hari_ini = "Tidak di ketahui";		
            break;
        }
     
        return $hari_ini;
     
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
        $nisn = str_replace(' ','',$data['nisn']);
        $nis = str_replace(' ','',$data['nis']);
        $nama = $data['nama'];
        $id_kelas = $data['id_kelas'];
        $alamat = $data['alamat'];
        $no_telp = str_replace(' ','',$data['no_telp']);
        $id_spp = $data['id_spp'];
        $sql = "INSERT INTO siswa VALUES ('$nisn','$nis','$nama','$id_kelas','$alamat','$no_telp','$id_spp')";
        $hitung_nis = mysqli_num_rows(mysqli_query($this->kon(), "SELECT * FROM siswa WHERE nis='$nis'"));
        $hitung_nisn = mysqli_num_rows(mysqli_query($this->kon(), "SELECT * FROM siswa WHERE nisn='$nisn'"));
        
        if(is_numeric($nisn) && is_numeric($nis) && is_numeric($no_telp)){
            if($hitung_nis < 1 && $hitung_nisn < 1){
                mysqli_query($this->kon(), $sql);
                header('location: admin.php?page=datasiswa&status=inputberhasil');
                } else {
                    header('location: admin.php?page=datasiswa&status=dataganda');
                }
        } else {
            header('location: admin.php?page=datasiswa&status=errornumeric');
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
        $nisn = str_replace(' ','',$data['nisn']);
        $nis = str_replace(' ','',$data['nis']);
        $nama = $data['nama'];
        $id_kelas = $data['id_kelas'];
        $alamat = $data['alamat'];
        $no_telp = str_replace(' ','',$data['no_telp']);
        $id_spp = $data['id_spp'];
        $sql = "UPDATE siswa SET nisn='$nisn', nis='$nis', nama='$nama', id_kelas='$id_kelas', alamat='$alamat', no_telp='$no_telp', id_spp='$id_spp' WHERE nisn='$nisn'";
        $hitung_nis = mysqli_num_rows(mysqli_query($this->kon(), "SELECT * FROM siswa WHERE nis='$nis'"));
        $hitung_nisn = mysqli_num_rows(mysqli_query($this->kon(), "SELECT * FROM siswa WHERE nisn='$nisn'"));
        
        if(is_numeric($nisn) && is_numeric($nis) && is_numeric($no_telp)){
                mysqli_query($this->kon(), $sql);
                header('location: admin.php?page=datasiswa&status=editberhasil');
                } 
        else {
            header('location: admin.php?page=datasiswa&status=errornumeric');
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
                $datapetugas = mysqli_query($this->kon(), "SELECT * FROM petugas WHERE nama_petugas LIKE '%$cari%' AND level='petugas' ORDER BY id_petugas DESC");
                $data = $datapetugas;
            } elseif($_GET['petugas'] == ''){
                $datapetugas = mysqli_query($this->kon(), "SELECT * FROM petugas WHERE level='petugas' ORDER BY id_petugas DESC LIMIT $halaman_view, $per_page");
                $data = $datapetugas;
            }
        } else {
            $datapetugas = mysqli_query($this->kon(), "SELECT * FROM petugas WHERE level='petugas' ORDER BY id_petugas DESC LIMIT $halaman_view, $per_page");

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
        $uname = strtolower(str_replace(' ', '', $username));
        $hitung = mysqli_num_rows(mysqli_query($this->kon(), "SELECT * FROM petugas WHERE username='$username'"));
        $sql = "INSERT INTO petugas VALUES (null,'$uname', '$password', '$nama_petugas', 'petugas')";
        if($hitung < 1) {
        $query = mysqli_query($this->kon(), $sql);
        header('location: admin.php?page=datapetugas&status=inputberhasil');
        } else {
            header('location: admin.php?page=datapetugas&status=dataganda');
        }
    }
    public function editPetugas($id_petugas){
        $sql = "SELECT * FROM petugas WHERE id_petugas='$id_petugas'";
        $query = mysqli_query($this->kon(), $sql);

        while($d = mysqli_fetch_assoc($query)){
            $hasil[] = $d;
        }
        return $hasil;
    }
    public function updatePetugas($id_petugas, $username, $nama_petugas){
        
        $sql = "UPDATE petugas SET username='$username', nama_petugas='$nama_petugas' WHERE id_petugas='$id_petugas'";
        $query = mysqli_query($this->kon(), $sql);
        header('location: admin.php?page=datapetugas&status=editberhasil');
    }
    public function deletePetugas($id_petugas){
        $sql = "DELETE FROM petugas WHERE id_petugas='$id_petugas'";
        $query = mysqli_query($this->kon(), $sql);
        header('location: admin.php?page=datapetugas&status=berhasilhapus');
    }

    public function datakelas($halaman, $per_page){
        $halaman_view = $halaman > 1 ? ($halaman * $per_page) - $per_page : 0;
        $previous = $halaman - 1;
        $next = $halaman + 1;

        $sql = "SELECT * FROM kelas";
        $data = mysqli_query($this->kon(), $sql);

        if(isset($_GET['kelas'])){
            if($_GET['kelas'] != null) {
                $cari = $_GET['kelas'];
                $datakelas = mysqli_query($this->kon(), "SELECT * FROM kelas WHERE nama_kelas LIKE '%$cari%' ORDER BY id_kelas DESC");
                $data = $datakelas;
            } elseif($_GET['kelas'] == ''){
                $datakelas = mysqli_query($this->kon(), "SELECT * FROM kelas ORDER BY id_kelas DESC LIMIT $halaman_view, $per_page");
            }
        } else {
            $datakelas = mysqli_query($this->kon(), "SELECT * FROM kelas ORDER BY id_kelas DESC LIMIT $halaman_view, $per_page");

        }
        $jumlah_data = mysqli_num_rows($data);
        $total_halaman = ceil($jumlah_data / $per_page);
        $no = $halaman_view + 1;

        if(mysqli_num_rows($datakelas)>0){
            while($d = mysqli_fetch_assoc($datakelas)){
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
    public function insertKelas($nama_kelas, $kompetensi_keahlian){
        $sql = "INSERT INTO kelas VALUES (null,'$nama_kelas', '$kompetensi_keahlian')";
        $query = mysqli_query($this->kon(), $sql);
        header('location: admin.php?page=datakelas&status=inputberhasil');
    }
    public function editKelas($id_kelas){
        $sql = "SELECT * FROM kelas WHERE id_kelas='$id_kelas'";
        $query = mysqli_query($this->kon(), $sql);

        while($d = mysqli_fetch_assoc($query)){
            $hasil[] = $d;
        }
        return $hasil;
    }
    public function updateKelas($id_kelas, $nama_kelas, $kompetensi_keahlian){
        
        $sql = "UPDATE kelas SET nama_kelas='$nama_kelas', kompetensi_keahlian='$kompetensi_keahlian' WHERE id_kelas='$id_kelas'";
        $query = mysqli_query($this->kon(), $sql);
        header('location: admin.php?page=datakelas&status=editberhasil');
    }
    public function deleteKelas($id_kelas){
        $sql = "DELETE FROM kelas WHERE id_kelas='$id_kelas'";
        $query = mysqli_query($this->kon(), $sql);
        header('location: admin.php?page=datakelas&status=berhasilhapus');
    }
    public function dataspp($halaman, $per_page){
        $halaman_view = $halaman > 1 ? ($halaman * $per_page) - $per_page : 0;
        $previous = $halaman - 1;
        $next = $halaman + 1;

        $sql = "SELECT * FROM spp";
        $data = mysqli_query($this->kon(), $sql);

        if(isset($_GET['spp'])){
            if($_GET['spp'] != null) {
                $cari = $_GET['spp'];
                $dataspp = mysqli_query($this->kon(), "SELECT * FROM spp WHERE tahun LIKE '%$cari%' ORDER BY id_spp DESC");
                $data = $dataspp;
            } elseif($_GET['spp'] == ''){
                $dataspp = mysqli_query($this->kon(), "SELECT * FROM spp ORDER BY id_spp DESC LIMIT $halaman_view, $per_page");
            }
        } else {
            $dataspp = mysqli_query($this->kon(), "SELECT * FROM spp ORDER BY id_spp DESC LIMIT $halaman_view, $per_page");

        }
        $jumlah_data = mysqli_num_rows($data);
        $total_halaman = ceil($jumlah_data / $per_page);
        $no = $halaman_view + 1;

        if(mysqli_num_rows($dataspp)>0){
            while($d = mysqli_fetch_assoc($dataspp)){
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
    public function insertSpp($tahun, $nominal){
        $sql = "INSERT INTO spp VALUES (null,'$tahun', '$nominal')";
        $hitung = mysqli_num_rows(mysqli_query($this->kon(), "SELECT * FROM spp WHERE tahun='$tahun'"));
        if($hitung < 1){
            if(is_numeric($tahun) == true && is_numeric($nominal) == true){
                $query = mysqli_query($this->kon(), $sql);
        header('location: admin.php?page=dataspp&status=inputberhasil');
        } else {
            header('location: admin.php?page=dataspp&status=errornumeric');
            
        }
            } else {
                header('location: admin.php?page=dataspp&status=dataganda');
            }
    }
    public function editSpp($id_spp){
        $sql = "SELECT * FROM spp WHERE id_spp='$id_spp'";
        $query = mysqli_query($this->kon(), $sql);

        while($d = mysqli_fetch_assoc($query)){
            $hasil[] = $d;
        }
        return $hasil;
    }
    public function updateSpp($id_spp, $tahun, $nominal){
        
        $sql = "UPDATE spp SET tahun='$tahun', nominal='$nominal' WHERE id_spp='$id_spp'";
        
            if(is_numeric($nominal) == true){
                $query = mysqli_query($this->kon(), $sql);
        header('location: admin.php?page=dataspp&status=editberhasil');
        } else {
            header('location: admin.php?page=dataspp&status=errornumeric');
            
        }
    }
    public function deleteSpp($id_spp){
        $sql = "DELETE FROM spp WHERE id_spp='$id_spp'";
        $query = mysqli_query($this->kon(), $sql);
        header('location: admin.php?page=dataspp&status=berhasilhapus');
    }
    public function dataBayar($nisn){
        $sql = "SELECT * FROM pembayaran WHERE nisn='$nisn' ORDER BY id_pembayaran DESC";
        $query = mysqli_query($this->kon(), $sql);
        $hitung = mysqli_num_rows($query);
        if($hitung >0){
            while($d = mysqli_fetch_assoc($query)){
                $hasil[] = $d;
            }
        } else {
            $hasil = null;
        }
        return $hasil;
    } 
    public function ayoBayar($nisn, $bulan_dibayar, $id_spp, $id_petugas, $jumlah_bayar, $tahun_dibayar){
        $tgl_bayar = date('Y-m-d');
        $sql = "INSERT INTO pembayaran VALUES (null, '$id_petugas', '$nisn', '$tgl_bayar', '$bulan_dibayar', '$tahun_dibayar', '$id_spp', '$jumlah_bayar')";
        $hitung = mysqli_num_rows(mysqli_query($this->kon(), "SELECT * FROM pembayaran WHERE nisn='$nisn' AND bulan_dibayar='$bulan_dibayar' AND tahun_dibayar='$tahun_dibayar'"));
    if($_SESSION['data']['level'] == 'admin'){
        if($hitung <1){
            $query = mysqli_query($this->kon(), $sql);
            header('location: admin.php?page=pembayaran&nisn='.$nisn.'&status=berhasilbayar');
    } else {
        header('location: admin.php?page=pembayaran&nisn='.$nisn.'&status=dataganda');
    }
    } elseif ($_SESSION['data']['level'] == 'petugas') {
        if($hitung <1){
            $query = mysqli_query($this->kon(), $sql);
            header('location: petugas.php?page=pembayaran&nisn='.$nisn.'&status=berhasilbayar');
    } else {
        header('location: petugas.php?page=pembayaran&nisn='.$nisn.'&status=dataganda');
    }
    }
    }
    public function history($nisn){
        $sql = "SELECT * FROM pembayaran LEFT JOIN siswa ON pembayaran.nisn = siswa.nisn LEFT JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas WHERE pembayaran.nisn='$nisn' ORDER BY id_pembayaran DESC";
        $query = mysqli_query($this->kon(), $sql);
        $hitung = mysqli_num_rows($query);
        if($hitung > 0) {
            while ($d = mysqli_fetch_assoc($query)){
                $select[] = $d;
            } 
            } else {
                $select = null;
        }
        return $select;
    }
    public function deleteBayar($nisn, $id_pembayaran){
        $sql = "DELETE FROM pembayaran WHERE id_pembayaran='$id_pembayaran'";
        $query = mysqli_query($this->kon(), $sql);
        header('location: admin.php?page=pembayaran&nisn='.$nisn.'&status=berhasilhapus');
    }
    public function laporan($halaman, $per_page){
        $halaman_view = $halaman > 1 ? ($halaman * $per_page) - $per_page : 0;
        $previous = $halaman - 1;
        $next = $halaman + 1;
        $data = mysqli_query($this->kon(), "SELECT * FROM pembayaran LEFT JOIN siswa ON pembayaran.nisn=siswa.nisn ORDER BY id_pembayaran");

        if(isset($_GET['laporan'])){
            if($_GET['laporan'] != null) {
                $cari = $_GET['laporan'];
                $datalaporan = mysqli_query($this->kon(), "SELECT * FROM pembayaran LEFT JOIN siswa ON pembayaran.nisn=siswa.nisn WHERE tgl_bayar LIKE '%$cari%' ORDER BY id_pembayaran DESC");
                $data = $datalaporan;
            } elseif($_GET['laporan'] == ''){
                $datalaporan = mysqli_query($this->kon(), "SELECT * FROM pembayaran LEFT JOIN siswa ON pembayaran.nisn=siswa.nisn ORDER BY id_pembayaran DESC LIMIT $halaman_view, $per_page");
            }
        } else {
            $datalaporan = mysqli_query($this->kon(), "SELECT * FROM pembayaran LEFT JOIN siswa ON pembayaran.nisn=siswa.nisn ORDER BY id_pembayaran DESC LIMIT $halaman_view, $per_page");

        }
        $jumlah_data = mysqli_num_rows($data);
        $total_halaman = ceil($jumlah_data / $per_page);
        $no = $halaman_view + 1;

        if(mysqli_num_rows($datalaporan)>0){
            while($d = mysqli_fetch_assoc($datalaporan)){
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
    public function grafik(){
        $data = mysqli_query($this->kon(), "SELECT * FROM pembayaran");
        if(mysqli_num_rows($data)>0){
            while($d = mysqli_fetch_assoc($data)){
                $select[] = $d;
            } 
        } else {
            $select = null;
        }
        return $select;
    }
    public function dashboard(){
        $data = "SELECT SUM(jumlah_bayar) AS sum FROM pembayaran";
        $hasil = mysqli_query($this->kon(), $data);

        $val = mysqli_fetch_array($hasil);
        $total['jumlah'] = $val['sum'];

        $jml_siswa = mysqli_num_rows(mysqli_query($this->kon(), "SELECT * FROM siswa"));
        $total['jml_siswa'] = $jml_siswa;

        $jml_angkatan = mysqli_num_rows(mysqli_query($this->kon(), "SELECT * FROM spp"));
        $total['jml_angkatan'] = $jml_angkatan;

        $jml_kelas = mysqli_num_rows(mysqli_query($this->kon(), "SELECT * FROM kelas"));
        $total['jml_kelas'] = $jml_kelas;

        $jml_petugas = mysqli_num_rows(mysqli_query($this->kon(), "SELECT * FROM petugas"));
        $total['jml_petugas'] = $jml_petugas;

        return $total;
    }
}