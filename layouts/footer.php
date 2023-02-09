<div class="pt-5">
<footer class="fixed-bottom mt-5">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
  <a class="text-light" href="<?= $config['home']; ?>">Copyright ©<?= date("Y"); ?> PPDB Sakuci</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">


<script type="text/javascript">document.write('\u003C\u0073\u0070\u0061\u006E\u0020\u0063\u006C\u0061\u0073\u0073\u003D\u0022\u006E\u0061\u0076\u0062\u0061\u0072\u002D\u0074\u006F\u0067\u0067\u006C\u0065\u0072\u002D\u0069\u0063\u006F\u006E\u0022\u003E\u003C\u002F\u0073\u0070\u0061\u006E\u003E\u000A\u0020\u0020\u003C\u002F\u0062\u0075\u0074\u0074\u006F\u006E\u003E\u000A\u0020\u0020\u003C\u0064\u0069\u0076\u0020\u0063\u006C\u0061\u0073\u0073\u003D\u0022\u0063\u006F\u006C\u006C\u0061\u0070\u0073\u0065\u0020\u006E\u0061\u0076\u0062\u0061\u0072\u002D\u0063\u006F\u006C\u006C\u0061\u0070\u0073\u0065\u0022\u0020\u0069\u0064\u003D\u0022\u006E\u0061\u0076\u0062\u0061\u0072\u004E\u0061\u0076\u0022\u003E\u000A\u0020\u0020\u0020\u0020\u003C\u0061\u0020\u0068\u0072\u0065\u0066\u003D\u0022\u0023\u0022\u0020\u0063\u006C\u0061\u0073\u0073\u003D\u0022\u0074\u0065\u0078\u0074\u002D\u006C\u0069\u0067\u0068\u0074\u0020\u006D\u006C\u002D\u0061\u0075\u0074\u006F\u0022\u003E\u0043\u0072\u0065\u0061\u0074\u0065\u0064\u0020\u0077\u0069\u0074\u0068');</script>
❤
<script type="text/javascript">document.write('\u0062\u0079\u0020\u0049\u006E\u0064\u0072\u0061\u0020\u0042\u0061\u0074\u0061\u0072\u0061\u003C\u002F\u0061\u003E\u000A\u0020\u0020\u003C\u002F\u0064\u0069\u0076\u003E\u000A\u0020\u0020\u003C\u002F\u0064\u0069\u0076\u003E\u000A\u003C\u002F\u006E\u0061\u0076\u003E');</script>

</footer>
</div>

<script src="<?= $config['home']?>js/jquery.slim.min.js"></script>
<script src="<?= $config['home']?>js/popper.min.js"></script>
<script src="<?= $config['home']?>js/bootstrap.min.js"></script>

<script>
setInterval(myTimer, 1000);

function myTimer() {
  const date = new Date();
  document.getElementById("jam").innerHTML = date.toLocaleTimeString();
}
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php
$data = $fungsi->grafik();   
?>
<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [<?php
          foreach($data as $d){
        $tgl_bayar = date('d M Y', strtotime($d['tgl_bayar']));
          echo "'".$tgl_bayar."'" .",";
          }
          
?>
],
      datasets: [{
        label: 'Pembayaran',
        data: [
          <?php
          foreach($data as $d){
          echo $d['jumlah_bayar'] . ",";
          }
          
?>
]
        ,
        borderWidth: 1
      }],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>

</body>
</html>