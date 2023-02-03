<div class="container">
    <div class="row">
        
        <div class="col-3">
        <div class="form-group">
        <a class="btn btn-primary" href="<?= $config['home']?>admin.php?page=formpetugas">Tambah Data</a>
    </div>
        </div>
        
                    
                        <div class="col-3" >
                        <form action="admin.php?page=datapetugas" method="get">
                        <input type="text" name="petugas" class="form-control" placeholder="Cari Nama Petugas" autocomplete="off">
                        </div>
                        <div class="col-3">
                        <button class="btn btn-primary" type="submit" name="cari" value="cari">Cari</button>
                        </div>
                        
                    </form>
                
    </div>
    <?php
            if(isset($_GET['status'])){
                if($_GET['status'] == 'inputberhasil') { ?>
                
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Sukses! </strong> Kamu berhasil Input Data Petugas
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

            <?php    } elseif($_GET['status'] == 'editberhasil'){ ?>

<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Sukses! </strong> Kamu berhasil Edit Data Petugas
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>



       <?php     } elseif ($_GET['status'] == 'berhasilhapus'){ ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Sukses! </strong> Kamu berhasil Hapus Data Petugas
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
  <?php     }
            }

?>

<?php
$per_page = 5;
$halaman = isset($_GET['halaman']) ? $_GET['halaman'] : 1;
$datas = $fungsi->petugas($halaman, $per_page);
$data_page = $datas['data'];
$total_halaman = $datas['total_halaman'];
$next = $datas['next'];
$previous = $datas['previous'];
$no = $datas['no'];

?>

    <table class="table table-bordered table-striped">
        <tr>
            <th>No</th>
            <th>Nama Petugas</th>
            <th>Username</th>
            <th>Level</th>
            <th>Aksi</th>
        </tr>
        <?php $no=1; ?>
        <?php
        if ($data_page != null) {
            foreach ($data_page as $d) { ?>

                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $d['nama_petugas']; ?></td>
                    <td><?= $d['username']; ?></td>
                    <td><?= ucwords($d['level']);?></td>
                    <td><a class="btn btn-success btn-sm mb-1" href="admin.php?page=editpetugas&id_petugas=<?= $d['id_petugas']; ?>">Edit</a>
                    <a class="btn btn-danger btn-sm mb-1" href="admin.php?page=deletePetugas&id_petugas=<?= $d['id_petugas']; ?>" onclick="return confirm('Apa anda yakin menghapus data ini?');">Hapus</a>
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
    <li class="page-item"><a class="page-link" href="<?= $halaman>1 ? $config['home'].'admin.php?page=datapetugas&halaman='.$previous : "" ?>">Previous</a></li>
    <?php 
    for($x=1; $x <= $total_halaman; $x++){
        $link_active = ($halaman == $x) ? "page-item active" : "page-item";
    ?>
    <li class="page-item <?= $link_active; ?>"><a class="page-link" href="<?= $config['home'] . "admin.php?page=datapetugas&halaman=$x";?>"><?= $x;?></a></li>
    
    <?php } ?>
    <li class="page-item"><a class="page-link" href="<?= $halaman<$total_halaman ? $config['home'].'admin.php?page=datapetugas&halaman='.$next : "" ?>">Next</a></li>
  </ul>
</nav>
    </div>
</div>
</div>

