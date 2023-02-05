<?php
$data = $fungsi->editPetugas($_GET['id_petugas']);
foreach ($data as $d) { ?>

<div class="container">
    <h3 class="mb-3">Form Edit Data Petugas</h3>
    <div class="row">
        <div class="col-6">
        <form action="admin.php?page=updatepetugas" method="post">
            <input type="text" value="<?= $d['id_petugas']; ?>" name="id_petugas" hidden>
    <div class="form-group">
        <label>Nama Petugas</label>
        <input type="text" name="nama_petugas" class="form-control" value="<?= $d['nama_petugas']; ?>" required>
    </div>
    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" class="form-control" value="<?= $d['username']; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
        </div>
    </div>
</div>

<?php } ?>