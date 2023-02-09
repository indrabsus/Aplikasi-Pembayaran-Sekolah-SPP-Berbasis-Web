<div class="container pt-5">
    
<div class="row justify-content-center">

<div class="col-4">
       <img src="<?= $config['img'] ?>logo.png" width="200">
       
        </div>



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
        Login Petugas
    </div>
    <div class="card-body">
    <form action="index.php?aksi=login" method="post">
        <div class="form-group">
            <input type="text" name="username" class="form-control">
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control">
        </div>
        <button name="login" class="btn btn-primary" id="loginB">Login</button>
    </form>
    <a href="index.php?aksi=logins">Login Siswa</a>
    </div>
</div>
        </div>


</div>
</div>