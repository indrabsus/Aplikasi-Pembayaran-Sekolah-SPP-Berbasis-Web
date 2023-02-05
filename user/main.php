<?php
$data = $fungsi->dashboard();
$pendapatan = $data['jumlah'];
$siswa = $data['jml_siswa'];
$kelas = $data['jml_kelas'];
$angkatan = $data['jml_angkatan'];
$petugas = $data['jml_petugas'];
?>
<div class="container">
<div class="row justify-content-center">
<div class="col-4">
    <div class="card mt-4">
        <div class="card-header">Laporan</div>
        <div class="card-body">
        
        <p>Jumlah Siswa : <button type="button" class="btn btn-primary btn-sm">
  <span class="badge badge-light"><?= $siswa ?></span> Orang
  <span class="sr-only">unread messages</span>
</button></p>
        <hr>
        <p>Jumlah Kelas : <button type="button" class="btn btn-success btn-sm">
  <span class="badge badge-light"><?= $kelas ?></span> Kelas
  <span class="sr-only">unread messages</span>
</button></p>
        <hr>
        <p>Jumlah Angkatan : <button type="button" class="btn btn-warning btn-sm">
  <span class="badge badge-light"><?= $angkatan ?></span> Angkatan
  <span class="sr-only">unread messages</span>
</button></p>
        <hr>
        <p>Jumlah Petugas : <button type="button" class="btn btn-danger btn-sm">
  <span class="badge badge-light"><?= $petugas ?></span> Orang
  <span class="sr-only">unread messages</span>
</button></p>
        <hr>
        <p>Pendapatan Total : 
        <button type="button" class="btn btn-dark">Rp. 
  <span class="badge badge-light"><?= number_format($pendapatan, 2, ',', '.'); ?></span>
  <span class="sr-only">unread messages</span>
</button>
    </p>
    
        </div>
    </div>
    </div>
    <div class="col-8">
  <canvas id="myChart"></canvas>
</div>
</div>

</div>