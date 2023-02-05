<?php
$per_page = 5;
$halaman = isset($_GET['halaman']) ? $_GET['halaman'] : 1;
$datas = $fungsi->laporan($halaman, $per_page);
$data_page = $datas['data'];
$total_halaman = $datas['total_halaman'];
$next = $datas['next'];
$previous = $datas['previous'];
$no = $datas['no'];

?>

<div class="container">
<div class="row">
        
                    
        <div class="col-3 ml-auto mb-1" >
                        <form action="admin.php?page=laporan" method="get">
                        <div class="input-group">
                        <input type="date" name="laporan" class="form-control" autocomplete="off">
                        
                        <div class="input-group-append">
                        <button class="btn btn-dark" type="submit" name="cari" value="carilaporan">Cari</button>
                        </div>
                        </div>
                        </form>
                        </div>
                   
                
    </div>
    <table class="table table-striped table-bordered">
        <tr>
            <td>No</td>
            <td>NISN</td>
            <td>Nama Siswa</td>
            <td>Tanggal Bayar</td>
            <td>Bulan Tahun SPP</td>
            <td>Nominal</td>
        </tr>
        <?php $no=1; ?>
        <?php 
            if(isset($data_page)){
                foreach($data_page as $d){ ?>
            <tr>
                <td><?= $no++;?></td>
                <td><?= $d['nisn'];?></td>
                <td><?= $d['nama'];?></td>
                <td><?= date('d F Y', strtotime($d['tgl_bayar']));?></td>
                <td><?= $d['bulan_dibayar'];?> <?= $d['tahun_dibayar'];?></td>
                <td>Rp. <?= number_format($d['jumlah_bayar'],2,',','.');?></td>
            </tr>
          <?php      }
            }
        ?>
    </table>
    <div class="row pb-5" id="loginB">
    <div class="col-6">
    <nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item"><a class="page-link" href="<?= $halaman>1 ? $config['home'].'admin.php?page=laporan&halaman='.$previous : "" ?>">Previous</a></li>
    <?php 
    for($x=1; $x <= $total_halaman; $x++){
        $link_active = ($halaman == $x) ? "page-item active" : "page-item";
    ?>
    <li class="page-item <?= $link_active; ?>"><a class="page-link" href="<?= $config['home'] . "admin.php?page=laporan&halaman=$x";?>"><?= $x;?></a></li>
    
    <?php } ?>
    <li class="page-item"><a class="page-link" href="<?= $halaman<$total_halaman ? $config['home'].'admin.php?page=laporan&halaman='.$next : "" ?>">Next</a></li>
  </ul>
</nav>
    </div>
</div>
</div>