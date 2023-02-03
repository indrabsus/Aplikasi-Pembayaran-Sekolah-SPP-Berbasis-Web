<div class="container pb-5">
    <h1 class="mb-3">Input Data Siswa</h1>
    <form action="<?= $config['home'] ?>admin.php?page=insertsiswa" method="post">
    <div class="row">
        <div class="col-6">
        <div class="form-group">
        <label>NISN</label>
        <input type="text" name="nisn" class="form-control">
    </div>
    <div class="form-group">
        <label>NIS</label>
        <input type="text" name="nis" class="form-control">
    </div>
    <div class="form-group">
        <label>Nama Siswa</label>
        <input type="text" name="nama" class="form-control">
    </div>
    <div class="form-group">
        <label>Kelas</label>
        <select name="id_kelas" class="form-control">
            <option value="">Pilih Kelas</option>
            <?php
                foreach($fungsi->kelas() as $d){ ?>
                    <option value="<?= $d['id_kelas']; ?>"><?= $d['nama_kelas']; ?></option>
             <?php   }
            ?>
            
        </select>
    </div>

    
        </div>
        <div class="col-6">
        <div class="form-group">
        <label>Alamat</label>
        <textarea name="alamat" class="form-control" rows="4"></textarea>
    </div>
    <div class="form-group">
        <label>No Telpon</label>
        <input type="text" name="no_telp" class="form-control">
    </div>
    <div class="form-group">
        <label>Tahun SPP</label>
        <select name="id_spp" class="form-control">
            <option value="">Pilih Tahun</option>
            <?php
                foreach($fungsi->tahun() as $d){ ?>
                    <option value="<?= $d['id_spp']; ?>">Tahun <?= $d['tahun']; ?> - Rp. <?= number_format($d['nominal'],2,',','.') ?></option>
             <?php   }
            ?>
            
        </select>
    </div>
        </div>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>