<?php
$data = $fungsi->history($_SESSION['data']['nisn']);
?>

<div class="container">
    <h3 class="mb-3">History Pembayaran</h3>
<table class="table table-striped table-bordered">
    <tr>
        <th>NISN</th>
        <th>Nama</th>
        <th>Tanggal Bayar</th>
        <th>Bulan Tahun SPP</th>
        <th>Nominal</th>
        <th>Petugas</th>
</tr>
  <?php
  if ($data != null) {
      foreach ($data as $d) { ?>
    <tr>
        <td><?= $d['nisn']; ?></td>
        <td><?= $d['nama']; ?></td>
        <td><?= date('d F Y', strtotime($d['tgl_bayar'])); ?></td>
        <td><?= $d['bulan_dibayar']; ?> <?= $d['tahun_dibayar']; ?></td>
        <td>Rp. <?= number_format($d['jumlah_bayar'], 2, ',', '.'); ?></td>
        <td><?= $d['nama_petugas']; ?></td>
    </tr>
    <?php }
  }
    ?>
</table>

</div>


