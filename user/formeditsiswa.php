


<div class="container pb-5">
    <h1 class="mb-3">Form Edit Siswa</h1>
    <form action="<?= $config['home'] ?>admin.php?page=updatesiswa" method="post">
    <div class="row">
    <?php
$data = $fungsi->editSiswa($_GET['nisn']);
foreach($data as $d){ ?>
        <div class="col-6">
        <div class="form-group">
        <label>NISN</label>
        <input type="text" name="nisn" class="form-control" value="<?= $d['nisn'];?>">
    </div>
    <div class="form-group">
        <label>NIS</label>
        <input type="text" name="nis" class="form-control" value="<?= $d['nis'];?>">
    </div>
    <div class="form-group">
        <label>Nama Siswa</label>
        <input type="text" name="nama" class="form-control" value="<?= $d['nama'];?>">
    </div>
    <div class="form-group">
        <label>No Telepon</label>
        <input type="text" name="no_telp" class="form-control" value="<?= $d['no_telp'];?>">
    </div>
    

    
        </div>
        <div class="col-6">
        <div class="form-group">
        <label>Alamat</label>
        <textarea name="alamat" class="form-control" rows="4"><?= $d['alamat'];?></textarea>
    </div>
    <div class="form-group">
        <label>Kelas</label>
        <select name="id_kelas" class="form-control">
            <option value="<?= $d['id_kelas'];?>"><?= $d['nama_kelas'];?></option>
            <?php
                foreach($fungsi->kelas() as $k){ ?>
                    <option value="<?= $k['id_kelas']; ?>"><?= $k['nama_kelas']; ?></option>
             <?php   }
            ?>
            
        </select>
    </div>
    <div class="form-group">
        <label>Tahun SPP</label>
        <select name="id_spp" class="form-control">
            <option value="<?= $d['id_spp']; ?>"><?= $d['nominal']; ?></option>
            <?php
                foreach($fungsi->tahun() as $d){ ?>
                    <option value="<?= $d['id_spp']; ?>"><?= $d['nominal']; ?></option>
             <?php   }
            ?>
            
        </select>
    </div>
        </div>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php
}
?>
