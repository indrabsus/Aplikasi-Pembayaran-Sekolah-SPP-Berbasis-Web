<div class="container">
    <div class="row">
        
        <div class="col-3">
        <div class="form-group">
        <a class="btn btn-primary" href="<?= $config['home']?>admin.php?page=formspp">Tambah Data</a>
    </div>
        </div>
        
                    
        <div class="col-3 ml-auto" >
                        <form action="admin.php?page=dataspp" method="get">
                        <div class="input-group">
                        <input type="text" name="spp" class="form-control" placeholder="Cari Tahun" autocomplete="off">
                        
                        <div class="input-group-append">
                        <button class="btn btn-dark" type="submit" name="cari" value="carispp">Cari</button>
                        </div>
                        </div>
                        </div>
                    </form>
                
    </div>
    <?php
            if(isset($_GET['status'])){
                if($_GET['status'] == 'inputberhasil') { ?>
                
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Sukses! </strong> Kamu berhasil Input Data SPP
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

            <?php    } elseif($_GET['status'] == 'editberhasil'){ ?>

<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Sukses! </strong> Kamu berhasil Edit Data SPP
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>



       <?php     } elseif ($_GET['status'] == 'berhasilhapus'){ ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Sukses! </strong> Kamu berhasil Hapus Data SPP
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
  <?php     } elseif($_GET['status'] == 'dataganda'){ ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Gagal! </strong> Terdeteksi Data Ganda
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
  <?php } elseif($_GET['status'] == 'errornumeric') { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Gagal! </strong> Terdeteksi ada error inputan harus menggunakan nomor
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php  }
            }

?>

<?php
$per_page = 5;
$halaman = isset($_GET['halaman']) ? $_GET['halaman'] : 1;
$datas = $fungsi->dataspp($halaman, $per_page);
$data_page = $datas['data'];
$total_halaman = $datas['total_halaman'];
$next = $datas['next'];
$previous = $datas['previous'];
$no = $datas['no'];

?>

    <table class="table table-bordered table-striped">
        <tr>
            <th>No</th>
            <th>Tahun</th>
            <th>Nominal</th>
            <th>Aksi</th>
        </tr>
        <?php $no=1; ?>
        <?php
        if ($data_page != null) {
            foreach ($data_page as $d) { ?>

                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $d['tahun']; ?></td>
                    <td>Rp.<?= number_format($d['nominal'],2,',','.'); ?></td>
                    <td><a class="btn btn-success btn-sm mb-1" href="admin.php?page=editspp&id_spp=<?= $d['id_spp']; ?>">Edit</a>
                    <a class="btn btn-danger btn-sm mb-1" href="admin.php?page=deletespp&id_spp=<?= $d['id_spp']; ?>" onclick="return confirm('Menghapus data ini sama dengan menghapus data siswa yang terhubung dengan tahun spp ini, apakah anda yakin?');">Hapus</a>
                </td>
                </tr>
         <?php }
        }
        
        ?>
        <tr>

        </tr>
    </table>
<div class="row pb-5" id="loginB">
    <div class="col-6">
    <nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item"><a class="page-link" href="<?= $halaman>1 ? $config['home'].'admin.php?page=dataspp&halaman='.$previous : "" ?>">Previous</a></li>
    <?php 
    for($x=1; $x <= $total_halaman; $x++){
        $link_active = ($halaman == $x) ? "page-item active" : "page-item";
    ?>
    <li class="page-item <?= $link_active; ?>"><a class="page-link" href="<?= $config['home'] . "admin.php?page=dataspp&halaman=$x";?>"><?= $x;?></a></li>
    
    <?php } ?>
    <li class="page-item"><a class="page-link" href="<?= $halaman<$total_halaman ? $config['home'].'admin.php?page=dataspp&halaman='.$next : "" ?>">Next</a></li>
  </ul>
</nav>
    </div>
</div>
</div>

