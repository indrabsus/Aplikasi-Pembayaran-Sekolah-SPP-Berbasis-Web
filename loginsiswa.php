<div class="container pt-5">
<div class="row justify-content-center">

<div class="col-4">

        <?php 
    if(isset($_GET['status'])){
        if($_GET['status'] == 'gagal'){ ?>

<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Gagal! </strong> User Tidak Ditemukan.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>


  <?php      }
    }
    
    ?>
<div class="card">
    <div class="card-header">
        Login Siswa
    </div>
    <div class="card-body">
    <form action="index.php?aksi=loginsiswa" method="post">
        <div class="form-group">
            <input type="text" name="nis" class="form-control">
        </div>
        <div class="form-group">
            <input type="password" name="no_telp" class="form-control">
        </div>
        <button name="loginS" class="btn btn-primary" id="loginB">Login</button>
    </form>
    <a href="index.php">Login Petugas</a>
    </div>
</div>
       
       
        </div>
        <div class="col-1"></div>



        <div class="col-4">
        <img src="<?= $config['img'] ?>logo.png" width="200">
        </div>


</div>
</div>