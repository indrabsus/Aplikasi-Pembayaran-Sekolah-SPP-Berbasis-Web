<div class="container">
    <h3 class="mb-3">Form Input Data Kelas</h3>
    <div class="row">
        <div class="col-6">
            <form action="admin.php?page=insertkelas" method="post">
            <div class="form-group">
        <label for="nama_kelas">Nama Kelas</label>
        <input type="text" class="form-control" name="nama_kelas" required>
    </div>
    <div class="form-group">
    <label for="kompetensi_keahlian">Kompetensi Keahlian</label>
        <input type="text" class="form-control" name="kompetensi_keahlian" required>
    </div>
    <button class="btn btn-primary" type="submit" name="submit">Submit</button>
            </form>
        </div>
    </div>
</div>