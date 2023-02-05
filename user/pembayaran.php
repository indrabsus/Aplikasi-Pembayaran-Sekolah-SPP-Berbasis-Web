<?php
$data = $fungsi->editSiswa($_GET['nisn']);
$history = $fungsi->dataBayar($_GET['nisn']);
foreach ($data as $d) { ?>
<div class="container">
<?php
        if (isset($_GET['status'])) {
            if ($_GET['status'] == 'berhasilbayar') { ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Sukses! </strong> Kamu Berhasil Bayar SPP
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php } elseif($_GET['status']== 'dataganda'){ ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Gagal! </strong> Terdeteksi Data Ganda.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php } elseif($_GET['status'] == 'berhasilhapus'){ ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Sukses! </strong> Hapus data pembayaran berhasil
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php }
        }
?>
    <div class="row">
       
        <div class="col-4">
        <table class="table table-bordered">
        <tr>
            <td>NISN</td>
            <td><?= $d['nisn'];?></td>
        </tr>
        <tr>
            <td>NIS</td>
            <td><?= $d['nis'];?></td>
        </tr>
        <tr>
            <td>Nama Siswa</td>
            <td><?= $d['nama'];?></td>
        </tr>
        <tr>
            <td>Kelas</td>
            <td><?= $d['nama_kelas'];?></td>
        </tr>
    </table>

    <?php 
        if($_SESSION['data']['level'] == 'admin'){ ?>
            <form action="admin.php?page=ayobayar" method="post">
        <?php } elseif($_SESSION['data']['level'] == 'petugas'){ ?>
            <form action="petugas.php?page=ayobayar" method="post">
      <?php  }
        ?>
            <input type="text" value="<?= $d['nisn'];?>" name="nisn" hidden>
            <input type="text" name="tahun_dibayar" value="<?= $d['tahun'];?>" hidden>
            <input type="text" name="id_petugas" value="<?= $_SESSION['data']['id_petugas']; ?>" hidden>
            <input type="text" name="id_spp" value="<?= $d['id_spp']; ?>" hidden>
            <input type="text" name="jumlah_bayar" value="<?= $d['nominal']; ?>" hidden>
            <div class="form-group">
                <select name="bulan_dibayar" class="form-control" required>
                    <option value="">Pilih Opsi</option>
                    <option value="Januari">Januari</option>
                    <option value="Februari">Februari</option>
                    <option value="Maret">Maret</option>
                    <option value="April">April</option>
                    <option value="Mei">Mei</option>
                    <option value="Juni">Juni</option>
                    <option value="Juli">Juli</option>
                    <option value="Agustus">Agustus</option>
                    <option value="September">September</option>
                    <option value="Oktober">Oktober</option>
                    <option value="November">November</option>
                    <option value="Desember">Desember</option>
                </select>
            </div>
            <button type="submit" class="btn btn-dark" id="loginB">Bayar</button>
            </form>



        </div>
        <div class="col-8">
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Tanggal Bayar</th>
                    <th>Bulan Tahun SPP</th>
                    <th>Nominal</th>
                    <?php if($_SESSION['data']['level'] == 'admin'){
                        echo "<th>Aksi</th>";
                    }
                    
                    ?>
                </tr>
                <?php $no = 1;?>
                <?php
                if (isset($history)) {
                    foreach ($history as $h) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= date('d M Y', strtotime($h['tgl_bayar'])); ?></td>
                    <td><?= $h['bulan_dibayar'];?> <?= $h['tahun_dibayar'];?></td>
                    <td>Rp. <?= number_format($h['jumlah_bayar'],2,',','.');?></td>
                    <?php 
                    if($_SESSION['data']['level'] == 'admin'){ ?>
                        <td><a href="admin.php?page=deletebayar&nisn=<?= $h['nisn']; ?>&id_pembayaran=<?= $h['id_pembayaran']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apa anda yakin menghapus data ini?');">Hapus</a></td>
                  <?php  }
                    ?>
                </tr>
             <?php }
                }
                ?>
            </table>
        </div>
    </div>
</div>
<?php
} ?>