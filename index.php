
    <?php
    session_start();
    if(isset($_SESSION['data'])){
        if($_SESSION['data']['level'] == 'admin'){
            header('location: admin.php');
        } elseif($_SESSION['data']['level'] == 'petugas'){
            header('location: petugas.php');
        } elseif($_SESSION['data']['nis'] != null){
            header('location: siswa.php');
        }
    }

include "system/fungsi.php";
include "system/auth.php";
$auth = new Login;
$fungsi = new Fungsi;
$config = $fungsi->config();

    include "layouts/header.php";
    
    
        if(isset($_GET['status'])){
            if($_GET['status'] == 'gagal'){
            echo "<h3>User tidak ditemukan</h3>";
            }
        }   
        if(empty($_GET['aksi'])){
            include "login.php";
        } elseif($_GET['aksi'] == 'login'){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $auth->login($username, $password);
        
        } elseif($_GET['aksi'] == 'logout'){
            $auth->logout();
        } elseif($_GET['aksi'] == 'loginSiswa'){
        $nis = $_POST['nis'];
        $no_telp = $_POST['no_telp'];

        $auth->loginSiswa($nis, $no_telp);
        }
        
        
    include "layouts/footer.php";
    ?>