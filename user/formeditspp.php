<?php
$data = $fungsi->editspp($_GET['id_spp']);
foreach ($data as $d) { ?>

<div class="container">
    <h3 class="mb-3">Form Edit Data SPP</h3>
    <div class="row">
        <div class="col-6">
        <form action="admin.php?page=updatespp" method="post">
            <input type="text" value="<?= $d['id_spp']; ?>" name="id_spp" hidden>
    <div class="form-group">
        <label>Tahun <?= $d['tahun']; ?></label>
        <input type="text" name="tahun" class="form-control" value="<?= $d['tahun']; ?>" hidden>
    </div>
    <div class="form-group">
        <label>Nominal</label>
        <input type="text" name="nominal" class="form-control" value="<?= $d['nominal']; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
        </div>
    </div>
</div>

<?php } ?>