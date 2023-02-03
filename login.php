<div class="row justify-content-center">

<div class="col-3">
        <div class="card">
    <div class="card-header">
        Login Siswa
    </div>
    <div class="card-body">
    <form action="index.php?aksi=loginSiswa" method="post">
        <div class="form-group">
            <input type="text" name="nis" class="form-control">
        </div>
        <div class="form-group">
            <input type="password" name="no_telp" class="form-control">
        </div>
        <button name="loginS" class="btn btn-primary">Login</button>
    </form>
    </div>
</div>
        </div>

        <div class="col-2 mt-5">
            <img src="<?= $config['img']?>vs.png" width="100px" class="rounded mx-auto d-block align-text-bottom">
        </div>


        <div class="col-3">
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
    </div>
</div>
        </div>


</div>