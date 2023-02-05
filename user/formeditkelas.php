<?php
$data = $fungsi->editKelas($_GET['id_kelas']);
foreach ($data as $d) { ?>

<div class="container">
    <h3 class="mb-3">Form Edit Data Kelas</h3>
    <div class="row">
        <div class="col-6">
        <form action="admin.php?page=updatekelas" method="post">
            <input type="text" value="<?= $d['id_kelas']; ?>" name="id_kelas" hidden>
    <div class="form-group">
        <label>Nama Kelas</label>
        <input type="text" name="nama_kelas" class="form-control" value="<?= $d['nama_kelas']; ?>" required>
    </div>
    <div class="form-group">
        <label>Kompetensi Keahlian</label>
        <input type="text" name="kompetensi_keahlian" class="form-control" value="<?= $d['kompetensi_keahlian']; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
        </div>
    </div>
</div>

<?php } ?>