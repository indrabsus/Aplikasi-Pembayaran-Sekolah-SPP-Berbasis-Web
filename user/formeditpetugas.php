<?php
$data = $fungsi->editPetugas($_GET['id_petugas']);
foreach ($data as $d) { ?>

<div class="container">
    <h3 class="mb-3">Form Input Data Petugas</h3>
    <div class="row">
        <div class="col-6">
        <form action="admin.php?page=insertpetugas" method="post">
    <div class="form-group">
        <label>Nama Petugas</label>
        <input type="text" name="nama_petugas" class="form-control" value="<?= $d['nama_petugas']; ?>">
    </div>
    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" class="form-control" value="<?= $d['username']; ?>">
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
        </div>
    </div>
</div>

<?php } ?>