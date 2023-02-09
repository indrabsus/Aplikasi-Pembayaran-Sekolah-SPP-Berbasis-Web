<?php

class Login{
    public function login($username=null, $password=null){
        $fungsi = new Fungsi;
        $config = $fungsi->config();
        if(isset($_POST['login'])){
        $sql = "SELECT * FROM petugas WHERE username='$username'";
        $query = mysqli_query($fungsi->kon(), $sql);
        $data = mysqli_fetch_assoc($query);
            $datapassword = isset($data['password']) ? $data['password'] : "";
        if(password_verify($password, $datapassword)){
            if($data['level'] == 'admin'){
                    $_SESSION['data'] = $data;
                    header('location: admin.php');
            } elseif($data['level'] == 'petugas'){
                $_SESSION['data'] = $data;
                header('location: petugas.php');
            } elseif($data['level'] == 'siswa'){
                header('location: siswa.php');
            }
            } else {

                $_GET['status'] = "gagal";
                header('location: index.php?status=gagal');

            }
        } 
    }
    public function loginSiswa($nis=null, $no_telp=null){
        $fungsi = new Fungsi;


        if(isset($_POST['loginS'])){
            $sql = "SELECT * FROM siswa WHERE nis='$nis'";
            $query = mysqli_query($fungsi->kon(), $sql);
            $data = mysqli_fetch_assoc($query);
            $nohp = isset($data['no_telp']) ? $data['no_telp'] : "";
            if($no_telp == $nohp){
                $_SESSION['data'] = $data;
                header('location: siswa.php');
            }
            else {

                $_GET['status'] = "gagal";
                header('location: index.php?aksi=logins&status=gagal');
    
            }
        }  
    }
    public function logout(){
        session_destroy();
        header('location: index.php');
    }
}
